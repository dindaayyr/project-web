<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePackagesTable extends Migration
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
            'travel_agent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'duration_days' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'hotel_star' => [
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 3,
            ],
            'airline' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'departure_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'departure_city' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'quota_total' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 45,
            ],
            'quota_remaining' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 45,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'is_featured' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'sold_out'],
                'default'    => 'active',
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
        $this->forge->addForeignKey('travel_agent_id', 'travel_agents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('packages');
    }

    public function down()
    {
        $this->forge->dropTable('packages');
    }
}
