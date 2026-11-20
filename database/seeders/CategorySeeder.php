<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category' => 'Coffee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Non Coffee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Tea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Frappe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Pastry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Dessert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
