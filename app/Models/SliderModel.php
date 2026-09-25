<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table            = 'sliders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    // Pastikan 'image' terdaftar di sini!
    protected $allowedFields    = ['title', 'description', 'image', 'link_url', 'status'];
}
