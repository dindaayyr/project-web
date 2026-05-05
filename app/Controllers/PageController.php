<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function berita()
    {
        $data = [
            'pageTitle'   => 'Berita & Informasi Umroh | UmrohQueens',
            'activePage'  => 'berita',
        ];

        return view('pages/berita', $data);
    }

    public function tentang()
    {
        $data = [
            'pageTitle'   => 'Tentang Kami | UmrohQueens',
            'activePage'  => 'tentang',
        ];

        return view('pages/tentang', $data);
    }
}
