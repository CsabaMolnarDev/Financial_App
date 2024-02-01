<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutUs extends Controller
{
    public function index()
    {
        // get users that are devs by role id
        $devs = DB::table('users')->where('roles_id','1')->get();
        return view('includes.about_us', ['devs' => $devs]);
    }
}
