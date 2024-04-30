{{-- TODO:

FIX SELECT BY CATEGORY
--}}



@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card bg-dark text-light text-center" style="border: 1px solid lightgray">
                    <div class="card-body">
                        <div class="row">
                            <p>Avarge income in your country: {{ $incomesAverage }} {{ $currencySymbol }}</p>
                        </div>
                        <div class="row mt-3">
                            <p>Avarage spending in your country: {{ $spendingsAverage }} {{ $currencySymbol }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card bg-dark text-light" style="border: 1px solid lightgray">
                    <div class="card-body">
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

                        {{-- if() if user in family
                                total family balance
                            @end if
                            --}}
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

    </div>
    @if (!auth()->user()->family || (auth()->user()->family && $familyMembers->count() == 1))
        {{-- If user dont have a family or user's family doesnt have members exept the user --}}
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
    @else
        <div class="specialcard-container">
            @php
                $currentMonth = date('m');
            @endphp
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
                <div class="specialcard h-130 bg-dark text-light">
                    <div class="specialcard-body">
                        <h5 class="specialcard-title">{{ $monthsLabels[$index] }}</h5>
                        @foreach ($familyMembers as $member)
                            @php
                                $memberCurrencySymbol = $familyCurrencySymbols[$member->id];
                                /* DOEST WORK NEEDS FIXING */
                            @endphp
                            @php
                                $userFinances = \App\Models\Finance::where('user_id', $member->id)
                                    ->whereMonth('time', $month)
                                    ->whereYear('time', $currentYear)
                                    ->get();
                                $totalIncome = $userFinances->where('type', 'Income')->sum('price');
                                $totalSpending = $userFinances->where('type', 'Spending')->sum('price');
                            @endphp
                            <p class="specialcard-text">Family member:<br>
                                @if ($member->username == auth()->user()->username)
                                <u> My account </u> @else<u>{{ $member->username }}</u>
                                @endif
                            </p>
                            <p class="specialcard-text">Total Income:<br>{{ $totalIncome }} {{ $memberCurrencySymbol }}
                            </p>
                            <p class="specialcard-text">Total Spending:<br>{{ $totalSpending }}
                                {{ $memberCurrencySymbol }}
                            </p>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    {{-- SELECT BY CATEGORY --}}
    <div class="container text-center mb-3 mt-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <form id="selectForm" action="{{ route('handleForm') }}" method="POST">
                            @csrf
                            <label for="options">Select an option : </label>
                            <select class="form-control" name="options" id="options" onchange="submitForm()">
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
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    @if (isset($selected_category))
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
                        @if ($totalIncomeForCategory !== null)
                            <p class="specialcard-text">Total Income for
                                <u><strong>{{ $selected_category->name }}</strong></u>:<br>{{ $totalIncome }}
                                {{ $currencySymbol }}
                            </p>
                        @endif

                        @if ($totalSpendingForCategory !== null)
                            <p class="specialcard-text">Total Spending for
                                <u><strong>{{ $selected_category->name }}</strong></u>:<br>{{ $totalSpending }}
                                {{ $currencySymbol }}
                            </p>
                        @endif

                    </div>
                </div>
            @endfor
        </div>
    @endif
    {{-- SELECT FAMILY MEMBER IF USER HAS FAMILY MEMBERS --}}
    @if ($familyMembers->count() > 1)
        <div id="advanced_details" class="hidden">
            <div class="container">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <div class="card-title">My Account
                            <hr>
                            @php
                                $userFinances = \App\Models\Finance::where('user_id', auth()->user()->id)
                                    ->whereMonth('time', $month)
                                    ->whereYear('time', $currentYear)
                                    ->get();
                                $totalIncomeForAuth = $userFinances->where('type', 'Income')->sum('price');
                                $totalSpendingForAuth = $userFinances->where('type', 'Spending')->sum('price');
                            @endphp
                            <div class="card-text">
                                <p>My Income for this month: {{ $totalIncomeForAuth }} {{ $currencySymbol }}</p>
                                @foreach ($incomeCategoriesForAuthUserMonthly as $category)
                                    <li>{{ $category->name }} -
                                        @php
                                            $totalIncomeForCategoryAuth = \App\Models\Finance::where(
                                                'user_id',
                                                auth()->user()->id,
                                            )
                                                ->where('category_id', $category->id)
                                                ->sum('price');
                                        @endphp
                                        {{ $totalIncomeForCategoryAuth }} {{ $currencySymbol }}
                                    </li>
                                @endforeach
                            </div>
                            <hr>
                            <p>My Spending for this month: {{ $totalSpendingForAuth }} {{ $currencySymbol }}</p>
                            @foreach ($spendingCategoriesForAuthUserMonthly as $category)
                                <li>{{ $category->name }} -
                                    @php
                                        $totalSpendingForCategoryAuth = \App\Models\Finance::where(
                                            'user_id',
                                            auth()->user()->id,
                                        )
                                            ->where('category_id', $category->id)
                                            ->sum('price');
                                    @endphp
                                    {{ $totalSpendingForCategoryAuth }} {{ $currencySymbol }}
                                </li>
                            @endforeach
                        </div>
                        <div class="card-text">
                            <form id="familymemberForm" action="{{ route('handleFamilyForm') }}" method="POST">
                                @csrf
                                <label for="familymember">Select a family member: </label>
                                <select name="familymember" id="familymember" onchange="submitForm()">
                                    <option value="" selected disabled>Choose</option>
                                    <optgroup label="Family members">
                                        @foreach ($familyMembers as $member)
                                            @if ($member->username != auth()->user()->username)
                                                <option value="{{ $member->id }}">{{ $member->username }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($selectedFamilyMemberId) &&
                    isset($memberIncome) &&
                    isset($incomeCategoriesForChoosenUserMonthly) &&
                    isset($memberSpending) &&
                    isset($spendingCategoriesForChoosenUserMonthly))
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                @php
                                    $username = \App\Models\User::where('id', '=', $selectedFamilyMemberId)->value(
                                        'username',
                                    );
                                @endphp
                                User:
                                <u>{{ $username }}</u>
                                <p>Member Income for this month: {{ $memberIncome }} {{ $familyMemberCurrencySymbol }}
                                </p>
                                @foreach ($incomeCategoriesForChoosenUserMonthly as $category)
                                    <li>{{ $category->name }} -
                                        @php
                                            $totalIncomeForCategory = \App\Models\Finance::where(
                                                'user_id',
                                                $selectedFamilyMemberId,
                                            )
                                                ->where('category_id', $category->id)
                                                ->sum('price');
                                        @endphp
                                        {{ $totalIncomeForCategory }} {{ $familyMemberCurrencySymbol }}
                                    </li>
                                @endforeach
                                <hr>
                                <p>Member Spending for this month: {{ $memberSpending }}
                                    {{ $familyMemberCurrencySymbol }}
                                </p>
                                @foreach ($spendingCategoriesForChoosenUserMonthly as $category)
                                    <li>{{ $category->name }} -
                                        @php
                                            $totalSpendingForCategory = \App\Models\Finance::where(
                                                'user_id',
                                                $selectedFamilyMemberId,
                                            )
                                                ->where('category_id', $category->id)
                                                ->sum('price');
                                        @endphp
                                        {{ $totalSpendingForCategory }} {{ $familyMemberCurrencySymbol }}
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
    {{-- Scripts --}}
    <script>
        /* SELECT BY CATEGORY HANDLER */
        function submitForm() {
            document.getElementById('selectForm').submit();
        }
        /* SELECT BY FAMILY MEMBER HANDLER */
        function submitForm() {
            document.getElementById('familymemberForm').submit();
        }
    </script>
@endsection
