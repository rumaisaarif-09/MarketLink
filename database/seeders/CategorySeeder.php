<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Required food categories database mein add hongi
        Category::create([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
        ]);

        Category::create([
            'name' => 'Fruits',
            'slug' => 'fruits',
        ]);

        Category::create([
            'name' => 'Grains',
            'slug' => 'grains',
        ]);

        Category::create([
            'name' => 'Organic',
            'slug' => 'organic',
        ]);
    }
}