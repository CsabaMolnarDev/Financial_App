<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvancedStatisticsController extends Controller
{
    public function index()
    {
        return view('includes.advancedStatistics');
    }
}
