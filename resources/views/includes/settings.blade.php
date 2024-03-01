@extends('layouts.app')
@section('content')
  
{{--TODO: set these into a card + frontend, and possibly make a change option next to them --}}
{{-- show currency, list out all categories --}}

<div class="row justify-content-center">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
            <form action="" method="POST">
                <h3 class="card-title">Profile Details</h3>
                <div><p class="card-text"><strong>Name: {{ $user->username }}</strong></p>
                    <button type="button" class="btn btn-primary">Change Username</button>
                </div>
                <div><p class="card-text"><strong>Email: {{ $user->email }}</strong></p>
                    <button type="button" class="btn btn-primary">Change Email</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>



@endsection