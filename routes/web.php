<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

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

// About
Route::get('/about', function () {
    return view('about.about');
});

// Profile All Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Contact All Routes
Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index');
    Route::post('/contacts','store')->name('contact.store');
});

// Posts All Routes
Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/add/post', 'add')->name('add.post');
    Route::post('/store/post/', 'store')->name('store.post');
    Route::get('/post/{id}', 'details')->name('post.details');
    Route::get('/search', 'search')->name('search.posts');
    Route::get('/posts', 'all')->name('posts.all');    
    Route::get('/my-posts', 'myPosts')->name('my.posts');
    Route::get('/category-{category_id}', 'searchByCategory')->name('search.by.category');
    Route::get('/edit/{id}', 'editPost')->name('edit.post');
    Route::get('/delete/{id}', 'destroy')->name('delete.post');
    Route::post('/update/post/{id}', 'update')->name('update');
    Route::post('/posts/{post}/comments', 'addComment')->name('post.addComment');
    Route::post('/posts/{post}/like', 'likePost')->name('post.like');
    Route::delete('/posts/{post}/unlike', 'unlikePost')->name('post.unlike');
});

require __DIR__.'/auth.php';
