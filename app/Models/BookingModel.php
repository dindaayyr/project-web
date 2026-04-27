<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'package_id', 'booking_code', 'total_price', 'status', 'payment_proof', 'notes'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Get bookings for a specific user with package details
     */
    public function getUserBookings(int $userId)
    {
        return $this->select('bookings.*, packages.name as package_name, packages.departure_date, packages.image as package_image, travel_agents.name as travel_name')
                    ->join('packages', 'packages.id = bookings.package_id')
                    ->join('travel_agents', 'travel_agents.id = packages.travel_agent_id')
                    ->where('bookings.user_id', $userId)
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }
}
