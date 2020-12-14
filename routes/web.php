<?php

use App\Http\Controllers\AdminController;
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

Route::get('/login', ['middleware' => ['role'], function () {
    return 'succeeded';
}]);

Route::get('/admin', [AdminController::class, 'index']);

// assign a role to a user
Route::get('/sync/role/{role_id}/user/{user_id}', function ($role_id, $user_id) {
    $user = User::find($user_id);
    $user->roles()->sync([$role_id]);

    return "added a role_id: {$role_id} to {$user->name}";
});

// detach a role to a user
Route::get('/detach/role/{role_id}/user/{user_id}', function ($role_id, $user_id) {
    $user = User::find($user_id);
    $user->roles()->detach();

    return "detached a role to {$user->name}";
});
