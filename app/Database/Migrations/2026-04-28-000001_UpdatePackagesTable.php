<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePackagesTable extends Migration
{
    public function up()
    {
        // Step 1: Rename existing columns
        $this->forge->modifyColumn('packages', [
            'name' => [
                'name'       => 'nama_paket',
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'price' => [
                'name'       => 'harga_jual',
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'duration_days' => [
                'name'       => 'program_hari',
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'departure_date' => [
                'name' => 'tanggal_berangkat',
                'type' => 'DATE',
                'null' => true,
            ],
            'quota_total' => [
                'name'       => 'total_seat',
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 45,
            ],
            'quota_remaining' => [
                'name'       => 'available_seat',
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 45,
            ],
            'airline' => [
                'name'       => 'maskapai',
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);

        // Step 2: Add new columns
        $this->forge->addColumn('packages', [
            'jumlah_jamaah' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
                'after'      => 'total_seat',
            ],
            'rute' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'maskapai',
            ],
            'miqat_awal' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'rute',
            ],
            'hotel_madinah' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'miqat_awal',
            ],
            'bintang_madinah' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 3,
                'after'      => 'hotel_madinah',
            ],
            'hotel_mekkah' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'bintang_madinah',
            ],
            'bintang_mekkah' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 3,
                'after'      => 'hotel_mekkah',
            ],
        ]);

        // Step 3: Drop old hotel_star column (replaced by bintang_madinah + bintang_mekkah)
        $this->forge->dropColumn('packages', 'hotel_star');
    }

    public function down()
    {
        // Re-add hotel_star
        $this->forge->addColumn('packages', [
            'hotel_star' => [
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 3,
                'after'      => 'program_hari',
            ],
        ]);

        // Drop new columns
        $this->forge->dropColumn('packages', [
            'jumlah_jamaah', 'rute', 'miqat_awal',
            'hotel_madinah', 'bintang_madinah',
            'hotel_mekkah', 'bintang_mekkah',
        ]);

        // Rename back
        $this->forge->modifyColumn('packages', [
            'nama_paket' => [
                'name'       => 'name',
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga_jual' => [
                'name'       => 'price',
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'program_hari' => [
                'name'       => 'duration_days',
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'tanggal_berangkat' => [
                'name' => 'departure_date',
                'type' => 'DATE',
                'null' => true,
            ],
            'total_seat' => [
                'name'       => 'quota_total',
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 45,
            ],
            'available_seat' => [
                'name'       => 'quota_remaining',
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 45,
            ],
            'maskapai' => [
                'name'       => 'airline',
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);
    }
}
