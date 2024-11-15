<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'num_of_pages', 'picture_url', 'category_id'];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function comments(){
        return $this->belongsToMany(Comment::class);
    }
};


