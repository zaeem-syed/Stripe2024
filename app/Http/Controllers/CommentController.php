<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function index(Post $post)
    {

        return response()->json([
            'post' => $post,
            'comment' => $post->comments,
            'user' => $post->user
        ]);


    }
}
