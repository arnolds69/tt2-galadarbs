@extends('app')
@section('content')
<h2>Posts</h2>
<div class="page-wrapper">
    <div class="content">
        <form method="GET" action="/">
            <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
            <button type="submit">Search</button>
        </form>
        <div class="post-grid">
            @forelse($posts as $post)
                <div class="post-card">
                    <b>{{ $post->title }}</b><br>
                    <small>{{ $post->category }}</small><br>
                    <small>User: <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->username }}</a></small><br>
                    <small>Views: {{ $post->viewcount }}</small><br>
                    <a href="{{ route('posts.show', $post->id) }}">View</a>
                </div>
            @empty
                <p>No posts yet.</p>
            @endforelse
        </div>
    </div>
    <div class="sidebar">
        <b>Filter </b><br><br>
        <a href="/?category=running">Running</a><br>
        <a href="/?category=lifting">Lifting</a><br>
        <a href="/?category=swimming">Swimming</a><br>
        <a href="/?category=cycling">Cycling</a><br>
        <a href="/?category=other">Other</a><br>
        <a href="/">All</a>

        <br><br>

    <b>Sort by</b><br><br>

    <a href="/?sort=recent">Most Recent</a><br>
    <a href="/?sort=views">Most Views</a><br>
    </div>
</div>
<div class="pagination">
    @if(!$posts->onFirstPage())
        <a href="{{ $posts->previousPageUrl() }}">Previous</a>
    @endif
    <span>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</span>
    @if($posts->hasMorePages())
        <a href="{{ $posts->nextPageUrl() }}">Next</a>
    @endif
</div>
@endsection