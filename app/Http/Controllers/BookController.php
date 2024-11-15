<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Input\Input;

class BookController extends Controller
{

    public function book($bookname){
        $book = Book::where('title', $bookname)->firstOrFail();

        return View::make('view')->with('book', $book);
    }

    public function index(){
        $books=Book::all();
        return view('books.index', compact('books'));
    }

    public function create(){
        return view('books.create');
    }

    public function store(Request $request){
        $categoryid=(int)$request->input('category_id');

        $authorId =(int)$request->input('author_id');
        $selectedAuthor= Author::where('id', $authorId)->first();

        $book=Book::create([

            'title' => $request->input('title'),
            'num_of_pages' => $request->input('num_of_pages'),
            'picture_url' => $request->input('picture_url'),
            'category_id' => $categoryid

        ]);
        $comment = Comment::create([
            'comment'=> " ",
            'user_id' => '1'
        ]);
        $book->authors()->attach($selectedAuthor);
        $book->comments()->attach($comment);


        return redirect()->route('books.index');
    }

    public function show(Book $book){
        return view('books.show', compact('book'));
    }

    public function edit(Book $book){
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book){
        $categoryid         = (int)$request->input('category_id');
        $authorId           = (int)$request->input('author_id');
        $selectedAuthor     = Author::where('id', $authorId)->first();

        $book->update([
            'title' => $request->input('title'),
            'num_of_pages' => $request->input('num_of_pages'),
            'picture_url' => $request->input('picture_url'),
            'category_id' => $categoryid
        ]);

        $book->authors()->sync($selectedAuthor);
        return redirect()->route('books.index')->with('success', 'Successfuly Updated Book');
    }


    public function destroy(Book $book){
        $book->delete();
        return redirect()->route('books.index');
    }
}
