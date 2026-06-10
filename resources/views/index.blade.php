@extends('app')
@section('content')
<h2>Posts</h2>
<div class="content">
    @forelse($posts as $post)
        <div class="post-card">
            <b>{{ $post->title }}</b>
            User: {{ $post->user->username }}<br>
            Views: {{ $post->viewcount }}<br>
            <a href="{{ route('posts.show', $post->id) }}">View</a>
        </div>
    @empty
        <p>No posts yet.</p>
    @endforelse
</div>
@endsection