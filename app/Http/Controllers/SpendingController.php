<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Finance;
use Illuminate\Support\Facades\DB;
use App\Models\User; 

class SpendingController extends Controller
{
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        /* 
        $finances = Finance::where('id', $user->finances_id)->get();
        return view('includes.income', ['finances' => $finances]); */

        $currencies = Finance::distinct()->pluck('currency');
        $categories = Finance::join('users', 'finances.id', '=', 'users.finances_id')
        ->where('users.id', $user->id)
        ->where('finances.type', 'spending')
        ->distinct()
        ->pluck('finances.category');


        return view('includes.spending', ['currencies' => $currencies], ['categories' => $categories]);
    }
    public function addCategory(Request $request)
{
        $request->validate([
            'new_category' => 'required|string|max:255',
        ]);

            // Create a new finance record
            $finance = new Finance();
            $finance->user_id = auth()->user()->id;
            $finance->category = $request->input('new_category');
            $finance->type = 'spending';
            $finance->save();

        return redirect()->back()->with('success', 'Category added successfully.');
}
}
