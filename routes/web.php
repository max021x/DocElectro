<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

Route::view('/' , 'home.index')->name('home') ; 

// Route::view('/register' , 'auth.register') ;

Route::get('/login' , [AuthController::class , 'index'])->name('login') ; 
Route::post('/login' , [AuthController::class , 'authenticate'])->name('login') ; 
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout')  ;



