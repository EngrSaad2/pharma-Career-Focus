<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::withCount('posts')->get();

        $query = BlogPost::with('category')->where('is_published', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('summary', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        $posts = $query->orderBy('published_at', 'desc')->paginate(6)->withQueryString();
        $recentPosts = BlogPost::where('is_published', true)->orderBy('published_at', 'desc')->take(4)->get();

        return view('pages.blog.index', compact('posts', 'categories', 'recentPosts'));
    }

    public function show($slug)
    {
        $post = BlogPost::with(['category', 'author'])->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $post->increment('views_count');

        $relatedPosts = BlogPost::where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }
}
