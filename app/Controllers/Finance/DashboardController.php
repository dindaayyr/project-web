<?php

namespace App\Controllers\Finance;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\DisbursementModel;

class DashboardController extends BaseController
{
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

        $data = [
            'bookings' => $bookingModel->getSettledBookings(),
        ];

        return view('finance/transactions', $data);
    }
}
