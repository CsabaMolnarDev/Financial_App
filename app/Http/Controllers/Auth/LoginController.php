<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        // Check if we have an invitation token in the session
        if (session()->has('invitation_token')) {
            // Retrieve the token
            $token = session('invitation_token');
            // Remove the token from the session to prevent reuse
            session()->forget('invitation_token');

            // Redirect to the invitation acceptance route with the token
            return redirect()->route('family.acceptInvitation', ['token' => $token]);
        }

        // Default redirect if no invitation token is present
        return redirect($this->redirectTo);
    }
}
