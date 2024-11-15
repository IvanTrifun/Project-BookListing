<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Comment;
use App\Models\Note;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



// https://www.youtube.com/watch?v=KgB3wntZfzI&t=342s
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRelationships;


    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'username',
        'email',
        'password'
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * @var array<int, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function roles (){
        return $this->belongsToMany(Role::class);
    }

    public function comments(){
        return $this->hasOne(Comment::class);
    }

    public function notes(){
        return $this->belongsToMany(Note::class);
    }

}
