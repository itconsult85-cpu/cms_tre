<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table            = 'teams';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false; // Berdasarkan skema awal, tidak ada timestamps
    protected $allowedFields    = ['name', 'position', 'bio', 'image', 'social_links', 'sort_order', 'status'];
}
