@extends('layouts.app')
@section('content')
  
{{--TODO: set these into a card + frontend, and possibly make a change option next to them --}}
<h2>Profile Details</h2>
<p><strong>Name: </strong> {{ $user->username }}</p>
<p><strong>Email: </strong> {{ $user->email }}</p>
{{-- show currency, list out all categories --}}

@endsection