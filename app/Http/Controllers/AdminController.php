<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        $search = request()->input('search');
        $categorie = request()->input('categorie');

        $posts = Post::with('category', 'user');

        if($search) {

            $posts->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });

        }

        if($categorie) {

            $posts->whereHas('category', function ($query) use ($categorie) {
                $query->where('slug', $categorie);
            });

        }

        $posts = $posts->latest()->get();

        $categories = Category::all();

        return view('admin.index', [
            'categories' => $categories,
            'posts' => $posts,
            'search' => $search,
            'categorie' => $categorie
        ]);

    }
}
