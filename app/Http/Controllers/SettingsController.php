<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Currency;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Finance;


class SettingsController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $currencies = Currency::all();
        $userId = Auth::id();
        $finances = Finance::where('type','Spending')->where('user_id', $userId)->get();
        return view('includes.settings', ['user' => $user, 'currencies' => $currencies ], ['finances' => $finances]);
    }
    public function changeFullName(Request $request)
    {
        $request->validate([
            'newFullname' => 'required|string|max:255|unique:users,fullname'
        ]);

        $user = auth()->user();


        $user->fullname = $request->newFullname;
        $user->save();
        toastr()->success("Username has been changed successfully");
        return back();

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

    public function changeCurrency(Request $request)
    {
        $request->validate([
            'newCurrency' => 'required|exists:currencies,id'
        ]);
        $user = auth()->user();
        $user->currency_id = $request->newCurrency;
        $user->save();
        toastr()->success("Currency has been changed successfully");
        return back();
    }

    public function enableNotification(Request $request)
    {
        $user = auth()->user();
        $userTimezone = $request->input('timezone');
        /* $selectedTime = $request->input('appt'); */
        $checkboxValue = $request->input('notification');
        $user->notification = $checkboxValue ? '1' : '0';
        /* $user->notification_time = $selectedTime; */
        $user->timezone = $userTimezone;
        $user->save();
        toastr()->success('Notification settings updated successfully');
        return redirect('/home');

       /*  $userTimezone = $request->input('timezone');
        $selectedTimeinput = $request->input('appt');
        $checkboxValue = $request->input('notification');
        if ($checkboxValue == 'on') {

            $timeNow = Carbon::now($userTimezone);
            $selectedTime = Carbon::createFromFormat('Y-m-d H:i', $selectedTimeinput, $userTimezone);



            if ($timeNow->format('H:i') === $selectedTime->format('H:i')) {
                echo 'Working, innit';
            }
        }
        else { */
    }


}
