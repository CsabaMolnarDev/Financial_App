{{-- here we can track our income --}}
@extends('layouts.app')
@section('content')
<img id="regFormPicture" src="../storage/pictures/income.jpg" alt="background" title="background">
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center" id="financeButton">
           <button class="btn btn-outline-danger" onclick="window.location=' {{ url("/incomeCreate") }} '">Add new income</button>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach($finances as $item)
        <div class="col-4">
            <div class="card bg-dark text-info text-center" id="financeCard">
                <div class="row-3">
                    <h5 class="card-title">{{$item->name}}</h5>
                </div>
                <div class="row-3">
                    <p class="card-text">{{$item->type}}</p>
                </div>
                <div class="row-3">
                    <p class="card-text">{{$item->price}}</p>
                </div>
                <div class="row-3">
                    <p class="card-text">{{$item->time}}</p>
                </div>         
            </div>         
        </div>
        @endforeach
    </div>
</div>
@endsection
