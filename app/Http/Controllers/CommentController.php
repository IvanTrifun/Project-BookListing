<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $comments=Comment::all();

        return view('comments.index', compact('comments'));
    }



    public function store(Request $request){
        $currentUser=Auth::user();
        $book = Book::where('id', $request->input('book_id'))->first();

        $comment = Comment::create([
            'comment'=>$request->input('comment'),
            'user_id'=>$currentUser->id,
            'status' => 'pending'
        ]);

        $comment->book()->attach($book);

        // printf($username = $comment->user->username);
        // die;

        // return response()->json(['error' => $username], 500);
        return response()->json(['username' => $comment->user->username, 'comment' =>$comment->comment, 'commentId'=> $comment->id]);
    }

    public function show(Comment $comment){

        return redirect()->route('books.show',['book'=> $comment->book()->first()->id]);
    }

    public function edit(Comment $comment){
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment){
        // $comment->update([
        //     'status'=>$request->input('status')
        // ]);

        // return redirect()->route('books.show' , ['book' => $bookId])->with('success', 'Comment Updated successfuly');
    }

    public function destroy(Comment $comment){
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function approve(Request $request, Comment $comment){
        $user = $comment->user()->first();
        $currentUser = Auth::user();

        $comment->update([
            'comment'=> $comment->comment,
            'user_id'=> $user->id,
            'status'=> 'approved'
        ]);

        // return redirect()->route('books.show',['book'=> $comment->book()->first()->id]);
        return response()->json([
        'comment_id' => $comment->id,
        'username' => $comment->user->username,
        'comment' => $comment->comment,
        'currentUserId' => $currentUser->id, 'userId' => $user->id
        ]);
    }

    public function disapprove(Request $request, Comment $comment){
        $user = $comment->user()->first();


        $comment->update([
            'comment'=> $comment->comment,
            'user_id'=> $user->id,
            'status' => 'not_approved'
        ]);

        // return redirect()->route('books.show',['book'=> $comment->book()->first()->id]);
        return response()->json(['message' => 'Comment dissaproved successfully']);
    }
}
