<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Finance;
use App\Models\Monthly;
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

        $familyFunc = $this->getFamilyMembers();
        $familymembers = $familyFunc['familymembers'];
        
        $familyIncomesCall = $this->generateFamilyIncomeArticles();
        $familyIncomes = $familyIncomesCall['articles'];
        
        $allIncomesZero = $this->allIncomesZero();
        $allSpendingsZero = $this->allSpendingsZero();

        $familySpendingCall = $this->generateFamilySpendingArticles();
        $familySpending = $familySpendingCall['articles2'];
       

        $getfinances = $this->getFinances();
        $userMonthlyFinances = $getfinances['userfinances'];

        $getFamilyFinances = $this->getFamilyFinances();
        $familyFinances = $getFamilyFinances['familyFinances'];



        $financeColors = [];
        foreach ($userMonthlyFinances as $finance) {
            $financeColors[$finance->id] = $this->getFinanceColor($finance->id);
        }

        if ($familyFinances != null) {
            $familyFinanceColors = [];
            foreach ($familyFinances as $finance) {
                $familyFinanceColors[$finance->id] = $this->getFinanceColor($finance->id);
            }
        }





        return view('home', [
            'currencies' => $currencies,
            //user graphs
            'incomeCategoryPrices' => $incomeCategoryPrices,
            'spendingCategoryPrices' => $spendingCategoryPrices,
            //family graph
            'familyIncomes' => $familyIncomes,
            'familySpending' => $familySpending,
            'familymembers' => $familymembers,
            //calendar
            'userMonthlyFinances' => $userMonthlyFinances,
            'financeColors' => $financeColors,
            'familyFinances' => $familyFinances ?? null,
            'familyFinanceColors' => $familyFinanceColors ?? null,
            'allIncomesZero' => $allIncomesZero ?? '',
            'allSpendingsZero' => $allSpendingsZero ?? ''
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

        //family data
          
        $familyFunc = $this->getFamilyMembers();
        $familymembers = $familyFunc['familymembers'];

        $familyIncomesCall = $this->generateFamilyIncomeArticles();
        $familyIncomes = $familyIncomesCall['articles'];

        $familySpendingCall = $this->generateFamilySpendingArticles();
        $familySpending = $familySpendingCall['articles2'];

        $getfinances = $this->getFinances();
        $userMonthlyFinances = $getfinances['userfinances'];

        $getFamilyFinances = $this->getFamilyFinances();
        $familyFinances = $getFamilyFinances['familyFinances'];
   
        $allIncomesZero = $this->allIncomesZero();
        $allSpendingsZero = $this->allSpendingsZero();

        $financeColors = [];
        foreach ($userMonthlyFinances as $finance) {
            $financeColors[$finance->id] = $this->getFinanceColor($finance->id);
        }

        if ($familyFinances != null) {
            $familyFinanceColors = [];
            foreach ($familyFinances as $finance) {
                $familyFinanceColors[$finance->id] = $this->getFinanceColor($finance->id);
            }
        }


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
            'spendingCategoryPrices' => $spendingCategoryPrices,
            'familyIncomes' => $familyIncomes,
            'familySpending' => $familySpending,
            'familymembers' => $familymembers,
            'allIncomesZero' => $allIncomesZero ?? '',
            'allSpendingsZero' => $allSpendingsZero ?? '',
            //calendar
            'userMonthlyFinances' => $userMonthlyFinances,
            'financeColors' => $financeColors,
            'familyFinances' => $familyFinances ?? null,
            'familyFinanceColors' => $familyFinanceColors ?? null


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
                $categoryName = $finance->name; 
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
        $familyFunc = $this->getFamilyMembers();
        $familymembers = $familyFunc['familymembers'];


        $articles = [];

        foreach ($familymembers as $user) {
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
    public function generateFamilySpendingArticles()
    {

        $familyFunc = $this->getFamilyMembers();
        $familymembers = $familyFunc['familymembers'];

        $articles = [];

        foreach ($familymembers as $user) {
            $familySpending = $user->finances()
                ->where('type', 'Spending')
                ->whereMonth('time', now()->month)
                ->whereYear('time', now()->year)
                ->sum('price');

            $articles[] = [
                'user_id' => $user->id,
                'user_fullname' => $user->fullname,
                'family_spending' => $familySpending ,
            ];
        }

        return [
            'articles2' => $articles
        ];

    }

  

   public function getFamilyMembers() {
        $currentUserFamilyId = auth()->user()->family_id;

        $familymembers = User::whereNotNull('family_id')
        ->where('family_id', $currentUserFamilyId)
        ->get();
        return [
            'familymembers' => $familymembers
        ];
   }


    public function getFinances()
    {
        $userfinances = Finance::where('finances.user_id', '=', auth()->user()->id)
        ->select('name', 'price', 'time', 'type', 'id')
        ->get();
        return [
            'userfinances' => $userfinances
        ];
    }

    public function getFamilyFinances()
    {
        $getFamilyMembers = $this->getFamilyMembers(); 
        $familymembers = $getFamilyMembers['familymembers'];
      
        $userFinances = collect();
        foreach ($familymembers as $member) {
            $finances = Finance::where('user_id', $member->id)->get();
            $userFinances = $userFinances->concat($finances);
        }
        return [
            'familyFinances' => $userFinances
        ];

    }

    public function getFinanceColor($financeId)
    {
        $isMonthly = Monthly::where('finance_id', $financeId)->exists();
        $finance = Finance::find($financeId);
        $type = $finance->type;

        if ($isMonthly) {
            return ($type === 'Income') ? 'lime' : 'red';
        } else {
            return ($type === 'Income') ? 'green' : 'crimson';
        }
    }

    public function allIncomesZero()
    {
        $familyIncomesCall = $this->generateFamilyIncomeArticles();
        $familyIncomes = $familyIncomesCall['articles'];
        $allIncomesZero = true;
        foreach ($familyIncomes as $income) {
            if ($income['family_income'] != 0) {
                $allIncomesZero = false;
                break;
            }
        }
        return $allIncomesZero ? null : false;
    }

    public function allSpendingsZero()
    {
        $familySpendingCall = $this->generateFamilySpendingArticles();
        $familySpending = $familySpendingCall['articles2'];
        $allSpendingsZero = true;
        foreach ($familySpending as $spending) {
            if ($spending['family_spending'] != 0) {
                $allSpendingsZero = false;
                break;
            }
        }
        return $allSpendingsZero ? null : false;
    }
}
