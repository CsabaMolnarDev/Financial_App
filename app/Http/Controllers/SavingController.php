<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;
use App\Models\Category;
use App\Models\Finance;


class SavingController extends Controller
{
    public function index()
    {
        $unfinishedGoals = Saving::where('user_id', '=', auth()->user()->id)->orWhere('completed', '=', 'false')->get();
        return view('includes.saving', [
            'unfinishedGoals' => $unfinishedGoals,
        ]);
    }

    public function addSavingGoal(Request $request)
    {
        


        $savingGoal = new Saving();
        $savingGoal->name = $request->input('savingGoalName');
        $savingGoal->amount = $request->input('savingGoalAmount');
        $savingGoal->user_id = auth()->user()->id;
        $savingGoal->shared_with_family = auth()->user()->family ? true : false;
        $savingGoal->save();

        
        return back();

    }

    public function addSaving(Request $request)
    {

        $exists = Category::where('type', 'saving')->exists();
        if (!$exists) {
            $savingCategory = new Category();
            $savingCategory->name = 'Saving';
            $savingCategory->owner_id = auth()->id();
            $savingCategory->type = 'saving';
            $savingCategory->save();
        }


        $savingCategory = Category::where('owner_id', '=', auth()->user()->id)
        ->orWhere('name', '=', 'Saving')
        ->first();
        $savingName = Saving::find($request->goals);
           $saving = Finance::create([
            'user_id' => auth()->user()->id,
            'type' => 'Saving',
            'name' => $savingName->name,
            'price' => $request->savingAmount,
            'time' => date("Y/m/d") .'-' . date("H:i:s"),
            'category_id' =>  $savingCategory->id,
            'currency_id' => auth()->user()->currency_id

        ]);  
        $saving->save();



                

            return back();
        } 

}

    

