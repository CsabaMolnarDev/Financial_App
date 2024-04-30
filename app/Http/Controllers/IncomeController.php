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
        $userId = Auth::id();
        $user = Auth::user();
        $finances = Finance::where('type','Income')->where('user_id', $userId)->get();
        $categories = Category::where(function($query) use ($user) {
            $query->where('owner_id', 0)
                  ->where('type', 'income');
        })
        ->orWhere(function($query) use ($user) {
            $query->where('owner_id', $user->id)
                  ->where('type', 'income');
        })->get();
        $user = auth()->user();
        $currencySymbol = $user->currency->symbol;
        return view('includes.income', [
            'finances' => $finances,
            'categories' => $categories,
            'currencySymbol' => $currencySymbol,
        ]);
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
            $category->type = 'income';
            $category->save();

        toastr()->success($category->name . ' has been added to the categories successfully');
        return back();
    }
    /* income create */
    public function create(){
        $user = Auth::user();
        $availableCategories = Category::where(function($query) use ($user) {
            $query->where('owner_id', 0)
                  ->where('type', 'income');
        })
        ->orWhere(function($query) use ($user) {
            $query->where('owner_id', $user->id)
                  ->where('type', 'income');
        })
        ->get();
        return view('includes.incomeCreate',[
            'categories' => $availableCategories,
            'currency' => $user->currency->symbol]);
    }

    public function editIncomeValue(Request $request)
    {
        $request->validate([
            'row' => 'required',
            'column' => 'required',
            'value' => 'required',
        ]);

        $id = $request->row;
        $column = $request->column;
        $value = $request->value;

        $finance = Finance::findOrFail($id);
        $finance->$column = $value;
        $finance->save();

        return response()->json(['success' => true, 'refresh' => true]); 
    }

    public function deleteFinance($id)
    {
        $deleteFinanceById = Finance::where('id', '=', $id)->delete();
        toastr()->success("Finance record deleted successfully");
        return back();
    }
}
