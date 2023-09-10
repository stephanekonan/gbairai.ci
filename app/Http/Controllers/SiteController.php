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

        $posts = Post::with('category', 'user')->latest()->get();
        $categories = Category::all();

        return view('welcome', [ 'posts' => $posts, 'categories' => $categories ]);
    }
}
