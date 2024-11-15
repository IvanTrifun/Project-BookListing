<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [ 'note', 'book_id' ];

    public function books(){
        return $this->belongsTo(Book::class);
    }

    public function users(){
        $users = $this->belongsToMany(User::class);
        return $users ;
    }


}
