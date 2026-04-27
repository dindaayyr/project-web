<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PackageModel;

class DashboardController extends BaseController
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
        $userId = session()->get('user_id');

        $bookings = $this->bookingModel->getUserBookings($userId);

        // Calculate summary
        $totalSpent = array_sum(array_column($bookings, 'total_price'));
        $activeBookings = count(array_filter($bookings, fn($b) => in_array($b['status'], ['pending', 'verified'])));

        // Get recommended packages (exclude ones user already booked)
        $bookedPackageIds = array_column($bookings, 'package_id');
        $recommended = $this->packageModel
            ->select('packages.*, travel_agents.name as travel_name')
            ->join('travel_agents', 'travel_agents.id = packages.travel_agent_id')
            ->where('packages.status', 'active');

        if (!empty($bookedPackageIds)) {
            $recommended->whereNotIn('packages.id', $bookedPackageIds);
        }

        $recommended = $recommended->orderBy('packages.is_featured', 'DESC')
                                   ->limit(3)
                                   ->find();

        $data = [
            'bookings'       => $bookings,
            'totalSpent'     => $totalSpent,
            'activeBookings' => $activeBookings,
            'recommended'    => $recommended,
        ];

        return view('user/dashboard', $data);
    }

    public function bookings()
    {
        $userId = session()->get('user_id');

        $data = [
            'bookings' => $this->bookingModel->getUserBookings($userId),
        ];

        return view('user/bookings', $data);
    }

    public function documents()
    {
        return view('user/documents');
    }

    public function payments()
    {
        $userId = session()->get('user_id');

        $data = [
            'bookings' => $this->bookingModel->getUserBookings($userId),
        ];

        return view('user/payments', $data);
    }
}
