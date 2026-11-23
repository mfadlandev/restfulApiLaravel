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
        $outlets = DB::table('outlets')->get();

        foreach ($outlets as $outlet) {
            DB::table('categories')->insert([
                // COFFEE
                [
                    'outlet_id' => $outlet->id,
                    'category' => 'Coffee',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // NON COFFEE
                [
                    'outlet_id' => $outlet->id,
                    'category' => 'Non Coffee',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // FOOD
                [
                    'outlet_id' => $outlet->id,
                    'category' => 'Food',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // SNACK
                [
                    'outlet_id' => $outlet->id,
                    'category' => 'Snack',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
