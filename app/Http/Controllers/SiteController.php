<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index() {

        $categorie = request()->input('categorie');

        $posts = Post::with('category', 'user');

        if($categorie) {

            $posts->whereHas('category', function ($query) use ($categorie) {
                $query->where('slug', $categorie);
            });

        }

        $posts = $posts->latest()->get();

        $categories = Category::all();

        return view('welcome', [ 'posts' => $posts, 'categories' => $categories ]);
    }
}
