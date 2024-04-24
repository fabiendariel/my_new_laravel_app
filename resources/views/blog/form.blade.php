<form action="" method="post">
  @csrf
  @method($post->id ? 'PATCH' : 'POST')
  <div class="form-group mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
    @error("title")
      {{ $message }}
    @enderror
  </div>
  <div class="form-group mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" class="form-control" name="slug" value="{{ old('slug', $post->slug) }}">
    @error("slug")
      {{ $message }}
    @enderror
  </div>
  <div class="form-group mb-3">
    <label for="content" class="form-label">Contenu</label>
    <textarea class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
    @error("content")
      {{ $message }}
    @enderror
  </div>
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ URL::previous() }}" class="btn btn-danger">Retour</a>
    <button type="submit" class="btn btn-secondary">
      @if ($post->id)
        Modifier
      @else
        Créer
      @endif
    </button>
  </div>
</form>