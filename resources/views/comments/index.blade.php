@extends('layouts.app')

@section('content')
    {{-- @foreach ($comments as $comment)
    <div class="d-flex" id="comment-{{$comment->id}}">
        <div class="d-inline-flex">
            <h4>{{$comment->user->username}} :</h4>
            <p class="m-1">{{$comment->comment}}</p>
        </div>
    </div>

    @endforeach --}}

<hr style="width: 100%">

    @foreach ($comments as $comment )
        @if ($comment->status == 'not_approved')
                 <div class="d-inline-flex" id="comment-{{$comment->id}}">
                    <div class="d-flex">
                        <h4>{{$comment->user->username}} : </h4>
                        <p class="m-1">{{$comment->comment}}</p>
                        <a href="{{ route('comments.approve', ['comment' => $comment->id])}}" class="btn btn-success m-1 px-4">/\</a>
                        <a class="btn btn-danger m-1 px-4 deleteComment" data-comment-id="{{$comment->id}}">X</a>
                    </div>
                </div>
        @endif
    @endforeach
@endsection
