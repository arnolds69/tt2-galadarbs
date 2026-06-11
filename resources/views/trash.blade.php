
@extends('app')
@section('content')
<h2>Trash (Deleted Posts)</h2>

@if($posts->count() == 0)
    <p>No deleted posts.</p>
@endif

@foreach($posts as $post)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <b>{{ $post->title }}</b><br>
        <small>By: {{ $post->user->username ?? 'Unknown' }}</small><br>

        <form method="POST" action="/posts/{{ $post->id }}/restore">
            @csrf
            <button type="submit">Restore</button>
        </form>
    </div>
@endforeach

<div style="margin-top:1rem;">
    {{ $posts->links() }}
</div>
@endsection