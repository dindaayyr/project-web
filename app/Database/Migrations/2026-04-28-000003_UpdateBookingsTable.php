<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateBookingsTable extends Migration
{
    public function up()
    {
        // Expand status ENUM for Midtrans flow
        $this->forge->modifyColumn('bookings', [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'verified', 'lunas', 'completed', 'cancelled', 'refunded'],
                'default'    => 'pending',
            ],
        ]);

        // Add Midtrans-related columns
        $this->forge->addColumn('bookings', [
            'midtrans_transaction_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'status',
            ],
            'midtrans_snap_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'midtrans_transaction_id',
            ],
            'payment_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'midtrans_snap_token',
            ],
            'paid_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'payment_type',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bookings', [
            'midtrans_transaction_id',
            'midtrans_snap_token',
            'payment_type',
            'paid_at',
        ]);

        $this->forge->modifyColumn('bookings', [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'verified', 'completed', 'cancelled'],
                'default'    => 'pending',
            ],
        ]);
    }
}
