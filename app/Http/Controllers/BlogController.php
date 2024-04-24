<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\View\View;
use Str;

class BlogController extends Controller
{
    
    public function index(): View
    {        
        $posts = Post::with('category')->get();
        foreach($posts as $post){
            $category = $post->category?->name;
        }        
        
        return view('blog.index', [
            'posts' => Post::paginate(4)
        ]);
    }

    public function create(): View
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post
        ]);
    }

    public function store(FormPostRequest $request): RedirectResponse
    {        
        $post = Post::create($request->validated());

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success','L\'article a bien été créé');
    }

    public function edit(Post $post): View
    {
        return view('blog.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, FormPostRequest $request): RedirectResponse
    {
        $post->update($request->validated());

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'L\'article a bien été modifié');
    }

    public function show(string $slug, Post $post): RedirectResponse | View
    {
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'post' => $post]);
        }
        return view('blog.show', [
            'post' => $post
        ]);
    }

}
