<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
    $posts = \App\Models\Post::with('user')
        ->where('private', 0)
        ->when($request->category, fn($q) => $q->where('category', $request->category))
        ->when($request->q, fn($q) => $q->where('title', 'like', '%' . $request->q . '%')
            ->orWhereHas('user', fn($u) => $u->where('username', 'like', '%' . $request->q . '%')))
        ->latest()
        ->paginate(10)->withQueryString();
    return view('index', compact('posts'));
}

public function store(Request $request)
{
    $post = \App\Models\Post::create([
        'title'    => $request->title,
        'type'     => $request->type,
        'private'  => $request->private,
        'category' => $request->category,
        'user_id'  => auth()->id(),
        'viewcount' => 0,
    ]);

    foreach ($request->exercises as $ex) {
        if (!empty($ex['exercisename'])) {
            \App\Models\Exercise::create([
                'post_id'      => $post->id,
                'exercisename' => $ex['exercisename'],
                'duration'     => $ex['duration'] ?? null,
                'weight'       => $ex['weight'] ?? null,
            ]);
        }
    }

    return redirect('/');
}
public function mine() {
    $posts = \App\Models\Post::where('user_id', auth()->id())->get();
    return view('mine', compact('posts'));
}
public function show($id) {
    $post = \App\Models\Post::with(['user', 'exercises'])->findOrFail($id);
    if (auth()->id() !== $post->user_id) {
        $post->increment('viewcount');
    }
    return view('show', compact('post'));
}
public function create() {
    return view('create');
}
public function edit($id) {
    $post = \App\Models\Post::findOrFail($id);
    return view('edit', compact('post'));
}

public function update(Request $request, $id) {
    $post = \App\Models\Post::findOrFail($id);
    $post->update([
        'title'    => $request->title,
        'type'     => $request->type,
        'private'  => $request->private,
        'category' => $request->category,
    ]);
    return redirect('/my-posts');
}

public function destroy($id) {
    \App\Models\Post::findOrFail($id)->delete();
    return redirect('/my-posts');
}
}