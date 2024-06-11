@extends('layouts.app')
@section('content')
    <div class="landingContainer text-center" style="height: 85vh">
        <div class="row gy-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <h1 class="mb-4 mt-0 text-info" id="slogen">Start managing your finances with our help today
                        </h1>
                    </div>
                </div>
                <div class="row gy-3">
                    <div class="col-md-12">
                        <button id="landingButton" type="button" class="btn btn-success"
                            onclick="window.location=' {{ url('/register') }} '">Getting started</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
