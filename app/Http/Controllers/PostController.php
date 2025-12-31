<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        $posts = $query->paginate(12) ;
        return view('posts.index' , compact('posts')) ;  
    }

    public function show (Post $post) 
    {       
        $comments = Comment::where('post_id' , $post->id)->get() ; 
        return view('posts.show' , compact('post' , 'comments')) ; 
    }
}
