<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
            Category::create([
                'category'=>$request->input('category')
            ]);

            return redirect()->route('books.index')->with('success', 'Category Stored successfuly');
    }

    public function edit(Category $category){
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category){
            $category->update([
                'category'=>$request->input('category')
            ]);

            return redirect()->route('books.index')->with('success', 'Category Updated successfuly');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('books.index')->with('success', 'Category Destroyed successfuly');
    }
}
