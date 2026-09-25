<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaGalleryModel extends Model
{
    protected $table            = 'media_gallery';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false; // Tabel ini murni data file
    protected $allowedFields    = ['relation_id', 'relation_type', 'file_name', 'file_path', 'sort_order'];
}
