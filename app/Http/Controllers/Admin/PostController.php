<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Route;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::query();

        if (request()->has('search')) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('content', 'like', '%' . request('search') . '%');
        }

        $posts = $query->paginate(12);
        return view('admin.posts.index', compact('posts'));
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
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string',  'max:100'],
            'content' => ['required' , 'string'] , 
            'image' => ['required', 'nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, and PNG images are allowed.',
            'image.max' => 'The image must not exceed 2MB in size.',
        ]);

        Post::create([...$fides , 'user_id' => $request->user()->id]);

        return redirect()->route('admin.posts.index')->with('success', 'Post is stored in database :)');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request) {}

    public function destroy(Request $request, Post $post)
    {
        if (!$post) {
            return redirect()->back()->with('error', 'Post not Found :(');
        }
        $post->delete();
        return redirect()->back()->with('success', 'Post is Deleted :)');
    }
}
