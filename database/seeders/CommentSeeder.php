<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $getRandomUser = $users->random();
        Comment::factory(20)->create()->each(function ($comments){
            foreach($comments as $comment){
                $comment->user->attach($getRandomUser->id);
            }
        });
    }
}
