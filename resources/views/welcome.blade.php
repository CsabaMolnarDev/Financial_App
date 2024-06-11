@extends('layouts.app')
@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="height: 80vh;">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <div class="card" id="welcomeCard">
                    <div class="card-body">
                        <h4 id="welcomeSlogen" class="card-title text-info">Start managing your finances with our help today
                        </h4>
                        <button id="welcomeButton" type="button" class="btn btn-outline-warning"
                            onclick="window.location=' {{ url('/register') }} '">Getting started</button>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
