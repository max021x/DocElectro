<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12) ; 
        return view('posts.index');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $fides  = $request->validate([
            ''
        ]);

        Post::created($fides);

        return redirect()->route()->with('success', 'Post is stored in database :)');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request) {

    }

    public function destroy(Post $post) {

    }

}
