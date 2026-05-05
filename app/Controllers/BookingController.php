<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PackageModel;
use App\Libraries\MidtransLib;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $packageModel;
    protected $midtrans;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->packageModel = new PackageModel();
        $this->midtrans     = new MidtransLib();
    }

    /**
     * Show checkout form
     */
    public function checkout($packageId)
    {
        $package = $this->packageModel->getById($packageId);

        if (!$package) {
            return redirect()->to('/katalog')->with('error', 'Paket tidak ditemukan.');
        }

        if ($package['available_seat'] <= 0) {
            return redirect()->back()->with('error', 'Mohon maaf, kuota paket ini sudah penuh.');
        }

        $data = [
            'package'   => $package,
            'pageTitle' => 'Checkout - ' . $package['nama_paket']
        ];

        return view('booking/checkout', $data);
    }

    /**
     * Process booking and get Snap Token
     */
    public function store()
    {
        $packageId = $this->request->getPost('package_id');
        log_message('info', 'BookingController::store: Processing for package ' . $packageId);
        
        $package   = $this->packageModel->getById($packageId);

        if (!$package || $package['available_seat'] <= 0) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Paket tidak tersedia atau kuota penuh.']);
        }
        $orderId = 'UQ-' . time() . '-' . rand(100, 999);
        $totalPrice = (float)$package['harga_jual'];

        $bookingData = [
            'order_id'        => $orderId,
            'package_id'      => $packageId,
            'user_id'         => session()->get('user_id'),
            'travel_agent_id' => $package['travel_agent_id'],
            'jamaah_name'     => $this->request->getPost('nama_lengkap'),
            'jamaah_email'    => $this->request->getPost('email'),
            'jamaah_phone'    => $this->request->getPost('no_hp'),
            'total_price'     => $totalPrice,
            'payment_status'  => 'pending'
        ];

        try {
            // Save to DB first
            $this->bookingModel->insert($bookingData);

            // Prepare Midtrans Params
            $params = [
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $bookingData['jamaah_name'],
                    'email'      => $bookingData['jamaah_email'],
                    'phone'      => $bookingData['jamaah_phone'],
                ],
                'item_details' => [
                    [
                        'id'       => $packageId,
                        'price'    => $totalPrice,
                        'quantity' => 1,
                        'name'     => substr($package['nama_paket'], 0, 50),
                    ]
                ]
            ];

            log_message('info', 'BookingController::store: Getting Snap Token for ' . $orderId);
            
            // Check if keys are placeholders
            $serverKey = env('MIDTRANS_SERVER_KEY');
            if (empty($serverKey) || strpos($serverKey, 'YOUR_SERVER_KEY_HERE') !== false) {
                log_message('error', 'BookingController::store: Midtrans Server Key is not configured correctly in .env');
                return $this->response->setJSON(['status' => 'error', 'message' => 'Sistem pembayaran belum dikonfigurasi. Mohon hubungi admin untuk mengisi API Key Midtrans di file .env.']);
            }

            try {
                $snapToken = $this->midtrans->getSnapToken($params);
                log_message('info', 'BookingController::store: Snap Token received: ' . $snapToken);
            } catch (\Exception $me) {
                log_message('error', 'BookingController::store: Midtrans Error: ' . $me->getMessage());
                return $this->response->setJSON(['status' => 'error', 'message' => 'Midtrans Error: ' . $me->getMessage()]);
            }

            // Update Snap Token in DB
            $this->bookingModel->where('order_id', $orderId)->set(['snap_token' => $snapToken])->update();

            return $this->response->setJSON([
                'status'     => 'success',
                'snap_token' => $snapToken,
                'order_id'   => $orderId
            ]);

        } catch (\Exception $e) {
            log_message('error', 'BookingController::store: ' . $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memproses pembayaran. ' . $e->getMessage()]);
        }
    }

    /**
     * Midtrans Notification Handler (Webhook)
     */
    public function notification()
    {
        try {
            $notif = $this->midtrans->getNotification();

            $transaction = $notif->transaction_status;
            $type        = $notif->payment_type;
            $orderId     = $notif->order_id;
            $fraud       = $notif->fraud_status;

            $booking = $this->bookingModel->where('order_id', $orderId)->first();
            if (!$booking) {
                return $this->response->setStatusCode(404, 'Booking not found');
            }

            $updateData = [
                'payment_method'   => $type,
                'transaction_time' => $notif->transaction_time,
            ];

            if ($transaction == 'settlement') {
                $updateData['payment_status'] = 'success';
                
                // AUTO UPDATE DATABASE LOGIC
                // 1. Update available seat and jumlah_jamaah
                $this->packageModel->decrementSeat($booking['package_id']);
                
                // 2. Send email notification (placeholder logic)
                $this->sendEmailNotification($booking);

            } else if ($transaction == 'pending') {
                $updateData['payment_status'] = 'pending';
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $updateData['payment_status'] = 'failed';
            }

            $this->bookingModel->where('order_id', $orderId)->set($updateData)->update();

            return $this->response->setJSON(['status' => 'success']);

        } catch (\Exception $e) {
            log_message('error', 'BookingController::notification: ' . $e->getMessage());
            return $this->response->setStatusCode(500, $e->getMessage());
        }
    }

    private function sendEmailNotification($booking)
    {
        // Placeholder for email notification logic
        // In real app, use CI4 Email Library
        log_message('info', 'Email sent to ' . $booking['jamaah_email'] . ' for order ' . $booking['order_id']);
    }

    public function success()
    {
        return view('booking/success');
    }

    public function pending()
    {
        return view('booking/pending');
    }

    public function failed()
    {
        return view('booking/failed');
    }
}
