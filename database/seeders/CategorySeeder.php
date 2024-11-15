<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['category' => 'Action']);
        Category::create(['category' => 'Horror']);
        Category::create(['category' => 'Drama']);
        Category::create(['category' => 'Sci-fi']);
        Category::create(['category' => 'Thriller']);
        Category::create(['category' => 'Comedy']);
        Category::create(['category' => 'Fantasy']);
    }
}
