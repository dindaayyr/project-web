<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PackageModel;
use App\Models\DocumentModel;

class DashboardController extends BaseController
{
    protected $bookingModel;
    protected $packageModel;
    protected $docModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->packageModel = new PackageModel();
        $this->docModel     = new DocumentModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $bookings = $this->bookingModel->getUserBookings($userId);

        // Calculate summary
        $totalSpent = array_sum(array_column($bookings, 'total_price'));
        $activeBookings = count(array_filter($bookings, fn($b) => in_array($b['payment_status'], ['pending', 'success'])));

        // Get recommended packages (exclude ones user already booked)
        $bookedPackageIds = array_column($bookings, 'package_id');
        $recommended = $this->packageModel
            ->select('paket_umroh.*, travel_agents.name as travel_name')
            ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
            ->where('paket_umroh.status', 'active');

        if (!empty($bookedPackageIds)) {
            $recommended->whereNotIn('paket_umroh.id_paket', $bookedPackageIds);
        }

        $recommended = $recommended->orderBy('paket_umroh.id_paket', 'DESC')
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
        $userId = session()->get('user_id');
        $data = [
            'docs' => $this->docModel->getByUser($userId)
        ];
        return view('user/documents', $data);
    }

    public function uploadDocuments()
    {
        $userId = session()->get('user_id');
        $files = $this->request->getFiles();

        if ($files) {
            foreach ($files as $type => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    // Define folder and name
                    $newName = $userId . '_' . $type . '_' . $file->getRandomName();
                    $file->move(FCPATH . 'uploads/documents', $newName);
                    
                    $filePath = 'uploads/documents/' . $newName;

                    // Check if already exists
                    $existing = $this->docModel->where('user_id', $userId)->where('doc_type', $type)->first();
                    
                    if ($existing) {
                        $this->docModel->update($existing['id'], [
                            'file_path' => $filePath,
                            'status'    => 'pending',
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    } else {
                        $this->docModel->insert([
                            'user_id'   => $userId,
                            'doc_type'  => $type,
                            'file_path' => $filePath,
                            'status'    => 'pending'
                        ]);
                    }
                }
            }
            return redirect()->to('/user/documents')->with('success', 'Dokumen berhasil diunggah dan sedang menunggu verifikasi.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah dokumen.');
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
