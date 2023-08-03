@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
        <hr>
        @foreach ($articles as $article)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>{{ $article->title }}</h5>
                </div>
                <div class="card-body">
                    {{ $article->content }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form class="d-inline" action="{{ route('articles.destroy', $article->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
