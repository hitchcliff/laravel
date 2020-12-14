<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        // find the user
        // $user = Auth::user;
        $user = User::find(2);

        // check the user if its admin
        if (!$user->isAdmin()) {
            return redirect()->intended('/');
        }
        return $next($request);
    }
}
