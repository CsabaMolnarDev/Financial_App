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
</head>

<body>
    <div id="app">
        {{-- Navnar --}}
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                {{-- Home img/button --}}
                <a class="navbar-brand text-light" href="
                    @guest
                        {{ url('/') }}
                    @else
                        {{ url('/home') }}
                    @endguest
                        ">
                    <img id="homeIcon" src="../storage/icons/homeIcon3.png" alt="">
                </a>
                {{-- Side menu  --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-dark text-info" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img  src="../storage/icons/appIcon.png" alt="">Finances</h5>

                        <button type="button" class="btn text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close">X</button>
                    </div>
                    {{-- Log in / Register and Log out --}}
                    <div class="offcanvas-body bg-dark text-info">
                        <ul class="navbar-nav">
                            @guest
                            @if (Route::has('login'))
                                <button id="menuBtn" class="btn btn-outline-info" type="submit" onclick="window.location=' {{ url("/login") }} '">{{ __('Login') }}</button>
                            @endif
                            @if (Route::has('register'))
                                <button id="menuBtn" class="btn btn-outline-info" type="submit" onclick="window.location=' {{ url("/register") }} '"> {{ __('Register') }}</button>
                            @endif
                        @else
                         <button id="menuBtn" class="btn btn-outline-info" type="submit" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}</button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    {{-- <button class="btn btn-outline-info" type="submit" onclick="window.location=' {{ url("/about_us") }} '"">Finances</button> --}}
                                    {{-- both income and spending maybe? here we could edit our incomes --}}
                                    <button id="menuBtn" class="btn btn-outline-info" type="submit" onclick="window.location=' {{ url("/income") }} '"">Incomes</button>
                                    <button id="menuBtn" class="btn btn-outline-info" type="submit" onclick="window.location=' {{ url("/spending") }} '"">Spendings</button>
                        @endguest
                        <button class="btn btn-outline-info" type="submit" onclick="window.location=' {{ url("/about_us") }} '"">About us</button>
                        {{-- Make about us page and controler and route --}}
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4"id="content">
            @yield('content')
            @yield('footer')
        </main>
    </div>
</body>
</html>
