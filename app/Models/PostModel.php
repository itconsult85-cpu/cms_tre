<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true; // Aktifkan created_at & updated_at
    protected $allowedFields    = ['user_id', 'category_id', 'title', 'slug', 'content', 'featured_image', 'status'];

    // Fungsi khusus untuk mengambil data artikel beserta nama kategori dan nama penulis
    public function getAllPosts()
    {
        return $this->select('posts.*, categories.name as category_name, users.name as author_name')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->join('users', 'users.id = posts.user_id', 'left')
            ->orderBy('posts.id', 'DESC')
            ->findAll();
    }
}
