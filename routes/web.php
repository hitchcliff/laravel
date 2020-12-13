<?php

use App\Models\Role;
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
| Many to many
|--------------------------------------------------------------------------
*/

// assign a role to a user
Route::get('/user/{id}', function ($id) {
    // adds new role to the user
    $user = User::find($id)->roles()->save(new Role(['name' => 'subscriber']));
    return $user;
});


// read the all users role
Route::get('/read/roles', function () {
    $roles = Role::get();
    return $roles;
});

// read the role of all user
Route::get('/read/user', function () {
    $users = User::get();
    return $users;
});

//update a role to a user
Route::get('/update/role/{id}', function ($id) {
    $user =  User::find($id);
    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name === 'Administrator') {
                $role->name = strtolower($role->name);
                $role->save();
            }
        }
    }
});

// delete role of a user, & detach pivot
Route::get('/delete/user/{id}', function ($id) {
    $user = User::find($id);

    $user->roles()->delete(); // delete the roles asigned to user
    $user->roles()->detach(); // detach the user role in pivot 

    return $user;
});

// sync to attach a role to the user
// best way to avoid duplications in 'Roles'
Route::get('/sync/user/{id}', function ($id) {
    $user = User::find($id);
    $user->roles()->sync([2]); // add roles to the user without adding new row in the "Role" model
    // 1 = Administrator
    // 2 = Subscriber
    return $user;
});

// detach user "Role" from pivot table
// best to way to avoid deleting the current 'Roles'
Route::get('/detach/user/{id}', function ($id) {
    $user = User::find($id)->roles()->detach();
    return $user;
});
