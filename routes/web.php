<?php

use App\Models\Post;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| One to many
|--------------------------------------------------------------------------
*/

// create a post through a user to get the id
Route::get('/create', function () {
    $post = Post::create(['title' => 'hey', 'content' => 'good job']);

    $createdPost = User::findOrFail(1)->posts()->save($post);
    return $createdPost;
});

// read post from a user
Route::get('/read/user/{id}', function ($id) {
    $post = User::find($id)->posts()->get(); // returns collection
    return $post;
});

// find the user who posted the post
Route::get('/read/post/{id}', function ($id) {
    $user = Post::find($id);
    return $user;
});

// delete a single post from a user
Route::get('/delete/post/{id}', function ($id) {
    $post = Post::find($id)->delete();
    return $post;
});

// update a post from the user
Route::get('/update/user/{id}', function ($id) {
    $updatedPost = ['title' => 'nice post', 'content' => 'thank you edwin'];
    $post = User::find($id)->posts()->where('id', '=',  3)->update($updatedPost);
    return $post;
});

// retrieve a user from post
Route::get('/update/post/{id}', function ($id) {
    $updatedUser = ['name' => 'Sir Edwin', 'email' => 'hello@email.com'];
    $post = Post::find($id);
    $user = User::find($post->user_id)->update($updatedUser);
    return $user;
});
