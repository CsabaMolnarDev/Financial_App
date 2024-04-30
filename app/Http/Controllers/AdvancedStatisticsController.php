<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Finance;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;


class AdvancedStatisticsController extends Controller
{
    protected $incomeCategoriesForAuthUserMonthly;
    protected $spendingCategoriesForAuthUserMonthly;

    public function index()
    {


        $currentDate = Carbon::now();
        $currentMonth = $currentDate->month;
        $currentYear = $currentDate->year;
        $userId = Auth::id();
        $incomes = Finance::where('type','Income')->where('user_id', $userId)->get();
        $spendings = Finance::where('type','Spending')->where('user_id', $userId)->get();

        $currencySymbol = auth()->user()->currency->symbol;
        $familyMembers = User::where('family_id', auth()->user()->family_id)
                     ->whereNotNull('family_id')
                     ->get();

        $spendingsWithTheSameCurrency = Finance::where('currency_id', auth()->user()->currency_id)->where('type', 'Spending')->pluck('price')->avg();
        $incomesWithTheSameCurrency = Finance::where('currency_id', auth()->user()->currency_id)->where('type', 'Income')->pluck('price')->avg();


        $familyCurrencySymbols = [];
        foreach ($familyMembers as $member) {
            $familyCurrencySymbols[$member->id] = $member->currency->symbol;
        }
        $totalIncome = 0;
        $totalSpending = 0;
        foreach($familyMembers as $member)
        {
            $userFinances = Finance::where('user_id', $member->id)->get();



            $memberIncome = $userFinances->where('type', 'Income')->sum('price');
            $memberSpending = $userFinances->where('type', 'Spending')->sum('price');

            $totalIncome += $memberIncome;
            $totalSpending += $memberSpending;

        }
        //dropdowns
        //spending categories
        //mysql equivalent
        /* SELECT DISTINCT categories.*
            FROM categories
            JOIN finances ON categories.id = finances.category_id
            WHERE categories.type = 'spending'
            AND (categories.owner_id = 0 OR categories.owner_id = :userId)
            AND finances.user_id = :userId; */
        $spendingCategoriesWithFinance = Category::join('finances', 'categories.id', '=', 'finances.category_id')
        ->where('categories.type', '=', 'spending')
        ->where(function ($query) use ($userId) {
            $query->where('categories.owner_id', '=', 0)
                ->orWhere('categories.owner_id', '=', $userId);
        })
        ->where('finances.user_id', '=', $userId) // Filter by user_id in finances table
        ->select('categories.*')
        ->distinct()
        ->get();
        //income categories
        //mysql equivalent
        /* SELECT DISTINCT categories.*
            FROM categories
            JOIN finances ON categories.id = finances.category_id
            WHERE categories.type = 'income'
            AND (categories.owner_id = 0 OR categories.owner_id = :userId)
            AND finances.user_id = :userId; */
        $incomeCategoriesWithFinance = Category::join('finances', 'categories.id', '=', 'finances.category_id')
        ->where('categories.type', '=', 'income')
        ->where(function ($query) use ($userId) {
            $query->where('categories.owner_id', '=', 0)
                ->orWhere('categories.owner_id', '=', $userId);
        })
        ->where('finances.user_id', '=', $userId)
        ->select('categories.*')
        ->distinct()
        ->get();



        $this->incomeCategoriesForAuthUserMonthly = Category::join('finances', 'categories.id', '=', 'finances.category_id')
        ->where('categories.type', '=', 'income')
        ->where(function ($query) use ($userId) {
            $query->where('categories.owner_id', '=', 0)
                ->orWhere('categories.owner_id', '=', $userId);
        })
        ->where('finances.user_id', '=', $userId)
        ->whereMonth('finances.time', '=', $currentMonth)
        ->whereYear('finances.time', '=', $currentYear)
        ->select('categories.*')
        ->distinct()
        ->get();

        $this->spendingCategoriesForAuthUserMonthly = Category::join('finances', 'categories.id', '=', 'finances.category_id')
        ->where('categories.type', '=', 'spending')
        ->where(function ($query) use ($userId) {
            $query->where('categories.owner_id', '=', 0)
                ->orWhere('categories.owner_id', '=', $userId);
        })
        ->where('finances.user_id', '=', $userId)
        ->whereMonth('finances.time', '=', $currentMonth)
        ->whereYear('finances.time', '=', $currentYear)
        ->select('categories.*')
        ->distinct()
        ->get();


        return view('includes.advancedStatistics', [
            'incomes' => $incomes,
            'spendings' => $spendings,
            'currencySymbol' => $currencySymbol,
            'familyMembers' => $familyMembers,
            'total_income' => $totalIncome,
            'total_spending' => $totalSpending,
            'available_balance' => $totalIncome - $totalSpending,
            'spendingCategories' => $spendingCategoriesWithFinance,
            'incomeCategories' => $incomeCategoriesWithFinance,
            'familyCurrencySymbols' => $familyCurrencySymbols,
            'incomeCategoriesForAuthUserMonthly' => $this->incomeCategoriesForAuthUserMonthly,
            'spendingCategoriesForAuthUserMonthly' => $this->spendingCategoriesForAuthUserMonthly,
            'spendingsWithTheSameCurrency' =>round($spendingsWithTheSameCurrency, 3),
            'incomesWithTheSameCurrency' => round($incomesWithTheSameCurrency, 3)

        ]);
    }


    public function handleForm(Request $request)
    {
        $selectedOption = $request->input('options');
        if ($selectedOption != "summary") {
            $categoryId = $selectedOption;
            $category = Category::find($categoryId);
            $indexData = $this->index();

            // Filter incomes and spendings by selected category
            $filteredIncomes = $indexData['incomes']->where('category_id', $categoryId);
            $filteredSpendings = $indexData['spendings']->where('category_id', $categoryId);

            // Calculate total income and total spending for the selected category based on its type, if the selected category is spending then the totalIncomeForCategory will return null
            $totalIncomeForCategory = $category->type === 'income' ? $filteredIncomes->sum('price') : null;
            $totalSpendingForCategory = $category->type === 'spending' ? $filteredSpendings->sum('price') : null;


            $spendingsWithTheSameCurrency = Finance::where('currency_id', auth()->user()->currency_id)->where('type', 'Spending')->pluck('price')->avg();
            $incomesWithTheSameCurrency = Finance::where('currency_id', auth()->user()->currency_id)->where('type', 'Income')->pluck('price')->avg();

            // Pass filtered incomes and spendings to the view
            return view('includes.advancedStatistics', [
                'incomes' => $indexData['incomes'],
                'spendings' => $indexData['spendings'],
                'currencySymbol' => $indexData['currencySymbol'],
                'familyMembers' => $indexData['familyMembers'],
                'total_income' => $indexData['total_income'],
                'total_spending' => $indexData['total_spending'],
                'available_balance' => $indexData['available_balance'],
                'spendingCategories' => $indexData['spendingCategories'],
                'incomeCategories' => $indexData['incomeCategories'],
                'selected_category' => $category,
                'totalIncomeForCategory' => $totalIncomeForCategory,
                'totalSpendingForCategory' => $totalSpendingForCategory,
                'filteredIncomes' => $filteredIncomes,
                'filteredSpendings' => $filteredSpendings,
                'spendingsWithTheSameCurrency' =>round($spendingsWithTheSameCurrency, 3),
                'incomesWithTheSameCurrency' => round($incomesWithTheSameCurrency, 3)
                ]);
        }
    }
    function handleFamilyForm(Request $request)
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->month;
        $currentYear = $currentDate->year;


        $authUserId = auth()->user()->id;
        $selectedFamilyMember = $request->input('familymember');
        $familymember = User::find($selectedFamilyMember);
        $indexData = $this->index();
        $memberIncome = Finance::where('user_id', $selectedFamilyMember)->where('type', 'Income')->whereMonth('time', $currentMonth)->whereYear('time', $currentYear)->sum('price');
        $memberSpending = Finance::where('user_id', $selectedFamilyMember)->where('type', 'Spending')->whereMonth('time', $currentMonth)->whereYear('time', $currentYear)->sum('price');
        $familyMemberCurrencySymbol = $familymember->currency->symbol;
        $selectedFamilyMemberId = $familymember->id;


        $incomeCategoriesForAuthUserMonthly = $this->incomeCategoriesForAuthUserMonthly;
        $spendingCategoriesForAuthUserMonthly = $this->spendingCategoriesForAuthUserMonthly;






        $incomeCategoriesForChoosenUserMonthly = Category::join('finances', 'categories.id', '=', 'finances.category_id')
                ->where('categories.type', '=', 'income')
                ->where(function ($query) use ($selectedFamilyMemberId) {
                    $query->where('categories.owner_id', '=', 0)
                        ->orWhere('categories.owner_id', '=', $selectedFamilyMemberId);
                })
                ->where('finances.user_id', '=', $selectedFamilyMemberId)
                ->whereMonth('finances.time', '=', $currentMonth)
                ->whereYear('finances.time', '=', $currentYear)
                ->select('categories.*')
                ->distinct()
                ->get();

        $spendingCategoriesForChoosenUserMonthly = Category::join('finances', 'categories.id', '=', 'finances.category_id')
                ->where('categories.type', '=', 'spending')
                ->where(function ($query) use ($selectedFamilyMemberId) {
                    $query->where('categories.owner_id', '=', 0)
                        ->orWhere('categories.owner_id', '=', $selectedFamilyMemberId);
                })
                ->where('finances.user_id', '=', $selectedFamilyMemberId)
                ->whereMonth('finances.time', '=', $currentMonth)
                ->whereYear('finances.time', '=', $currentYear)
                ->select('categories.*')
                ->distinct()
                ->get();

                //avarage spending, income in your country
                $spendingsWithTheSameCurrency = Finance::where('currency_id', auth()->user()->currency_id)->where('type', 'Spending')->pluck('price')->avg();
                $incomesWithTheSameCurrency = Finance::where('currency_id', auth()->user()->currency_id)->where('type', 'Income')->pluck('price')->avg();



            return view('includes.advancedStatistics', [
                'selectedFamilyMemberId' => $selectedFamilyMemberId,
                'memberIncome' => $memberIncome,
                'memberSpending' => $memberSpending,
                'familyMemberCurrencySymbol' => $familyMemberCurrencySymbol,
                'incomeCategoriesForChoosenUserMonthly' => $incomeCategoriesForChoosenUserMonthly,
                'spendingCategoriesForChoosenUserMonthly' => $spendingCategoriesForChoosenUserMonthly,
                'incomeCategoriesForAuthUserMonthly' => $incomeCategoriesForAuthUserMonthly,
                'spendingCategoriesForAuthUserMonthly' => $spendingCategoriesForAuthUserMonthly,
                'spendingsWithTheSameCurrency' =>round($spendingsWithTheSameCurrency, 3),
                'incomesWithTheSameCurrency' => round($incomesWithTheSameCurrency, 3),
                'incomes' => $indexData['incomes'],
                'spendings' => $indexData['spendings'],
                'currencySymbol' => $indexData['currencySymbol'],
                'familyMembers' => $indexData['familyMembers'],
                'total_income' => $indexData['total_income'],
                'total_spending' => $indexData['total_spending'],
                'available_balance' => $indexData['available_balance'],
                'spendingCategories' => $indexData['spendingCategories'],
                'incomeCategories' => $indexData['incomeCategories'],
                'familyCurrencySymbols' => $indexData['familyCurrencySymbols'],
            ]);
    }

}
