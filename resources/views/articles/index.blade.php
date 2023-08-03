@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Articles</h1>

        <!-- Search Form for Articles -->
        <form action="{{ route('articles.search') }}" method="GET" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search articles...">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
        <hr>

        <!-- Display Articles with Pagination -->
        <div class="row">
            @foreach ($articles as $article)
                <div class="col-md-6 mb-3">
                    <div class="card">
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
                </div>
            @endforeach
        </div>

        <!-- Display Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
