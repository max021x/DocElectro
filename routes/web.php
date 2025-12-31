<?php

use App\Http\Middleware\AdminDashboard;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserDashboardController;

Route::view('/', 'home.index')->name('home');


Route::middleware(['guest'])->group(function () {
    
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
    // Route::view('/register' , 'auth.register') ;    
});

Route::get('/posts', [PostController::class , 'index'])->name('posts.index');
Route::get('/posts/{post}/show', [PostController::class , 'show'])->name('posts.show');

Route::middleware(['auth'])->group(function  () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/comment/{post}/store' , [CommentController::class , 'store'])->name('comments.store') ; 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
}) ; 

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts/store', [AdminPostController::class, 'store'])->name('admin.posts.create');
    Route::get('/posts/{id}/show', [AdminPostController::class, 'show'])->name('admin.posts.show');
    Route::get('/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::post('/posts/{id}/update', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::post('/posts/{id}/destroy', [AdminPostController::class, 'update'])->name('admin.posts.destroy');

    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'index'])->name('admin.users.create');
});
