<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false; // Sesuai skema awal, tidak ada kolom created_at
    protected $allowedFields    = ['title', 'slug', 'short_description', 'content', 'icon_class', 'image', 'status'];
}
