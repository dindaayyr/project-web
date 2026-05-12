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
        'order_id', 'package_id', 'user_id', 'travel_agent_id',
        'jamaah_name', 'jamaah_email', 'jamaah_phone',
        'total_price', 'payment_status', 'snap_token',
        'payment_method', 'transaction_time', 'settlement_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get booking with package details
     */
    public function getWithPackage(string $orderId)
    {
        return $this->select('bookings.*')
                    ->select('bookings.order_id as booking_code')
                    ->select('bookings.payment_status as status')
                    ->select('paket_umroh.nama_paket, paket_umroh.tanggal_berangkat, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = bookings.travel_agent_id')
                    ->where('bookings.order_id', $orderId)
                    ->first();
    }

    /**
     * Get bookings for a specific travel agent (used by Agent Dashboard)
     */
    public function getAgentBookings(int $agentId)
    {
        return $this->select('bookings.*')
                    ->select('bookings.order_id as booking_code')
                    ->select('bookings.payment_status as status')
                    ->select('paket_umroh.nama_paket, paket_umroh.tanggal_berangkat')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->where('bookings.travel_agent_id', $agentId)
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get bookings for a specific user (used by User Dashboard)
     */
    public function getUserBookings(int $userId)
    {
        return $this->select('bookings.*')
                    ->select('bookings.order_id as booking_code')
                    ->select('bookings.payment_status as status')
                    ->select('paket_umroh.nama_paket, paket_umroh.tanggal_berangkat, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = bookings.travel_agent_id')
                    ->where('bookings.user_id', $userId)
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get bookings ready for disbursement (H-14 before departure)
     */
    public function getReadyForDisbursement()
    {
        $h14Date = date('Y-m-d', strtotime('+14 days'));

        return $this->select('bookings.*')
                    ->select('bookings.order_id as booking_code')
                    ->select('bookings.payment_status as status')
                    ->select('paket_umroh.nama_paket, paket_umroh.tanggal_berangkat, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = bookings.travel_agent_id')
                    ->where('bookings.payment_status', 'success')
                    ->where('bookings.settlement_status', 'pending')
                    ->where('paket_umroh.tanggal_berangkat <=', $h14Date)
                    ->orderBy('paket_umroh.tanggal_berangkat', 'ASC')
                    ->findAll();
    }

    /**
     * Get settled bookings (used by Finance Dashboard)
     */
    public function getSettledBookings()
    {
        return $this->select('bookings.*')
                    ->select('bookings.order_id as booking_code')
                    ->select('bookings.payment_status as status')
                    ->select('paket_umroh.nama_paket, paket_umroh.tanggal_berangkat, travel_agents.name as travel_name')
                    ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = bookings.travel_agent_id')
                    ->whereIn('bookings.payment_status', ['success', 'lunas', 'settlement'])
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }
}
