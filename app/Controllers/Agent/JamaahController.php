<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookingModel;

class JamaahController extends BaseController
{
    protected $userModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
    }

    /**
     * List all jamaah who have booked this agent's packages
     */
    public function index()
    {
        $agentId = session()->get('travel_agent_id');
        $search  = $this->request->getGet('search');
        $package = $this->request->getGet('package');
        $status  = $this->request->getGet('status');
        
        $query = $this->userModel
            ->select('users.*, bookings.status as booking_status, paket_umroh.nama_paket')
            ->join('bookings', 'bookings.user_id = users.id')
            ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
            ->where('paket_umroh.travel_agent_id', $agentId);

        if (!empty($search)) {
            $query->like('users.name', $search);
        }
        if (!empty($package)) {
            $query->where('bookings.package_id', $package);
        }
        if (!empty($status)) {
            $query->where('bookings.status', $status);
        }

        $jamaah = $query->groupBy('users.id')->findAll();

        // Get agent's packages for filter dropdown
        $packages = (new \App\Models\PackageModel())->where('travel_agent_id', $agentId)->findAll();

        $data = [
            'jamaah'   => $jamaah,
            'packages' => $packages,
            'search'   => $search,
            'package_id' => $package,
            'status'   => $status,
        ];

        return view('agent/jamaah/index', $data);
    }

    public function edit($id)
    {
        $agentId = session()->get('travel_agent_id');
        
        // Ensure this jamaah actually has a booking with this agent
        $check = $this->bookingModel
            ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
            ->where('bookings.user_id', $id)
            ->where('paket_umroh.travel_agent_id', $agentId)
            ->first();

        if (!$check) {
            return redirect()->to('/agent/jamaah')->with('error', 'Data jamaah tidak ditemukan.');
        }

        $user = $this->userModel->find($id);
        return view('agent/jamaah/form', ['user' => $user]);
    }

    public function update($id)
    {
        $agentId = session()->get('travel_agent_id');
        
        // Security check
        $check = $this->bookingModel
            ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
            ->where('bookings.user_id', $id)
            ->where('paket_umroh.travel_agent_id', $agentId)
            ->first();

        if (!$check) return redirect()->to('/agent/jamaah');

        $this->userModel->update($id, [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/agent/jamaah')->with('success', 'Data jamaah berhasil diperbarui.');
    }
}
