<?php

use App\Http\Controllers\Blogs\PostController as BlogPostController;
use App\Models\Post;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
// use Illuminate\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts.index',['posts'=>Post::latest()->paginate(10)]);
});

// Route::resource('posts', 'Blogs\PostController');
// Route::resource('posts', PostController::class);
Route::resource('posts',BlogPostController::class);