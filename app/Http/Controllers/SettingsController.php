<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curreny;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('includes.settings', ['user' => $user ]);
    }

    public function changeUserName(Request $request)
    {
        $request->validate([
            'newUsername' => 'required|string|max:255|unique:users,username'
        ]);

        $user = auth()->user();

        
        $user->username = $request->newUsername;
        $user->save();
        toastr()->success("Username has been changed successfully");
        return back();

    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'newEmail' => 'required|string|email|max:255|unique:users,email'
        ]);

        $user = auth()->user();

        $user->email = $request->newEmail;
        $user->save();
        toastr()->success("Email has been changed successfully");
        return back();

    }
}
