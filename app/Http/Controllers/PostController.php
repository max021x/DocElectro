<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostViews;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::query();

        if (request()->has('category')) {
            $query->where('category', request('category'));
        }

        if (request()->has('search')) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('content', 'like', '%' . request('search') . '%');
        }

        $posts = $query->paginate(12);
        return view('posts.index', compact('posts'));
    }

    public function show(Request $request, Post $post)
    {
        $ip = $request->ip();
        static::incrementView($ip, $post->id);
        $comments = Comment::where('post_id', $post->id)->get();
        $converter = new CommonMarkConverter();
        $post->content = $converter->convert($post->content)->getContent();
        return view('posts.show', compact('post', 'comments'));
    }

    private static function incrementView($ip, $id)
    {
        $storedIp = PostViews::where('post_id', $id)->where('ip_address', $ip)->exists();
        if (!$storedIp) {

            PostViews::create([
                'post_id' => $id,
                'ip_address' => $ip
            ]);

            $post = Post::find($id);
            $view = $post->views + 1;
            $post->update(['views' => $view]);
        }
    }
}
