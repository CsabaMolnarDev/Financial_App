<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- website icon --}}
    <link rel="icon" type="image/png" href="../storage/icons/appIcon.png" sizes="96x96">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Finances</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- Apexcharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    {{-- Csv export --}}
    <script src="{{ asset('js/json-to-csv-export.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Jquerry table --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    {{-- Phone mask using: https://intl-tel-input.com --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@21.1.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@21.1.1/build/js/intlTelInput.min.js"></script>
</head>

<body
    style="
background-size: cover;
background-repeat: no-repeat;
background-attachment: fixed;
background-position: center;
background-image: url('../storage/pictures/home.jpg');

">
    <div id="app">
        {{-- Navnar --}}
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                {{-- Home img/button --}}
                <a class="navbar-brand text-light"
                    href="
                    @guest
{{ url('/') }}
                    @else
                        {{ url('/home') }} @endguest
                        ">
                    <img id="homeIcon" src="../storage/icons/homeIcon3.png" alt="">
                </a>
                {{-- Side menu  --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end bg-dark text-info" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="../storage/icons/appIcon.png"
                                alt="">Finances</h5>

                        <button type="button" class="btn text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close">X</button>
                    </div>
                    {{-- Log in / Register and Log out --}}
                    <div class="offcanvas-body bg-dark text-info">
                        <ul class="navbar-nav">
                            @guest
                                @if (Route::has('login'))
                                    <button id="menuBtn" class="btn btn-outline-success" type="submit"
                                        onclick="window.location=' {{ url('/login') }} '">{{ __('Login') }}</button>
                                @endif
                                @if (Route::has('register'))
                                    <button id="menuBtn" class="btn btn-outline-warning" type="submit"
                                        onclick="window.location=' {{ url('/register') }} '">
                                        {{ __('Register') }}</button>
                                @endif
                            @else
                                <button id="menuBtn" class="btn btn-outline-warning" type="submit"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <button id="menuBtn" class="btn btn-outline-success" type="submit"
                                    onclick="window.location=' {{ url('/income') }} '">Incomes</button>
                                <button id="menuBtn" class="btn btn-outline-danger" type="submit"
                                    onclick="window.location=' {{ url('/spending') }} '">Spendings</button>
                                <button id="menuBtn" class="btn btn-outline-primary" type="submit"
                                    onclick="window.location=' {{ url('/settings') }} '">Settings</button>
                                {{-- Under construction --}}
                                <button id="menuBtn" class="btn btn-outline-success" type="submit"
                                    onclick="window.location=' {{ url('/download') }} '">Download</button>
                                <button id="menuBtn" class="btn btn-outline-info" type="submit"
                                    onclick="window.location=' {{ url('/documentation') }} '">Documentation</button>
                            @endguest
                            <button class="btn btn-outline-info" type="submit"
                                onclick="window.location=' {{ url('/about_us') }} '">About us</button>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4"id="content" style="margin-top: 7vh">
            @yield('content')
            @yield('footer')
        </main>
    </div>
</body>

</html>
