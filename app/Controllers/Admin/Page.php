<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class Page extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Halaman',
            'pages' => $this->pageModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/page/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Buat Halaman Baru'];
        return view('admin/page/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|is_unique[pages.title]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Judul halaman sudah ada, silakan gunakan judul lain.');
        }

        // Membuat slug URL otomatis dan tetap unik jika judulnya sama.
        $slug = $this->uniqueSlug($this->request->getPost('title'));
        $imagePath = null;

        $file = $this->request->getFile('featured_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/pages';
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $imagePath = 'uploads/pages/' . $newName;
        }

        $this->pageModel->insert([
            'title'            => $this->request->getPost('title'),
            'slug'             => $slug,
            'content'          => $this->request->getPost('content'),
            'featured_image'   => $imagePath,
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'status'           => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/page')->with('success', 'Halaman baru berhasil dibuat.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Halaman',
            'page'  => $this->pageModel->find($id)
        ];
        return view('admin/page/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title' => "required|is_unique[pages.title,id,{$id}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Judul halaman sudah digunakan.');
        }

        $pageLama = $this->pageModel->find($id);
        $slug = $this->uniqueSlug($this->request->getPost('title'), (int) $id);
        $imagePath = $pageLama['featured_image'];

        $file = $this->request->getFile('featured_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            if (!empty($pageLama['featured_image']) && file_exists(FCPATH . $pageLama['featured_image'])) {
                unlink(FCPATH . $pageLama['featured_image']);
            }
            $uploadPath = FCPATH . 'uploads/pages';
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $imagePath = 'uploads/pages/' . $newName;
        }

        $this->pageModel->update($id, [
            'title'            => $this->request->getPost('title'),
            'slug'             => $slug,
            'content'          => $this->request->getPost('content'),
            'featured_image'   => $imagePath,
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'status'           => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/page')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function delete($id)
    {
        $page = $this->pageModel->find($id);
        if (!empty($page['featured_image']) && file_exists(FCPATH . $page['featured_image'])) {
            unlink(FCPATH . $page['featured_image']);
        }

        $this->pageModel->delete($id);
        return redirect()->to('/admin/page')->with('success', 'Halaman berhasil dihapus.');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = url_title($title, '-', true) ?: 'halaman';
        $slug = $baseSlug;
        $suffix = 2;

        while (true) {
            $query = $this->pageModel->where('slug', $slug);
            if ($ignoreId !== null) {
                $query->where('id !=', $ignoreId);
            }

            if ($query->first() === null) {
                return $slug;
            }

            $slug = $baseSlug . '-' . $suffix++;
        }
    }
}
