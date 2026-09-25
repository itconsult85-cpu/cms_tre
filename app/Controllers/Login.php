<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // SENSOR: Jika benar-benar kosong, arahkan ke Setup
        if ($userModel->countAllResults() === 0) {
            return redirect()->to('/setup');
        }

        // Jika user sudah dalam keadaan login, langsung lewati halaman ini ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/user'); // Nanti bisa disesuaikan ke dashboard utama
        }

        return view('login');
    }

    public function process()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        // Verifikasi kecocokan username dan password
        if ($user && password_verify($password, $user['password'])) {

            // Cek apakah akun aktif (status = 1)
            if ($user['status'] != 1) {
                return redirect()->back()->with('error', 'Akun Anda dinonaktifkan.');
            }

            // Daftarkan sesi (session)
            session()->set([
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'username'   => $user['username'],
                'role'       => $user['role'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/admin/user')->with('success', 'Selamat datang, ' . $user['name']);
        }

        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
