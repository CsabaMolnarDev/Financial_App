@extends('layouts.app')

@section('content')
{{-- Picture or video of the main page --}}
<video id="welcomeVideo" src="../storage/videos/welcome.mp4" autoplay loop placeinline muted></video>
{{-- Slogen --}}
{{-- Start manageing your finances
        with our help today --}}
          {{-- button --}}
          <div class="container d-flex align-items-center justify-content-center" style="height: 80vh;">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 text-center">
                    <div class="card" id="welcomeCard">
                        <div class="card-body">
                            <h4 id="welcomeSlogen" class="card-title text-info">Start managing your finances with our help today</h4>
                            <button id="welcomeButton" type="button" class="btn btn-outline-warning" onclick="window.location=' {{ url("/register") }} '">Getting started</button>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
@endsection
{{-- Footer if needed --}}
{{-- @section('footer')
<footer id="footer">
    <p class="bg-dark text-light">Copiright@</p>
    {{-- icon that when pressed leads to the top of the page
</footer>
@endsection--}}
