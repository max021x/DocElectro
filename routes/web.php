<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

Route::view('/' , 'home.index') ; 

Route::view('/login' , 'auth.login') ; 
Route::view('/register' , 'auth.register') ; 




