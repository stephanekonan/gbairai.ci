<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

use Carbon\Carbon;

class PostController extends Controller
{
    public function store(Request $request) {

        $imageName = $request->image->store('posts');

        $userID = Auth::user()->id;

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category()->associate($request->category);
        $post->user_id = $userID;
        $post->image = $imageName;

        $post->save();

        if($post) {

            Alert::toast('Article enregistré avec succès', 'success')->position('top');

            return redirect()->back()->with('success', 'Article enregistré avec succès');

        } else {

            Alert::toast('Une erreur s\'est produite', 'error')->position('top');

            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function delete($post_id) {

        $post = Post::find($post_id);

        if (!$post) {

            Alert::toast('Poste non trouvé', 'error');
            return redirect()->back()->with('error', 'Poste non trouvé');

        } else {

            $post->delete();
            Alert::toast('Poste supprimé avec succès', 'success')->position('top');
            return redirect()->back()->with('success', 'Poste supprimé avec succès');

        }

    }

    public function update($post_id) {


    }

    public function show(Request $request) {

        Carbon::setLocale('fr');

        $posts = Post::with('category', 'user')->latest()->get();

        $categories = Category::all();

        $post_id = Crypt::decryptString($request->id);

        $post = Post::find($post_id);

        $comments = Comment::all();

        return view('posts.show', [
            'post' => $post,
            'categories' => $categories,
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
