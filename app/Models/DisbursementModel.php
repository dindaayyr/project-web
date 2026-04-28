<?php

namespace App\Models;

use CodeIgniter\Model;

class DisbursementModel extends Model
{
    protected $table            = 'disbursements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'booking_id', 'travel_agent_id',
        'gross_amount', 'commission_rate', 'commission_amount', 'net_amount',
        'status', 'disbursed_at', 'notes'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Get disbursements with related info
     */
    public function getAll()
    {
        return $this->select('disbursements.*, travel_agents.name as travel_name, bookings.booking_code, packages.nama_paket as package_name')
                    ->join('travel_agents', 'travel_agents.id = disbursements.travel_agent_id')
                    ->join('bookings', 'bookings.id = disbursements.booking_id')
                    ->join('packages', 'packages.id = bookings.package_id')
                    ->orderBy('disbursements.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get disbursements for a specific travel agent
     */
    public function getByAgent(int $agentId)
    {
        return $this->select('disbursements.*, bookings.booking_code, packages.nama_paket as package_name')
                    ->join('bookings', 'bookings.id = disbursements.booking_id')
                    ->join('packages', 'packages.id = bookings.package_id')
                    ->where('disbursements.travel_agent_id', $agentId)
                    ->orderBy('disbursements.created_at', 'DESC')
                    ->findAll();
    }
}
