@extends('layouts.app')

@section('content')
<img id="regFormPicture" src="../storage/pictures/home.jpg" alt="background" title="background">
<div id="homeContainer" class="container d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <div class="card bg-dark" id="homeCard">
                <div class="card-body">
                    <h4 id="homeSlogen" class="card-title text-light">Check out the incomes here!</h4>
                    <button id="homeButton" class="btn btn-outline-success" type="submit" onclick="window.location=' {{ url("/income") }} '"">Incomes</button>
                    <h4 id="homeSlogen" class="card-title text-light">Check out the spendings here!</h4>
                    <button id="homeButton" class="btn btn-outline-danger" type="submit" onclick="window.location=' {{ url("/spending") }} '"">Spendings</button>
                    <h4 id="homeSlogen" class="card-title text-light">Are you interested in our staff?</h4>
                    <button id="homeButton" class="btn btn-outline-info " type="submit" onclick="window.location=' {{ url("/about_us") }} '"">About us</button>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
@endsection
