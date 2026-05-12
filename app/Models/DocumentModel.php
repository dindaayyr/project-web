<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table            = 'user_documents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'doc_type', 'file_path', 'status', 'notes'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getByUser(int $userId)
    {
        $docs = $this->where('user_id', $userId)->findAll();
        $formatted = [];
        foreach ($docs as $doc) {
            $formatted[$doc['doc_type']] = $doc;
        }
        return $formatted;
    }
}
