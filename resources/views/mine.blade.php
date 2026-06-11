@extends('app')
@section('content')
<h2>My Posts</h2>
<div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:1rem;" class="myposts">
    @forelse($posts as $post)
        <div style="border:1px solid #ccc; padding:1rem; width:200px;">
            <b>{{ $post->title }}</b><br>
            {{ $post->type }} · {{ $post->category }}<br>
            {{ $post->private ? 'Private' : 'Public' }}<br>
            <a href="{{ route('posts.show', $post->id) }}">View</a> |
            <a href="/posts/{{ $post->id }}/edit">Edit</a> |
            <form method="POST" action="/posts/{{ $post->id }}/delete" style="display:inline">
                @csrf <button type="submit">Delete</button>
            </form>
        </div>
    @empty
        <p>No posts yet.</p>
    @endforelse
</div>
@endsection