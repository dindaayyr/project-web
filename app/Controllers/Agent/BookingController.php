<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PackageModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $packageModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->packageModel = new PackageModel();
    }

    public function index()
    {
        $agentId = session()->get('travel_agent_id');
        
        // Ensure agent only sees their own bookings
        if (!$agentId) {
            return redirect()->to('/login')->with('error', 'Silakan login sebagai agen.');
        }

        $data = [
            'bookings'  => $this->bookingModel->getAgentBookings($agentId),
            'pageTitle' => 'Manajemen Booking | Agent Dashboard'
        ];

        return view('agent/bookings/index', $data);
    }

    /**
     * Agent can view details but cannot change payment status (handled by system/admin)
     */
    public function detail($id)
    {
        $agentId = session()->get('travel_agent_id');
        $booking = $this->bookingModel->find($id);

        if (!$booking || $booking['travel_agent_id'] != $agentId) {
            return redirect()->to('/agent/bookings')->with('error', 'Booking tidak ditemukan.');
        }

        $data = [
            'booking'   => $booking,
            'package'   => $this->packageModel->find($booking['package_id']),
            'pageTitle' => 'Detail Booking ' . $booking['order_id']
        ];

        return view('agent/bookings/detail', $data);
    }
}
