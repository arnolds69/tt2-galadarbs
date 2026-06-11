@extends('app')
@section('content')
<div style="max-width:600px; margin:2rem auto;">
    <h2>{{ $post->title }}</h2>
    <p>By: {{ $post->user->username }} · {{ $post->category }} · {{ $post->type }} · views:  {{ $post->viewcount }}</p>
    <hr>
    <h3>Exercises</h3>
    <ul>
        @foreach($post->exercises as $ex)
            <li>
                {{ $ex->exercisename }}
                {{ $ex->duration ? '· '.$ex->duration.' min' : '' }}
                {{ $ex->weight ? '· '.$ex->weight.' kg' : '' }}
            </li>
        @endforeach
    </ul>
    @auth
        @if(auth()->id() === $post->user_id)
            <a href="/posts/{{ $post->id }}/edit">Edit</a> |
            <form method="POST" action="/posts/{{ $post->id }}/delete" style="display:inline">
                @csrf <button type="submit">Delete</button>
            </form>
        @endif
    @endauth
    <br><a href="/">← Back</a>
</div>
@endsection