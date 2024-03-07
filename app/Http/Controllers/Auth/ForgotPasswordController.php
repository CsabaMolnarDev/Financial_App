<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\{DB, Hash, Mail, Str};
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showForgetPasswordForm()
    {
        return view('auth.showForgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        toastr()->info('We have emailed your password reset link!');
        return back();
    }

    public function showResetPasswordForm($token)
    {   
       
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        if (!$request->has('token')) {
            return back()->withInput()->with('error', 'Invalid token 1 !');
        }
        // Retrieve all tokens for the user's email
        $tokens = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->get();
    
        $tokenFound = false;
        foreach ($tokens as $tokenRecord) {
            if (Hash::check($request->token, $tokenRecord->token)) {
                $tokenFound = true;
                break; // Exit the loop if a matching token is found
            }
        }
    
        if (!$tokenFound) {
            return back()->withInput()->with('error', 'Invalid token 2 !');
        }
    
        // Token is valid, proceed with password update
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    
        // Delete all reset tokens for this user to prevent reuse
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    
        toastr()->success('Your password has been changed');
        return redirect('/login');
    }
}

   