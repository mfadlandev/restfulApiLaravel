<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('iurans')->insert([
            [
                'p_id' => 1,
                'tahun' => '2026',
                'tanggal' => '2026-01-10',
                'nominal' => 50000,
                'payment' => 'Transfer',
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'p_id' => 1,
                'tahun' => '2026',
                'tanggal' => '2026-02-10',
                'nominal' => 50000,
                'payment' => 'Tunai',
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'p_id' => 2,
                'tahun' => '2026',
                'tanggal' => '2026-01-15',
                'nominal' => 50000,
                'payment' => 'Transfer',
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'p_id' => 3,
                'tahun' => '2026',
                'tanggal' => '2026-02-15',
                'nominal' => 50000,
                'payment' => 'Tunai',
                'status' => 'Belum Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
