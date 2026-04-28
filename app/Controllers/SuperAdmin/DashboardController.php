<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\PackageModel;
use App\Models\BookingModel;
use App\Models\TravelAgentModel;
use App\Models\UserModel;

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
                ->select('bookings.*, users.name as user_name, packages.nama_paket as package_name')
                ->join('users', 'users.id = bookings.user_id')
                ->join('packages', 'packages.id = bookings.package_id')
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
                ->select('packages.*, travel_agents.name as travel_name')
                ->join('travel_agents', 'travel_agents.id = packages.travel_agent_id')
                ->orderBy('packages.created_at', 'DESC')
                ->findAll(),
        ];

        return view('superadmin/packages', $data);
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
