<?php

namespace App\Http\Controllers;
use App\Models\Category;
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
        $finances = Finance::where('type','Spending')->get();
        return view('includes.spending',['finances' => $finances]);
    }
    public function addCategory(Request $request)
    {
        $request->validate([
            'new_category' => 'required|string|max:255',
        ]);

            // Create a new finance record
            $category = new Category();
            $category->name = $request->input('new_category');
            $category->owner_id = auth()->id();
            $category->save();

           
        return redirect()->back()->with('success', 'Category added successfully.');
    }
    public function create(){
        $availableCategories = Category::where('owner_id',0)->orWhere('owner_id', Auth::user()->id)->get();
        return view('includes.spendingCreate',['categories' => $availableCategories]);
    }
}
