@extends('base')

@section('title', $post->title)

@section('content')

    <article>
      <h1>{{ $post->title }}</h1>
      <p>{{ $post->content }}</p>
      <p>
        <a href="{{ route('blog.edit', ['post' => $post]) }}" class="btn btn-success">Editer l'article</a>
      </p>
    </article>

  
@endsection