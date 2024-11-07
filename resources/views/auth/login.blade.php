@extends('layouts.app')
@section('content')
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <div class="" id="RegFormTittle">{{ __('Login') }}</div>
                    <div class="">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="">
                                <label for="email"
                                    class="">{{ __('Email Address') }}</label>
                                <div class="">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <label for="password"
                                    class="">{{ __('Password') }}</label>
                                <div class="">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                </div>
                                <div class="logbtn">
                                    <button type="submit" class="">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="">
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                </div>
                                <div class="">
                                    <a class="btn-link" href="{{ route('register') }}">Register now!</a>
                                    @if (Route::has('password.request'))
                                        <a class="btn-link" href="{{ route('password.request') }}">Forgot password?</a>
                                    @endif
                                    <a class="btn-link" href="{{ route('restoreAccountIndex') }}">Restore deactivated
                                        account!</a>
                                </div>
                                <div class="">
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
