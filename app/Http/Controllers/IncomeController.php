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
        $finances = Finance::where('type','Income')->where('user_id', $userId)->get();
        $categoryIdys = $finances->pluck('category_id')->unique();
        $categories = Category::whereIn('id', $categoryIdys)->pluck('name', 'id');
        $user = auth()->user();
        $currencySymbol = $user->currency->symbol;
        return view('includes.income', [
            'finances' => $finances,
            'categories' => $categories,
            'currencySymbol' => $currencySymbol
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
            $category->save();

        toastr()->success($category->name . ' has been added to the categories successfully');
        return back();
    }
    public function create(){
        $availableCategories = Category::where('owner_id',0)->orWhere('owner_id', Auth::user()->id)->get();
        $user = Auth::user();
        return view('includes.incomeCreate',[
            'categories' => $availableCategories,
            'currency' => $user->currency->symbol]);
    }

    public function editSpendingValue(Request $request)
    {
        dd($request);
        $id = $request->input('id');
        $column = $request->input('column');
        $value = $request->input('value');

      /*   $finance = Finance::findOrFail($id);
        $finance->$column = $value;
        $finance->save();

        return response()->json(['success' => true]); */
    }

    public function deleteFinance($id)
    {
        $deleteFinanceById = Finance::where('id', '=', $id)->delete();
        toastr()->success("Finance record deleted successfully");
        return back();
    }
}
