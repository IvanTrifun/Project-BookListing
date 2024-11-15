<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignAuthorsToBooks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $authors = Author::all();

        foreach ($books as $book){
            $randomAuthor = $authors->random();
            $book->authors()->attach($randomAuthor);

        }
    }
}
