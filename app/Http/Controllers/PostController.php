<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostReadingCountUpdated;

class PostController extends Controller
{
    //

    public function index()
    {
        $post =Post::with('user')->latest()->get();
        return view('post.index')->with('post',$post);
    }

    public function show(Post $post)
    {
        $initialCount = $post->getCurrentReadersCount();
        return view('post.show', compact('post', 'initialCount'));

    }

    // app/Http/Controllers/PostController.php

public function joinChannel($id, Request $request)
{
    $post = Post::findOrFail($id);

    // Increment the reader count for the post
    if (!$request->session()->has('has_joined_post_' . $id)) {
        $post->incrementReadersCount();
        $request->session()->put('has_joined_post_' . $id, true);
    }

    // Return the updated count
    return response()->json(['count' => $post->getCurrentReadersCount()]);
}

public function leaveChannel($id)
{
    $post = Post::findOrFail($id);

    // Ensure the reader count is decremented
    if (session()->has('has_joined_post_' . $id)) {
        $post->decrementReadersCount();
        session()->forget('has_joined_post_' . $id);
    }

    return response()->json(['count' => $post->getCurrentReadersCount()]);
}

public function getCurrentReadersCount($id)
{
    $post = Post::findOrFail($id);
    return response()->json(['count' => $post->getCurrentReadersCount()]);
}

}
