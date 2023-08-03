@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $user->name }}</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Activities:</h2>
                <ul class="list-group">
                    @foreach ($activities as $activity)
                        <li class="list-group-item">{{ $activity->created_at->diffForHumans() }} - {{ $activity->action }}: {{ $activity->description }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Manage Content:</h2>
                <div class="list-group">
                    <a href="/articles" class="list-group-item list-group-item-action">Manage Articles</a>
                </div>
            </div>
        </div>
    </div>
@endsection
