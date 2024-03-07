<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
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

        $finances = Finance::where('type','Income')->get();
        return view('includes.income',['finances' => $finances]);
    }
    public function create(){
        $availableCategories = Category::where('owner_id',0)->orWhere('owner_id', Auth::user()->id)->get();
        return view('includes.incomeCreate',['categories' => $availableCategories]);
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
}
