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
use App\Models\Family;
use App\Models\FamilyInvitations;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\FamilyInvitationMail;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;



class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = auth()->user();
        $currencies = Currency::all();
        $userId = Auth::id();
        $family = User::where('family_id', '=', $user->family_id)->get();
        return view('includes.settings', [
            'user' => $user,
            'currencies' => $currencies,
            'family' => $family
        ]);
    }
    public function changeFullName(Request $request)
    {
        $request->validate([
            'newFullname' => 'required|string|max:255|min:5|unique:users,fullname'
        ]);

        $user = Auth::user();


        $user->fullname = $request->newFullname;
        $user->update();     
        return back();

    }
    public function changeUserName(Request $request)
    {
        $request->validate([
            'newUsername' => 'required|string|max:255|min:5|unique:users,username'
        ]);

        $user = auth()->user();


        $user->username = $request->newUsername;
        $user->save();

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
     
        return back();
    }

    public function changeCurrency(Request $request)
    {
        $request->validate([
            'newCurrency' => 'required|exists:currencies,id'
        ]);
        $currencyFrom  = auth()->user()->currency->code;

        $user = auth()->user();
        $user->currency_id = $request->newCurrency;
        $user->save();

        $currencyTo  = Currency::find($request->newCurrency)->code;
        //exchange rate is rounded to 3 decimal
        $exchangeRate = round(app(ExchangeRate::class)->exchangeRate($currencyFrom, $currencyTo), 3);
        $userFinances = Finance::where('user_id', $user->id)->get();
       foreach ($userFinances as $finance) {
            $finance->price = $finance->price * $exchangeRate;
            $finance->save();

        }
        //1.10086,

       
        return back();
    }

    public function enableNotification(Request $request)
    {   
        $user = auth()->user();
        if($user->notification == false){
            $userTimezone = $request->input('timezone');
            $user->notification = '1';
            $user->timezone = $userTimezone;
            $user->save();
           
            return back();
        }
       else
        {
            $user->notification = '0';
            $user->timezone = null;
            $user->save();
           
            return back();
        } 
        
    }
    public function changePhone(Request $request)
    {
        $request->validate([
            'newPhone' => 'required|string|unique:users,phone'
        ]);
        /*        $user->family_id = $family->id;
            $user->save(); */
            if (auth()->user()->phone == null) {
                $user = auth()->user();
                $user->phone = $request->newPhone;
                $user->save();
              
                return back();
            }            

            $phone = $request->newPhone;
            $numbers="";
            $firstchar=true;
            $request->newPhone=null;
            for ($i=0; $i < strlen($phone); $i++) {
                if(!$firstchar){
                    if(is_numeric($phone[$i])){
                        $numbers.=strval($phone[$i]);
                    }
                }
                else{
                    if(is_numeric($phone[$i]) || $phone[$i]=='+'){
                        $numbers.=strval($phone[$i]);
                        $firstchar = false;
                    }
                }
            }
            $request->newPhone=$numbers;
            //@dd($request->newPhone);

        $user = auth()->user();

        $user->phone = $request->newPhone;
        $user->save();
      
        return back();
    }

    public function createFamily()
    {

        $user = auth()->user();
        //we can only have 1 family, so if you already have 1 you can't create
        if($user->family_id == null)
        {
            $userSplittedName = explode(" ", $user->fullname);

            $family = new Family();
            $family->name = $userSplittedName[0];
            $family->creator_Id = $user->id;
            $family->save();
            $user->family_id = $family->id;
            $user->save();
          
            return back();
        }
        else {
        
            return back();
        }
    }

    public function checkIfUserExists(Request $request)
    {

        $username = $request->input('username');
        $userFound = User::where('username', $username)->exists();
        if (!$userFound) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found',
            ]);
        }

        $userFamilyId = auth()->user()->family_id;
        $inviteduser = User::where('username', $username)
                   ->where('family_id', $userFamilyId)
                   ->whereNotNull('family_id')
                   ->first();
        if ($inviteduser) {
            return response()->json([
                'status' => 'failed2',
                'message' => 'User is already in your family',
            ]);
        }

        return response()->json([
            'status' => 'success',
        ]);

    }

    public function deleteFamily()
    {
        $user = auth()->user();
        $userFamilyId = $user->family_id;
        $deleteFamily = Family::where('id', '=', $userFamilyId)->delete();
        $deleteFamilyMembers = User::where('family_id', '=', $userFamilyId)->update(['family_id' => null]);



        return back();
    }

    public function deleteFamilyMember($id)
    {
        $deleteFamilyMemberById = User::where('id', '=', $id)->update(['family_id' => null]);

        return back();
    }

    public function addFamilyMember(Request $request)
    {
        $request->validate([
            'familymember' => 'required|string|exists:users,username'
        ]);

        $joininguser = User::where('username', '=', $request->familymember)->first();
        $user = auth()->user();
        $token = Str::random(60);
        $invitation = FamilyInvitations::create([
            'recipient_email' => $joininguser->email,
            'token' => $token,
            'family_id' => $user->family_id,
            'status' => 'pending',
            'sender_id' => $user->id
        ]);
        $username = auth()->user()->username;
        Mail::to($joininguser->email)->send(new FamilyInvitationMail($invitation, $username));

        return back();
    }

    public function leaveFamily()
    {
        $user = auth()->user();
        $leaveFamily = User::where('id', '=', $user->id)->update(['family_id' => null]);

        return back();
    }

    public function softDeleteAccount()
    {
        $user = auth()->user();
      
        $user->delete();
        return redirect()->route('home');
    }

    public function readingFile(Request $request)
    {

        $request->validate([
            'fileInput' => 'required|mimes:txt,csv'
        ],[
            'fileInput.mimes' => 'The file must be a file of type: txt, csv.'
        ]);


        // Check if a file was uploaded
        if ($request->hasFile('fileInput')) {
            // Get the uploaded file
            $file = $request->file('fileInput');
            $fileObject = new \SplFileObject($file->getRealPath());
            $fileObject->setFlags(\SplFileObject::READ_CSV);
            $fileObject->setCsvControl(',');
            $rows = [];

            while(!$fileObject->eof())
            {
                $row = $fileObject->fgetcsv();
                
                if(empty($row)){
                    continue;
                }

                $rows[] = [
                    'user_id'=> $row[0],
                    'type' => $row[1],
                    'name' => $row[2],
                    'price' => $row[3],
                    'time' => $row[4],
                    'category_id' => $row[5],
                    'currency_id' => $row[6]
                ];
            
                
            }
        
           foreach ($rows as $obj) {
                Finance::create([
                    'user_id' => auth()->user()->id,
                    'type' => $obj['type'],
                    'name' => $obj['name'],
                    'price' => $obj['price'],
                    'time' => $obj['time'],
                    'category_id' => $obj['category_id'],
                    'currency_id' => $obj['currency_id']
                ]);
            } 

            return back();
        }

        return back()->withErrors(['fileInput' => 'Please upload a valid file.']);
    }
}
