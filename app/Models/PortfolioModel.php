<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table            = 'portfolios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['category_id', 'title', 'slug', 'client_name', 'project_url', 'description', 'cover_image', 'project_date', 'status'];

    // Mengambil data portofolio beserta nama dan slug kategorinya (Penting untuk filter Frontend)
    public function getAllPortfolios()
    {
        return $this->select('portfolios.*, categories.name as category_name, categories.slug as category_slug')
            ->join('categories', 'categories.id = portfolios.category_id', 'left')
            ->orderBy('portfolios.id', 'DESC')
            ->findAll();
    }
}
