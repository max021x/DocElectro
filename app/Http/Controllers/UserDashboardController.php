<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SavedPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function  index()
    {

        $user = Auth::user();

        $savedPosts = SavedPost::where('saved_posts.user_id', '=' , $user->id)
            ->join('posts', 'saved_posts.post_id', '=', 'posts.id')
            ->select('posts.*', 'saved_posts.created_at')
            ->orderBy('saved_posts.created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('user' , 'savedPosts'));
    }


    public function savePost(Request $request,  Post $post)
    {

        $user_id = $request->user()->id;
        $post_id = $post->id;

        $isSaved = SavedPost::where('user_id', $user_id)
            ->where('post_id', $post_id)->exists();

        if ($isSaved) {
            return redirect()->back()->with("error", "Sorry you have already saved this post before");
        }

        SavedPost::create([
            'user_id' => $user_id,
            'post_id' => $post_id
        ]);

        return redirect()->back()->with("success", "Tutorial has saved see the dashboard");
    }

    public function deletePost (Request $request , Post $post) {
        
    }
}
