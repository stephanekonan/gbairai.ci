<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        Comment::create([
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
        ]);

        Alert::toast('Commentaire publié', 'success')->position('top');

        return redirect()->back();
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'contentreply' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        $commentReply = new Comment();
        $commentReply->content = $request->input('contentreply');
        $commentReply->user_id = $request->input('user_id');
        $commentReply->post_id = $request->input('post_id');

        $comment->replies()->save($commentReply);

        Alert::toast('Commentaire ajouté', 'success')->position('top');

        return redirect()->back();
    }
}
