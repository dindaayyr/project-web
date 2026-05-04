<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\TravelAgentModel;
use App\Models\UserModel;

class AgentController extends BaseController
{
    protected $agentModel;
    protected $userModel;

    public function __construct()
    {
        $this->agentModel = new TravelAgentModel();
        $this->userModel  = new UserModel();
    }

    public function index()
    {
        $data = [
            'agents' => $this->agentModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('superadmin/agents/index', $data);
    }

    public function edit($id)
    {
        $agent = $this->agentModel->find($id);
        if (!$agent) {
            return redirect()->to('/superadmin/agents')->with('error', 'Agen tidak ditemukan.');
        }

        $data = [
            'agent' => $agent,
        ];
        return view('superadmin/agents/form', $data);
    }

    public function update($id)
    {
        $agent = $this->agentModel->find($id);
        if (!$agent) {
            return redirect()->to('/superadmin/agents')->with('error', 'Agen tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        
        $this->agentModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'ppiu_number' => $this->request->getPost('ppiu_number'),
            'city'        => $this->request->getPost('city'),
            'address'     => $this->request->getPost('address'),
            'phone'       => $this->request->getPost('phone'),
            'status'      => $status,
        ]);

        return redirect()->to('/superadmin/agents')->with('success', 'Data agen berhasil diperbarui.');
    }

    public function delete($id)
    {
        $agent = $this->agentModel->find($id);
        if ($agent) {
            // Delete associated user accounts too? 
            // For safety, just delete agent record, user will remain but without travel_agent_id link?
            // Actually better to delete or deactivate associated users.
            $this->userModel->where('travel_agent_id', $id)->delete();
            $this->agentModel->delete($id);
            return redirect()->to('/superadmin/agents')->with('success', 'Agen dan akun terkait berhasil dihapus.');
        }
        return redirect()->to('/superadmin/agents')->with('error', 'Gagal menghapus agen.');
    }

    public function verify($id)
    {
        $this->agentModel->update($id, ['status' => 'active']);
        return redirect()->to('/superadmin/agents')->with('success', 'Agen berhasil diverifikasi.');
    }
}
