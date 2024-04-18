<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use App\Models\Monthly;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();
        $finances = Finance::where('user_id', $userId)->get();
        foreach ($finances as $key => $value) {
            $monthlymain = Monthly::where('finance_id',$value->id)->get();
            if(count($monthlymain)!=0){
                //dd($monthlymain);
                $monthly = $monthlymain[0];
                //dd($monthly);
                if ($monthly->year!=date('Y')) {
                    $years = $monthly->year-date(('Y'));
                    if ($years!=1) {
                        $times=12*$years+(12-$monthly->month)+date('m');
                        for ($i=0; $i < $times; $i++) { 
                            $finance=Finance::create([
                                'user_id'=> auth()->user()->id,
                                'type' => $value->type,
                                'name'=> $value->name,
                                'price' => $value->price,
                                'time' => date("Y/m/d") .'-' . date("H:i:s"),
                                'category_id'=> $value->category_id,
                                'currency_id' =>$value->currency_id,
                            ]);
                            $finance->save();
                        }
                        $monthly->year = date('Y');
                        $monthly->month = date('m');
                    }
                    else{
                        $times=(12-$monthly->month)+date('m');
                        for ($i=0; $i < $times; $i++) { 
                            $finance=Finance::create([
                                'user_id'=> auth()->user()->id,
                                'type' => $value->type,
                                'name'=> $value->name,
                                'price' => $value->price,
                                'time' => date("Y/m/d") .'-' . date("H:i:s"),
                                'category_id'=> $value->category_id,
                                'currency_id' =>$value->currency_id,
                            ]);
                            $finance->save();
                        }
                        $monthly->year = date('Y');
                        $monthly->month = date('m');
                    }
                }
                else{
                    $times=date('m')-$monthly->month;
                        for ($i=0; $i < $times; $i++) { 
                            $finance=Finance::create([
                                'user_id'=> auth()->user()->id,
                                'type' => $value->type,
                                'name'=> $value->name,
                                'price' => $value->price,
                                'time' => date("Y/m/d") .'-' . date("H:i:s"),
                                'category_id'=> $value->category_id,
                                'currency_id' =>$value->currency_id,
                            ]);
                            $finance->save();
                        }
                        $monthly->year = date('Y');
                        $monthly->month = date('m');
                }
                $monthly->save();
            }
        }
        // Default redirect if no invitation token is present
        return redirect($this->redirectTo);
    }
}
