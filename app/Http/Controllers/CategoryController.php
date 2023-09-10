<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function store(Request $request) {

        $request->validate([
            'name' => ['required', 'min:5'],
            'slug' => ['required', 'min:5']
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        Alert::toast('Catégorie crée avec succès', 'success')->position('top');

        return redirect()->back();

    }
}
