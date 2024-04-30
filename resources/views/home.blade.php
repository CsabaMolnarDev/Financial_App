@extends('layouts.app')
@section('content')
    {{-- calendar goes here, monthly inc montly sallery etc --}}
    <div class="container mb-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-4">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Montly Income</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- Use apexcharts --}}
                            <h1>Apexcharts comes here (pie diagram)</h1>
                        </div>
                        <div class="row">
                            <button class="btn btn-outline-info" type="submit"
                                onclick="window.location=' {{ url('/income') }} '">Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Montly Spending</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- Use apexcharts --}}
                            <h1>Apexcharts comes here (pie diagram)</h1>
                        </div>
                        <div class="row">
                            <button class="btn btn-outline-info" type="submit"
                                onclick="window.location=' {{ url('/spending') }} '">Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card text-light bg-dark">
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('calculate') }}" method="POST">
                            @csrf
                            <label for="currency_id" id="symbol">1 {{ isset($fromSymbol) ? $fromSymbol : '' }}</label>
                            <select id="currency" class="form-control" type="text" name="currency_id" value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                <option value="" disabled selected hidden>Please Choose...</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }} -
                                    {{ $currency->symbol }}</option>
                                 @endforeach
                            </select>
                            <label for="currency_id2" id="result">{{ isset($exchangeRate) ? $exchangeRate . ' ' . $toSymbol : '' }}</label>
                            <select id="currency2" class="form-control" type="text" name="currency_id2" value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                <option value="" disabled selected hidden>Please Choose...</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }} -
                                    {{ $currency->symbol }}</option>
                                 @endforeach
                            </select>
                            <button class="btn btn-outline-success form-control" type="submit">Calculate</button>
                        </form>
                       
   
          

                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script>
        /* apexcharts pie */
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endsection
