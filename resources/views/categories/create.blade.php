@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Create Category</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create New Category</button>
        </form>

        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
