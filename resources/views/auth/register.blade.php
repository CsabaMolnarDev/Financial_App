{{-- TODO: make the currency filled from database???? line 50 --}}

@extends('layouts.app')

@section('content')
<img id="regFormPicture" src="../storage/pictures/register.jpg" alt="background" title="background">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-info">
                <div class="card-header text-info" id="RegFormTittle">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="fullname" class="col-md-4 col-form-label text-md-end">{{ __('Fullname') }}</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input onchange="checkUsernameTaken(this.value);" id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="currency" class="col-md-4 col-form-label text-md-end">{{ __('Currency') }}</label>
                            <div class="col-md-6">
                                <select id="currency" class="form-control"  type="text"  @error('currency') is-invalid @enderror name="currency_id" value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                <option value="" disabled selected hidden>Please Choose...</option>
                                 @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }} - {{ $currency->symbol }}</option>
                                @endforeach
                                    
                                
                                </select>
                                @error('currency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row content-justify-center">
                            <div class="col-4">

                            </div>
                            <div class="col-4 text-center">
                                <button id="logButton" type="submit" class="btn btn-outline-info registerButton">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>
                        <div class="row content-justify-center">
                            <div class="col-4">

                            </div>
                            <div class="col-4 text-center">

                                    <a href="{{ route('login') }}">I have account? Log in!</a>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkUsernameTaken(input){
        $.ajax({
            type: 'POST',
            url: '/checkUsernameTaken',
            data: {
                '_token' : '{{csrf_token()}}',
                'name': input
            },
            success: function(data) {
           
                if (data.status == "failed")
                {   
                    $('#responseText').removeClass('text-danger text-success')
                    $('#responseText').html('Username is taken');
                    $('#responseText').addClass('text-danger');
                    
                }
                else {
                    $('#responseText').removeClass('text-danger text-success')
                    $('#responseText').html("Username available");
                    $('#responseText').addClass('text-success');
                }
            }
        });
    }
</script>
@endsection
