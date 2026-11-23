<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlets = DB::table('outlets')->get();

        foreach ($outlets as $outlet) {

            $coffee = DB::table('categories')
                ->where('outlet_id', $outlet->id)
                ->where('category', 'Coffee')
                ->value('category_id');

            $nonCoffee = DB::table('categories')
                ->where('outlet_id', $outlet->id)
                ->where('category', 'Non Coffee')
                ->value('category_id');

            $food = DB::table('categories')
                ->where('outlet_id', $outlet->id)
                ->where('category', 'Food')
                ->value('category_id');

            $snack = DB::table('categories')
                ->where('outlet_id', $outlet->id)
                ->where('category', 'Snack')
                ->value('category_id');

            DB::table('products')->insert([
                // COFFEE
                [
                    'outlet_id' => $outlet->id,
                    'name' => 'Espresso',
                    'slug' => $outlet->id . '-' . Str::slug('Espresso'),
                    'description' => 'Kopi espresso murni dengan cita rasa kuat dan aroma khas kopi.',
                    'category_id' => $coffee,
                    'price' => 18000,
                    'img' => 'products/espresso.jpg',
                    'stock' => 30,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'outlet_id' => $outlet->id,
                    'name' => 'Cafe Latte',
                    'slug' => $outlet->id . '-' . Str::slug('Cafe Latte'),
                    'description' => 'Perpaduan espresso dan susu yang lembut.',
                    'category_id' => $coffee,
                    'price' => 22000,
                    'img' => 'products/cafe-latte.jpg',
                    'stock' => 25,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // NON COFFEE
                [
                    'outlet_id' => $outlet->id,
                    'name' => 'Matcha Latte',
                    'slug' => $outlet->id . '-' . Str::slug('Matcha Latte'),
                    'description' => 'Minuman matcha dengan susu.',
                    'category_id' => $nonCoffee,
                    'price' => 25000,
                    'img' => 'products/matcha-latte.jpg',
                    'stock' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // FOOD
                [
                    'outlet_id' => $outlet->id,
                    'name' => 'Chicken Rice',
                    'slug' => $outlet->id . '-' . Str::slug('Chicken Rice'),
                    'description' => 'Nasi dengan ayam pilihan.',
                    'category_id' => $food,
                    'price' => 28000,
                    'img' => 'products/chicken-rice.jpg',
                    'stock' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // SNACK
                [
                    'outlet_id' => $outlet->id,
                    'name' => 'French Fries',
                    'slug' => $outlet->id . '-' . Str::slug('French Fries'),
                    'description' => 'Kentang goreng renyah.',
                    'category_id' => $snack,
                    'price' => 15000,
                    'img' => 'products/french-fries.jpg',
                    'stock' => 30,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
