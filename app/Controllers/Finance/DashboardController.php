<?php

namespace App\Controllers\Finance;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\DisbursementModel;
use App\Libraries\MidtransLib;

class DashboardController extends BaseController
{
    private const COMMISSION_RATE = 5.00;

    public function index()
    {
        $bookingModel = new BookingModel();
        $disbursementModel = new DisbursementModel();

        $settledBookings = $bookingModel->getSettledBookings();
        $allDisbursements = $disbursementModel->getAll();

        // Summary stats
        $totalSettled     = count($settledBookings);
        $totalAmount      = array_sum(array_column($settledBookings, 'total_price'));
        $totalDisbursed   = count(array_filter($allDisbursements, fn($d) => $d['status'] === 'completed'));
        $pendingDisburse  = count(array_filter($allDisbursements, fn($d) => $d['status'] === 'pending' || $d['status'] === 'ready'));

        $data = [
            'totalSettled'    => $totalSettled,
            'totalAmount'     => $totalAmount,
            'totalDisbursed'  => $totalDisbursed,
            'pendingDisburse' => $pendingDisburse,
            'recentBookings'  => array_slice($settledBookings, 0, 10),
        ];

        return view('finance/dashboard', $data);
    }

    public function transactions()
    {
        $bookingModel = new BookingModel();
        $commissionRate = self::COMMISSION_RATE;

        // Get settled bookings with full details
        $settledBookings = $bookingModel->getSettledWithDetails();

        // Build enriched list with H-14 check and commission calc
        $transactionList = [];
        $totalWaiting = 0;
        $totalReady = 0;

        foreach ($settledBookings as $booking) {
            $grossAmount      = (float)$booking['total_price'];
            $commissionAmount = round($grossAmount * ($commissionRate / 100), 2);
            $netToAgent       = $grossAmount - $commissionAmount;
            $netProfitPlatform = $commissionAmount;

            // H-14 check
            $departureDate = $booking['tanggal_berangkat'] ?? null;
            $isH14Ready = false;
            $daysUntilDeparture = null;

            if ($departureDate) {
                $today = new \DateTime();
                $departure = new \DateTime($departureDate);
                $diff = $today->diff($departure);
                $daysUntilDeparture = $diff->invert ? 0 : $diff->days;
                $isH14Ready = ($daysUntilDeparture <= 14);
            }

            $settlementStatus = $booking['settlement_status'] ?? 'pending';

            if ($settlementStatus === 'pending') {
                $totalWaiting++;
                if ($isH14Ready) {
                    $totalReady++;
                }
            }

            $transactionList[] = [
                'booking'            => $booking,
                'gross_amount'       => $grossAmount,
                'commission_rate'    => $commissionRate,
                'commission_amount'  => $commissionAmount,
                'net_to_agent'       => $netToAgent,
                'net_profit_platform' => $netProfitPlatform,
                'is_h14_ready'       => $isH14Ready,
                'days_until_departure' => $daysUntilDeparture,
                'settlement_status'  => $settlementStatus,
            ];
        }

        $data = [
            'transactionList' => $transactionList,
            'commissionRate'  => $commissionRate,
            'totalWaiting'    => $totalWaiting,
            'totalReady'      => $totalReady,
            'totalAll'        => count($transactionList),
        ];

        return view('finance/transactions', $data);
    }

    /**
     * Refresh transaction status from Midtrans API
     */
    public function refreshStatus($bookingId)
    {
        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        try {
            $midtrans = new MidtransLib();
            $status = $midtrans->getTransactionStatus($booking['order_id']);

            $newStatus = $booking['payment_status'];
            if ($status->transaction_status === 'settlement' || $status->transaction_status === 'capture') {
                $newStatus = 'success';
            } elseif ($status->transaction_status === 'pending') {
                $newStatus = 'pending';
            } elseif (in_array($status->transaction_status, ['deny', 'cancel', 'expire'])) {
                $newStatus = 'failed';
            }

            $bookingModel->update($bookingId, [
                'payment_status' => $newStatus,
                'payment_method' => $status->payment_type ?? $booking['payment_method'],
            ]);

            return redirect()->back()->with('success', "Status Order {$booking['order_id']} diperbarui menjadi: " . ucfirst($newStatus));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal sinkronisasi: ' . $e->getMessage());
        }
    }
}
