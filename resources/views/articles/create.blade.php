@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Article</h1>
        <form action="{{ route('articles.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Article</button>
        </form>
    </div>
@endsection
