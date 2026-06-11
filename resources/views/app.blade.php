<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tt2galadarbs</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<nav>
     
    
    <div>
        <a href="{{ url('/') }}">Home</a>

    </div>
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
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('posts.trash') }}">Trash</a>
            @endif
        
        @endauth
    </div>
</nav>
<div style="padding:1rem">
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif
    @if(session('error'))<p style="color:red">{{ session('error') }}</p>@endif
    @yield('content')
</div>
</body>
</html>