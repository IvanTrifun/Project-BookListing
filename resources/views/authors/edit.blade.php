@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Update Author</h1>

        <form action="{{ route('authors.update', ['author' => $author->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$author->name}}" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{$author->last_name}}" required>
            </div>
            <div class="form-group">
                <label for="bio">Biography</label>
                <textarea name="bio" id="bio" class="form-control" value="{{$author->bio}}" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
