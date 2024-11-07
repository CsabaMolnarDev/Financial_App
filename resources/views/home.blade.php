@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="">
            <div class=""></div>
            <div class="">
                @if (auth()->user()->finances()->where('type', 'Income')->whereMonth('time', now()->month)->whereYear('time', now()->year)->exists())
                    <div class="">
                        <div class="">
                            <h3>Incomes this month</h3>
                        </div>
                        <div class="">
                            <div class="row" id="income">
                                <div id="incomeChart"></div>
                            </div>
                            <div class="row">
                                <button class="" type="submit"
                                    onclick="window.location=' {{ url('/income') }} '">Details</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="">
                @if (auth()->user()->finances()->where('type', 'Spending')->whereMonth('time', now()->month)->whereYear('time', now()->year)->exists())
                    <div class="">
                        <div class="">
                            <h3>Spendings this month</h3>
                        </div>
                        <div class="">
                            <div class="" id="spending">
                                <div id="spendingChart"></div>
                            </div>
                            <div class="">
                                <button class="" type="submit"
                                    onclick="window.location=' {{ url('/spending') }} '">Details</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class=""></div>
        </div>
    </div>
    <div class="">
        <div class="">
            <div class=""></div>
            <div class="">
                @if (auth()->user()->family && $familymembers->count() > 1 && $allIncomesZero === false)
                    <div class="">
                        <div class="">
                            <h3>Family Incomes</h3>
                        </div>
                        <div class="">
                            <div class="" id="familyIncome">
                                <div id="familyIncomeChart"></div>
                            </div>
                            <div class="">
                                <button class="" type="submit"
                                    onclick="window.location=' {{ url('/advancedStatistics') }} '">Details</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="">
                @if (auth()->user()->family && $familymembers->count() > 1 && $allSpendingsZero === false)
                    <div class="">
                        <div class="">
                            <h3>Family Spendings</h3>
                        </div>
                        <div class="">
                            <div class="" id="familySpending">
                                <div id="familySpendingChart"></div>
                            </div>
                            <div class="">
                                <button class="" type="submit"
                                    onclick="window.location=' {{ url('/advancedStatistics') }} '">Details</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class=""></div>
        </div>
    </div>
    <div class="">
        <div class="">
            <div class=""></div>
            <div class="">
                <div class="">
                    <div class="">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>
    <div class="">
        <div class="">
            <div class=""></div>
            <div class="">
                <div class="">
                    <div class="">
                        <h3 class="">Exchange currency</h3>
                    </div>
                    <div class="">
                        <form action="{{ route('calculate') }}" method="POST">
                            @csrf
                            <div class="">
                                <div class=""></div>
                                <div class="">
                                    <label for="currency" id="symbol">1
                                        {{ isset($fromSymbol) ? $fromSymbol : '' }}</label>
                                </div>
                                <div class="">
                                    <select id="currency" class="form-control" type="text" name="currency_id"
                                        value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="currency2"
                                        id="result">{{ isset($exchangeRate) ? $exchangeRate . ' ' . $toSymbol : '' }}</label>
                                </div>
                                <div class="">
                                    <select id="currency2" class="form-control" type="text" name="currency_id2"
                                        value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=""></div>
                            </div>
                            <div class="">
                                <div class=""></div>
                                <div class="">
                                    <button class="form-control" type="submit">Calculate</button>
                                </div>
                                <div class=""></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>
    <script>
        /* Functions: */
        // Fetch the category prices data from PHP
        var spendingCategoryPrices = @json($spendingCategoryPrices);
        /* Graphs: */
        /* Pie graph */
        var spendingOptions = {
            chart: {
                type: 'pie',
                width: 300,
                height: 300,
                /* Fontcolor */
                foreColor: '#FBFBFB',
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2,
                colors: ["#fff"]
            },
            legend: {
                show: false
            },
            // Other options...
            labels: Object.keys(spendingCategoryPrices),
            series: Object.values(spendingCategoryPrices),
            // Other options...
            responsive: [{
                // breakepoint in px.... when the window size goes under this, the graph changes
                breakpoint: 1200,
                // options for the changed responsive graph
                options: {
                    plotOptions: {
                        chart: {
                            horizontal: false
                        }
                    },
                    chart: {
                        width: 200,
                        height: 200,
                    },
                }
            }]
        };
        /* render apexcharts */
        var spendingChart = new ApexCharts(document.querySelector('#spendingChart'), spendingOptions);
        spendingChart.render();
        /* Functions: */
        // Fetch the category prices data from PHP
        var incomeCategoryPrices = @json($incomeCategoryPrices);
        /* Graphs: */
        /* Pie graph */
        var incomeOptions = {
            chart: {
                type: 'pie',
                width: 300,
                height: 300,
                /* Fontcolor */
                foreColor: '#FBFBFB',
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2,
                colors: ["#fff"]
            },
            legend: {
                show: false
            },
            // Other options...
            labels: Object.keys(incomeCategoryPrices),
            series: Object.values(incomeCategoryPrices),
            // Other options...
            responsive: [{
                // breakepoint in px.... when the window size goes under this, the graph changes
                breakpoint: 1200,
                // options for the changed responsive graph
                options: {
                    plotOptions: {
                        chart: {
                            horizontal: false
                        }
                    },
                    chart: {
                        width: 200,
                        height: 200,
                    },
                }
            }]
        };
        /* render apexcharts */
        var incomeChart = new ApexCharts(document.querySelector('#incomeChart'), incomeOptions);
        incomeChart.render();
        /* Graphs: */
        /* Pie graph */
        var familyIncomes = @json($familyIncomes);
        if (familyIncomes.length > 1) {
            var familyIncomeLabels = [];
            var familyIncomeSeries = [];

            for (var i = 0; i < familyIncomes.length; i++) {
                familyIncomeLabels.push(familyIncomes[i].user_fullname);
                familyIncomeSeries.push(familyIncomes[i].family_income);
            }
            var familyIncomeOptions = {
                chart: {
                    type: 'pie',
                    width: 300,
                    height: 300,
                    /* Fontcolor */
                    foreColor: '#FBFBFB',
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    width: 2,
                    colors: ["#fff"]
                },
                legend: {
                    show: false
                },
                labels: familyIncomeLabels,
                series: familyIncomeSeries,
                // Other options...
                responsive: [{
                    // breakepoint in px.... when the window size goes under this, the graph changes
                    breakpoint: 1200,
                    // options for the changed responsive graph
                    options: {
                        plotOptions: {
                            chart: {
                                horizontal: false
                            }
                        },
                        chart: {
                            width: 200,
                            height: 200,
                        },
                    }
                }]
            };
            var familyIncomeChart = new ApexCharts(document.querySelector('#familyIncomeChart'), familyIncomeOptions);
            familyIncomeChart.render();

        }
        //familySpending
        var familySpending = @json($familySpending);
        if (familySpending.length > 1) {
            var familySpendingLabels = [];
            var familySpendingSeries = [];

            for (var i = 0; i < familySpending.length; i++) {
                familySpendingLabels.push(familySpending[i].user_fullname);
                familySpendingSeries.push(familySpending[i].family_spending);
            }
            var familySpendingOptions = {
                chart: {
                    type: 'pie',
                    width: 300,
                    height: 300,
                    /* Fontcolor */
                    foreColor: '#FBFBFB',
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    width: 2,
                    colors: ["#fff"]
                },
                legend: {
                    show: false
                },
                labels: familySpendingLabels,
                series: familySpendingSeries,
                // Other options...
                responsive: [{
                    // breakepoint in px.... when the window size goes under this, the graph changes
                    breakpoint: 1200,
                    // options for the changed responsive graph
                    options: {
                        plotOptions: {
                            chart: {
                                horizontal: false
                            }
                        },
                        chart: {
                            width: 200,
                            height: 200,
                        },
                    }
                }]
            };
            var familySpendingChart = new ApexCharts(document.querySelector('#familySpendingChart'), familySpendingOptions);
            familySpendingChart.render();
        }
        var MonthlyFamilyFinances = @json($familyFinances);
        if (MonthlyFamilyFinances.length != 0) {
            var financeColors = @json($familyFinanceColors);
            var jsonData = [];
            MonthlyFamilyFinances.forEach(function(element) {
                var color = financeColors[element.id];
                var eventData = {
                    title: element.name,
                    start: element.time,
                    color: color
                };
                jsonData.push(eventData);
            });
            //calendar
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev',
                        center: 'title, today, month, agendaDay',
                        right: 'next',
                    },
                    events: jsonData
                })
            });
        } else {
            var MonthlyFinances = @json($userMonthlyFinances);
            var financeColors = @json($financeColors);
            console.log(financeColors);
            var jsonData = [];
            MonthlyFinances.forEach(function(element) {

                var color = financeColors[element.id];
                var eventData = {
                    title: element.name,
                    start: element.time,
                    color: color
                };
                jsonData.push(eventData);
            });
            //calendar
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev',
                        center: 'title, today, month, agendaDay',
                        right: 'next',
                    },
                    events: jsonData
                })
            });
        }
    </script>
@endsection
