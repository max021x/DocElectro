<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function  index()
    {

        $user = Auth::user();



        return view('user.dashboard', compact('user'));
    }
}
