<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| Polymorphic `many` to `many`
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// add a tag to the post
Route::get('/attach/tag/post/{id}', function ($id) {

    // find the first post
    $post = Post::find($id);

    // then attach the specified tag: 'Arnaldo Skiles'
    // sync avoid duplication
    $post->tags()->sync([2]);

    dd($post);
});

// detach a tag to the post
Route::get('/detach/tag/post/{id}', function ($id) {
    $post = Post::find($id)->tags()->detach();

    dd($post);
});

// read all posts from a specific tags
Route::get('/tags/{id}/posts', function ($id) {
    $tags = Tag::find($id)->posts();
    return dd($tags);
});
