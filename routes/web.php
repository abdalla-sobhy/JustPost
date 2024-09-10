<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\postController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'welcome')->name('views.welcome');

// Route::get('/test', function () {
//     $test = "Test again";
//     return "<h1>".$test."</h1>";
// });

// Route::post('/', function (Request $request) {
//     // validate the incoming request
//     // create new post
//     dd($request->all());
// });

// Route::put('/{id}', function (Request $request, $id) {
//     // edit post based on the id
//     return $id;
// });

// Route::delete('/{id}', function ($id) {
//     // delete post based on the id
//     return $id;
// });

// Route::get('/posts', [postController::class, 'index'])->name('post.index');
// Route::get('/posts/create', [postController::class, 'create']);
// Route::post('/posts', [postController::class, 'store']);
// Route::get('/posts/{id}', [postController::class, 'show']);
// Route::get('/posts/{id}/edit', [postController::class, 'edit']);
// Route::put('/posts/{id}', [postController::class, 'update']);
// Route::delete('/posts/{id}', [postController::class, 'destroy']);


Route::middleware('auth')->group(function(){
    Route::get('/posts/create', [postController::class, 'create'])->name('posts.create');
    Route::post('/posts', [postController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [postController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [postController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [postController::class, 'destroy'])->name('posts.destroy');
    Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

    Route::post('/posts/{post}', [commentController::class, 'store'])->name('comments.store');

    Route::middleware('is_admin')->group(function(){
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    });
});

// Route::resource('/posts', postController::class)->middleware('auth');

Route::get('/posts', [postController::class, 'index'])->name('posts.index'); // un secured by any middleware
Route::get('/posts/{post}', [postController::class, 'show'])->name('posts.show'); // ( was ) secured by a costume middleware

// Route::get('/posts/{post}', [commentController::class, 'index'])->name('comments.index');


Route::middleware('guest')->group(function(){
    Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginUserController::class, 'login'])->name('login');
    Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');
});




// MVP model view controller

// Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
// Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

// Route::get('/login', [LoginUserController::class, 'login'])->name('login');
// Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');

