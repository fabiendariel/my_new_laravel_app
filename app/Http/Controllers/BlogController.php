<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    
    public function index(): View
    {
        $posts = Post::paginate(1);
        return view('blog.index', [
            'posts' => \App\Models\Post::paginate(1)
        ]);
    }

    public function show(string $slug, int $id): RedirectResponse | View
    {
        $post = \App\Models\Post::findOrFail($id);
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $id]);
        }
        return view('blog.show', [
            'post' => $post
        ]);;
    }

}
