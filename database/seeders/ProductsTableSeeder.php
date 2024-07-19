<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = ['manual_car', 'automatic_car', 'truck', 'motorcycle', 'quad'];

        foreach (range(1, 20) as $index) {
            DB::table('products')->insert([
                'name' => 'Product ' . $index,
                'description' => 'Description for Product ' . $index,
                'price' => rand(50, 500),
                'category' => $categories[array_rand($categories)],
                'image' => 'assets/product' . rand(1, 5) . '.jpg',
                'duration' => rand(30, 120),
                'level' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
