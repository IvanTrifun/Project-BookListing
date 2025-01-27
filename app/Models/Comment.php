<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['comment', 'user_id', 'status'];
    public function book(){
        return $this->belongsToMany(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
