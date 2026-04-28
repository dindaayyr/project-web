<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showLogin()
    {
        // If already logged in, redirect to role-appropriate dashboard
        if (session()->get('logged_in')) {
            return redirect()->to($this->getDashboardUrl(session()->get('user_role')));
        }

        return view('auth/login');
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
