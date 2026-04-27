<?php

namespace App\Controllers;

use App\Models\PackageModel;
use App\Models\NewsModel;

class LandingController extends BaseController
{
    public function index()
    {
        $data = [
            'featuredPackages' => [],
            'latestNews'       => [],
        ];

        try {
            $packageModel = new PackageModel();
            $newsModel    = new NewsModel();

            $data['featuredPackages'] = $packageModel->getFeatured(3);
            $data['latestNews']       = $newsModel->getLatest(3);
        } catch (\Exception $e) {
            // Database not configured yet — show page without data
            log_message('warning', 'LandingController: Database not available - ' . $e->getMessage());
        }

        return view('landing/index', $data);
    }
}
