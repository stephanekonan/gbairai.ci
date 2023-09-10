<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('acceuil');

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register',[AuthController::class, 'registerView'] )->name('register.index');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/', [AuthController::class, 'logout'])->name('logout');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

Route::group(['middleware' => 'auth'], function () {

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/reply', [CommentController::class, 'reply'])->name('comments.reply');

});


Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard/category', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/admin/dashboard/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/admin/dashboard/post/{id}', [PostController::class, 'delete'])->name('post.delete');
    Route::put('/admin/dashboard/post/{id}', [PostController::class, 'update'])->name('post.update');

});
