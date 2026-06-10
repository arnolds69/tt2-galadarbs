@extends('app')
@section('content')
<div style="max-width:400px; margin:2rem auto;">
    <h2>Log in</h2>
    <form method="POST" action="/login">
        @csrf
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Log in</button>
    </form>
    <p>No account? <a href="{{ route('register') }}">Register</a></p>
</div>
@endsection