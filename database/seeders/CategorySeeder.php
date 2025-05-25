<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // <-- Tambahkan ini
use Illuminate\Support\Str; // <-- Tambahkan ini
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $categories = ['Sneakers', 'Sports', 'Casual', 'Formal'];
    foreach ($categories as $category) {
        Category::create([
            'name' => $category,
            'slug' => Str::slug($category)
        ]);
    }
}
}
