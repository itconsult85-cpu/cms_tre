<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class Team extends BaseController
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Tim & Staff',
            // Diurutkan berdasarkan sort_order agar bisa diatur siapa yang tampil duluan (misal CEO di atas)
            'teams' => $this->teamModel->orderBy('sort_order', 'ASC')->findAll()
        ];
        return view('admin/team/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Anggota Tim'];
        return view('admin/team/create', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required',
            'position' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama dan Jabatan wajib diisi.');
        }

        // 1. Proses Upload Foto Profil
        $imagePath = null;
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/teams', $newName);
            $imagePath = 'uploads/teams/' . $newName;
        }

        // 2. Proses Social Links menjadi JSON
        $socialLinks = $this->request->getPost('social'); // Mengambil array dari input name="social[...]"
        $socialJson = !empty($socialLinks) ? json_encode($socialLinks) : null;

        $this->teamModel->insert([
            'name'         => $this->request->getPost('name'),
            'position'     => $this->request->getPost('position'),
            'bio'          => $this->request->getPost('bio'),
            'image'        => $imagePath,
            'social_links' => $socialJson,
            'sort_order'   => $this->request->getPost('sort_order') ?: 0,
            'status'       => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/team')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Anggota Tim',
            'team'  => $this->teamModel->find($id)
        ];
        return view('admin/team/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name'     => 'required',
            'position' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama dan Jabatan wajib diisi.');
        }

        $teamLama = $this->teamModel->find($id);

        // 1. Proses Upload Foto Profil (Unlink foto lama jika ada yang baru)
        $imagePath = $teamLama['image'];
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($teamLama['image']) && file_exists(FCPATH . $teamLama['image'])) {
                unlink(FCPATH . $teamLama['image']);
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/teams', $newName);
            $imagePath = 'uploads/teams/' . $newName;
        }

        // 2. Proses Social Links menjadi JSON
        $socialLinks = $this->request->getPost('social');
        $socialJson = !empty($socialLinks) ? json_encode($socialLinks) : null;

        $this->teamModel->update($id, [
            'name'         => $this->request->getPost('name'),
            'position'     => $this->request->getPost('position'),
            'bio'          => $this->request->getPost('bio'),
            'image'        => $imagePath,
            'social_links' => $socialJson,
            'sort_order'   => $this->request->getPost('sort_order') ?: 0,
            'status'       => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/team')->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function delete($id)
    {
        $team = $this->teamModel->find($id);
        if (!empty($team['image']) && file_exists(FCPATH . $team['image'])) {
            unlink(FCPATH . $team['image']);
        }

        $this->teamModel->delete($id);
        return redirect()->to('/admin/team')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
