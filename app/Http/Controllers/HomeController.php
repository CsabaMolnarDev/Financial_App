<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Finance;
use Carbon\Carbon;


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
        $spendingFunc = $this->spendingGraphData();
        $spendingCategoryPrices = $spendingFunc['categoryPrices'];


        $incomeFunc = $this->incomeGraphData();
        $incomeCategoryPrices = $incomeFunc['categoryPrices'];
        
        $familyIncomesCall = $this->generateFamilyIncomeArticles();
        $familyIncomes = $familyIncomesCall['articles'];   
        return view('home', [
            'currencies' => $currencies,
            'incomeCategoryPrices' => $incomeCategoryPrices,
            'spendingCategoryPrices' => $spendingCategoryPrices,
            'familyIncomes' => $familyIncomes

        ]);
    }

    public function calculate(Request $request)
    {
        $result = $this->ListCurrencies();
        $currencies = $result['currencies'];
        $spendingFunc = $this->spendingGraphData();
        $spendingCategoryPrices = $spendingFunc['categoryPrices'];
        $incomeFunc = $this->incomeGraphData();
        $incomeCategoryPrices = $incomeFunc['categoryPrices'];


        $from = Currency::find($request->currency_id)->code;
        $fromSymbol = Currency::find($request->currency_id)->symbol;
        $to = Currency::find($request->currency_id2)->code;
        $toSymbol = Currency::find($request->currency_id2)->symbol;
       $exchangeRate = app(ExchangeRate::class)->exchangeRate($from, $to); 
        return view('home', [
            'exchangeRate' => round($exchangeRate, 2),
            'toSymbol' => $toSymbol,
            'fromSymbol' => $fromSymbol,
            'currencies' => $currencies,
            //graphicon data
            'incomeCategoryPrices' => $incomeCategoryPrices,
            'spendingCategoryPrices' => $spendingCategoryPrices
        ]);
    }
 



    public function ListCurrencies()
    {
        $currencies = Currency::all();
        return [
            'currencies' => $currencies,
        ];
    }

    public function spendingGraphData()
    {
            // Get the current month and year
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        // Query to get finances data for the current month
        $spendingFinances = Finance::where('type', 'Spending')
            ->whereMonth('time', '=', $currentMonth)
            ->whereYear('time', '=', $currentYear)
            ->where('user_id', auth()->user()->id)
            ->get();

        // Organize the finances data by category
        $categoryPrices = [];
        foreach ($spendingFinances as $finance) {
            $categoryName = $finance->name; // Assuming category name is stored in the 'name' column
            $price = $finance->price;
            if (!isset($categoryPrices[$categoryName])) {
                $categoryPrices[$categoryName] = $price;
            } else {
                $categoryPrices[$categoryName] += $price;
            }
        }

        return [
            'categoryPrices' => $categoryPrices
        ];
    }

    public function incomeGraphData()
    {
            // Get the current month and year
            $currentMonth = Carbon::now()->format('m');
            $currentYear = Carbon::now()->format('Y');
    
            // Query to get finances data for the current month
            $spendingFinances = Finance::where('type', 'Income')
                ->whereMonth('time', '=', $currentMonth)
                ->whereYear('time', '=', $currentYear)
                ->where('user_id', auth()->user()->id)
                ->get();
    
            // Organize the finances data by category
            $categoryPrices = [];
            foreach ($spendingFinances as $finance) {
                $categoryName = $finance->name; // Assuming category name is stored in the 'name' column
                $price = $finance->price;
                if (!isset($categoryPrices[$categoryName])) {
                    $categoryPrices[$categoryName] = $price;
                } else {
                    $categoryPrices[$categoryName] += $price;
                }
            }
    
            return [
                'categoryPrices' => $categoryPrices
            ];
    }


    public function generateFamilyIncomeArticles()
    {
        
        $users = User::whereNotNull('family_id')->get();
        
        $articles = [];
        
        foreach ($users as $user) {
            $familyIncome = $user->finances()
                ->where('type', 'Income')
                ->whereMonth('time', now()->month)
                ->whereYear('time', now()->year)
                ->sum('price');
            
            $articles[] = [
                'user_id' => $user->id,
                'user_fullname' => $user->fullname,
                'family_income' => $familyIncome,
            ];
        }
    
        return [
            'articles' => $articles
        ];

    }
}
