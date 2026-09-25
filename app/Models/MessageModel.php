<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false; // Kita pakai created_at manual karena database skema awal tidak ada updated_at
    protected $allowedFields    = ['parent_id', 'name', 'email', 'subject', 'message', 'is_read', 'sender_type', 'created_at'];

    // Ambil pesan utama (bukan balasan)
    public function getInbox()
    {
        return $this->where('parent_id', null)->orderBy('created_at', 'DESC')->findAll();
    }

    // Ambil riwayat percakapan berdasarkan ID pesan utama
    public function getThread($parentId)
    {
        return $this->groupStart()
            ->where('id', $parentId)
            ->orWhere('parent_id', $parentId)
            ->groupEnd()
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }
}
