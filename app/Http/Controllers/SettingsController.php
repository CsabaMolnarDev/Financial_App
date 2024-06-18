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


        $user = auth()->user();

        $user->phone = $request->newPhone;
        $user->save();
      
        return back();
    }
    public function deletePhone()
    {
        User::where('id', '=', auth()->user()->id)->update(['phone' => null]);
       /*  $deleteFamilyMemberById = User::where('id', '=', $id)->update(['family_id' => null]); */
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

            
            $rows = file($file->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (!$this->DataValidation($rows)) {
                toastr()->error("Invalid file format");
                return back();
            } 
   

            $fileObject = new \SplFileObject($file->getRealPath());
            $fileObject->setFlags(\SplFileObject::READ_CSV);
            $fileObject->setCsvControl(',');
            $rows = [];

            while(!$fileObject->eof())
            {
                $row = $fileObject->fgetcsv();
                
                if ($row && !empty(array_filter($row))) {
                    $rows[] = [
                        'type' => $row[0],
                        'name' => $row[1],
                        'price' => $row[2],
                        'time' => $row[3],
                        'category' => $row[4],
                        'currency' => $row[5]
                    ];
                }
            }


            foreach ($rows as $row) {
                $categoryName = $row['category'];
                $category = Category::where('name', $categoryName)->where(function($query) {
                    $query->where('owner_id', 0)
                          ->orWhere('owner_id', auth()->user()->id);
                })
                ->first();

                if (!$category) {
                    Category::create([
                        'owner_id' => auth()->user()->id,
                        'name' => $categoryName,
                        'type' => $row['type']
                    ]);
                }
            }
           
        
           foreach ($rows as $obj) {
                Finance::create([
                    'user_id' => auth()->user()->id,
                    'type' => $obj['type'],
                    'name' => $obj['name'],
                    'price' => $obj['price'],
                    'time' => $obj['time'],
                    'category_id' => Category::where('name', '=',  $obj['category'])->value('id'),
                    'currency_id' => Currency::where('name', 'like', '%' . $obj['currency'] . '%')->value('id')
                ]);

            } 

            return back();
        }

        return back()->withErrors(['fileInput' => 'Please upload a valid file.']);
    }

    public function DataValidation($rows)
    {
        $floatPattern = '/^-?\d+(\.\d+)?$/';
        $dateTimePattern = '/^\d{4}[-.]?\d{2}[-.]?\d{2} \d{2}:\d{2}:\d{2}$/';
        $validTypes = ['Income', 'income', 'Spending', 'spending'];

        foreach ($rows as $index => $row) {
            $data = str_getcsv($row);

            // Validate type
            if (!in_array($data[0], $validTypes)) {
                return false;
            }   

            // Validate price
            if (!preg_match($floatPattern, $data[2])) {
                return false;
            }

            // Validate date time
            if (!preg_match($dateTimePattern, $data[3])) {
                return false;
            }


            // Validate currency existence
            $currencyExists = Currency::where('name', 'like', '%' . $data[5] . '%')->exists();
            if (!$currencyExists) {
                return false;
            }
        }

        return true;
    }


    public function downloadFinances()
    {
        $userFinances = Finance::where('user_id', '=', auth()->user()->id)->get();   

        $financeArray = []; 

        foreach ($userFinances as $finance) {

            $financeArray[] = [
                'type' => $finance->type,
                'name' => $finance->name,
                'price' => $finance->price,
                'time' => $finance->time,
                'category' => $finance->category->name,
                'currency' => $finance->currency->name
            ];
            

        }

        $csvFileName  = 'finances.csv';
        $file = fopen($csvFileName , 'w');
        $firstrow = "Type, Name, Price, Time, Category, Currency";
        fwrite($file, $firstrow."\n");
        foreach ($financeArray as $finance) {
            fputcsv($file, $finance);
        }
        fclose($file);
        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download($csvFileName, $csvFileName, $headers);
    }
}
