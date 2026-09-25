<?php

namespace App\Controllers;

use App\Models\UserModel;

class Setup extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Jika tabel users sudah ada isinya, blokir halaman setup dan lempar ke login
        if ($this->userModel->countAllResults() > 0) {
            return redirect()->to('/login');
        }

        return view('setup');
    }

    public function store()
    {
        // Pengecekan keamanan ganda
        if ($this->userModel->countAllResults() > 0) {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'name'     => 'required',
            'username' => 'required|is_unique[users.username]|alpha_numeric',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Pastikan semua data diisi dengan benar dan email/username belum terpakai.');
        }

        // Simpan sebagai Superadmin pertama kali
        $this->userModel->insert([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => 'superadmin', // Menjadi role tertinggi
            'status'   => 1
        ]);

        return redirect()->to('/login')->with('success', 'Setup berhasil! Akun Superadmin telah dibuat. Silakan login.');
    }
}
