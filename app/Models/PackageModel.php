<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table            = 'packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'travel_agent_id', 'name', 'description', 'price', 'duration_days',
        'hotel_star', 'airline', 'departure_date', 'departure_city',
        'quota_total', 'quota_remaining', 'image', 'is_featured', 'status'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Get featured packages with travel agent info
     */
    public function getFeatured(int $limit = 3)
    {
        return $this->select('packages.*, travel_agents.name as travel_name, travel_agents.logo as travel_logo')
                    ->join('travel_agents', 'travel_agents.id = packages.travel_agent_id')
                    ->where('packages.is_featured', 1)
                    ->where('packages.status', 'active')
                    ->orderBy('packages.created_at', 'DESC')
                    ->limit($limit)
                    ->find();
    }

    /**
     * Get all active packages with filters
     */
    public function getFiltered(array $filters = [])
    {
        $builder = $this->select('packages.*, travel_agents.name as travel_name, travel_agents.logo as travel_logo')
                        ->join('travel_agents', 'travel_agents.id = packages.travel_agent_id')
                        ->where('packages.status !=', 'inactive');

        if (!empty($filters['min_price'])) {
            $builder->where('packages.price >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $builder->where('packages.price <=', $filters['max_price']);
        }
        if (!empty($filters['duration'])) {
            if (is_array($filters['duration'])) {
                $builder->whereIn('packages.duration_days', $filters['duration']);
            } else {
                $builder->where('packages.duration_days', $filters['duration']);
            }
        }
        if (!empty($filters['hotel_star'])) {
            $builder->where('packages.hotel_star', $filters['hotel_star']);
        }
        if (!empty($filters['airline'])) {
            $builder->where('packages.airline', $filters['airline']);
        }
        if (!empty($filters['departure_city'])) {
            $builder->like('packages.departure_city', $filters['departure_city']);
        }

        // Sorting
        $sortBy = $filters['sort_by'] ?? 'popular';
        switch ($sortBy) {
            case 'cheapest':
                $builder->orderBy('packages.price', 'ASC');
                break;
            case 'fastest':
                $builder->orderBy('packages.duration_days', 'ASC');
                break;
            case 'popular':
            default:
                $builder->orderBy('packages.is_featured', 'DESC')
                        ->orderBy('packages.created_at', 'DESC');
                break;
        }

        return $builder->findAll();
    }

    /**
     * Get single package with travel agent info
     */
    public function getById(int $id)
    {
        return $this->select('packages.*, travel_agents.name as travel_name, travel_agents.logo as travel_logo, travel_agents.description as travel_desc, travel_agents.phone as travel_phone')
                    ->join('travel_agents', 'travel_agents.id = packages.travel_agent_id')
                    ->where('packages.id', $id)
                    ->first();
    }
}
