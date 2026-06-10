@extends('app')
@section('content')
<div style="max-width:400px; margin:2rem auto;">
    <h2>Register</h2>
    <form method="POST" action="/register">
        @csrf
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="password_confirmation" placeholder="Confirm password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
</div>
@endsection