<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SavedPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function  index()
    {

        $user = Auth::user();

        $savedPosts = SavedPost::where('saved_posts.user_id', '=', $user->id)
            ->join('posts', 'saved_posts.post_id', '=', 'posts.id')
            ->select('posts.*', 'saved_posts.created_at')
            ->orderBy('saved_posts.created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('user', 'savedPosts'));
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

    public function deletePost(Request $request, Post $post)
    {

        $user_id = $request->user()->id;
        $post_id = $post->id;
        $savedPost = SavedPost::where('user_id', $user_id)
            ->where('post_id', $post_id)->delete();

        if ($savedPost) {
            return redirect()->back()->with("success", "Post removed from saved items");
        }

        return redirect()->back()->with("error", "Saved post not found");
    }

    public function updateEmail(Request $request)
    {
        $user =  Auth::user();

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'confirm_password' => ['required']
        ]);

        if (!Hash::check($request->input('confirm_password'), $user->password)) {
            return redirect()->back()
                ->with('error', 'Invalid credentials. Please try again.');
        }

        $user->update(
            [
                'email' => $request->input('email'),
            ]
        );

        return redirect()->back()->with('success', 'Your email has changed successfully');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate(
            [
                'current_password' => ['required'],
                'password' => ['required', 'confirmed'],
            ]
        );

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()
                ->with('error', 'Invalid credentials. Please try again.');
        }

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect()->back()->with('success', 'Your password has changed successfully');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => ['required']
        ]);

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()
                ->with('error', 'Invalid credentials. Please try again.');
        }

        $user->status = false ; 
        $user->save() ; 
        
        return redirect()->route('home');
    }
}
