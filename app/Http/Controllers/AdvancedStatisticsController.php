<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Finance;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AdvancedStatisticsController extends Controller
{
    public function index()
    {
   
        $userId = Auth::id();
        $incomes = Finance::where('type','Income')->where('user_id', $userId)->get();
        $spendings = Finance::where('type','Spending')->where('user_id', $userId)->get();
        
        $currencySymbol = auth()->user()->currency->symbol;
        $familyMembers = User::where('family_id', auth()->user()->family_id)
                     ->whereNotNull('family_id') 
                     ->get();

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
        ->where('finances.user_id', '=', $userId) // Filter by user_id in finances table
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
            'incomeCategories' => $incomeCategoriesWithFinance
        ]);
    }


    public function handleForm(Request $request)
{
    $selectedOption = $request->input('options');

    switch ($selectedOption) {
        case 'summary':
           dd("summárum");
            // Logic for summary
            return view('includes.advancedStatistics', [
                // Add your data here
            ]);
        
        case 'Spending Categories':
            $selectedCategory = $request->input('spendingOptions');
            // Logic for handling spending category
            dd($selectedCategory);
            break;

        case 'Income Categories':
            $selectedCategory = $request->input('incomeOptions');
            // Logic for handling income category
            dd($selectedCategory);
            break;

        default:
            return "error";
    }
}
}
