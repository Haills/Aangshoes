<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $products = [
        [
            'name' => 'Air Running Pro',
            'category_id' => 1,
            'price' => 299.99,
            'stock' => 50
        ],
        // ... tambahkan data lainnya
    ];
    
    foreach ($products as $product) {
        Product::create($product);
    }
}
}
