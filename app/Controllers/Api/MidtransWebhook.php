<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PackageModel;
use CodeIgniter\API\ResponseTrait;

class MidtransWebhook extends BaseController
{
    use ResponseTrait;

    /**
     * Handle Midtrans payment notification webhook.
     *
     * When status is 'settlement':
     * 1. Update booking status to 'lunas'
     * 2. Decrement available_seat on the package
     * 3. Trigger email notifications (E-Tiket to user, booking alert to agent)
     */
    public function handle()
    {
        $payload = $this->request->getJSON(true);

        if (empty($payload)) {
            return $this->fail('Invalid payload.', 400);
        }

        $transactionStatus = $payload['transaction_status'] ?? '';
        $orderId           = $payload['order_id'] ?? '';
        $transactionId     = $payload['transaction_id'] ?? '';
        $paymentType       = $payload['payment_type'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? 'accept';

        // Validate server key signature (recommended for production)
        $serverKey   = env('MIDTRANS_SERVER_KEY', '');
        $signKey     = $payload['signature_key'] ?? '';
        $statusCode  = $payload['status_code'] ?? '';
        $grossAmount = $payload['gross_amount'] ?? '';

        if (!empty($serverKey)) {
            $expectedSignature = hash('sha512',
                $orderId . $statusCode . $grossAmount . $serverKey
            );

            if ($signKey !== $expectedSignature) {
                log_message('error', "Midtrans Webhook: Invalid signature for order {$orderId}");
                return $this->fail('Invalid signature.', 403);
            }
        }

        // Find booking by order_id (which maps to booking_code)
        $bookingModel = new BookingModel();
        $booking = $bookingModel->where('booking_code', $orderId)->first();

        if (!$booking) {
            log_message('error', "Midtrans Webhook: Booking not found for order_id={$orderId}");
            return $this->fail('Booking not found.', 404);
        }

        // Handle transaction status
        if (($transactionStatus === 'capture' && $fraudStatus === 'accept') ||
            $transactionStatus === 'settlement') {

            // 1. Update booking status to 'lunas'
            $bookingModel->update($booking['id'], [
                'status'                  => 'lunas',
                'midtrans_transaction_id' => $transactionId,
                'payment_type'            => $paymentType,
                'paid_at'                 => date('Y-m-d H:i:s'),
            ]);

            // 2. Decrement available_seat
            $packageModel = new PackageModel();
            $packageModel->decrementSeat($booking['package_id']);

            // 3. Send email notifications
            $this->sendSettlementNotifications($booking, $transactionId);

            log_message('info', "Midtrans Webhook: Booking {$orderId} settled successfully.");

        } elseif ($transactionStatus === 'cancel' || $transactionStatus === 'deny' || $transactionStatus === 'expire') {

            $bookingModel->update($booking['id'], [
                'status'                  => 'cancelled',
                'midtrans_transaction_id' => $transactionId,
            ]);

            log_message('info', "Midtrans Webhook: Booking {$orderId} cancelled/denied/expired.");

        } elseif ($transactionStatus === 'pending') {
            log_message('info', "Midtrans Webhook: Booking {$orderId} is pending.");
        }

        return $this->respond(['status' => 'ok']);
    }

    /**
     * Send email notifications after successful payment
     */
    private function sendSettlementNotifications(array $booking, string $transactionId): void
    {
        $email = \Config\Services::email();

        // Check if email is configured
        $smtpHost = env('email.SMTPHost', '');
        if (empty($smtpHost)) {
            log_message('warning', 'Midtrans Webhook: SMTP not configured, skipping email notifications.');
            return;
        }

        // Get user details
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($booking['user_id']);

        // Get package details
        $packageModel = new PackageModel();
        $package = $packageModel->getById($booking['package_id']);

        if (!$user || !$package) {
            log_message('error', 'Midtrans Webhook: User or package not found for email notification.');
            return;
        }

        // --- Email to User (E-Tiket) ---
        try {
            $email->setFrom(env('email.fromEmail', 'noreply@umrohqueens.com'), 'UmrohQueens');
            $email->setTo($user['email']);
            $email->setSubject('E-Tiket Umroh - ' . $booking['booking_code']);
            $email->setMessage(view('emails/e_ticket', [
                'user'          => $user,
                'booking'       => $booking,
                'package'       => $package,
                'transactionId' => $transactionId,
            ]));
            $email->send();
            $email->clear();
        } catch (\Exception $e) {
            log_message('error', 'Email to user failed: ' . $e->getMessage());
        }

        // --- Email to Agent (Booking Notification) ---
        if (!empty($package['travel_phone'])) {
            $agentModel = new \App\Models\TravelAgentModel();
            $agent = $agentModel->find($package['travel_agent_id']);

            if ($agent && !empty($agent['email'])) {
                try {
                    $email->setFrom(env('email.fromEmail', 'noreply@umrohqueens.com'), 'UmrohQueens');
                    $email->setTo($agent['email']);
                    $email->setSubject('Booking Baru - ' . $booking['booking_code']);
                    $email->setMessage(view('emails/agent_booking_notification', [
                        'agent'   => $agent,
                        'user'    => $user,
                        'booking' => $booking,
                        'package' => $package,
                    ]));
                    $email->send();
                    $email->clear();
                } catch (\Exception $e) {
                    log_message('error', 'Email to agent failed: ' . $e->getMessage());
                }
            }
        }
    }
}
