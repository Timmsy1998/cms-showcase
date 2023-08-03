@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
        <hr>
        @foreach ($categories as $category)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>{{ $category->name }}</h5>
                </div>
                <div class="card-footer">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form class="d-inline" action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
