<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table            = 'pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true; // Aktifkan created_at & updated_at
    protected $allowedFields    = ['title', 'slug', 'content', 'featured_image', 'meta_title', 'meta_description', 'status'];
}
