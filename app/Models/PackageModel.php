<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table            = 'paket_umroh';
    protected $primaryKey       = 'id_paket';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'travel_agent_id', 'nama_paket', 'description', 'harga_jual',
        'program_hari', 'maskapai', 'rute', 'tanggal_berangkat',
        'departure_city', 'total_seat', 'jumlah_jamaah', 'available_seat',
        'miqat_awal', 'hotel_madinah', 'bintang_madinah',
        'hotel_mekkah', 'bintang_mekkah',
        'image', 'poster_paket', 'is_featured', 'status', 'status_paket'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    // Model events for automatic available_seat calculation
    protected $beforeInsert = ['calculateAvailableSeat'];
    protected $beforeUpdate = ['calculateAvailableSeat'];

    /**
     * Automatically calculate available_seat = total_seat - jumlah_jamaah
     */
    protected function calculateAvailableSeat(array $data): array
    {
        $d = $data['data'] ?? [];

        $totalSeat     = $d['total_seat'] ?? null;
        $jumlahJamaah  = $d['jumlah_jamaah'] ?? null;

        if ($totalSeat !== null && $jumlahJamaah !== null) {
            $data['data']['available_seat'] = (int)$totalSeat - (int)$jumlahJamaah;
        }
        elseif (isset($data['id'])) {
            $existing = $this->find($data['id']);
            if ($existing) {
                $ts = $totalSeat ?? $existing['total_seat'];
                $jj = $jumlahJamaah ?? $existing['jumlah_jamaah'];
                $data['data']['available_seat'] = (int)$ts - (int)$jj;
            }
        }

        return $data;
    }

    /**
     * Get featured packages with travel agent info
     */
    public function getFeatured(int $limit = 3)
    {
        return $this->select('paket_umroh.*, paket_umroh.id_paket as id, travel_agents.name as travel_name, travel_agents.logo as travel_logo')
                    ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                    ->where('paket_umroh.is_featured', 1)
                    ->where('paket_umroh.status', 'active')
                    ->orderBy('paket_umroh.created_at', 'DESC')
                    ->limit($limit)
                    ->find();
    }

    /**
     * Get all active packages with filters
     */
    public function getFiltered(array $filters = [])
    {
        $builder = $this->select('paket_umroh.*, paket_umroh.id_paket as id, travel_agents.name as travel_name, travel_agents.logo as travel_logo')
                        ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                        ->where('paket_umroh.status !=', 'inactive');

        if (!empty($filters['min_price'])) {
            $builder->where('paket_umroh.harga_jual >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $builder->where('paket_umroh.harga_jual <=', $filters['max_price']);
        }
        if (!empty($filters['duration'])) {
            if (is_array($filters['duration'])) {
                $builder->whereIn('paket_umroh.program_hari', $filters['duration']);
            } else {
                $builder->where('paket_umroh.program_hari', $filters['duration']);
            }
        }
        if (!empty($filters['hotel_star'])) {
            $star = (int)$filters['hotel_star'];
            $builder->groupStart()
                    ->where('paket_umroh.bintang_madinah >=', $star)
                    ->orWhere('paket_umroh.bintang_mekkah >=', $star)
                    ->groupEnd();
        }
        if (!empty($filters['airline'])) {
            $builder->like('paket_umroh.maskapai', $filters['airline']);
        }
        if (!empty($filters['departure_city'])) {
            $builder->like('paket_umroh.departure_city', $filters['departure_city']);
        }

        $sortBy = $filters['sort_by'] ?? 'popular';
        switch ($sortBy) {
            case 'cheapest':
                $builder->orderBy('paket_umroh.harga_jual', 'ASC');
                break;
            case 'fastest':
                $builder->orderBy('paket_umroh.program_hari', 'ASC');
                break;
            case 'popular':
            default:
                $builder->orderBy('paket_umroh.is_featured', 'DESC')
                        ->orderBy('paket_umroh.created_at', 'DESC');
                break;
        }

        return $builder->findAll();
    }

    public function getFilteredPaginated(array $filters = [], int $perPage = 9)
    {
        $this->select('paket_umroh.*, paket_umroh.id_paket as id, travel_agents.name as travel_name, travel_agents.logo as travel_logo')
             ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
             ->where('paket_umroh.status !=', 'inactive');

        if (!empty($filters['min_price'])) {
            $this->where('paket_umroh.harga_jual >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $this->where('paket_umroh.harga_jual <=', $filters['max_price']);
        }
        if (!empty($filters['duration'])) {
            if (is_array($filters['duration'])) {
                $this->whereIn('paket_umroh.program_hari', $filters['duration']);
            } else {
                $this->where('paket_umroh.program_hari', $filters['duration']);
            }
        }
        if (!empty($filters['hotel_star'])) {
            $star = (int)$filters['hotel_star'];
            $this->groupStart()
                 ->where('paket_umroh.bintang_madinah >=', $star)
                 ->orWhere('paket_umroh.bintang_mekkah >=', $star)
                 ->groupEnd();
        }
        if (!empty($filters['airline'])) {
            $this->like('paket_umroh.maskapai', $filters['airline']);
        }
        if (!empty($filters['departure_city'])) {
            $this->like('paket_umroh.departure_city', $filters['departure_city']);
        }

        $sortBy = $filters['sort_by'] ?? 'popular';
        switch ($sortBy) {
            case 'cheapest':
                $this->orderBy('paket_umroh.harga_jual', 'ASC');
                break;
            case 'fastest':
                $this->orderBy('paket_umroh.program_hari', 'ASC');
                break;
            case 'popular':
            default:
                $this->orderBy('paket_umroh.is_featured', 'DESC')
                     ->orderBy('paket_umroh.created_at', 'DESC');
                break;
        }

        return $this->paginate($perPage);
    }

    /**
     * Get single package with travel agent info
     */
    public function getById(int $id)
    {
        return $this->select('paket_umroh.*, paket_umroh.id_paket as id, travel_agents.name as travel_name, travel_agents.logo as travel_logo, travel_agents.description as travel_desc, travel_agents.phone as travel_phone')
                    ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                    ->where('paket_umroh.id_paket', $id)
                    ->first();
    }

    public function getByAgent(int $agentId)
    {
        return $this->select('paket_umroh.*, paket_umroh.id_paket as id')
                    ->where('travel_agent_id', $agentId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function decrementSeat(int $packageId, int $qty = 1): bool
    {
        $package = $this->find($packageId);
        if (!$package) return false;

        $newJamaah = (int)$package['jumlah_jamaah'] + $qty;
        $newAvailable = (int)$package['total_seat'] - $newJamaah;

        if ($newAvailable < 0) return false;

        return $this->update($packageId, [
            'jumlah_jamaah'  => $newJamaah,
            'available_seat' => $newAvailable,
        ]);
    }

}
