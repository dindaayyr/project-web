<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Super Admin
        $this->db->table('users')->insert([
            'name'       => 'Super Admin',
            'email'      => 'admin@umrohqueens.com',
            'phone'      => '08123456789',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'superadmin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Seed Jamaah User
        $this->db->table('users')->insert([
            'name'       => 'Siti Aisyah',
            'email'      => 'siti@email.com',
            'phone'      => '08567891234',
            'password'   => password_hash('jamaah123', PASSWORD_DEFAULT),
            'role'       => 'jamaah',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Seed Finance Admin
        $this->db->table('users')->insert([
            'name'       => 'Admin Keuangan',
            'email'      => 'finance@umrohqueens.com',
            'phone'      => '08111222333',
            'password'   => password_hash('finance123', PASSWORD_DEFAULT),
            'role'       => 'finance',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Seed Travel Agents
        $agents = [
            [
                'name'        => 'Al-Amin Universal Tour',
                'ppiu_number' => 'PPIU/451/2024',
                'address'     => 'Jl. KH. Mas Mansyur No. 12, Jakarta Pusat',
                'city'        => 'Jakarta',
                'phone'       => '021-5551234',
                'email'       => 'info@alamin-tour.com',
                'status'      => 'active',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Berkah Mulia Travel',
                'ppiu_number' => 'PPIU/328/2024',
                'address'     => 'Jl. Ahmad Yani No. 88, Surabaya',
                'city'        => 'Surabaya',
                'phone'       => '031-8881234',
                'email'       => 'info@berkahmulia.com',
                'status'      => 'active',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Safina Haramain',
                'ppiu_number' => 'PPIU/567/2024',
                'address'     => 'Jl. Diponegoro No. 55, Bandung',
                'city'        => 'Bandung',
                'phone'       => '022-7771234',
                'email'       => 'info@safinaharamain.com',
                'status'      => 'active',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('travel_agents')->insertBatch($agents);

        // Seed Agent Users (linked to travel_agents)
        $this->db->table('users')->insert([
            'name'            => 'Agen Al-Amin',
            'email'           => 'agen@alamin-tour.com',
            'phone'           => '08222333444',
            'password'        => password_hash('agent123', PASSWORD_DEFAULT),
            'role'            => 'agent',
            'travel_agent_id' => 1,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'name'            => 'Agen Berkah Mulia',
            'email'           => 'agen@berkahmulia.com',
            'phone'           => '08333444555',
            'password'        => password_hash('agent123', PASSWORD_DEFAULT),
            'role'            => 'agent',
            'travel_agent_id' => 2,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        // Seed Packages (new schema)
        $packages = [
            [
                'travel_agent_id'   => 1,
                'nama_paket'        => 'Paket Umroh Hemat 9 Hari',
                'description'       => 'Paket umroh hemat dengan fasilitas hotel bintang 3, termasuk tiket pesawat PP, makan 3x sehari, dan guide berpengalaman.',
                'harga_jual'        => 23500000,
                'program_hari'      => 9,
                'maskapai'          => 'Saudi Airlines',
                'rute'              => 'CGK - JED - MED',
                'tanggal_berangkat' => '2026-06-15',
                'departure_city'    => 'Jakarta',
                'total_seat'        => 45,
                'jumlah_jamaah'     => 33,
                'available_seat'    => 12,
                'miqat_awal'        => 'Bir Ali',
                'hotel_madinah'     => 'Al Eiman Royal',
                'bintang_madinah'   => 3,
                'hotel_mekkah'      => 'Elaf Al Mashaer',
                'bintang_mekkah'    => 3,
                'image'             => 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=600&h=400&fit=crop',
                'is_featured'       => 1,
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id'   => 2,
                'nama_paket'        => 'Paket Umroh Premium 12 Hari',
                'description'       => 'Paket umroh premium dengan hotel bintang 5 dekat Masjidil Haram, city tour Madinah, dan ziarah lengkap.',
                'harga_jual'        => 35000000,
                'program_hari'      => 12,
                'maskapai'          => 'Garuda Indonesia',
                'rute'              => 'CGK - JED - MED - CGK',
                'tanggal_berangkat' => '2026-07-20',
                'departure_city'    => 'Jakarta',
                'total_seat'        => 30,
                'jumlah_jamaah'     => 22,
                'available_seat'    => 8,
                'miqat_awal'        => 'Bir Ali',
                'hotel_madinah'     => 'Pullman Zamzam Madinah',
                'bintang_madinah'   => 5,
                'hotel_mekkah'      => 'Swissotel Al Maqam',
                'bintang_mekkah'    => 5,
                'image'             => 'https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?w=600&h=400&fit=crop',
                'is_featured'       => 1,
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id'   => 3,
                'nama_paket'        => 'Paket Umroh Reguler Plus 10 Hari',
                'description'       => 'Paket umroh reguler plus dengan hotel bintang 4, termasuk city tour dan ziarah Madinah lengkap.',
                'harga_jual'        => 28000000,
                'program_hari'      => 10,
                'maskapai'          => 'Emirates',
                'rute'              => 'SUB - DXB - JED',
                'tanggal_berangkat' => '2026-08-10',
                'departure_city'    => 'Surabaya',
                'total_seat'        => 40,
                'jumlah_jamaah'     => 15,
                'available_seat'    => 25,
                'miqat_awal'        => 'Juhfah',
                'hotel_madinah'     => 'Millennium Al Aqeeq',
                'bintang_madinah'   => 4,
                'hotel_mekkah'      => 'Hilton Suites Makkah',
                'bintang_mekkah'    => 4,
                'image'             => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=600&h=400&fit=crop',
                'is_featured'       => 1,
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id'   => 1,
                'nama_paket'        => 'Paket Umroh VIP Eksklusif 14 Hari',
                'description'       => 'Pengalaman umroh VIP dengan suite hotel di depan Masjidil Haram, private guide, dan layanan concierge.',
                'harga_jual'        => 55000000,
                'program_hari'      => 14,
                'maskapai'          => 'Garuda Indonesia',
                'rute'              => 'CGK - JED - MED - CGK',
                'tanggal_berangkat' => '2026-06-28',
                'departure_city'    => 'Jakarta',
                'total_seat'        => 15,
                'jumlah_jamaah'     => 12,
                'available_seat'    => 3,
                'miqat_awal'        => 'Bir Ali',
                'hotel_madinah'     => 'The Oberoi Madina',
                'bintang_madinah'   => 5,
                'hotel_mekkah'      => 'Raffles Makkah Palace',
                'bintang_mekkah'    => 5,
                'image'             => 'https://images.unsplash.com/photo-1590076215667-875c2d2d8b4e?w=600&h=400&fit=crop',
                'is_featured'       => 0,
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id'   => 2,
                'nama_paket'        => 'Paket Umroh Keluarga 12 Hari',
                'description'       => 'Paket umroh family-friendly dengan kamar connecting, program anak, dan pendamping khusus.',
                'harga_jual'        => 30000000,
                'program_hari'      => 12,
                'maskapai'          => 'Saudi Airlines',
                'rute'              => 'SUB - JED - MED',
                'tanggal_berangkat' => '2026-09-05',
                'departure_city'    => 'Surabaya',
                'total_seat'        => 35,
                'jumlah_jamaah'     => 35,
                'available_seat'    => 0,
                'miqat_awal'        => 'Bir Ali',
                'hotel_madinah'     => 'Crowne Plaza Madinah',
                'bintang_madinah'   => 4,
                'hotel_mekkah'      => 'Le Meridien Makkah',
                'bintang_mekkah'    => 5,
                'image'             => 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=600&h=400&fit=crop',
                'is_featured'       => 0,
                'status'            => 'sold_out',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id'   => 1,
                'nama_paket'        => 'Paket Umroh Backpacker 7 Hari',
                'description'       => 'Paket ekonomis untuk jamaah yang ingin umroh dengan budget terjangkau. Hotel bintang 3 area Aziziyah.',
                'harga_jual'        => 19500000,
                'program_hari'      => 7,
                'maskapai'          => 'Lion Air',
                'rute'              => 'CGK - JED',
                'tanggal_berangkat' => '2026-07-01',
                'departure_city'    => 'Jakarta',
                'total_seat'        => 50,
                'jumlah_jamaah'     => 12,
                'available_seat'    => 38,
                'miqat_awal'        => 'Juhfah',
                'hotel_madinah'     => 'Al Eiman Taibah',
                'bintang_madinah'   => 3,
                'hotel_mekkah'      => 'Ajyad Makarim',
                'bintang_mekkah'    => 3,
                'image'             => 'https://images.unsplash.com/photo-1580418827493-f2b22c0a76cb?w=600&h=400&fit=crop',
                'is_featured'       => 0,
                'status'            => 'active',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('packages')->insertBatch($packages);

        // Seed Bookings
        $bookings = [
            [
                'user_id'      => 2,
                'package_id'   => 1,
                'booking_code' => 'UQ-20260415-001',
                'total_price'  => 23500000,
                'status'       => 'lunas',
                'paid_at'      => date('Y-m-d H:i:s'),
                'notes'        => 'Pembayaran lunas via Midtrans.',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'      => 2,
                'package_id'   => 3,
                'booking_code' => 'UQ-20260418-002',
                'total_price'  => 28000000,
                'status'       => 'pending',
                'paid_at'      => null,
                'notes'        => 'Menunggu pembayaran.',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('bookings')->insertBatch($bookings);

        // Seed News
        $news = [
            [
                'title'        => 'Kuota Umroh 2026 Ditambah Pemerintah',
                'slug'         => 'kuota-umroh-2026-ditambah',
                'content'      => 'Kementerian Agama RI mengumumkan penambahan kuota jamaah umroh untuk tahun 2026.',
                'image'        => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=600&h=300&fit=crop',
                'author'       => 'Redaksi UmrohQueens',
                'published_at' => date('Y-m-d H:i:s'),
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Tips Memilih Paket Umroh yang Tepat',
                'slug'         => 'tips-memilih-paket-umroh',
                'content'      => 'Memilih paket umroh yang tepat memerlukan pertimbangan matang.',
                'image'        => 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=600&h=300&fit=crop',
                'author'       => 'Redaksi UmrohQueens',
                'published_at' => date('Y-m-d H:i:s'),
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('news')->insertBatch($news);
    }
}
