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
    return redirect('/posts');
});
// Route::resource('posts', 'Blogs\PostController');
// Route::resource('posts', PostController::class);
Route::resource('posts',BlogPostController::class);
// Route::get('/posts',[BlogPostController::class,'index'])->name('posts.index');
// Route::get('/posts/create',[BlogPostController::class,'create'])->name('posts.create');
// Route::post('/posts',[BlogPostController::class,'store'])->name('posts.store');
// Route::get('/posts/{post}/show',[BlogPostController::class,'show'])->name('posts.show');
// Route::get('/posts/{post}/edit',[BlogPostController::class,'edit'])->name('posts.edit');
// Route::put('/edit/{post}',[BlogPostController::class,'update'])->name('posts.update');
// Route::delete('/posts/{post}/',[BlogPostController::class,'destroy'])->name('posts.destroy');
