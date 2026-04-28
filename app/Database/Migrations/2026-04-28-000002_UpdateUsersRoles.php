<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUsersRoles extends Migration
{
    public function up()
    {
        // Expand role ENUM to support 4 roles
        $this->forge->modifyColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['jamaah', 'agent', 'finance', 'superadmin'],
                'default'    => 'jamaah',
            ],
        ]);

        // Add travel_agent_id for agent users
        $this->forge->addColumn('users', [
            'travel_agent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'role',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'travel_agent_id');

        $this->forge->modifyColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['jamaah', 'admin'],
                'default'    => 'jamaah',
            ],
        ]);
    }
}
