<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class Client extends BaseController
{
    protected $clientModel;
    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    public function index()
    {
        $data = ['title' => 'Manajemen Logo Klien', 'clients' => $this->clientModel->orderBy('sort_order', 'ASC')->findAll()];
        return view('admin/client/index', $data);
    }

    public function create()
    {
        return view('admin/client/create', ['title' => 'Tambah Klien Baru']);
    }

    public function store()
    {
        $rules = ['name' => 'required', 'logo' => 'uploaded[logo]|is_image[logo]'];
        if (!$this->validate($rules)) return redirect()->back()->withInput()->with('error', 'Nama dan Logo wajib diisi.');

        $file = $this->request->getFile('logo');
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/clients', $newName);

        $this->clientModel->insert([
            'name'       => $this->request->getPost('name'),
            'logo'       => 'uploads/clients/' . $newName,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status'     => $this->request->getPost('status')
        ]);
        return redirect()->to('/admin/client')->with('success', 'Klien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin/client/edit', ['title' => 'Edit Klien', 'client' => $this->clientModel->find($id)]);
    }

    public function update($id)
    {
        $clientLama = $this->clientModel->find($id);
        $imagePath = $clientLama['logo'];

        $file = $this->request->getFile('logo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (file_exists(FCPATH . $clientLama['logo'])) unlink(FCPATH . $clientLama['logo']);
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/clients', $newName);
            $imagePath = 'uploads/clients/' . $newName;
        }

        $this->clientModel->update($id, [
            'name'       => $this->request->getPost('name'),
            'logo'       => $imagePath,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status'     => $this->request->getPost('status')
        ]);
        return redirect()->to('/admin/client')->with('success', 'Klien berhasil diperbarui.');
    }

    public function delete($id)
    {
        $client = $this->clientModel->find($id);
        if (file_exists(FCPATH . $client['logo'])) unlink(FCPATH . $client['logo']);
        $this->clientModel->delete($id);
        return redirect()->to('/admin/client')->with('success', 'Klien berhasil dihapus.');
    }
}
