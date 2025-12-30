<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index () 
    {
        $query = Post::query() ; 

        if(request()->has('category')){
            $query->where('category' , request('category')) ; 
        }

        if(request()->has('search')) {
            $query->where('title' , 'like' , '%' . request('search') . '%')
            ->orWhere('content' , 'like' , '%' . request('search') . '%') ;  
        }

        $posts = $query->paginate(6) ;
        return view('posts.index' , compact('posts')) ;  
    }
}
