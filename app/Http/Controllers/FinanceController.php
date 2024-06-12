<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;
use App\Models\Monthly;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinanceRequest $request)
    {
        $bool = str_contains(url()->previous(), 'spending');
        if($request->category_id == null ||$request->name == null ||$request->price == null)
        {
            return back();
        }

        $finance = Finance::create([
            'user_id'=> auth()->user()->id,
            'type' => $bool ? 'Spending' : 'Income',
            'name'=> $request->name,
            'price' => $request->price,
            'time' => date("Y/m/d") .'-' . date("H:i:s"),
            'category_id'=> $request->category_id,
            'currency_id' =>auth()->user()->currency_id
            ]);
            $finance->save();
            if($request->monthly){
                Monthly::create([
                    'finance_id' => $finance->id,
                    'year' => date("Y"),
                    'month' => date("m")
                ]);
            }
            if($bool){
                return redirect()->route('spending');
            }
            else{
                return redirect()->route('income');
            }

    }
    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinanceRequest $request, Finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        //
    }
}
