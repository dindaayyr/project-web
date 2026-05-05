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
        $pager = null;
        $totalCount = 0;

        try {
            $packageModel = new PackageModel();
            $packages = $packageModel->getFilteredPaginated($filters, 9);
            $pager = $packageModel->pager;

            // Get total count across all pages for display
            $totalCount = $pager->getTotal();
        } catch (\Exception $e) {
            log_message('warning', 'KatalogController: Database not available - ' . $e->getMessage());
        }

        // Build query string for pagination links (preserve filters)
        $queryParams = array_filter($filters, function($v) {
            return $v !== null && $v !== '';
        });

        $data = [
            'packages'    => $packages,
            'filters'     => $filters,
            'pager'       => $pager,
            'totalCount'  => $totalCount,
            'queryParams' => $queryParams,
            'pageTitle'   => 'Katalog Paket Umroh | UmrohQueens'
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
