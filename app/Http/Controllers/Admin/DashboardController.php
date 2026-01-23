<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment ; 
use App\Models\Contact ;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {   
        $totalPosts = Post::count() ; 
        $totalComments = Comment::count();
        $totalContacts = Contact::count() ;  
        $totalUsers = User::count() ;  
        return view('admin.dashboard.index' ,  compact('totalPosts' , 'totalComments' , 'totalContacts' , 'totalUsers')) ; 
    }
}
