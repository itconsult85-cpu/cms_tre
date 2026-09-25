<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class Message extends BaseController
{
    protected $messageModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
    }

    // Menampilkan daftar pesan masuk (Inbox)
    public function index()
    {
        $data = [
            'title'    => 'Pesan Masuk',
            'messages' => $this->messageModel->getInbox()
        ];
        return view('admin/message/index', $data);
    }

    // Membuka percakapan & menandai sudah dibaca
    public function read($id)
    {
        $parentMsg = $this->messageModel->find($id);

        // Tandai sudah dibaca
        if ($parentMsg['is_read'] == 0) {
            $this->messageModel->update($id, ['is_read' => 1]);
        }

        $data = [
            'title'     => 'Baca Pesan: ' . $parentMsg['subject'],
            'parentMsg' => $parentMsg,
            'threads'   => $this->messageModel->getThread($id)
        ];
        return view('admin/message/read', $data);
    }

    // Membalas pesan dan mengirimkan Email ke Pengunjung
    public function reply($id)
    {
        $parentMsg = $this->messageModel->find($id);
        $replyText = $this->request->getPost('reply_message');

        // 1. Simpan balasan ke Database agar terekam di riwayat chat CMS
        $this->messageModel->insert([
            'parent_id'   => $id,
            'name'        => session()->get('name'), // Nama Admin
            'email'       => get_setting('email_website') ?? 'admin@domain.com', // Opsional, ambil dari setting
            'subject'     => 'Re: ' . $parentMsg['subject'],
            'message'     => $replyText,
            'is_read'     => 1,
            'sender_type' => 'admin',
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        // 2. Kirim Email Beneran ke Pengunjung
        $email = \Config\Services::email();

        $email->setTo($parentMsg['email']);
        $email->setSubject('Balasan: ' . $parentMsg['subject']);

        // Template Email Sederhana
        $pesanEmail = "Halo " . $parentMsg['name'] . ",<br><br>";
        $pesanEmail .= nl2br($replyText) . "<br><br>";
        $pesanEmail .= "---<br><em>Salam hangat,<br>Tim KOKUO Group</em>";

        $email->setMessage($pesanEmail);

        if ($email->send()) {
            return redirect()->back()->with('success', 'Balasan berhasil dikirim ke email tujuan.');
        } else {
            // Jika gagal kirim email (biasanya karena .env SMTP belum diatur), pesan tetap tersimpan di database.
            return redirect()->back()->with('error', 'Balasan tersimpan di database, tapi gagal mengirim email. Cek konfigurasi SMTP Anda.');
        }
    }

    public function delete($id)
    {
        // Hapus pesan induk beserta seluruh balasannya (Cascade manual karena tidak diset di database)
        $this->messageModel->where('parent_id', $id)->delete();
        $this->messageModel->delete($id);
        return redirect()->to('/admin/message')->with('success', 'Pesan berhasil dihapus.');
    }
}
