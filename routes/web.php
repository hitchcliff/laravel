<?php

use App\Models\Photo;
use App\Models\Product;
use App\Models\Staff;
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
| Polymorphic `morphTo` & `morphMany`
|--------------------------------------------------------------------------
*/

// create a photo for staff
Route::get('/create/staff/{id}', function ($id) {
    $photo = Staff::find($id)->photos();
    // check if there is already a photo
    if ($photo->count() === 1) {
        return response(null, 409);
    } else {
        $photo->create(['path' => 'staffphoto2.jpg']);
        return $photo->get();
    }
});

// create a photo for product
Route::get('/create/product/{id}', function ($id) {
    $products = Product::find($id)->photos()->create(['path' => 'productphoto.jpg']);
    return $products;
});

// read the photos of a 1 single staff
Route::get('/read/staff/{id}', function ($id) {
    $staffs = Staff::findOrFail($id)->photos;
    foreach ($staffs as $staff) {
        return $staff;
    }
});

// read the photos of a 1 single product
Route::get('/read/product/{id}', function ($id) {
    $products = Product::findOrFail($id)->photos;
    foreach ($products as $product) {
        return $product;
    }
});

// update the photos of a 1 single staff
Route::get('/update/staff/{id}', function ($id) {
    $staffs = Staff::findOrFail($id)->photos;
    foreach ($staffs as $staff) {
        $staff->path = "updatedstaff.png";
        return $staff->save();
    }
});

// delete the photos of a 1 single product
Route::get('/delete/product/{id}', function ($id) {
    $product = Product::findOrFail($id)->photos()->delete();
    return $product;
});

// assigning photos to a staff
Route::get('/assign/staff/{id}/{photoId}', function ($id, $photoId) {
    $staff = Staff::find($id);
    $photo = Photo::find($photoId);

    $staff->photos()->save($photo);
    return $staff;
});

// unassign and updating photo to a staff
Route::get('/unassigned/staff/{id}/{photoId}', function ($id, $photoId) {
    $staff = Staff::find($id);
    $staff->photos()->whereId($photoId)->update(['imageable_id' => '', 'imageable_type' => '']);

    return $staff;
});
