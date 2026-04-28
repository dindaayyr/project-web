<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\PackageModel;

class PackageController extends BaseController
{
    protected $packageModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
    }

    public function index()
    {
        $agentId = session()->get('travel_agent_id');

        $data = [
            'packages' => $this->packageModel->getByAgent($agentId),
        ];

        return view('agent/packages/index', $data);
    }

    public function create()
    {
        return view('agent/packages/form', ['package' => null]);
    }

    public function store()
    {
        $rules = [
            'nama_paket'        => 'required|min_length[5]',
            'harga_jual'        => 'required|numeric|greater_than[0]',
            'program_hari'      => 'required|integer|greater_than[0]',
            'tanggal_berangkat' => 'required|valid_date',
            'maskapai'          => 'required',
            'total_seat'        => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $agentId = session()->get('travel_agent_id');

        $this->packageModel->insert([
            'travel_agent_id'   => $agentId,
            'nama_paket'        => $this->request->getPost('nama_paket'),
            'description'       => $this->request->getPost('description'),
            'harga_jual'        => $this->request->getPost('harga_jual'),
            'program_hari'      => $this->request->getPost('program_hari'),
            'tanggal_berangkat' => $this->request->getPost('tanggal_berangkat'),
            'maskapai'          => $this->request->getPost('maskapai'),
            'rute'              => $this->request->getPost('rute'),
            'departure_city'    => $this->request->getPost('departure_city'),
            'total_seat'        => $this->request->getPost('total_seat'),
            'jumlah_jamaah'     => $this->request->getPost('jumlah_jamaah') ?? 0,
            'miqat_awal'        => $this->request->getPost('miqat_awal'),
            'hotel_madinah'     => $this->request->getPost('hotel_madinah'),
            'bintang_madinah'   => $this->request->getPost('bintang_madinah') ?? 3,
            'hotel_mekkah'      => $this->request->getPost('hotel_mekkah'),
            'bintang_mekkah'    => $this->request->getPost('bintang_mekkah') ?? 3,
            'image'             => $this->request->getPost('image') ?? '/assets/img/default-package.jpg',
            'status'            => 'active',
        ]);

        return redirect()->to('/agent/packages')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $agentId = session()->get('travel_agent_id');
        $package = $this->packageModel->where('id', $id)->where('travel_agent_id', $agentId)->first();

        if (!$package) {
            return redirect()->to('/agent/packages')->with('error', 'Paket tidak ditemukan atau bukan milik Anda.');
        }

        return view('agent/packages/form', ['package' => $package]);
    }

    public function update($id)
    {
        $agentId = session()->get('travel_agent_id');
        $package = $this->packageModel->where('id', $id)->where('travel_agent_id', $agentId)->first();

        if (!$package) {
            return redirect()->to('/agent/packages')->with('error', 'Paket tidak ditemukan atau bukan milik Anda.');
        }

        $rules = [
            'nama_paket'        => 'required|min_length[5]',
            'harga_jual'        => 'required|numeric|greater_than[0]',
            'program_hari'      => 'required|integer|greater_than[0]',
            'tanggal_berangkat' => 'required|valid_date',
            'maskapai'          => 'required',
            'total_seat'        => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $this->packageModel->update($id, [
            'nama_paket'        => $this->request->getPost('nama_paket'),
            'description'       => $this->request->getPost('description'),
            'harga_jual'        => $this->request->getPost('harga_jual'),
            'program_hari'      => $this->request->getPost('program_hari'),
            'tanggal_berangkat' => $this->request->getPost('tanggal_berangkat'),
            'maskapai'          => $this->request->getPost('maskapai'),
            'rute'              => $this->request->getPost('rute'),
            'departure_city'    => $this->request->getPost('departure_city'),
            'total_seat'        => $this->request->getPost('total_seat'),
            'jumlah_jamaah'     => $this->request->getPost('jumlah_jamaah') ?? 0,
            'miqat_awal'        => $this->request->getPost('miqat_awal'),
            'hotel_madinah'     => $this->request->getPost('hotel_madinah'),
            'bintang_madinah'   => $this->request->getPost('bintang_madinah') ?? 3,
            'hotel_mekkah'      => $this->request->getPost('hotel_mekkah'),
            'bintang_mekkah'    => $this->request->getPost('bintang_mekkah') ?? 3,
        ]);

        return redirect()->to('/agent/packages')->with('success', 'Paket berhasil diperbarui.');
    }

    public function delete($id)
    {
        $agentId = session()->get('travel_agent_id');
        $package = $this->packageModel->where('id', $id)->where('travel_agent_id', $agentId)->first();

        if (!$package) {
            return redirect()->to('/agent/packages')->with('error', 'Paket tidak ditemukan atau bukan milik Anda.');
        }

        $this->packageModel->delete($id);

        return redirect()->to('/agent/packages')->with('success', 'Paket berhasil dihapus.');
    }
}
