<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;

class Income extends Controller
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
}
