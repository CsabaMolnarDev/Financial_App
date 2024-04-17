{{-- this is where we can check how we cando our things --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <h1 class="text-info ">In the future you can read the manual for our product here</h1>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script>
        /* Bg img */
        document.body.style.backgroundImage = "url('../storage/pictures/documentation.jpg')";
    </script>
@endsection
