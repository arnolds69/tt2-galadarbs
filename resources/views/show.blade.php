@extends('app')
@section('content')
<div style="max-width:600px; margin:2rem auto;" class="showpost">
    <h2>{{ $post->title }}</h2>
    <p>By: {{ $post->user->username }} || {{ $post->category }} || {{ $post->type }} || views:  {{ $post->viewcount }} || {{ $post->private ? 'Private' : 'Public' }}</p>
    <br>
    <p> Created: {{ $post->created_at }} || Last updated: {{ $post->updated_at }}
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
        @if(auth()->id() === $post->user_id || auth()->user()->role === 'admin')
            <a href="/posts/{{ $post->id }}/edit">Edit</a> | 
            <form method="POST" action="/posts/{{ $post->id }}/delete" style="display:inline">
                @csrf <button type="submit">Delete</button>
            </form><br>
            <a href="/">Back</a>

        @endif
    @endauth

</div>
@endsection