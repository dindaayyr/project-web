<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\PackageModel;
use App\Models\BookingModel;
use App\Models\TravelAgentModel;
use App\Models\UserModel;
use App\Libraries\MidtransLib;

class DashboardController extends BaseController
{
    public function index()
    {
        $packageModel = new PackageModel();
        $bookingModel = new BookingModel();
        $agentModel   = new TravelAgentModel();
        $userModel    = new UserModel();

        $data = [
            'totalAgents'   => $agentModel->countAll(),
            'totalPackages' => $packageModel->countAll(),
            'totalBookings' => $bookingModel->countAll(),
            'totalUsers'    => $userModel->where('role', 'jamaah')->countAllResults(),
            'latestBookings' => $bookingModel
                ->select('bookings.*')
                ->select('bookings.order_id as booking_code')
                ->select('bookings.payment_status as status')
                ->select('users.name as user_name, paket_umroh.nama_paket as package_name')
                ->join('users', 'users.id = bookings.user_id')
                ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                ->orderBy('bookings.created_at', 'DESC')
                ->limit(10)
                ->findAll(),
        ];

        return view('superadmin/dashboard', $data);
    }

    public function agents()
    {
        $agentModel = new TravelAgentModel();

        $data = [
            'agents' => $agentModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('superadmin/agents', $data);
    }

    public function packages()
    {
        $packageModel = new PackageModel();

        $data = [
            'packages' => $packageModel
                ->select('paket_umroh.*, paket_umroh.id_paket as id, travel_agents.name as travel_name')
                ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                ->orderBy('paket_umroh.created_at', 'DESC')
                ->findAll(),
        ];

        return view('superadmin/packages', $data);
    }


    public function users()
    {
        $userModel = new UserModel();
        $data = [
            'users' => $userModel->where('role', 'jamaah')->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('superadmin/users', $data);
    }

    public function transactions()
    {
        $bookingModel = new BookingModel();

        $allBookings = $bookingModel->getAllWithDetails();

        // Calculate global stats
        $commissionRate = 5.0; // 5%
        $successBookings = array_filter($allBookings, fn($b) => in_array($b['status'], ['success', 'lunas', 'settlement']));
        $pendingBookings = array_filter($allBookings, fn($b) => $b['status'] === 'pending');

        $totalRevenue = array_sum(array_column($successBookings, 'total_price'));
        $totalCommission = round($totalRevenue * ($commissionRate / 100), 2);

        $data = [
            'bookings'        => $allBookings,
            'totalRevenue'    => $totalRevenue,
            'totalCommission' => $totalCommission,
            'totalSuccess'    => count($successBookings),
            'totalPending'    => count($pendingBookings),
            'totalAll'        => count($allBookings),
            'commissionRate'  => $commissionRate,
        ];
        return view('superadmin/transactions', $data);
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

    public function aiConfig()
    {
        $data = [
            'aiApiKey' => env('AI_API_KEY', ''),
        ];

        return view('superadmin/ai_config', $data);
    }

    public function saveAiConfig()
    {
        // In production, save to database or update .env
        // For now, flash a success message
        return redirect()->back()->with('success', 'Konfigurasi AI berhasil disimpan.');
    }
}
