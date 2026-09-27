<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate([
            'slug' => 'vegetables',
        ], [
            'name' => 'Vegetables',
        ]);

        Category::firstOrCreate([
            'slug' => 'fruits',
        ], [
            'name' => 'Fruits',
        ]);

        Category::firstOrCreate([
            'slug' => 'grains',
        ], [
            'name' => 'Grains',
        ]);

        Category::firstOrCreate([
            'slug' => 'organic',
        ], [
            'name' => 'Organic',
        ]);
    }
}