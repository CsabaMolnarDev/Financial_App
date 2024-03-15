@extends('layouts.app')

@section('content')
<img id="regFormPicture" src="../storage/pictures/login.jpg" alt="background" title="background">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light">
                <div class="card-header bg-dark text-info" id="RegFormTittle">{{ __('Login') }}</div>
                <div class="card-body bg-dark">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="row content-justify-center">
                                <div class="col-4">
                                </div>
                                <div class="col-3 text-center logbtn">
                                    <button type="submit" class="btn btn-outline-success">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                </div>
                            </div>
                            <div class="row content-justify-center">
                                <div class="col-4">
                                </div>
                                <div class="col-4 text-center">
                                    <a href="{{ route('register') }}">Register now!</a>
                                    @if (Route::has('password.request'))
                                   <a class="btn btn-link" href="{{ route('password.request') }}">Forgot password?</a>
                                   @endif
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
@endsection
