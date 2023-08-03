@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Tag</h1>
        <form action="{{ route('tags.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Tag</button>
        </form>
    </div>
@endsection
