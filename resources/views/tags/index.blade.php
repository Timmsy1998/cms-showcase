@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tags</h1>
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Create New Tag</a>
        <hr>
        @foreach ($tags as $tag)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>{{ $tag->name }}</h5>
                </div>
                <div class="card-footer">
                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form class="d-inline" action="{{ route('tags.destroy', $tag->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
