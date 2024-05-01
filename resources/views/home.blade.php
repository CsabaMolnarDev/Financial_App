@extends('layouts.app')
@section('content')
    {{-- calendar goes here, monthly inc montly sallery etc --}}
    <div class="container">
        <div class="row gy-3">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Montly Income</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="row" id="pie">
                            {{-- Use apexcharts --}}
                            @if (auth()->user()->finances()->where('type', 'Income')->exists())
                                <div id="income"></div>
                            @else
                                <p>You have not added income yet</p>
                            @endif
                        </div>
                        <div class="row">
                            <button class="btn btn-outline-info" type="submit"
                                onclick="window.location=' {{ url('/income') }} '">Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Montly Spending</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="row" id="pie">
                            {{-- Use apexcharts --}}
                            @if (auth()->user()->finances()->where('type', 'Spending')->exists())
                                <div id="spending"></div>
                            @else
                                <p>You have not added spending yet</p>
                            @endif

                        </div>
                        <div class="row">
                            <button class="btn btn-outline-info" type="submit"
                                onclick="window.location=' {{ url('/spending') }} '">Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row gy-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card text-light bg-dark">
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row gy-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card text-light bg-dark">
                    <div class="card-header">
                        <h3 class="text-center">Exchange currency</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('calculate') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-1">
                                    <label for="currency_id" id="symbol">1
                                        {{ isset($fromSymbol) ? $fromSymbol : '' }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select id="currency" class="form-control" type="text" name="currency_id"
                                        value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label for="currency_id2"
                                        id="result">{{ isset($exchangeRate) ? $exchangeRate . ' ' . $toSymbol : '' }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select id="currency2" class="form-control" type="text" name="currency_id2"
                                        value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-outline-success form-control" type="submit">Calculate</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script>
        /* Functions: */
        // Fetch the category prices data from PHP
        var spendingCategoryPrices = @json($spendingCategoryPrices);

        /* Graphs: */
        /* Pie graph */
        var options = {
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
        var chart = new ApexCharts(document.querySelector('#spending'), options);
        chart.render();



        /* Functions: */
        // Fetch the category prices data from PHP
        var incomeCategoryPrices = @json($incomeCategoryPrices);

        /* Graphs: */
        /* Pie graph */
        var options = {
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
        var chart = new ApexCharts(document.querySelector('#income'), options);
        chart.render();

        //calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endsection
