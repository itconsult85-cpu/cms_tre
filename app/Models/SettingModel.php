<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false; // Di tabel settings kita tidak pakai created_at
    protected $allowedFields    = ['setting_key', 'setting_value', 'setting_type', 'description'];
}
