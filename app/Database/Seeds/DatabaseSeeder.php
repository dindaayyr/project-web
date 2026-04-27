<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Admin User
        $this->db->table('users')->insert([
            'name'       => 'Admin UmrohQueens',
            'email'      => 'admin@umrohqueens.com',
            'phone'      => '08123456789',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'admin',
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

        // Seed Packages
        $packages = [
            [
                'travel_agent_id' => 1,
                'name'            => 'Paket Umroh Hemat 9 Hari',
                'description'     => 'Paket umroh hemat dengan fasilitas hotel bintang 3, termasuk tiket pesawat PP, makan 3x sehari, dan guide berpengalaman.',
                'price'           => 23500000,
                'duration_days'   => 9,
                'hotel_star'      => 3,
                'airline'         => 'Saudi Airlines',
                'departure_date'  => '2026-06-15',
                'departure_city'  => 'Jakarta',
                'quota_total'     => 45,
                'quota_remaining' => 12,
                'image'           => 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=600&h=400&fit=crop',
                'is_featured'     => 1,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 2,
                'name'            => 'Paket Umroh Premium 12 Hari',
                'description'     => 'Paket umroh premium dengan hotel bintang 5 dekat Masjidil Haram, city tour Madinah, dan ziarah lengkap.',
                'price'           => 35000000,
                'duration_days'   => 12,
                'hotel_star'      => 5,
                'airline'         => 'Garuda Indonesia',
                'departure_date'  => '2026-07-20',
                'departure_city'  => 'Jakarta',
                'quota_total'     => 30,
                'quota_remaining' => 8,
                'image'           => 'https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?w=600&h=400&fit=crop',
                'is_featured'     => 1,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 3,
                'name'            => 'Paket Umroh Reguler Plus 10 Hari',
                'description'     => 'Paket umroh reguler plus dengan hotel bintang 4, termasuk city tour dan ziarah Madinah lengkap.',
                'price'           => 28000000,
                'duration_days'   => 10,
                'hotel_star'      => 4,
                'airline'         => 'Emirates',
                'departure_date'  => '2026-08-10',
                'departure_city'  => 'Surabaya',
                'quota_total'     => 40,
                'quota_remaining' => 25,
                'image'           => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=600&h=400&fit=crop',
                'is_featured'     => 1,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 1,
                'name'            => 'Paket Umroh VIP Eksklusif 14 Hari',
                'description'     => 'Pengalaman umroh VIP dengan suite hotel di depan Masjidil Haram, private guide, dan layanan concierge.',
                'price'           => 55000000,
                'duration_days'   => 14,
                'hotel_star'      => 5,
                'airline'         => 'Garuda Indonesia',
                'departure_date'  => '2026-06-28',
                'departure_city'  => 'Jakarta',
                'quota_total'     => 15,
                'quota_remaining' => 3,
                'image'           => 'https://images.unsplash.com/photo-1590076215667-875c2d2d8b4e?w=600&h=400&fit=crop',
                'is_featured'     => 0,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 2,
                'name'            => 'Paket Umroh Keluarga 12 Hari',
                'description'     => 'Paket umroh family-friendly dengan kamar connecting, program anak, dan pendamping khusus.',
                'price'           => 30000000,
                'duration_days'   => 12,
                'hotel_star'      => 4,
                'airline'         => 'Saudi Airlines',
                'departure_date'  => '2026-09-05',
                'departure_city'  => 'Surabaya',
                'quota_total'     => 35,
                'quota_remaining' => 0,
                'image'           => 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=600&h=400&fit=crop',
                'is_featured'     => 0,
                'status'          => 'sold_out',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 3,
                'name'            => 'Paket Umroh Ramadhan 15 Hari',
                'description'     => 'Rasakan ibadah umroh di bulan suci Ramadhan. Termasuk sahur & buka puasa di hotel dekat Haram.',
                'price'           => 42000000,
                'duration_days'   => 15,
                'hotel_star'      => 5,
                'airline'         => 'Emirates',
                'departure_date'  => '2027-03-01',
                'departure_city'  => 'Jakarta',
                'quota_total'     => 25,
                'quota_remaining' => 18,
                'image'           => 'https://images.unsplash.com/photo-1519817650390-64a93db51149?w=600&h=400&fit=crop',
                'is_featured'     => 0,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 1,
                'name'            => 'Paket Umroh Backpacker 7 Hari',
                'description'     => 'Paket ekonomis untuk jamaah yang ingin umroh dengan budget terjangkau. Hotel bintang 3 area Aziziyah.',
                'price'           => 19500000,
                'duration_days'   => 7,
                'hotel_star'      => 3,
                'airline'         => 'Lion Air',
                'departure_date'  => '2026-07-01',
                'departure_city'  => 'Jakarta',
                'quota_total'     => 50,
                'quota_remaining' => 38,
                'image'           => 'https://images.unsplash.com/photo-1580418827493-f2b22c0a76cb?w=600&h=400&fit=crop',
                'is_featured'     => 0,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 2,
                'name'            => 'Paket Umroh Plus Turki 16 Hari',
                'description'     => 'Kombinasi umroh dan wisata Turki. Kunjungi Istanbul, Cappadocia, sebelum menuju Tanah Suci.',
                'price'           => 48000000,
                'duration_days'   => 16,
                'hotel_star'      => 4,
                'airline'         => 'Turkish Airlines',
                'departure_date'  => '2026-08-20',
                'departure_city'  => 'Jakarta',
                'quota_total'     => 20,
                'quota_remaining' => 14,
                'image'           => 'https://images.unsplash.com/photo-1541432901042-2d8bd64b4a9b?w=600&h=400&fit=crop',
                'is_featured'     => 0,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'travel_agent_id' => 3,
                'name'            => 'Paket Umroh Ekspress 5 Hari',
                'description'     => 'Paket umroh kilat untuk jamaah yang memiliki waktu terbatas. Langsung terbang ke Jeddah.',
                'price'           => 21000000,
                'duration_days'   => 5,
                'hotel_star'      => 3,
                'airline'         => 'Saudi Airlines',
                'departure_date'  => '2026-06-22',
                'departure_city'  => 'Bandung',
                'quota_total'     => 40,
                'quota_remaining' => 4,
                'image'           => 'https://images.unsplash.com/photo-1466442929976-97f336a657be?w=600&h=400&fit=crop',
                'is_featured'     => 0,
                'status'          => 'active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('packages')->insertBatch($packages);

        // Seed Bookings for demo user
        $bookings = [
            [
                'user_id'      => 2,
                'package_id'   => 1,
                'booking_code' => 'UQ-20260415-001',
                'total_price'  => 23500000,
                'status'       => 'verified',
                'notes'        => 'Pembayaran DP telah dikonfirmasi.',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'      => 2,
                'package_id'   => 3,
                'booking_code' => 'UQ-20260418-002',
                'total_price'  => 28000000,
                'status'       => 'pending',
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
                'content'      => 'Kementerian Agama RI mengumumkan penambahan kuota jamaah umroh untuk tahun 2026. Kebijakan ini disambut baik oleh biro travel di seluruh Indonesia.',
                'image'        => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=600&h=300&fit=crop',
                'author'       => 'Redaksi UmrohQueens',
                'published_at' => date('Y-m-d H:i:s'),
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Tips Memilih Paket Umroh yang Tepat',
                'slug'         => 'tips-memilih-paket-umroh',
                'content'      => 'Memilih paket umroh yang tepat memerlukan pertimbangan matang. Perhatikan legalitas biro travel, fasilitas hotel, dan maskapai yang digunakan.',
                'image'        => 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=600&h=300&fit=crop',
                'author'       => 'Redaksi UmrohQueens',
                'published_at' => date('Y-m-d H:i:s'),
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Visa Umroh Kini Bisa Diurus Online',
                'slug'         => 'visa-umroh-online',
                'content'      => 'Arab Saudi meluncurkan sistem e-visa untuk jamaah umroh. Proses pengurusan visa kini lebih mudah dan cepat melalui platform digital.',
                'image'        => 'https://images.unsplash.com/photo-1580418827493-f2b22c0a76cb?w=600&h=300&fit=crop',
                'author'       => 'Redaksi UmrohQueens',
                'published_at' => date('Y-m-d H:i:s'),
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('news')->insertBatch($news);
    }
}
