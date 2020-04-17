<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GioBase') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="background">
        <div id="app" class="foreground d-flex flex-column flex-nowrap align-content-between justify-content-between">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm gbNav">
                <div class="container-fluid">
                    <a class="navbar-brand font-logo font-logo-nav" href="{{ url('/') }}">
                        {{ config('app.name', 'GioBase') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse font-nav" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a href="/labels" class="nav-link">Labels</a></li>
                            <li class="nav-item"><a href="/artists" class="nav-link">Artists</a></li>
                            <li class="nav-item"><a href="/records" class="nav-link">Records</a></li>
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right font-nav" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/home">Home</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
    
            <main class="py-4">
                @yield('content')
            </main>

            <footer class="navbar flex-column navbar-expand-md navbar-light gbNav text-center justify-content-center font-nav">
                <p class="p-1 m-0">All Rights Reserved</p>
                <p class="p-1 m-0">Site Designed and Developed by <a href="https://blackfrog.tech" target="_blank" rel="noopener noreferrer" class="text-decoration-none"><img src="{{ asset('images/bfLogo.svg') }}" alt="Black Frog Tech Logo" width="25px" height="25px"><span class="px-1 text-dark text-uppercase">Black Frog</span></a></p>
            </footer>
        </div>
    </div>
</body>
</html>
