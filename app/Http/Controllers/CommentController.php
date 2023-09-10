<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{

    public function show() {

        // $comments = Comment::all();

        // return view('admin.pages.articles.show', compact('comments'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        // dd($request->all());

        Comment::create([
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
        ]);

        Alert::toast('Commentaire publié', 'success')->position('top');

        return redirect()->back();
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
