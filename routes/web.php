<?php

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// finding the user ang get the user
Route::get('/user/{id}', function ($id) {
    $user = User::find($id)->address;
    return $user;
});

// find the address of the based on user `id` then update it
Route::get('/update/{id}', function ($id) {
    $address = Address::whereUserId($id)->first();
    $address->name = "updated address";

    return $address;
});

// deleting the user
Route::get('/user/delete/{id}', function ($id) {
    $user = User::findOrFail($id)->delete();
    return $user;
});

// find the user then delete the address of that user
Route::get('/user/address/{id}', function ($id) {
    $user = User::find($id)->address()->delete();
    return $user;
});
