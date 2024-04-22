<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    
    public function index(): View
    {        
        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse | View
    {
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'post' => $post]);
        }
        return view('blog.show', [
            'post' => $post
        ]);;
    }

}
