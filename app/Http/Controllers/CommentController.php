<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post ;
use App\Models\Comment ; 

class CommentController extends Controller
{

    
    public function store (Request $request , Post $post) 
    {           
        $request->validate([
            'content' => ['required' , 'max:1000'] , 
        ]) ; 

        Comment::create([
            'content' => $request->input('content') , 
            'post_id' => $post->id , 
            'user_id' => $request->user()->id
        ])  ; 

        return redirect()->route('posts.show' , $post->id)->with('success' , 'Your comments has sent') ; 
        
    }
}
