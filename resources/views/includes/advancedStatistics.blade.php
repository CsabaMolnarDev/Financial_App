@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        {{-- Work here --}}
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script>
        /* Bg img */ /* Replace "documentation" with the picture we want */
        document.body.style.backgroundImage = "url('../storage/pictures/documentation.jpg')";
    </script>
@endsection
