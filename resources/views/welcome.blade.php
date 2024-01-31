@extends('layouts.app')

@section('content')
{{-- Picture or video of the main page --}}
<video id="welcome" src="../storage/videos/welcome.mp4" autoplay loop placeinline muted></video>
{{-- Slogen --}}
{{-- Start manageing your finances
        with our help today --}}
          {{-- button --}}
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <div class="card" id="slogenCard">
                <div class="card-body">
                    <h4 id="slogen" class="card-title">Start manageing your finances <br> with our help today</h4>
                    <button id="welcomeButton" type="button"class="btn btn-primary">Getting started</button>

                </div>
            </div>

        </div>
        <div class="col-2"></div>
    </div>
</div>


@endsection

