{{-- here we can read about the creators --}}
@extends('layouts.app')
@section('content')
    <div class="container" style="margin-bottom: 3vh">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3 class="card-title">The story of our project in short</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Our little project is a web application designed for financial management.
                            We chose this idea because we wanted to create a project that we could both use in the future by
                            running it on a server and continue to develop as we please.
                            The choice of topic mainly stemmed from these aspects. On the other hand, we have always been
                            interested in finance.
                            We believe that this small project, as well as this application, even in its current state,
                            could provide a foundation for us and others in managing their finances and achieving their
                            financial goals.
                            We believe that if people are able to track their expenses even for a few months, significant
                            cost savings can be achieved.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 3vh">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Contact us here</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <p></p>
                            <li>24/7 on email: laravelmybeloved@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script>
        /* Background image */
        document.body.style.backgroundImage = "url('../storage/pictures/about.jpg')";
    </script>
@endsection
