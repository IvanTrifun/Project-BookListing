@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column">
        <div class="p-2">
            <h1 class="mt-4">{{ $book->title }}</h1>
            <p class="lead">By : {{ $book->authors[0]->name }} {{ $book->authors[0]->last_name }}</p>
            <hr>
        </div>
        <div class="d-flex justify-content-between">
            <div class="p-2">
                <img src="{{ $book->picture_url }}" alt="">
                @if (\Illuminate\Support\Facades\Auth::user())
                @foreach (\Illuminate\Support\Facades\Auth::user()->roles as $role)
                   @if ($role->role_type=='admin')
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>

                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                @endif
                    @endforeach
                        @endif
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
            <div class="p-2">
                <p>{{$book->authors[0]->bio}}</p>
            </div>
        </div>

            <br>
            {{-- NOTES --}}
        @if (\Illuminate\Support\Facades\Auth::user())
            <div style="display: block" class="notesContainer border border-2 border-warning p-4">
                <a class="addNote btn btn-primary my-3">Add Note</a>
                <form class="createNoteForm" style="display: flex">
                    <input type="hidden" name="book_id" value="{{$book->id}}">
                    <label class="m-2" for="note">Note: </label>
                    <textarea class="form-control" id="note" name="note" rows="4"></textarea>
                    <button type="submit" class="submitNote m-3 btn btn-primary" data-book-id="{{$book->id}}">Create Note</button>
                </form>
                {{$i= null;}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody class="noteTableBody">
                    @foreach ($book->notes as $note)
                    @foreach ($note->users as $user)

                            @if (\Illuminate\Support\Facades\Auth::user()->id == $user->id)
                                    <tr class="tr-{{$note->id}}">
                                        <td>{{$i+=1;}}</td>
                                        <td class="note note-{{$note->id}}" data-note-id="{{$note->id}}">
                                            <span class="note-content content-note-{{$note->id}}">{{ $note->note }}</span>
                                        </td>
                                        <td>
                                            <form class="updateNote" data-note-id="{{$note->id}}">
                                                <input type="text" class="form-control note-input noteInput-{{$note->id}}" data-note-id="{{$note->id}}" id='unote' name='unote' value="{{$note->note}}" style="display: none;">
                                                <button class="addTheNote addTheNote-{{$note->id}} btn btn-success py-1" data-note-id="{{$note->id}}" style="display: none"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="edit-note btn btn-primary m-1 edit-note-{{$note->id}}" data-note-id="{{$note->id}}">Edit Note</a>
                                            <a class="delteNote delete-note-{{$note->id}} btn btn-danger" data-note-id="{{$note->id}}">Delete Note</a>
                                        </td>
                                    </tr>
                                @endif
                        @endforeach
                    @endforeach
                        </tbody>
                </table>
            </div>
        @endif

            {{-- COMMENTS --}}
            <br>

            <form  id="#create-comment-form" class="createComment d-block">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            @if (\Illuminate\Support\Facades\Auth::user())
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" name="comment" id="comment" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit comment</button>
            @endif

            <hr>
            <h3>COMMENTS :</h3>


            <div class="CommentsDisplayAproved d-inline-flex">
                <div class="commentButtonContainer">
                    <a style="display:none;" class="btn btn-danger m-2 px-4 deleteCommentApproved deleteComment">X</a>
                </div>
            </div>

            @foreach ($book->comments as $comment)

                @if ($comment->status == 'approved')
                    <div class="d-flex comment-{{$comment->id}}">
                        <div class="d-inline-flex approvedCommentsDisplay">

                            <h4>{{$comment->user->username}} :</h4>
                            <p class="m-1">{{$comment->comment}}</p>

                            @if (\Illuminate\Support\Facades\Auth::user())
                                @if ($comment->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                    <a id="dugmence" class="btn btn-danger m-2 px-4 deleteComment" data-comment-id="{{$comment->id}}">Delete</a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach

    <hr style="width: 100%">

    @if (\Illuminate\Support\Facades\Auth::user())
        <div class="CommentsDisplay d-inline-flex"></div>
        @foreach (\Illuminate\Support\Facades\Auth::user()->roles as $role)
            @if ($role->role_type=='admin' && $comment->status == 'pending')
                    <h1>Admin Approve/Disapprove Comments</h1>
                <div class="adminReviewCommentsDisplay"></div>
            @endif
        @endforeach
    @endif

            @foreach ($book->comments as $comment)
                <div class="d-flex">
                    <div class="d-inline-flex">
                        @if (\Illuminate\Support\Facades\Auth::user())
                            @foreach (\Illuminate\Support\Facades\Auth::user()->roles as $role)
                                @if ($role->role_type=='admin' && $comment->status == 'pending')
                                <div class="d-inline-flex comment-{{$comment->id}}">
                                    <h4>{{$comment->user->username}} :</h4>
                                    <p class="m-1 px-2 border border-top-5 border-bottom-5">{{$comment->comment}}</p>

                                    <a class="approveComment btn btn-success m-1 px-4" data-comment-id="{{$comment->id}}">Approve</a>
                                    <a class="disapproveComment btn btn-danger m-1 px-4" data-comment-id="{{$comment->id}}">Disapprove</a>
                                </div>
                                @endif
                            @endforeach
                       @endif
                    </div>
                </div>
            @endforeach
        </form>
@endsection
