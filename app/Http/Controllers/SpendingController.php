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
        $user = auth()->user();
        $currencySymbol = $user->currency->symbol;
        return view('includes.spending', [
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
            $category->type = 'spending';
            $category->save();

        toastr()->success($category->name . ' has been added to the categories successfully');
        return back();
    }
    /* spending create page */
    public function create(){
        $user = Auth::user();
        $availableCategories = Category::where(function($query) use ($user) {
            $query->where('owner_id', 0)
                  ->where('type', 'spending');
        })
        ->orWhere(function($query) use ($user) {
            $query->where('owner_id', $user->id)
                  ->where('type', 'spending');
        })
        ->get();
        return view('includes.spendingCreate',[
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
