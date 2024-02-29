<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curreny;
use App\Models\Category;


class SettingsController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        
        return view('includes.settings', ['user' => $user ]);
    }
}
