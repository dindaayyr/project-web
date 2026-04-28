<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\PackageModel;
use App\Models\BookingModel;
use App\Models\DisbursementModel;

class DashboardController extends BaseController
{
    protected $packageModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $agentId = session()->get('travel_agent_id');

        $packages = $this->packageModel->getByAgent($agentId);
        $bookings = $this->bookingModel->getAgentBookings($agentId);

        // Summary stats
        $totalPackages   = count($packages);
        $activePackages  = count(array_filter($packages, fn($p) => $p['status'] === 'active'));
        $totalBookings   = count($bookings);
        $totalRevenue    = array_sum(array_column(
            array_filter($bookings, fn($b) => $b['status'] === 'lunas'),
            'total_price'
        ));

        $data = [
            'packages'       => $packages,
            'bookings'       => array_slice($bookings, 0, 10), // latest 10
            'totalPackages'  => $totalPackages,
            'activePackages' => $activePackages,
            'totalBookings'  => $totalBookings,
            'totalRevenue'   => $totalRevenue,
        ];

        return view('agent/dashboard', $data);
    }

    public function bookings()
    {
        $agentId = session()->get('travel_agent_id');

        $data = [
            'bookings' => $this->bookingModel->getAgentBookings($agentId),
        ];

        return view('agent/bookings', $data);
    }

    public function disbursements()
    {
        $agentId = session()->get('travel_agent_id');
        $disbursementModel = new DisbursementModel();

        $data = [
            'disbursements' => $disbursementModel->getByAgent($agentId),
        ];

        return view('agent/disbursements', $data);
    }
}
