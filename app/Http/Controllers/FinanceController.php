<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'time' => 'required|date'
        ]);

        
            $bool = Str::contains(request()->url(), 'spending');
        

        Finance::create([
            'user_id'=> auth()->user()->id,
            'type' => $bool ? 'Spending' : 'Income', //if income create set this to income else spending
            'name'=> $request->name,
            'price' => $request->price,
            'time' => time(),   
            'category_id'=> $request->category_id,
            'currency_id' =>auth()->user()->currency_id 
        ]);
        return redirect()->back();
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
