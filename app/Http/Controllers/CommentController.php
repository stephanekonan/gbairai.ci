<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
            'post_id' => $request->input('post_id'),
        ]);

        return back();
    }

    public function reply(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
            'post_id' => $request->input('post_id'),
            'parent_comment_id' => $request->input('parent_comment_id'),
        ]);

        return back();
    }
}
