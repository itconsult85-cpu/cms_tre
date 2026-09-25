<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Akun',
            'users' => $this->userModel->orderBy('id', 'ASC')->findAll()
        ];
        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Akun Baru'];
        return view('admin/user/create', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required',
            'username' => 'required|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali data Anda. Username atau Email mungkin sudah dipakai.');
        }

        $this->userModel->insert([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
            'status'   => 1
        ]);
        return redirect()->to('/admin/user')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Akun',
            'user'  => $this->userModel->find($id)
        ];
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name'     => 'required',
            'username' => "required|is_unique[users.username,id,{$id}]",
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role'     => 'required',
            'status'   => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali data Anda. Username atau Email bentrok dengan akun lain.');
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
            'status'   => $this->request->getPost('status')
        ];

        if (!empty($this->request->getPost('password'))) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/user')->with('success', 'Akun berhasil diperbarui.');
    }

    public function delete($id)
    {
        if (session()->get('user_id') == $id) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak dapat menghapus akun yang sedang Anda gunakan login!');
        }

        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'Akun berhasil dihapus.');
    }
}
