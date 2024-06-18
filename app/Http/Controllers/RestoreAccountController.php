<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RestoreAccountController extends Controller
{
    public function restoreAccountIndex()
    {
        return view('auth.accountRestore');
    }

    public function checkIfUserDisabled(Request $request)
    {
        $email = $request->input('email');
        

        $deletedUser = User::where('email', $email)->withTrashed()->exists();
        if(!$deletedUser){
            return response()->json([
                'status' => 'failed',
                'message' => 'Your account is not disabled or does not exists'
            ]); 
        }
        else
        {
            return response()->json([
                'status' => 'success',
            ]); 
        }
 
    }

    public function reactivateAccount(Request $request)
    {
        $userEmail = $request->input('email');
        $activate = User::where('email', $userEmail)->withTrashed();
        $activate->restore();
        Auth::logout();
        return redirect()->route('login');
    }
}
