<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
{
    $posts = \App\Models\Post::with('user')
        ->when(!(auth()->check() && auth()->user()->role === 'admin'),
            fn($q) => $q->where('private', 0)
        )
        ->when($request->category,
            fn($q) => $q->where('category', $request->category)
        )
        ->when($request->q,
            fn($q) => $q->where('title', 'like', '%' . $request->q . '%')
                ->orWhereHas('user', fn($u) =>
                    $u->where('username', 'like', '%' . $request->q . '%')
                )
        )
        ->when($request->sort === 'views', function ($q) {
            $q->orderBy('viewcount', 'desc');
        }, function ($q) {
            $q->latest(); // default = most recent
        })
        ->paginate(10)
        ->withQueryString();

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
//also checks if user has appropriate role/id
public function edit($id) {
    $post = \App\Models\Post::findOrFail($id);
    if (auth()->id() !== $post->user_id && auth()->user()->role !== 'admin') {
        return redirect('/')->with('error', 'Unauthorized.');
    }
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

    foreach ($request->exercises ?? [] as $ex) {

        if (isset($ex['delete']) && isset($ex['id'])) {
            \App\Models\Exercise::where('id', $ex['id'])->delete();
            continue;
        }

        // update existing exercise
        if (!empty($ex['id'])) {
            \App\Models\Exercise::where('id', $ex['id'])->update([
                'exercisename' => $ex['exercisename'],
                'duration'     => $ex['duration'] ?? null,
                'weight'       => $ex['weight'] ?? null,
            ]);
        }

        // add new exercise
        elseif (!empty($ex['exercisename'])) {
            \App\Models\Exercise::create([
                'post_id'      => $post->id,
                'exercisename' => $ex['exercisename'],
                'duration'     => $ex['duration'] ?? null,
                'weight'       => $ex['weight'] ?? null,
            ]);
        }
    }

    return redirect('/my-posts');
}
//also checks for appropiate role
public function destroy($id) { 
    $post = \App\Models\Post::findOrFail($id);
    if (auth()->id() !== $post->user_id && auth()->user()->role !== 'admin') {
        return redirect('/')->with('error', 'Unauthorized.');
    }
    $post->delete();
    return redirect('/my-posts');
}
//for soft delete
public function restore($id)
{
    $post = \App\Models\Post::withTrashed()->findOrFail($id);

    if (auth()->user()->role !== 'admin') {
        return redirect('/')->with('error', 'Unauthorized.');
    }

    $post->restore();

    return redirect('/posts/trash')->with('success', 'Post restored.');
}
public function trash()
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/')->with('error', 'Unauthorized.');
    }

    $posts = Post::onlyTrashed()->with('user')->paginate(10);

    return view('trash', compact('posts'));
}
}