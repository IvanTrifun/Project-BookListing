<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(50)->has(Note::factory(4))->create();
    }
}
