@extends('app')
@section('content')
<div style="max-width:600px; margin:2rem auto;">
    <h2>New Post</h2>
    <form method="POST" action="/posts">
        @csrf
        <input type="text" name="title" placeholder="Title" required><br>
        <select name="type">
            <option value="history">History</option>
            <option value="plan">Plan</option>
        </select><br>
        <select name="private">
            <option value="0">Public</option>
            <option value="1">Private</option>
        </select><br>
        <select name="category">
    <option value="running">Running</option>
    <option value="lifting">Lifting</option>
    <option value="swimming">Swimming</option>
    <option value="cycling">Cycling</option>
    <option value="other">Other</option>
</select><br>

        <h3 style="margin-top:1rem">Exercises</h3>
        <div id="exercises">
            <div style="display:flex; gap:.5rem; margin-bottom:.5rem">
                <input name="exercises[0][exercisename]" placeholder="Exercise name" required>
                <input name="exercises[0][duration]" placeholder="Duration (min)" type="number">
                <input name="exercises[0][weight]" placeholder="Weight (kg)" type="number">
            </div>
        </div>
        <button type="button" onclick="addEx()">+ Add exercise</button><br><br>
        <button type="submit">Save</button>
    </form>
</div>
<script>
let i = 1;
function addEx() {
    document.getElementById('exercises').insertAdjacentHTML('beforeend',
        `<div style="display:flex; gap:.5rem; margin-bottom:.5rem">
            <input name="exercises[${i}][exercisename]" placeholder="Exercise name">
            <input name="exercises[${i}][duration]" placeholder="Duration (min)" type="number">
            <input name="exercises[${i}][weight]" placeholder="Weight (kg)" type="number">
        </div>`);
    i++;
}
</script>
@endsection