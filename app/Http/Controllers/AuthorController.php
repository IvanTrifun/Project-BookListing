<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors=Author::all();
        return view('books.index', compact('authors'));
    }

    public function create(){
        return view('authors.create');
    }

    public function store(Request $request){
        Author::create([
            'name'=>$request->input('name'),
            'last_name'=>$request->input('last_name'),
            'bio'=>$request->input('bio')
        ]);

        return redirect()->route('books.index')->with('success', 'Author Stored successfuly');
    }

    public function show(Author $author){
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author){
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author){


        $author->update([
            'name'=>$request->input('name'),
            'last_name'=>$request->input('last_name'),
            'bio'=>$request->input('bio')
        ]);

        return redirect()->route('books.index')->with('success', 'Author Updated successfuly');
    }


    public function destroy(Author $author){
        $author->delete();
        return redirect()->route('books.index');
    }
}
