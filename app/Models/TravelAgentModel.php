<?php

namespace App\Models;

use CodeIgniter\Model;

class TravelAgentModel extends Model
{
    protected $table            = 'travel_agents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'logo', 'ppiu_number', 'address', 'city', 'phone', 'email', 'status'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
