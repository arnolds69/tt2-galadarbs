@extends('app')
@section('content')
<h2>{{ $user->username }} followers</h2>
<div class="post-grid">
    @forelse($followers as $follower)
        <div class="post-card">
            <a href="{{ route('profile.show', $follower->id) }}">{{ $follower->username }}</a>
        </div>
    @empty
        <p>No followers yet.</p>
    @endforelse
</div>
<div class="pagination">
    @if(!$followers->onFirstPage())
        <a href="{{ $followers->previousPageUrl() }}">Previous</a>
    @endif
    <span>Page {{ $followers->currentPage() }} of {{ $followers->lastPage() }}</span>
    @if($followers->hasMorePages())
        <a href="{{ $followers->nextPageUrl() }}">Next</a>
    @endif
</div>
@endsection