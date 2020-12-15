<?php

use Illuminate\Support\Facades\Mail;
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

// sending email to endpoints
Route::get('/send', function () {

    // data will be passed in `email.blade.php`
    $data = [
        'title' => 'Nice',
        'content' => 'omg, message sent!',
    ];

    Mail::send('email', $data, function ($message) {
        $message->to('hitchcliff1@gmail.com', 'Nivek')->subject('You are an awesome person!');
    });
});
