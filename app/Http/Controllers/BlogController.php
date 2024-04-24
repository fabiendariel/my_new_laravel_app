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
        
        $post = Post::find(5);

// Eloquent Relationships
        // On créé une catégorie et on l'affecte au post en cours
        // $category = $post->category()->create([
        //     'name' => 'Categorie 1'
        // ]);

        // On affecte la categorie en cours au post en cours
        // $post->category()->associate($category);
        
        // On créé des tags
        // $post->tags()->createMany([[
        //     'name' => 'Tag 1'
        // ],[
        //     'name' => 'Tag 2'
        // ]]);
        
        // Retirer un tag
        // $post->tags()->detach(2);
        
        // Update de la liste des tags
        // $post->tags()->sync([1,2]);
        
        // On récupère les posts de la catégories dont l'id de post > à 4
        // $category->posts()->where('id','>','4')->get();  

        // $post->save();

        // Retourne tous les posts ayant au moins un tag
        // $posts = Post::has('tags', '>=', 1)->get();

        // dd($posts);
        return view('blog.index', [
            'posts' => Post::with('tags', 'category')->paginate(10)
        ]);
    }

    public function create(): View
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get()
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
            'post' => $post,
            'categories' => Category::select('id', 'name')->get()
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
