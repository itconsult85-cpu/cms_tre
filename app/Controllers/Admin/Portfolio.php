<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortfolioModel;
use App\Models\CategoryModel;
use App\Models\MediaGalleryModel;

class Portfolio extends BaseController
{
    protected $portfolioModel;
    protected $categoryModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->portfolioModel = new PortfolioModel();
        $this->categoryModel  = new CategoryModel();
        $this->mediaModel     = new MediaGalleryModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Manajemen Portofolio',
            'portfolios' => $this->portfolioModel->getAllPortfolios()
        ];
        return view('admin/portfolio/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Portofolio',
            'categories' => $this->categoryModel->where('type', 'portfolio')->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/portfolio/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'       => 'required|is_unique[portfolios.title]',
            'category_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Judul sudah ada atau Kategori kosong.');
        }

        $slug = url_title($this->request->getPost('title'), '-', true);

        // 1. UPLOAD COVER IMAGE (Gambar Utama)
        $coverPath = null;
        $coverFile = $this->request->getFile('cover_image');
        if ($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            $newName = $coverFile->getRandomName();
            $coverFile->move(FCPATH . 'uploads/portfolios', $newName);
            $coverPath = 'uploads/portfolios/' . $newName;
        }

        // 2. SIMPAN DATA PORTOFOLIO KE DATABASE
        $portfolioId = $this->portfolioModel->insert([
            'category_id'  => $this->request->getPost('category_id'),
            'title'        => $this->request->getPost('title'),
            'slug'         => $slug,
            'client_name'  => $this->request->getPost('client_name'),
            'project_url'  => $this->request->getPost('project_url'),
            'project_date' => $this->request->getPost('project_date') ?: null,
            'description'  => $this->request->getPost('description'),
            'cover_image'  => $coverPath,
            'status'       => $this->request->getPost('status')
        ]);

        // 3. UPLOAD MULTIPLE IMAGE (Gambar Galeri Tambahan)
        if ($files = $this->request->getFiles()) {
            if (isset($files['gallery_images'])) {
                foreach ($files['gallery_images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $img->move(FCPATH . 'uploads/portfolios/gallery', $newName);

                        // Simpan setiap gambar ke tabel media_gallery
                        $this->mediaModel->insert([
                            'relation_id'   => $portfolioId,
                            'relation_type' => 'portfolio',
                            'file_name'     => $img->getClientName(),
                            'file_path'     => 'uploads/portfolios/gallery/' . $newName
                        ]);
                    }
                }
            }
        }

        return redirect()->to('/admin/portfolio')->with('success', 'Portofolio berhasil ditambahkan beserta galerinya.');
    }

    public function edit($id)
    {
        $data = [
            'title'      => 'Edit Portofolio',
            'portfolio'  => $this->portfolioModel->find($id),
            'categories' => $this->categoryModel->where('type', 'portfolio')->orderBy('name', 'ASC')->findAll(),
            'galleries'  => $this->mediaModel->where(['relation_id' => $id, 'relation_type' => 'portfolio'])->findAll()
        ];
        return view('admin/portfolio/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title'       => "required|is_unique[portfolios.title,id,{$id}]",
            'category_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal, cek inputan Anda.');
        }

        $portfolioLama = $this->portfolioModel->find($id);
        $slug = url_title($this->request->getPost('title'), '-', true);

        // 1. UPDATE COVER IMAGE
        $coverPath = $portfolioLama['cover_image'];
        $coverFile = $this->request->getFile('cover_image');
        if ($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            if (!empty($coverPath) && file_exists(FCPATH . $coverPath)) {
                unlink(FCPATH . $coverPath); // Hapus cover lama
            }
            $newName = $coverFile->getRandomName();
            $coverFile->move(FCPATH . 'uploads/portfolios', $newName);
            $coverPath = 'uploads/portfolios/' . $newName;
        }

        // 2. UPDATE DATA PORTOFOLIO
        $this->portfolioModel->update($id, [
            'category_id'  => $this->request->getPost('category_id'),
            'title'        => $this->request->getPost('title'),
            'slug'         => $slug,
            'client_name'  => $this->request->getPost('client_name'),
            'project_url'  => $this->request->getPost('project_url'),
            'project_date' => $this->request->getPost('project_date') ?: null,
            'description'  => $this->request->getPost('description'),
            'cover_image'  => $coverPath,
            'status'       => $this->request->getPost('status')
        ]);

        // 3. HAPUS GAMBAR GALERI LAMA (Jika dicentang untuk dihapus)
        $deleteGalleryIds = $this->request->getPost('delete_gallery'); // Array ID gambar
        if (!empty($deleteGalleryIds)) {
            foreach ($deleteGalleryIds as $galleryId) {
                $imgLama = $this->mediaModel->find($galleryId);
                if ($imgLama && file_exists(FCPATH . $imgLama['file_path'])) {
                    unlink(FCPATH . $imgLama['file_path']); // Hapus file fisik
                }
                $this->mediaModel->delete($galleryId); // Hapus dari database
            }
        }

        // 4. UPLOAD MULTIPLE GAMBAR GALERI BARU (Tambahan)
        if ($files = $this->request->getFiles()) {
            if (isset($files['gallery_images'])) {
                foreach ($files['gallery_images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $img->move(FCPATH . 'uploads/portfolios/gallery', $newName);

                        $this->mediaModel->insert([
                            'relation_id'   => $id,
                            'relation_type' => 'portfolio',
                            'file_name'     => $img->getClientName(),
                            'file_path'     => 'uploads/portfolios/gallery/' . $newName
                        ]);
                    }
                }
            }
        }

        return redirect()->to('/admin/portfolio')->with('success', 'Portofolio dan galeri berhasil diperbarui.');
    }

    public function delete($id)
    {
        $portfolio = $this->portfolioModel->find($id);

        // 1. Hapus Cover Image fisik
        if (!empty($portfolio['cover_image']) && file_exists(FCPATH . $portfolio['cover_image'])) {
            unlink(FCPATH . $portfolio['cover_image']);
        }

        // 2. Hapus semua file Galeri fisik milik portofolio ini
        $galleries = $this->mediaModel->where(['relation_id' => $id, 'relation_type' => 'portfolio'])->findAll();
        foreach ($galleries as $gal) {
            if (file_exists(FCPATH . $gal['file_path'])) {
                unlink(FCPATH . $gal['file_path']);
            }
            $this->mediaModel->delete($gal['id']);
        }

        // 3. Hapus Portofolio dari database
        $this->portfolioModel->delete($id);

        return redirect()->to('/admin/portfolio')->with('success', 'Portofolio beserta semua gambarnya berhasil dihapus bersih.');
    }
}
