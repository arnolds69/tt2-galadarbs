@extends('app')
@section('content')
<div style="max-width:500px; margin:2rem auto;">
    <h2>{{ $user->username }}</h2>
    <p>Posts: {{ $postCount }}</p>
    <p><a href="{{ route('profile.followers', $user->id) }}">Followers</a>: {{ $followerCount }}</p>
    <p>Role: {{ $user->role }}</p>
    @auth
        @if(auth()->id() !== $user->id)
            @if($isFollowing)
                <form method="POST" action="{{ route('profile.unfollow', $user->id) }}">
                    @csrf
                    <button type="submit">Unfollow</button>
                </form>
            @else
                <form method="POST" action="{{ route('profile.follow', $user->id) }}">
                    @csrf
                    <button type="submit">Follow</button>
                </form>
            @endif
        @endif
    @endauth

    @if(auth()->id() === $user->id)
        <hr>
        <h3>Change password</h3>
        <form method="POST" action="/profile/{{ $user->id }}/password">
            @csrf
            <input type="password" name="password" placeholder="New password" required><br>
            <input type="password" name="password_confirmation" placeholder="Confirm password" required><br>
            <button type="submit">Update password</button>
        </form>
    @endif
</div>
@endsection