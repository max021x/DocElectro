<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;

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
        $converter = new CommonMarkConverter();
        $post->content = $converter->convert($post->content)->getContent();
        return view('admin.posts.show', compact('post'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, and PNG images are allowed.',
            'image.max' => 'The image must not exceed 2MB in size.',
        ]);


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('upload/posts', 'public');
            $validated['image'] = basename($path);
        } else {
            $validated['image'] = null;
        }

        Post::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $htmlContent,
            'image' => $validated['image'],
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, and PNG images are allowed.',
            'image.max' => 'The image must not exceed 2MB in size.',
        ]);

        if ($request->has('remove_image') && $request->remove_image) {
            if ($post->image && Storage::disk('public')->exists('upload/posts/' . $post->image)) {
                Storage::disk('public')->delete('upload/posts/' . $post->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists('upload/posts/' . $post->image)) {
                Storage::disk('public')->delete('upload/posts/' . $post->image);
            }
            $path = $request->file('image')->store('upload/posts', 'public');
            $validated['image'] = basename($path);
        } else {
            $validated['image'] = $post->image;
        }

        $post->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $validated['content'],
            'image' => $validated['image'],
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists('upload/posts/' . $post->image)) {
            Storage::disk('public')->delete('upload/posts/' . $post->image);
        }

        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully!');
    }
}
