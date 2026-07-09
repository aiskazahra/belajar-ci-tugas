<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        // nominal diskon berbeda tiap hari, dimulai dari tanggal hari ini
        // sampai dengan 9 hari selanjutnya (total 10 data, tanpa tanggal ganda)
        $nominals = [
            50000,
            75000,
            100000,
            25000,
            150000,
            60000,
            80000,
            120000,
            40000,
            200000,
        ];

        foreach ($nominals as $i => $nominal) {
            $data = [
                'tanggal' => date('Y-m-d', strtotime("+{$i} day")),
                'nominal' => $nominal,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('discount')->insert($data);
        }
    }
}
