<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

// returns the home page with all posts
Route::get('/', PostController::class .'@index')->name('posts.index');
// returns the form for adding a post
Route::get('/posts/create', PostController::class . '@create')->name('posts.create')->middleware('auth');
// adds a post to the database
Route::post('/posts', PostController::class .'@store')->name('posts.store')->middleware('auth');
// returns a page that shows a full post
Route::get('/posts/{post}', PostController::class .'@show')->name('posts.show');
// returns the form for editing a post
Route::get('/posts/{post}/edit', PostController::class .'@edit')->name('posts.edit')->middleware('auth');
// updates a post
Route::put('/posts/{post}', PostController::class .'@update')->name('posts.update')->middleware('auth');
// deletes a post
Route::delete('/posts/{post}', PostController::class .'@destroy')->name('posts.destroy')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
