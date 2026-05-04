<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TravelAgentModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $agentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->agentModel = new TravelAgentModel();
    }

    public function showLogin()
    {
        // ... (existing showLogin logic)
        if (session()->get('logged_in')) {
            return redirect()->to($this->getDashboardUrl(session()->get('user_role')));
        }
        return view('auth/login');
    }

    // ... (login, showRegister, register, logout remain same)

    public function showRegisterAgent()
    {
        if (session()->get('logged_in')) {
            return redirect()->to($this->getDashboardUrl(session()->get('user_role')));
        }
        return view('auth/register_agent');
    }

    public function registerAgent()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[255]',
            'ppiu_number'      => 'required',
            'city'             => 'required',
            'address'          => 'required',
            'phone'            => 'required',
            'email'            => 'required|valid_email|is_unique[users.email]|is_unique[travel_agents.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'npwp_file'        => 'uploaded[npwp_file]|max_size[npwp_file,2048]|ext_in[npwp_file,pdf,jpg,jpeg,png]',
            'legal_file'       => 'uploaded[legal_file]|max_size[legal_file,2048]|ext_in[legal_file,pdf,jpg,jpeg,png]',
            'logo'             => 'uploaded[logo]|max_size[logo,2048]|is_image[logo]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        // Handle File Uploads
        $npwpFile = $this->request->getFile('npwp_file');
        $legalFile = $this->request->getFile('legal_file');
        $logoFile = $this->request->getFile('logo');

        $npwpName = $npwpFile->getRandomName();
        $legalName = $legalFile->getRandomName();
        $logoName = $logoFile->getRandomName();

        $npwpFile->move(FCPATH . 'uploads/legal', $npwpName);
        $legalFile->move(FCPATH . 'uploads/legal', $legalName);
        $logoFile->move(FCPATH . 'uploads/packages', $logoName); // Put logo in packages for now

        // 1. Create Travel Agent (Status: Pending)
        $agentId = $this->agentModel->insert([
            'name'        => $this->request->getPost('name'),
            'email'       => $this->request->getPost('email'),
            'ppiu_number' => $this->request->getPost('ppiu_number'),
            'address'     => $this->request->getPost('address'),
            'city'        => $this->request->getPost('city'),
            'phone'       => $this->request->getPost('phone'),
            'npwp_file'   => '/uploads/legal/' . $npwpName,
            'legal_file'  => '/uploads/legal/' . $legalName,
            'logo'        => '/uploads/packages/' . $logoName,
            'status'      => 'pending',
        ]);

        // 2. Create User Account
        $this->userModel->insert([
            'name'            => $this->request->getPost('name'),
            'email'           => $this->request->getPost('email'),
            'phone'           => $this->request->getPost('phone'),
            'password'        => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'            => 'agent',
            'travel_agent_id' => $agentId,
        ]);

        return redirect()->to('/login')->with('success', 'Pendaftaran mitra berhasil! Akun Anda sedang diverifikasi oleh admin. Silakan tunggu informasi selanjutnya.');
    }

    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.')->withInput();
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah.')->withInput();
        }

        // Check if agent is pending
        if ($user['role'] === 'agent') {
            $agent = $this->agentModel->find($user['travel_agent_id']);
            if ($agent && $agent['status'] === 'pending') {
                return redirect()->back()->with('error', 'Akun Anda masih dalam proses verifikasi.')->withInput();
            }
            if ($agent && $agent['status'] === 'inactive') {
                return redirect()->back()->with('error', 'Akun Anda telah dinonaktifkan.')->withInput();
            }
        }

        // Set session
        session()->set([
            'user_id'          => $user['id'],
            'user_name'        => $user['name'],
            'user_email'       => $user['email'],
            'user_role'        => $user['role'],
            'user_avatar'      => $user['avatar'],
            'travel_agent_id'  => $user['travel_agent_id'] ?? null,
            'logged_in'        => true,
        ]);

        $dashboard = $this->getDashboardUrl($user['role']);
        $greeting  = $this->getRoleGreeting($user['role'], $user['name']);

        return redirect()->to($dashboard)->with('success', $greeting);
    }

    public function showRegister()
    {
        if (session()->get('logged_in')) {
            return redirect()->to($this->getDashboardUrl(session()->get('user_role')));
        }

        return view('auth/register');
    }

    public function register()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[255]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'phone'            => 'required|min_length[10]|max_length[15]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            ],
            'password_confirm' => [
                'matches' => 'Konfirmasi password tidak cocok.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $this->userModel->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'jamaah',
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Get dashboard URL based on role
     */
    private function getDashboardUrl(string $role): string
    {
        $map = [
            'jamaah'     => '/user/dashboard',
            'agent'      => '/agent/dashboard',
            'finance'    => '/finance/dashboard',
            'superadmin' => '/superadmin/dashboard',
        ];

        return $map[$role] ?? '/';
    }

    /**
     * Get role-appropriate greeting
     */
    private function getRoleGreeting(string $role, string $name): string
    {
        $greetings = [
            'jamaah'     => "Selamat datang, {$name}!",
            'agent'      => "Selamat datang, Agen {$name}!",
            'finance'    => "Selamat datang, Admin Keuangan!",
            'superadmin' => "Selamat datang, Super Admin!",
        ];

        return $greetings[$role] ?? "Selamat datang, {$name}!";
    }
}

