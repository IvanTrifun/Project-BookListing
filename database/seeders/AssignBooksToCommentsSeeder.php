<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignBooksToCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $comments = Comment::all();

        foreach ($books as $book){
            $randomComment = $comments->random();
            $book->comments()->attach($randomComment);

        }
    }
}
