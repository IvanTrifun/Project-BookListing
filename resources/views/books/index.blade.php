@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Books</h1>
        @if (\Illuminate\Support\Facades\Auth::user())
            @foreach (\Illuminate\Support\Facades\Auth::user()->roles as $role)
                @if ($role->role_type=='admin')
                    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
                @endif
            @endforeach
        @endif
        <div class="container">
            <div class="row">
                @foreach (App\Models\Book::all() as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ $book->picture_url }}" alt="{{ $book->title }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">Number of Pages: {{ $book->num_of_pages }}</p>
                                <p class="card-text">Written by: {{ $book->authors[0]->name }} {{ $book->authors[0]->last_name }}</p>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>
                                @if (\Illuminate\Support\Facades\Auth::user())
                                    @foreach (\Illuminate\Support\Facades\Auth::user()->roles as $role)
                                        @if ($role->role_type == 'admin')
                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if (\Illuminate\Support\Facades\Auth::user())
         @foreach (\Illuminate\Support\Facades\Auth::user()->roles as $role)
            @if ($role->role_type=='admin')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Bio</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Author::all() as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->last_name }}</td>
                        <td>{{ $author->bio }}</td>
                        <td>
                            <a href="{{ route('authors.edit', ['author' => $author->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Add New Author</a>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category</th>

                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Category::all() as $category)
                    <tr>
                        <td>{{ $category->category}}</td>

                        <td>
                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    </div>
    @endif
                            @endforeach
                        @endif
@endsection
