<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\note;

class NotesController extends Controller
{

    public function index(){
        $notes=Note::all();
        return view('notes.index', compact('notes'));
    }


    public function store(Request $request, $book_id){
        $currentUser = Auth::user();

        $note = Note::create([
                'note'=> $request->input('note'),
                'book_id'=> $request->input('book_id')
            ]);

        $note->users()->attach($currentUser);

            // return redirect()->route('books.show', ['book' => $book->id]);
        return response()->json(['note' => $note->note, 'note_id'=> $note->id]);
    }


    public function update(Request $request, Note $note){

        $note->update([
            'note'=>$request->input('unote'),
        ]);

        return response()->json(['note' => $note->note]);
    }

    public function destroy(Request $request, Note $note){
        $note->delete();
        return response()->json('note deletion successful');
    }


}
