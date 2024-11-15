<?php

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', function () {
    return redirect()->route('books.index');
});


Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/user/{username}', [\App\Http\Controllers\UserController::class, 'user']);

Route::resource('/books', \App\Http\Controllers\BookController::class);

Route::resource('/authors', \App\Http\Controllers\AuthorController::class);

Route::resource('/categories', \App\Http\Controllers\CategoryController::class);

Route::resource('/comments', \App\Http\Controllers\CommentController::class);

Route::resource('/notes', \App\Http\Controllers\NotesController::class);

Route::post('/notes/{book_id}/store', [\App\Http\Controllers\NotesController::class, 'store'])->name('comments.store');

Route::get('/notes/{note}/update', [\App\Http\Controllers\NotesController::class, 'update'])->name('comments.update');

Route::get('/notes/{note}/delete', [\App\Http\Controllers\NotesController::class, 'destroy'])->name('comments.destroy');

Route::delete('/comments/{comment}/delete', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/comments/{comment}/approve', [\App\Http\Controllers\CommentController::class, 'approve'])->name('comments.approve');

Route::get('/comments/{comment}/disapprove', [\App\Http\Controllers\CommentController::class, 'disapprove'])->name('comments.disapprove');

