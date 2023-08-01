<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(PostController::class)->group(function () {
        Route::get('user/posts', 'index')->name('post.index');
        Route::get('user/posts/create', 'create')->name('post.create');
        Route::get('user/posts/trash', 'trash')->name('post.trash');
        Route::get('user/posts/{post}/edit', 'edit')->name('post.edit');
        Route::get('user/posts/{post}/show', 'show')->name('post.show');
        Route::get('user/posts/{id}/delete', 'delete')->name('post.delete');
        Route::get('user/posts/{id}/destroy', 'destroy')->name('post.destroy');
        Route::get('user/posts/{id}/restore', 'restore')->name('post.restore');

        Route::post('user/posts', 'store')->name('post.store');
        Route::put('user/posts/{id}', 'update')->name('post.update');
    });

    Route::controller(CommentController::class)->group(function(){
        Route::post('comment', 'store')->name('comment.store');
    });
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('blog.index');
    Route::get('blogs/', 'index')->name('blog.index');
    Route::get('blogs/{post}', 'show')->name('blog.show');
});