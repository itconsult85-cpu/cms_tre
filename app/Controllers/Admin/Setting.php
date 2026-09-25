<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Setting extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Pengaturan Website',
            'settings' => $this->settingModel->findAll()
        ];
        return view('admin/setting/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Pengaturan Baru'];
        return view('admin/setting/create', $data);
    }

    public function store()
    {
        $rules = [
            'setting_key' => 'required|is_unique[settings.setting_key]|alpha_dash',
            'setting_type' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Key wajib diisi, unik, dan tanpa spasi.');
        }

        $type  = $this->request->getPost('setting_type');
        $value = $this->request->getPost('setting_value');

        // Logika Upload Gambar
        if ($type === 'image') {
            $file = $this->request->getFile('setting_image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/settings', $newName);
                $value = 'uploads/settings/' . $newName; // Simpan path ke database
            }
        }

        $this->settingModel->insert([
            'setting_key'   => strtolower($this->request->getPost('setting_key')),
            'setting_value' => $value,
            'setting_type'  => $type,
            'description'   => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/setting')->with('success', 'Pengaturan baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'   => 'Edit Pengaturan',
            'setting' => $this->settingModel->find($id)
        ];
        return view('admin/setting/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'setting_key' => "required|is_unique[settings.setting_key,id,{$id}]|alpha_dash"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Key pengaturan sudah digunakan.');
        }

        $settingLama = $this->settingModel->find($id);
        $type  = $this->request->getPost('setting_type');
        $value = $this->request->getPost('setting_value');

        if ($type === 'image') {
            $file = $this->request->getFile('setting_image');

            // Kondisi 1: Jika ada file upload baru
            if ($file && $file->isValid() && !$file->hasMoved()) {

                // UNLINK: Hapus file gambar lama dari server
                if (!empty($settingLama['setting_value']) && file_exists(FCPATH . $settingLama['setting_value'])) {
                    unlink(FCPATH . $settingLama['setting_value']);
                }

                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/settings', $newName);
                $value = 'uploads/settings/' . $newName;
            } else {
                // Jika tidak upload file baru, tetap pakai path gambar lama
                $value = $settingLama['setting_value'];
            }
        } else {
            // Kondisi 2: Jika tipe diubah dari image ke teks/URL
            // UNLINK: Hapus gambar lama karena tipe setting sudah bukan gambar lagi
            if ($settingLama['setting_type'] === 'image' && !empty($settingLama['setting_value']) && file_exists(FCPATH . $settingLama['setting_value'])) {
                unlink(FCPATH . $settingLama['setting_value']);
            }
        }

        $this->settingModel->update($id, [
            'setting_key'   => strtolower($this->request->getPost('setting_key')),
            'setting_value' => $value,
            'setting_type'  => $type,
            'description'   => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/setting')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $setting = $this->settingModel->find($id);

        // Kondisi 3: UNLINK gambar jika pengaturan ini dihapus dari database
        if ($setting['setting_type'] === 'image' && !empty($setting['setting_value']) && file_exists(FCPATH . $setting['setting_value'])) {
            unlink(FCPATH . $setting['setting_value']);
        }

        $this->settingModel->delete($id);
        return redirect()->to('/admin/setting')->with('success', 'Pengaturan berhasil dihapus.');
    }
}
