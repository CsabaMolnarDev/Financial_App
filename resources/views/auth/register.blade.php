@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header text-info" id="RegFormTittle">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="fullname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Fullname') }}</label>
                                <div class="col-md-6 text-dark">
                                    <input id="fullname" type="text"
                                        class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                        value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
                                    @error('fullname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <div class="col-md-6">
                                    <input oninput="checkUsernameTaken(this.value);" id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    <div id="responseText"></div>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Phone (optional)') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="currency"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Currency') }}</label>
                                <div class="col-md-6">
                                    <select id="currency" class="form-control" type="text"
                                        @error('currency') is-invalid @enderror name="currency_id"
                                        value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}</option>
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
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input oninput="checkEmailTaken(this.value);" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    <div id="responseTextEmail"></div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <div class="text-primary" id="passwordStrength"></div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row content-justify-center">
                                <div class="col-4">
                                </div>
                                <div class="col-4 text-center">
                                    <button id="logButton" type="submit" class="btn btn-outline-warning registerButton">
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
        /* Bg image */
        document.body.style.backgroundImage = "url('../storage/pictures/register.jpg')";
        /* Check username */
        function checkUsernameTaken(input) {
            $.ajax({
                type: 'POST',
                url: '/checkUsernameTaken',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'username': input
                },
                success: function(data) {
                    if (data.status == "failed") {
                        $('#responseText').removeClass('text-danger text-success')
                        $('#responseText').html(data.message);
                        $('#responseText').addClass('text-danger');

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                    $('#responseText').html('An error occurred. Please try again later.').addClass(
                        'text-danger');
                }
            });
        }

        function checkEmailTaken(input) {
            $.ajax({
                type: 'POST',
                url: '/checkEmailTaken',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': input
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == "failed") {
                        $('#responseTextEmail').removeClass('text-danger text-success')
                        $('#responseTextEmail').html(data.message);
                        $('#responseTextEmail').addClass('text-danger');

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                    $('#responseText').html('An error occurred. Please try again later.').addClass(
                        'text-danger');
                }
            });
        }
        /* Passw  is strong enough or not */
        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;
            $.ajax({
                type: 'POST',
                url: '/calculate-entropy',
                data: {
                    password: password,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    var strength;
                    var colorClass;
                    switch (true) {
                        case (response.entropy <= 35):
                            strength = 'Weak';
                            colorClass = 'text-danger';
                            break;
                        case (response.entropy >= 36 && response.entropy <= 59):
                            strength = 'Moderate';
                            colorClass = 'text-warning';
                            break;
                        case (response.entropy >= 60 && response.entropy <= 119):
                            strength = 'Strong';
                            colorClass = 'text-primary';
                            break;
                        case (response.entropy >= 120):
                            strength = 'Very Strong';
                            colorClass = 'text-success';
                            break;
                        default:
                            strength = 'Something went wrong';
                            colorClass = 'text-dark';
                            break;
                    }
                    var passwordStrengthElement = document.getElementById('passwordStrength');
                    passwordStrengthElement.innerText = 'Password Strength: ' + strength;
                    passwordStrengthElement.className = colorClass;
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log("Error:", errorThrown);
                }
            });
        });
        /* Phone num input field masking  */
        const input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@21.1.1/build/js/utils.js",
        });
    </script>
@endsection
