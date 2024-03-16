<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Currency;
use App\Mail\RegistrationSuccessful;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255', 'min:5'],
            'username' => ['required', 'string', 'max:255','min:5'],
            'phone' => ['required', 'string',],
            'currency_id' => ['required',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $roles_id = 3; // basic role, 2 pro, 1 dev
        $user = User::create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles_id' => $roles_id,
            'currency_id' => $data['currency_id']

        ]);
        $userName = $user->username;
        Mail::to($user->email)->send(new RegistrationSuccessful($userName));
        return $user;

    }

    public function showRegistrationForm()
    {
        $currencies = Currency::all();
        return view('auth.register', compact('currencies'));
    }

    public function checkNameIsTaken(Request $request)
    {
        $username = $request->input('username');

        $userFound = User::where('username', $username)->exists();
        if ($userFound) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Username is taken',
            ]);
        }
    }

    public function calculateEntropy(Request $request)
    {
        $password = $request->input('password');

        $entropy = $this->calculateEntropyScore($password);
        return response()->json(['entropy' => $entropy]);
    }

    private function calculateEntropyScore($password)
    {
        $charset = 0;

        if (preg_match('/[a-z]/', $password)) {
            $charset += 26;
        }
        if (preg_match('/[A-Z]/', $password)) {
            $charset += 26;
        }
        if (preg_match('/[0-9]/', $password)){
            $charset += 10;
        }
        if (preg_match('/[^a-zA-Z0-9]/', $password)) {
            $charset += 30;
        }
        $entropy = round(log(pow($charset, strlen($password)),2));


        return $entropy;
    }
}

