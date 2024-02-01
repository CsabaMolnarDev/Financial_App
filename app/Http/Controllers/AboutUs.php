<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUs extends Controller
{
    public function index()
    {
        return view('includes.about_us');
        //return view('../includes/about_us');
    }
}
