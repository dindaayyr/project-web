<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'package_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'booking_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'verified', 'completed', 'cancelled'],
                'default'    => 'pending',
            ],
            'payment_proof' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('booking_code');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('package_id', 'packages', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
