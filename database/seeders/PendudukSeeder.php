<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penduduks')->insert([
            [
                'NIK' => '5101010000000001',
                'nama' => 'Made Adi',
                'JK' => 'Laki-laki',
                'TTL' => 'Singaraja, 2000-01-10',
                'banjar_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NIK' => '5101010000000002',
                'nama' => 'Putu Ayu',
                'JK' => 'Perempuan',
                'TTL' => 'Singaraja, 2001-05-15',
                'banjar_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NIK' => '5101010000000003',
                'nama' => 'Komang Surya',
                'JK' => 'Laki-laki',
                'TTL' => 'Singaraja, 1999-08-20',
                'banjar_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NIK' => '5101010000000004',
                'nama' => 'Ketut Sari',
                'JK' => 'Perempuan',
                'TTL' => 'Singaraja, 2002-03-12',
                'banjar_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
