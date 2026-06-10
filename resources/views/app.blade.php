<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkoutLog</title>
    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: sans-serif; }
    nav { display: flex; justify-content: space-between; padding: 1rem 2rem; border-bottom: 1px solid #ccc; }
    nav a { text-decoration: none; color: #000; margin-left: 1rem; }
    .content { padding: 1rem 2rem; }
    .post-grid { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem; }
    .post-card { border: 1px solid #ccc; padding: 1rem; width: 180px; }
</style>
</head>
<body>
<nav>
    <div>
        @guest
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
    </div>
    <div>
        @auth
            <a href="{{ route('posts.create') }}">New Post</a>
            <a href="{{ route('posts.mine') }}">My Posts</a>
            <a href="{{ route('profile.show', auth()->id()) }}">My Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf <button type="submit">Log out</button>
            </form>
        @endauth
    </div>
</nav>
<hr>
<div style="padding:1rem">
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif
    @if(session('error'))<p style="color:red">{{ session('error') }}</p>@endif
    @yield('content')
</div>
</body>
</html>