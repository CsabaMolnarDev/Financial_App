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
        $userId = Auth::id();
        $finances = Finance::where('type','Spending')->where('user_id', $userId)->get();
        $categoryIdys = $finances->pluck('category_id')->unique();
        $categories = Category::whereIn('id', $categoryIdys)->pluck('name', 'id');
        return view('includes.spending',['finances' => $finances], ['categories' => $categories]);
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

        toastr()->success($category->name . ' has been added to the categories successfully');
        return back();
    }
    public function create(){
        $availableCategories = Category::where('owner_id',0)->orWhere('owner_id', Auth::user()->id)->get();
        return view('includes.spendingCreate',['categories' => $availableCategories]);
    }
}
