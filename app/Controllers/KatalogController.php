<?php

namespace App\Controllers;

use App\Models\PackageModel;

class KatalogController extends BaseController
{
    public function index()
    {
        $filters = [
            'min_price'      => $this->request->getGet('min_price'),
            'max_price'      => $this->request->getGet('max_price'),
            'duration'       => $this->request->getGet('duration'),
            'hotel_star'     => $this->request->getGet('hotel_star'),
            'airline'        => $this->request->getGet('airline'),
            'departure_city' => $this->request->getGet('departure_city'),
            'sort_by'        => $this->request->getGet('sort_by') ?? 'popular',
        ];

        $packages = [];

        try {
            $packageModel = new PackageModel();
            $packages = $packageModel->getFiltered($filters);
        } catch (\Exception $e) {
            log_message('warning', 'KatalogController: Database not available - ' . $e->getMessage());
        }

        $data = [
            'packages'  => $packages,
            'filters'   => $filters,
            'pageTitle' => 'Katalog Paket Umroh | UmrohQueens'
        ];

        return view('katalog/index', $data);
    }

    public function detail($id)
    {
        try {
            $packageModel = new PackageModel();
            $package = $packageModel->getById($id);

            if (!$package) {
                return redirect()->to('/katalog')->with('error', 'Paket tidak ditemukan.');
            }

            $data = [
                'package'   => $package,
                'pageTitle' => $package['nama_paket'] . ' | UmrohQueens'
            ];

            return view('katalog/detail', $data);
        } catch (\Exception $e) {
            log_message('error', 'KatalogController@detail: ' . $e->getMessage());
            return redirect()->to('/katalog')->with('error', 'Terjadi kesalahan sistem.');
        }
    }
}
