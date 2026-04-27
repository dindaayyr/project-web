<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'slug', 'content', 'image', 'author', 'published_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getLatest(int $limit = 3)
    {
        return $this->orderBy('published_at', 'DESC')->limit($limit)->findAll();
    }
}
