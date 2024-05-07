<?php

namespace App\Http\Controllers;

use App\Models\Monthly;
use App\Http\Requests\StoreMonthlyRequest;
use App\Http\Requests\UpdateMonthlyRequest;

class MonthlyController extends Controller
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
    public function store($id)
    {
        Monthly::create([
            'finance_id' => $id,
                    'year' => date("Y"),
                    'month' => date("m")
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Monthly $monthly)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monthly $monthly)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMonthlyRequest $request, Monthly $monthly)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monthly $monthly)
    {
    }
    public function deleteMonthly($id)
    {
        $deleteFinanceById = Monthly::where('finance_id', '=', $id)->delete();
        return back();
    }
}
