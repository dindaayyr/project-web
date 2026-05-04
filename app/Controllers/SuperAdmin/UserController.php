<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $role   = $this->request->getGet('role');

        $query = $this->userModel->orderBy('created_at', 'DESC');

        if (!empty($search)) {
            $query->groupStart()
                  ->like('name', $search)
                  ->orLike('email', $search)
                  ->orLike('phone', $search)
                  ->groupEnd();
        }

        if (!empty($role)) {
            $query->where('role', $role);
        }

        $data = [
            'users'  => $query->findAll(),
            'search' => $search,
            'role'   => $role,
        ];

        return view('superadmin/users/index', $data);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/superadmin/users')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'user' => $user,
        ];
        return view('superadmin/users/form', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/superadmin/users')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'role'  => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/superadmin/users')->with('success', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            return redirect()->to('/superadmin/users')->with('success', 'User berhasil dihapus.');
        }
        return redirect()->to('/superadmin/users')->with('error', 'Gagal menghapus user.');
    }
}
