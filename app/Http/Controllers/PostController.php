<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = \App\Models\Post::with('user')->where('private', 0)->get();
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
}