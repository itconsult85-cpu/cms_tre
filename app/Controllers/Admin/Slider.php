<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SliderModel;

class Slider extends BaseController
{
    protected $sliderModel;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Manajemen Hero Slider',
            'sliders' => $this->sliderModel->findAll()
        ];
        return view('admin/slider/index', $data);
    }

    public function create()
    {
        return view('admin/slider/create', ['title' => 'Tambah Slide Baru']);
    }

    public function store()
    {
        $file = $this->request->getFile('image');
        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Gambar wajib diunggah.');
        }

        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/sliders', $newName);

        $this->sliderModel->insert([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'link_url'    => $this->request->getPost('link_url'),
            'image'       => 'uploads/sliders/' . $newName,
            'status'      => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/slider')->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin/slider/edit', [
            'title'  => 'Edit Slide',
            'slider' => $this->sliderModel->find($id)
        ]);
    }

    public function update($id)
    {
        $slider = $this->sliderModel->find($id);
        $imagePath = $slider['image'];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!empty($slider['image']) && is_file(FCPATH . $slider['image'])) {
                unlink(FCPATH . $slider['image']);
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/sliders', $newName);
            $imagePath = 'uploads/sliders/' . $newName;
        }

        $this->sliderModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'link_url'    => $this->request->getPost('link_url'),
            'image'       => $imagePath,
            'status'      => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/slider')->with('success', 'Slide berhasil diperbarui.');
    }

    public function delete($id)
    {
        $slider = $this->sliderModel->find($id);

        if ($slider) {
            // Cek apakah string path tidak kosong dan benar-benar file
            if (!empty($slider['image']) && is_file(FCPATH . $slider['image'])) {
                unlink(FCPATH . $slider['image']);
            }

            $this->sliderModel->delete($id);
            return redirect()->to('/admin/slider')->with('success', 'Slide berhasil dihapus.');
        }

        return redirect()->to('/admin/slider')->with('error', 'Data tidak ditemukan.');
    }
}
