<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PackageModel;
use App\Models\UserModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $packageModel;
    protected $userModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->packageModel = new PackageModel();
        $this->userModel    = new UserModel();
    }

    public function index()
    {
        $agentId = session()->get('travel_agent_id');
        $data = [
            'bookings' => $this->bookingModel->getAgentBookings($agentId),
        ];

        return view('agent/bookings/index', $data);
    }

    public function create()
    {
        $agentId = session()->get('travel_agent_id');
        $data = [
            'packages' => $this->packageModel->where('travel_agent_id', $agentId)->findAll(),
            'users'    => $this->userModel->where('role', 'jamaah')->findAll(),
        ];
        return view('agent/bookings/form', $data);
    }

    public function store()
    {
        $packageId = $this->request->getPost('package_id');
        $package   = $this->packageModel->find($packageId);
        
        if (!$package) return redirect()->back()->with('error', 'Paket tidak valid.');

        $data = [
            'user_id'      => $this->request->getPost('user_id'),
            'package_id'   => $packageId,
            'booking_code' => 'BK-OFF-' . strtoupper(substr(md5(uniqid()), 0, 6)),
            'total_price'  => $package['harga_jual'],
            'status'       => $this->request->getPost('status'),
            'notes'        => 'Manual booking by Agent',
        ];

        $this->bookingModel->insert($data);
        return redirect()->to('/agent/bookings')->with('success', 'Booking berhasil dibuat.');
    }

    public function edit($id)
    {
        $agentId = session()->get('travel_agent_id');
        $booking = $this->bookingModel->find($id);

        if (!$booking) return redirect()->to('/agent/bookings')->with('error', 'Booking tidak ditemukan.');

        $data = [
            'booking'  => $booking,
            'packages' => $this->packageModel->where('travel_agent_id', $agentId)->findAll(),
            'users'    => $this->userModel->where('role', 'jamaah')->findAll(),
        ];
        return view('agent/bookings/form', $data);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');
        $this->bookingModel->update($id, ['status' => $status]);

        return redirect()->to('/agent/bookings')->with('success', 'Status booking berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->bookingModel->delete($id);
        return redirect()->to('/agent/bookings')->with('success', 'Booking berhasil dihapus.');
    }
}
