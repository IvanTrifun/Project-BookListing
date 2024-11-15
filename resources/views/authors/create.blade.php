@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Create Author</h1>

        <form action="{{ route('authors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="bio">Biography</label>
                <textarea name="bio" id="bio" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create New Author</button>
        </form>

        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
