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
        // If already logged in, redirect
        if (session()->get('user_id')) {
            $role = session()->get('user_role');
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/user/dashboard');
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
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'user_email'=> $user['email'],
            'user_role' => $user['role'],
            'user_avatar' => $user['avatar'],
            'logged_in' => true,
        ]);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return redirect()->to('/user/dashboard')->with('success', 'Selamat datang, ' . $user['name'] . '!');
    }

    public function showRegister()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/user/dashboard');
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
}
