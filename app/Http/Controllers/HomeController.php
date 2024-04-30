<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use App\Models\Currency;


class HomeController extends Controller
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
        $result = $this->ListCurrencies();
        $currencies = $result['currencies'];
        return view('home', [
            'currencies' => $currencies,
        ]);
    }

    public function calculate(Request $request)
    {
        $result = $this->ListCurrencies();
        $currencies = $result['currencies'];


        $from = Currency::find($request->currency_id)->code;
        $fromSymbol = Currency::find($request->currency_id)->symbol;
        $to = Currency::find($request->currency_id2)->code;
        $toSymbol = Currency::find($request->currency_id2)->symbol;
       $exchangeRate = app(ExchangeRate::class)->exchangeRate($from, $to); 
        return view('home', [
            'exchangeRate' => round($exchangeRate, 2),
            'toSymbol' => $toSymbol,
            'fromSymbol' => $fromSymbol,
            'currencies' => $currencies
        ]);
    }
 



    public function ListCurrencies()
    {
        $currencies = Currency::all();
        return [
            'currencies' => $currencies,
        ];
    }

}
