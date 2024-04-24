@extends('base')

@section('title','Accueil du Blog')

@section('content')

  <h1>Mon Blog</h1>
  @foreach ($posts as  $post)
    <article>
      <h2>{{ $post->title }}</h2>
      <p class="small">
      @if ($post->category)        
        <span class="badge bg-info">{{ $post->category?->name }}</span>
      @endif 
      @if (!$post->tags->isEmpty())        
        @foreach ($post->tags as $tag)
        <span class="badge bg-secondary">{{ $tag->name }}</span>          
        @endforeach        
      @endif           
      </p>
      <p>{{ $post->content }}</p>
      <p class="small">
          
      </p>
      <p>
        <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post]) }}" class="btn btn-primary">Lire la suite</a>
      </p>
    </article>
    
  @endforeach

  {{ $posts->links() }}
  
@endsection