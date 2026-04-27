<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Travel extends BaseController
{
    public function index()
    {
        // Nantinya di sini ambil data dari TravelModel
        return view('admin/travel/index');
    }

    public function approve($id)
    {
        // Logika update status ke 'active'
        return redirect()->back()->with('success', 'Travel Agent berhasil diverifikasi.');
    }
}