@extends('layouts.app')
@section('content')
<h2>Profile Details</h2>
<p><strong>Name: </strong> {{ $user->username }}</p>
<p><strong>Email: </strong> {{ $user->email }}</p>


@endsection