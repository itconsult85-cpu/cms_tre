<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Manajemen Kategori',
            'categories' => $this->categoryModel->orderBy('type', 'ASC')->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/category/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Kategori Baru'];
        return view('admin/category/create', $data);
    }

    public function store()
    {
        // slug dibuat otomatis dari nama kategori
        $slug = url_title($this->request->getPost('name'), '-', true);

        $rules = [
            'name' => 'required',
            // Pastikan slug unik agar tidak ada URL kategori yang ganda
            'slug' => "is_unique[categories.slug]"
        ];

        // Karena rules divalidasi array, kita perlu merge $this->request->getPost() dengan $slug
        $validationData = $this->request->getPost();
        $validationData['slug'] = $slug;

        if (!$this->validateData($validationData, $rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori ini sudah digunakan, silakan pilih nama lain.');
        }

        $this->categoryModel->insert([
            'name' => $this->request->getPost('name'),
            'slug' => $slug,
            'type' => $this->request->getPost('type')
        ]);

        return redirect()->to('/admin/category')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Kategori',
            'category' => $this->categoryModel->find($id)
        ];
        return view('admin/category/edit', $data);
    }

    public function update($id)
    {
        $slug = url_title($this->request->getPost('name'), '-', true);

        $rules = [
            'name' => 'required',
            'slug' => "is_unique[categories.slug,id,{$id}]"
        ];

        $validationData = $this->request->getPost();
        $validationData['slug'] = $slug;

        if (!$this->validateData($validationData, $rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori bentrok dengan kategori lain.');
        }

        $this->categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
            'slug' => $slug,
            'type' => $this->request->getPost('type')
        ]);

        return redirect()->to('/admin/category')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        // CodeIgniter 4 Foreign Key 'SET NULL' akan otomatis bekerja.
        // Jika kategori dihapus, artikel/portofolio yang ada di dalamnya tidak akan terhapus,
        // hanya kolom category_id-nya yang menjadi kosong (NULL).
        $this->categoryModel->delete($id);
        return redirect()->to('/admin/category')->with('success', 'Kategori berhasil dihapus.');
    }
}
