<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;

class Post extends BaseController
{
    protected $postModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Artikel / Berita',
            'posts' => $this->postModel->getAllPosts()
        ];
        return view('admin/post/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tulis Artikel Baru',
            // Hanya ambil kategori yang tipenya 'post'
            'categories' => $this->categoryModel->where('type', 'post')->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/post/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'       => 'required|is_unique[posts.title]',
            'category_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Judul sudah ada atau kategori belum dipilih.');
        }

        $slug = url_title($this->request->getPost('title'), '-', true);
        $imagePath = null;

        $file = $this->request->getFile('featured_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/posts', $newName);
            $imagePath = 'uploads/posts/' . $newName;
        }

        $this->postModel->insert([
            'user_id'        => session()->get('user_id'), // Otomatis rekam siapa yang login
            'category_id'    => $this->request->getPost('category_id'),
            'title'          => $this->request->getPost('title'),
            'slug'           => $slug,
            'content'        => $this->request->getPost('content'),
            'featured_image' => $imagePath,
            'status'         => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/post')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'      => 'Edit Artikel',
            'post'       => $this->postModel->find($id),
            'categories' => $this->categoryModel->where('type', 'post')->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/post/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title'       => "required|is_unique[posts.title,id,{$id}]",
            'category_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali isian Anda.');
        }

        $postLama = $this->postModel->find($id);
        $slug = url_title($this->request->getPost('title'), '-', true);
        $imagePath = $postLama['featured_image'];

        $file = $this->request->getFile('featured_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($postLama['featured_image']) && file_exists(FCPATH . $postLama['featured_image'])) {
                unlink(FCPATH . $postLama['featured_image']);
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/posts', $newName);
            $imagePath = 'uploads/posts/' . $newName;
        }

        $this->postModel->update($id, [
            // user_id sengaja tidak di-update agar tetap tercatat milik penulis aslinya
            'category_id'    => $this->request->getPost('category_id'),
            'title'          => $this->request->getPost('title'),
            'slug'           => $slug,
            'content'        => $this->request->getPost('content'),
            'featured_image' => $imagePath,
            'status'         => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/post')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function delete($id)
    {
        $post = $this->postModel->find($id);
        if (!empty($post['featured_image']) && file_exists(FCPATH . $post['featured_image'])) {
            unlink(FCPATH . $post['featured_image']);
        }

        $this->postModel->delete($id);
        return redirect()->to('/admin/post')->with('success', 'Artikel berhasil dihapus.');
    }
}
