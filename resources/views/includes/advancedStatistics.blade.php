@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card bg-dark text-light" style="border: 1px solid lightgray">
                    <div class="card-body">
                        @if (!auth()->user()->family || (auth()->user()->family && $familyMembers->count() == 1))
                            @php
                                $totalIncome = 0;
                                $totalSpending = 0;
                                $currentMonth = date('m');
                            @endphp

                            @foreach ($incomes as $income)
                                @if (substr($income->time, 5, 2) == $currentMonth)
                                    @php
                                        $totalIncome += $income->price;
                                    @endphp
                                @endif
                            @endforeach

                            @foreach ($spendings as $spend)
                                @if (substr($spend->time, 5, 2) == $currentMonth)
                                    @php
                                        $totalSpending += $spend->price;
                                    @endphp
                                @endif
                            @endforeach

                            @php
                                $availableBalance = $totalIncome - $totalSpending;
                            @endphp

                            <h1 class="available-balance">Available Balance: {{ $availableBalance }} {{ $currencySymbol }}
                            </h1>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

    </div>

    <div class="specialcard-container">
        @php
            $currentYear = date('Y');
            $monthsToShow = [$currentMonth - 2, $currentMonth - 1, $currentMonth];
            $monthsLabels = [
                date('F', mktime(0, 0, 0, $currentMonth - 2, 1, $currentYear)), // Two months ago
                date('F', mktime(0, 0, 0, $currentMonth - 1, 1, $currentYear)), // One month ago
                date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear)), // Current month
            ];
        @endphp
        @for ($i = 0; $i < 3; $i++)
            <div class="specialcard bg-dark text-light">
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

                    @foreach ($spendings as $spend)
                        @if (date('m', strtotime($spend->time)) == $monthsToShow[$i] && date('Y', strtotime($spend->time)) == $currentYear)
                            @php
                                $totalSpending += $spend->price;
                            @endphp
                        @endif
                    @endforeach
                    <p class="specialcard-text">Total Income:<br>{{ $totalIncome }} {{ $currencySymbol }}</p>
                    <hr>
                    <p class="specialcard-text">Total Spending:<br>{{ $totalSpending }} {{ $currencySymbol }}</p>
                </div>
            </div>
        @endfor
    </div>

    <form id="selectForm" action="{{ route('handleForm') }}" method="POST">
        @csrf
        <label for="options">Select an option : </label>
        <select name="options" id="options" onchange="submitForm()">
            <option value="" selected disabled>Choose one</option>
            <optgroup label="Spending categories">
                @foreach ($spendingCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="Income categories">
                @foreach ($incomeCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </optgroup>
        </select>
    </form>
    @if(isset($selected_category))
    <div class="specialcard-container">
        @php
            $currentYear = date('Y');
            $monthsToShow = [$currentMonth - 2, $currentMonth - 1, $currentMonth];
            $monthsLabels = [
                date('F', mktime(0, 0, 0, $currentMonth - 2, 1, $currentYear)), // Two months ago
                date('F', mktime(0, 0, 0, $currentMonth - 1, 1, $currentYear)), // One month ago
                date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear)), // Current month
            ];
        @endphp
        @for ($i = 0; $i < 3; $i++)
            <div class="specialcard bg-dark text-light">
                <div class="specialcard-body">
                    <h5 class="specialcard-title">{{ $monthsLabels[$i] }}</h5>
                    @php
                        $totalIncome = 0;
                        $totalSpending = 0;
                    @endphp
                    @foreach ($filteredIncomes as $income)
                        @if (date('m', strtotime($income->time)) == $monthsToShow[$i] && date('Y', strtotime($income->time)) == $currentYear)
                            @php
                                $totalIncome += $income->price;
                            @endphp
                        @endif
                    @endforeach
    
                    @foreach ($filteredSpendings as $spend)
                        @if (date('m', strtotime($spend->time)) == $monthsToShow[$i] && date('Y', strtotime($spend->time)) == $currentYear)
                            @php
                                $totalSpending += $spend->price;
                            @endphp
                        @endif
                    @endforeach
                    @if ($totalIncomeForCategory !== null )
                        <p class="specialcard-text">Total Income for <u><strong>{{ $selected_category->name }}</strong></u>:<br>{{ $totalIncome }} {{ $currencySymbol }}</p>
                    
                    @endif

                    @if ($totalSpendingForCategory !== null )
                        <p class="specialcard-text">Total Spending for <u><strong>{{ $selected_category->name }}</strong></u>:<br>{{ $totalSpending }} {{ $currencySymbol }}</p>
                    @endif
                    
                </div>
            </div>
        @endfor
    </div>
@endif

  
    <script>
        function submitForm() {
            document.getElementById('selectForm').submit();
        }
    </script>

@elseif ($familyMembers->count() > 1)
    <h1 class="available-balance">Available Balance: {{ $available_balance }} {{ $currencySymbol }}</h1>
    @php
        $currentMonth = date('m');
    @endphp
    <div class="specialcard-container">
        @php
            $currentYear = date('Y');
            $monthsToShow = [$currentMonth - 2, $currentMonth - 1, $currentMonth];
            $monthsLabels = [
                date('F', mktime(0, 0, 0, $currentMonth - 2, 1, $currentYear)), // Two months ago
                date('F', mktime(0, 0, 0, $currentMonth - 1, 1, $currentYear)), // One month ago
                date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear)), // Current month
            ];
        @endphp
        @foreach ($monthsToShow as $index => $month)
            <div class="specialcard h-130">
                <div class="specialcard-body">
                    <h5 class="specialcard-title">{{ $monthsLabels[$index] }}</h5>
                    @foreach ($familyMembers as $member)
                        @php

                            $userFinances = \App\Models\Finance::where('user_id', $member->id)
                                ->whereMonth('time', $month)
                                ->whereYear('time', $currentYear)
                                ->get();
                            $totalIncome = $userFinances->where('type', 'Income')->sum('price');
                            $totalSpending = $userFinances->where('type', 'Spending')->sum('price');
                        @endphp
                        <p class="specialcard-text">Family member:<br>{{ $member->username }}</p>
                        <p class="specialcard-text">Total Income:<br>{{ $totalIncome }} {{ $currencySymbol }}</p>
                        <p class="specialcard-text">Total Spending:<br>{{ $totalSpending }} {{ $currencySymbol }}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@else
    <h1>This is a bug, report me to the devs.</h1>
    @endif
    </div>
@endsection
