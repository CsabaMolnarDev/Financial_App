{{-- here we can read about the creators --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h3 class="text-info">Devs:</h3>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            {{-- from database --}}
            @foreach ($devs as $item)
                {{-- sets the amount of card we can put next to each other col-4*3 = 12 -> 3 card will be displayed in one row --}}
                <div class="col-4">
                    {{-- card --}}
                    <div class="card bg-dark text-light" style="margin-bottom: 5vh">
                        <div class="card-tittle text-info"> {{-- tittle of the card --}}
                            <div class="card-header cardTitle aboutTittle">{{ $item->username }}</div>
                        </div>{{-- end of the tittle --}}
                        <div class="card-body"> {{-- body of the card --}}
                            <div class="row">{{-- main content of card --}}
                                <div class="col-4">{{-- left side of the card --}}
                                    <div class="row">
                                        {{-- Image of the card --}}
                                        <?php
                                        if ($item->picture) {
                                            echo '<img class="card-img aboutPic" src="../storage/pictures/' . $item->picture . '.jpg" alt="Unknown picture"/>';
                                        } else {
                                            echo '<img class="card-img aboutPic" src="../storage/pictures/placeholder.jpg" alt="Unknown picture"/>';
                                        }
                                        ?>
                                    </div>
                                </div>{{-- end of the left side of the card --}}
                                <div class="col-8">{{-- right side of the card --}}
                                    <div class="row">{{-- TOP row --}}
                                        <div class="col-4">{{-- left side of the top row --}}
                                            <p class="card-text aboutFont">Name:</p>
                                        </div>
                                        <div class="col-8"> {{-- right side of the top row --}}
                                            <p class="card-text aboutFont">{{ $item->fullname }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">{{-- MIDDLE row --}}
                                        <div class="col-4">
                                            <p class="card-text aboutFont">Email:</p>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text aboutFont">{{ $item->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">{{-- BOTTOM row --}}
                                        <div class="col-4">
                                            <p class="card-text aboutFont">Phone:</p>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text aboutFont">{{ $item->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-info">
                <h3>Idea of the project</h3>
                <h3>Story...</h3>
                <h3>Features....</h3>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <script>
        /* Background image */
        document.body.style.backgroundImage = "url('../storage/pictures/about.jpg')";
    </script>
@endsection
