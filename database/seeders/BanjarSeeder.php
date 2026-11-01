<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanjarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banjars')->insert([
            ['nama' => 'Banjar Adat Kaja',
             'created_at' => now(), 'updated_at' => now()],

            ['nama' => 'Banjar Adat Kelod',
             'created_at' => now(), 'updated_at' => now()],

            ['nama' => 'Banjar Adat Tengah',
             'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
