<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Note;
use App\Models\Role;
use App\Models\User;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Category;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AuthorSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\AsignRoleSeeder;
use Database\Seeders\AssignAuthorsToBooks;
use Database\Seeders\AssignUserCommentSeeder;
use Database\Seeders\AssignNotesToUsersSeeder;
use Database\Seeders\AssignBooksToCommentsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);

        $this->call(AsignRoleSeeder::class);
        $this->call(AssignNotesToUsersSeeder::class);
        $this->call(AssignAuthorsToBooks::class);
        $this->call(AssignBooksToCommentsSeeder::class);
    }
}
