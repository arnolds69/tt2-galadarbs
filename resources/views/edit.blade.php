@extends('app')
@section('content')

<div style="max-width:600px; margin:2rem auto;">
    <h2>Edit Post</h2>

    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $post->title }}" required><br>

        <select name="type">
            <option value="history" {{ $post->type == 'history' ? 'selected' : '' }}>History</option>
            <option value="plan" {{ $post->type == 'plan' ? 'selected' : '' }}>Plan</option>
        </select><br>

        <select name="private">
            <option value="0" {{ $post->private == 0 ? 'selected' : '' }}>Public</option>
            <option value="1" {{ $post->private == 1 ? 'selected' : '' }}>Private</option>
        </select><br>

        <select name="category">
            <option value="running" {{ $post->category == 'running' ? 'selected' : '' }}>Running</option>
            <option value="lifting" {{ $post->category == 'lifting' ? 'selected' : '' }}>Lifting</option>
            <option value="swimming" {{ $post->category == 'swimming' ? 'selected' : '' }}>Swimming</option>
            <option value="cycling" {{ $post->category == 'cycling' ? 'selected' : '' }}>Cycling</option>
            <option value="other" {{ $post->category == 'other' ? 'selected' : '' }}>Other</option>
        </select><br>

        <h3 style="margin-top:1rem">Exercises</h3>

        <div id="exercises">
            @foreach($post->exercises as $i => $ex)
                <div style="display:flex; gap:.5rem; margin-bottom:.5rem">
                    <input type="hidden" name="exercises[{{ $i }}][id]" value="{{ $ex->id }}">

                    <input name="exercises[{{ $i }}][exercisename]"
                           value="{{ $ex->exercisename }}"
                           placeholder="Exercise name">

                    <input name="exercises[{{ $i }}][duration]"
                           value="{{ $ex->duration }}"
                           type="number"
                           placeholder="Duration">

                    <input name="exercises[{{ $i }}][weight]"
                           value="{{ $ex->weight }}"
                           type="number"
                           placeholder="Weight">

                    <label>
                        <input type="checkbox" name="exercises[{{ $i }}][delete]">
                        Delete
                    </label>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addEx()">+ Add exercise</button><br><br>

        <button type="submit">Save changes</button>
    </form>
</div>

<script>
let i = {{ count($post->exercises) }};

function addEx() {
    document.getElementById('exercises').insertAdjacentHTML('beforeend',
        `<div style="display:flex; gap:.5rem; margin-bottom:.5rem">
            <input name="exercises[${i}][exercisename]" placeholder="Exercise name">
            <input name="exercises[${i}][duration]" type="number" placeholder="Duration">
            <input name="exercises[${i}][weight]" type="number" placeholder="Weight">
        </div>`);
    i++;
}
</script>

@endsection