@extends('layouts.app')
@section('content')
<div>
    @if(!auth()->user()->family)

        @php
            $totalIncome = 0;
            $totalSpending = 0;
        @endphp

        @php
            $currentMonth = date('m'); 
        @endphp

        @foreach ($incomes as $income)
            @if (substr($income->time, 5, 2) == $currentMonth) 
                @php
                    $totalIncome += $income->price;
                @endphp
            @endif
        @endforeach

        @foreach ($spending as $spend)
            @if (substr($spend->time, 5, 2) == $currentMonth) 
                @php
                    $totalSpending += $spend->price;
                @endphp
            @endif
        @endforeach

        @php
            $availableBalance = $totalIncome - $totalSpending;
        @endphp

        <h1>Available Balance: {{ $availableBalance }} {{ $currencySymbol }}</h1>
        </div>
        <div class="specialcard-container">
        @php
            $currentMonth = date('m');
            $currentYear = date('Y');
            $monthsToShow = [$currentMonth - 2, $currentMonth - 1, $currentMonth];
            $monthsLabels = [
                date('F', mktime(0, 0, 0, $currentMonth - 2, 1, $currentYear)), // Two months ago
                date('F', mktime(0, 0, 0, $currentMonth - 1, 1, $currentYear)), // One month ago
                date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear)) // Current month
            ];
        @endphp
        @for ($i = 0; $i < 3; $i++)
            <div class="specialcard">
                <div class="specialcard-body">
                    <h5 class="specialcard-title">{{ $monthsLabels[$i] }}</h5>
                    @php
                        $totalIncome = 0;
                        $totalSpending = 0;
                    @endphp
                    @foreach ($incomes as $income)
                        @if (date('m', strtotime($income->time)) == $monthsToShow[$i] && date('Y', strtotime($income->time)) == $currentYear)
                            @php
                                $totalIncome += $income->price;
                            @endphp
                        @endif
                    @endforeach

                    @foreach ($spending as $spend)
                            @if (date('m', strtotime($spend->time)) == $monthsToShow[$i] && date('Y', strtotime($spend->time)) == $currentYear)
                                @php
                                    $totalSpending += $spend->price;
                                @endphp
                            @endif
                        @endforeach
                    <p class="specialcard-text">Total Income: {{ $totalIncome }} {{ $currencySymbol }}</p>
                    <p class="specialcard-text">Total Spending: {{ $totalSpending }} {{ $currencySymbol }}</p>
            </div>
        </div>
        @endfor
    @endif
    @elseif (auth()->user()->family && family)
    @endif
</div>
@endsection
