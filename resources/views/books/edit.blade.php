@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Book</h1>

        <form action="{{ route('books.update', ['book' => $book->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$book->title}}" required>
            </div>
            <div class="form-group">
                <label for="num_of_pages">Number of Pages</label>
                <input type="number" name="num_of_pages" id="numofpages" class="form-control" value="{{$book->num_of_pages}}" required>
            </div>
            <div class="form-group">
                <label for="picture_url">Picture(URL)</label>
                <textarea name="picture_url" id="picture" class="form-control" value="{{$book->picture_url}}" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Category</option>
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="author_id">Author:</label>
                <select name="author_id" id="author_id" class="form-control">
                    <option value="">Select an Author</option>
                    @foreach (App\Models\Author::all() as $author)
                        <option value="{{ $author->id }}">{{ $author->name}} , {{$author->last_name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>


        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection

