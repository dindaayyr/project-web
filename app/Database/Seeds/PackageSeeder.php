<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PackageModel;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packageModel = new PackageModel();
        
        $data = [
            ['2026-06-25', 'AN NAMIROH (paket 2 free 1)', 'GARUDA - FIT', 'YIAMED-JED SUB TRANSIT', 12, 50, 85, -35, 'MADINAH', 'AMJAD', 3, 'MATHER JIWAR', 7, 33700000],
            ['2026-06-25', 'AN NAMIROH', 'GARUDA', 'YIAMED-JEDSUB', 17, 34, 35, -1, 'MADINAH', 'AMJAD', 5, 'MATHER JIWAR', 10, 31000000],
            ['2026-06-25', 'RIHLAH', 'GARUDA', 'YIAMED-JEDSUB', 17, 40, 15, 25, 'MADINAH', 'ROYAL MADINAH', 9, 'MAYSAN AL MAQOM', 7, 33100000],
            ['2026-06-26', 'AN NAMIROH (AHLUL QURAN)', 'GARUDA - MALINDO', 'YIAMED-JEDKULCGK', 12, 50, 64, -14, 'MADINAH', 'AMJAD', 3, 'MATHER JIWAR', 7, 23000000],
            ['2026-06-26', 'AN NAMIROH (paket 2 free 1)', 'GARUDA - MALINDO', 'YIAMED-JEDKULCGK', 12, 105, 137, -32, 'MADINAH', 'BURJ MAWADDAH', 3, 'MANAZIL HIJRAH', 3, 33675000],
            ['2026-06-27', 'AN NAMIROH', 'GARUDA', 'YIAMED-JEDSUB', 18, 45, 7, 38, 'MADINAH', 'AMJAD', 5, 'MATHER JIWAR', 11, 32100000],
            ['2026-07-05', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 16, 45, 42, 3, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 9, 'MEKKAH TOWER', 5, 40850000],
            ['2026-07-06', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 12, 40, 38, 2, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 5, 'MEKKAH TOWER', 5, 37950000],
            ['2026-07-06', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 12, 45, 15, 30, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QESWAH', 5, 29700000],
            ['2026-07-08', 'AN NAMIROH', 'GARUDA', 'SUBJED - JEDSUB', 14, 40, 25, 15, 'MADINAH', 'ARKAN GOLDEN', 5, 'WAHA DHEAFA', 7, 31850000],
            ['2026-07-10', 'AN NAMIROH (paket 2 free 1)', 'belum tersedia', 'sub jed transit', 12, 0, 3, -3, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QISWAH', 7, 35850000],
            ['2026-07-12', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 16, 45, 40, 5, 'MADINAH', 'AMJAD', 9, 'MATHER JIWAR', 5, 32300000],
            ['2026-07-13', 'AN NAMIROH', 'GARUDA', 'SUBJED - MEDSUB', 12, 40, 0, 40, 'MADINAH', 'AMJAD', 5, 'MAYSAN AL MAQOM', 5, 34500000],
            ['2026-07-16', 'TAJALLI', 'LION', 'SUBJED - JEDSUB', 13, 40, 9, 31, 'MADINAH', 'THAIBA SUITE', 6, 'AL MIQAT', 5, 34500000],
            ['2026-07-17', 'AN NAMIROH (paket 3 free 1)', 'belum tersedia', 'sub jed transit', 12, 0, 9, -9, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QISWAH', 7, 32900000],
            ['2026-07-19', 'RIHLAH / FLASH SALE', 'LION', 'SUBJED - JEDSUB', 16, 45, 45, 0, 'MADINAH', 'ROYAL MADINAH', 9, 'VILLA RETAL', 5, 34950000],
            ['2026-07-20', 'ANTRAV', 'LION', 'SUBJED - JEDSUB', 12, 40, 31, 9, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 5, 'VILLA HILTON', 5, 34600000],
            ['2026-07-21', 'AN NAMIROH', 'belum tersedia', 'sub jed transit', 30, 40, 8, 32, 'MADINAH', 'BURJ MAWADDAH', 9, 'PARADISE', 19, 34950000],
            ['2026-08-02', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 16, 45, 14, 31, 'MADINAH', 'THAIBA SUITE', 5, 'AL MUWAHIDIN', 5, 33200000],
            ['2026-08-03', 'AN NAMIROH', 'GARUDA', 'SUBJED - MEDSUB', 12, 40, 2, 38, 'MADINAH', 'BARAKAH KAREM', 9, 'MANAZIL WIZAM', 5, 31250000],
            ['2026-08-06', 'TAJALLI', 'LION', 'SUBJED - JEDSUB', 13, 35, 0, 35, 'MADINAH', 'THAIBA SUITE', 6, 'AL MIQAT', 5, 34500000],
            ['2026-08-09', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 16, 45, 0, 45, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 9, 'MEKKAH TOWER', 5, 40850000],
            ['2026-08-10', 'AN NAMIROH (paket 2 free 1)', 'belum tersedia', 'sub jed transit', 12, 0, 13, -13, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QISWAH', 6, 35850000],
            ['2026-08-17', 'TAJALLI', 'LION', 'SUBJED - JEDSUB', 13, 35, 10, 25, 'MADINAH', 'SHOFWA TOWER', 5, 'THAIBA FRONT', 6, 45150000],
            ['2026-08-17', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 12, 45, 17, 28, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 5, 'MEKKAH TOWER', 5, 37950000],
            ['2026-08-17', 'AN NAMIROH (paket 3 free 1)', 'belum tersedia', 'sub jed transit', 12, 0, 0, 0, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QISWAH', 6, 32100000],
            ['2026-08-19', 'AN NAMIROH', 'GARUDA', 'SUBMED - JEDSUB', 14, 40, 29, 11, 'MADINAH', 'BURJ MAWADDAH', 5, 'PARADISE', 7, 30850000],
            ['2026-08-20', 'AN NAMIROH (Ning Umi Laila)', 'LION', 'SUBJED - JEDSUB', 13, 45, 10, 35, 'MADINAH', 'THAIBA SUITE', 5, 'TALLAT AJYAD', 7, 32950000],
            ['2026-08-21', 'AN NAMIROH', 'belum tersedia', 'sub jed transit', 30, 40, 2, 38, 'MADINAH', 'BURJ MAWADDAH', 9, 'PARADISE', 19, 36125000],
            ['2026-08-22', 'ANTRAV', 'LION', 'SUBJED - JEDSUB', 12, 40, 5, 35, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 5, 'VILLA HILTON', 5, 34600000],
            ['2026-08-23', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 16, 45, 21, 24, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 9, 'MEKKAH TOWER', 5, 40850000],
            ['2026-08-23', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 12, 40, 0, 40, 'MADINAH', 'BURJ MAWADDAH', 5, 'AL QESWAH', 9, 30800000],
            ['2026-08-26', 'TAJALLI', 'GARUDA', 'SUBMED - JEDSUB', 14, 40, 8, 32, 'MADINAH', 'THAIBA SUITE', 5, 'RAWABI ZAMZAM', 7, 35100000],
            ['2026-08-30', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 16, 45, 19, 26, 'MADINAH', 'AMJAD', 9, 'MATHER JIWAR', 5, 33350000],
            ['2026-09-02', 'AN NAMIROH', 'GARUDA', 'SUBMED - JEDSUB', 14, 40, 2, 38, 'MADINAH', 'ARKAN GOLDEN', 5, 'WAHA DHEAFA', 7, 30650000],
            ['2026-09-05', 'AN NAMIROH', 'GARUDA', 'SUBMED - JEDSUB', 16, 40, 10, 30, 'MADINAH', 'ARKAN GOLDEN', 9, 'AL MUWAHIDIN', 5, 33050000],
            ['2026-09-06', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 16, 45, 0, 45, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 9, 'MEKKAH TOWER', 5, 39600000],
            ['2026-09-10', 'AN NAMIROH (paket 2 free 1)', 'belum tersedia', 'sub jed transit', 12, 0, 3, -3, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QISWAH', 6, 35850000],
            ['2026-09-13', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 16, 45, 0, 45, 'MADINAH', 'AMJAD', 9, 'AL MUWAHIDIN', 5, 33150000],
            ['2026-09-14', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 12, 40, 3, 37, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 5, 'MEKKAH TOWER', 5, 36750000],
            ['2026-09-14', 'AN NAMIROH', 'GARUDA', 'SUBMED - JEDSUB', 12, 40, 0, 40, 'MADINAH', 'AMJAD', 5, 'MATHEER JIWAR', 5, 31800000],
            ['2026-09-17', 'TAJALLI', 'LION', 'SUBJED - JEDSUB', 13, 40, 0, 40, 'MADINAH', 'THAIBA SUITE', 6, 'AL MIQAT', 5, 34500000],
            ['2026-09-17', 'AN NAMIROH (paket 3 free 1)', 'belum tersedia', 'sub jed transit', 12, 0, 0, 0, 'MADINAH', 'BURJ MAWADDAH', 3, 'AL QISWAH', 6, 32100000],
            ['2026-09-20', 'RIHLAH', 'LION', 'SUBJED - JEDSUB', 16, 45, 0, 45, 'MADINAH', 'AL ANSOR GOLDEN TULIP', 9, 'MEKKAH TOWER', 5, 39600000],
            ['2026-09-21', 'AN NAMIROH', 'belum tersedia', 'sub jed transit', 30, 40, 0, 40, 'MADINAH', 'BURJ MAWADDAH', 9, 'PARADISE', 19, 36125000],
            ['2026-09-21', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 12, 40, 0, 40, 'MADINAH', 'BARAKAH KAREM', 5, 'AL MUWAHIDIN', 5, 30300000],
            ['2026-09-27', 'AN NAMIROH', 'LION', 'SUBJED - JEDSUB', 16, 45, 0, 45, 'MADINAH', 'ROYAL MADINAH', 5, 'rawabi zamzam', 5, 33550000],
            ['2026-09-28', 'AN NAMIROH', 'GARUDA', 'SUBJED - MUBJED', 12, 40, 5, 35, 'MADINAH', 'BARAKAH KAREM', 5, 'MANAZIL WIZAM', 5, 31250000],
        ];

        foreach ($data as $row) {
            $packageModel->insert([
                'travel_agent_id'   => 4, // Default to An-Namiroh Travel Agent
                'tanggal_berangkat' => $row[0],
                'nama_paket'        => $row[1],
                'maskapai'          => $row[2],
                'rute'              => $row[3],
                'program_hari'      => $row[4],
                'total_seat'        => $row[5],
                'jumlah_jamaah'     => $row[6],
                'available_seat'    => $row[7],
                'miqat_awal'        => $row[8],
                'hotel_madinah'     => $row[9],
                'bintang_madinah'   => $row[10],
                'hotel_mekkah'      => $row[11],
                'bintang_mekkah'    => $row[12],
                'harga_jual'        => $row[13],
                'status'            => 'active',
                'status_paket'      => 'tersedia',
                'description'       => 'Paket Umroh ' . $row[1] . ' dengan durasi ' . $row[4] . ' hari.'
            ]);
        }
    }
}
