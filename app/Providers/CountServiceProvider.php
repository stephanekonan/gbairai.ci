<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CountServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $postsCount = Post::count();
            $usersCount = User::count();
            $commentsCount = Comment::count();
            $categoriesCount = Category::count();

            $view->with([

                'postsCount' => $postsCount,
                'usersCount' => $usersCount,
                'commentsCount' => $commentsCount,
                'categoriesCount' => $categoriesCount
                
            ]);

        });
    }
}
