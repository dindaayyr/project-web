<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\PackageModel;
use App\Models\TravelAgentModel;

class PackageController extends BaseController
{
    protected $packageModel;
    protected $agentModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
        $this->agentModel   = new TravelAgentModel();
    }

    public function index()
    {
        $data = [
            'packages' => $this->packageModel
                ->select('paket_umroh.*, paket_umroh.id_paket as id, travel_agents.name as travel_name')
                ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                ->orderBy('paket_umroh.created_at', 'DESC')
                ->findAll(),
        ];

        return view('superadmin/packages/index', $data);
    }

    public function create()
    {
        $data = [
            'package' => null,
            'agents'  => $this->agentModel->findAll(),
        ];
        return view('superadmin/packages/form', $data);
    }

    public function store()
    {
        $rules = [
            'travel_agent_id'   => 'required',
            'nama_paket'        => 'required|min_length[5]',
            'harga_jual'        => 'required|numeric',
            'program_hari'      => 'required|integer',
            'tanggal_berangkat' => 'required|valid_date',
            'image'             => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $imagePath = $this->handleUpload('image');

        $this->packageModel->insert([
            'travel_agent_id'   => $this->request->getPost('travel_agent_id'),
            'nama_paket'        => $this->request->getPost('nama_paket'),
            'description'       => $this->request->getPost('description'),
            'harga_jual'        => $this->request->getPost('harga_jual'),
            'program_hari'      => $this->request->getPost('program_hari'),
            'maskapai'          => $this->request->getPost('maskapai'),
            'rute'              => $this->request->getPost('rute'),
            'departure_city'    => $this->request->getPost('departure_city'),
            'total_seat'        => $this->request->getPost('total_seat'),
            'jumlah_jamaah'     => $this->request->getPost('jumlah_jamaah') ?? 0,
            'miqat_awal'        => $this->request->getPost('miqat_awal'),
            'hotel_madinah'     => $this->request->getPost('hotel_madinah'),
            'bintang_madinah'   => $this->request->getPost('bintang_madinah'),
            'hotel_mekkah'      => $this->request->getPost('hotel_mekkah'),
            'bintang_mekkah'    => $this->request->getPost('bintang_mekkah'),
            'image'             => $imagePath ?? '/assets/img/default-package.jpg',
            'status'            => $this->request->getPost('status') ?? 'active',
            'is_featured'       => $this->request->getPost('is_featured') ? 1 : 0,
        ]);

        return redirect()->to('/superadmin/packages')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $package = $this->packageModel->where('id_paket', $id)->first();
        if (!$package) {
            return redirect()->to('/superadmin/packages')->with('error', 'Paket tidak ditemukan.');
        }

        $data = [
            'package' => $package,
            'agents'  => $this->agentModel->findAll(),
        ];
        return view('superadmin/packages/form', $data);
    }

    public function update($id)
    {
        $package = $this->packageModel->where('id_paket', $id)->first();
        if (!$package) {
            return redirect()->to('/superadmin/packages')->with('error', 'Paket tidak ditemukan.');
        }

        $rules = [
            'travel_agent_id'   => 'required',
            'nama_paket'        => 'required|min_length[5]',
            'harga_jual'        => 'required|numeric',
            'image'             => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = [
            'travel_agent_id'   => $this->request->getPost('travel_agent_id'),
            'nama_paket'        => $this->request->getPost('nama_paket'),
            'description'       => $this->request->getPost('description'),
            'harga_jual'        => $this->request->getPost('harga_jual'),
            'program_hari'      => $this->request->getPost('program_hari'),
            'maskapai'          => $this->request->getPost('maskapai'),
            'rute'              => $this->request->getPost('rute'),
            'departure_city'    => $this->request->getPost('departure_city'),
            'total_seat'        => $this->request->getPost('total_seat'),
            'jumlah_jamaah'     => $this->request->getPost('jumlah_jamaah'),
            'miqat_awal'        => $this->request->getPost('miqat_awal'),
            'hotel_madinah'     => $this->request->getPost('hotel_madinah'),
            'bintang_madinah'   => $this->request->getPost('bintang_madinah'),
            'hotel_mekkah'      => $this->request->getPost('hotel_mekkah'),
            'bintang_mekkah'    => $this->request->getPost('bintang_mekkah'),
            'status'            => $this->request->getPost('status'),
            'is_featured'       => $this->request->getPost('is_featured') ? 1 : 0,
        ];

        $imagePath = $this->handleUpload('image');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        $this->packageModel->update($id, $data);

        return redirect()->to('/superadmin/packages')->with('success', 'Paket berhasil diperbarui.');
    }

    private function handleUpload($fieldName)
    {
        $file = $this->request->getFile($fieldName);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/packages', $newName);
            return '/uploads/packages/' . $newName;
        }
        return null;
    }

    public function delete($id)
    {
        if ($this->packageModel->delete($id)) {
            return redirect()->to('/superadmin/packages')->with('success', 'Paket berhasil dihapus.');
        }
        return redirect()->to('/superadmin/packages')->with('error', 'Gagal menghapus paket.');
    }
}
