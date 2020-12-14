<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        // create a session
        // $request->session()->put(['edwin' => 'master instructor']);

        // forget a session
        // $request->session()->forget('edwin');
        // return $request->session()->all();

        // flashing a session
        // $request->session()->flash('message', 'Post has been created');
        return $request->session()->get('message');
    }
}
