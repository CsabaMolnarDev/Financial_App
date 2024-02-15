<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Income extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $finances = $user->finances()->get();
        return view('includes.income', ['finances' => $finances]);
    }
}
