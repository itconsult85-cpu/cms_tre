<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Service extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Manajemen Layanan',
            'services' => $this->serviceModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/service/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Layanan Baru'];
        return view('admin/service/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|is_unique[services.title]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama layanan sudah ada, silakan gunakan nama lain.');
        }

        $slug = url_title($this->request->getPost('title'), '-', true);
        $imagePath = null;

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/services', $newName);
            $imagePath = 'uploads/services/' . $newName;
        }

        $this->serviceModel->insert([
            'title'             => $this->request->getPost('title'),
            'slug'              => $slug,
            'short_description' => $this->request->getPost('short_description'),
            'content'           => $this->request->getPost('content'),
            'icon_class'        => $this->request->getPost('icon_class'),
            'image'             => $imagePath,
            'status'            => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/service')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'   => 'Edit Layanan',
            'service' => $this->serviceModel->find($id)
        ];
        return view('admin/service/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title' => "required|is_unique[services.title,id,{$id}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama layanan bentrok dengan layanan lain.');
        }

        $serviceLama = $this->serviceModel->find($id);
        $slug = url_title($this->request->getPost('title'), '-', true);
        $imagePath = $serviceLama['image'];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($serviceLama['image']) && file_exists(FCPATH . $serviceLama['image'])) {
                unlink(FCPATH . $serviceLama['image']);
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/services', $newName);
            $imagePath = 'uploads/services/' . $newName;
        }

        $this->serviceModel->update($id, [
            'title'             => $this->request->getPost('title'),
            'slug'              => $slug,
            'short_description' => $this->request->getPost('short_description'),
            'content'           => $this->request->getPost('content'),
            'icon_class'        => $this->request->getPost('icon_class'),
            'image'             => $imagePath,
            'status'            => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/service')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $service = $this->serviceModel->find($id);
        if (!empty($service['image']) && file_exists(FCPATH . $service['image'])) {
            unlink(FCPATH . $service['image']);
        }

        $this->serviceModel->delete($id);
        return redirect()->to('/admin/service')->with('success', 'Layanan berhasil dihapus.');
    }
}
