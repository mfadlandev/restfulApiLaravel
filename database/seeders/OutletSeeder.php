<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outlets')->insert([
            [
                'name' => 'Outlet Denpasar',
                'address' => 'Denpasar, Bali',
                'phone' => '081234567801',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outlet Singaraja',
                'address' => 'Singaraja, Bali',
                'phone' => '081234567802',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outlet Badung',
                'address' => 'Badung, Bali',
                'phone' => '081234567803',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
