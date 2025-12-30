<?php

use App\Http\Middleware\AdminDashboard;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::view('/', 'home.index')->name('home');

// Route::view('/register' , 'auth.register') ;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/posts', [PostController::class], 'index')->name('posts.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

});