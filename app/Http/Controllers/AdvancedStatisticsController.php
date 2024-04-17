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
        

      
        return view('includes.advancedStatistics', [
            'incomes' => $incomes,
            'spendings' => $spendings,
            'currencySymbol' => $currencySymbol,
            'familyMembers' => $familyMembers,
            'total_income' => $totalIncome,
            'total_spending' => $totalSpending,
            'available_balance' => $totalIncome - $totalSpending
        ]);
    }
}
