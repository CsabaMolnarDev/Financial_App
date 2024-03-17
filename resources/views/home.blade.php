@extends('layouts.app')
@section('content')
    <div id="homeContainer" class="container d-flex align-items-center justify-content-center" style="height: 80vh;">
        <div class="row">
            <h3 class="text-warning">Some content will come here later</h3>
        </div>
    </div>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <img src="../storage/icons/globe.png">
                        </div>
                        <div class="row">
                            <h4 class="card-title">Access from anywhere</h4>
                            <p class="card-text">You can access our product from anywhere on the globe</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <img src="../storage/icons/pin.png">
                        </div>
                        <div class="row">
                            <h4 class="card-title">Remember everything</h4>
                            <p class="card-text">With the help of our product, you can easily track and manage your finances
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <img src="../storage/icons/calendar.png">
                        </div>
                        <div class="row">
                            <h4 class="card-title">24/7 access</h4>
                            <p class="card-text">Our services are running day and night, in order to be able to support you
                                at any given time</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <img src="../storage/icons/family.png">
                        </div>
                        <div class="row">
                            <h4 class="card-title">Family support</h4>
                            <p class="card-text">You can create a group with your family, and you can manage the finances
                                together. //Clink link to get started with the family support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
