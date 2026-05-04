<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'package_id', 'booking_code', 'total_price',
        'status', 'payment_proof', 'notes',
        'midtrans_transaction_id', 'midtrans_snap_token',
        'payment_type', 'paid_at'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Get bookings for a specific user with package details
     */
    public function getUserBookings(int $userId)
    {
        return $this->select('bookings.*, paket_umroh.nama_paket as package_name, paket_umroh.tanggal_berangkat as departure_date, paket_umroh.image as package_image, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                    ->where('bookings.user_id', $userId)
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get bookings for packages owned by a specific travel agent
     */
    public function getAgentBookings(int $agentId)
    {
        return $this->select('bookings.*, paket_umroh.nama_paket as package_name, paket_umroh.tanggal_berangkat as departure_date, users.name as user_name, users.email as user_email, users.phone as user_phone')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('users', 'users.id = bookings.user_id')
                    ->where('paket_umroh.travel_agent_id', $agentId)
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get all successful bookings for finance/disbursement
     */
    public function getSettledBookings()
    {
        return $this->select('bookings.*, paket_umroh.nama_paket as package_name, paket_umroh.harga_jual, paket_umroh.tanggal_berangkat, paket_umroh.travel_agent_id, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                    ->where('bookings.status', 'lunas')
                    ->orderBy('paket_umroh.tanggal_berangkat', 'ASC')
                    ->findAll();
    }

    /**
     * Get bookings ready for disbursement (H-14 rule)
     */
    public function getReadyForDisbursement()
    {
        $cutoffDate = date('Y-m-d', strtotime('+14 days'));

        return $this->select('bookings.*, paket_umroh.nama_paket as package_name, paket_umroh.harga_jual, paket_umroh.tanggal_berangkat, paket_umroh.travel_agent_id, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = paket_umroh.travel_agent_id')
                    ->where('bookings.status', 'lunas')
                    ->where('paket_umroh.tanggal_berangkat <=', $cutoffDate)
                    ->orderBy('paket_umroh.tanggal_berangkat', 'ASC')
                    ->findAll();
    }

}
