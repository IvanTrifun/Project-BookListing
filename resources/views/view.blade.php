
<h1>{{$book->title}}</h1>

<h2>{{$book->category->category}}</h2>
<h3>{{$book->author->name}} {{$book->author->last_name}}</h3>

@foreach ($book->comments as $comment)
<p>{{$comment->user->name}} {{$comment->user->last_name}} :
{{$comment->comment}} on {{$comment->book->title}}</p>
@endforeach
@foreach ($book->notes as $note )
    <h1>{{$note->user->name}}</h1>
    <p>{{$note->note}}</p>
@endforeach

