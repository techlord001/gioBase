<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <meta name="description" content="GioBase is the world first & only dedicated database to the musical genre of Vaporwave. GioBase is not only the Wiki of Vaporwave but a must for all Vaporwave record collectors and aficionados keeping digital notes of all Vaporwave records, artists & labels. As a guest you're free to peruse our pages. By signing up however, users can keep track of their personal collections better than before in a clean and concise way all at the touch of a button.">
    <meta name="keywords" content="giobase, vaporwave, database, collection, collector, music, future funk, mallsoft">
    <meta name="author" content="Black Frog Tech Ltd">

    <title>{{ config('app.name', 'GioBase') . $titleExt }}</title>

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
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse</a>
                                <div class="dropdown-menu gbNav font-nav">
                                    <a href="/labels" class="dropdown-item">Labels</a>
                                    <a href="/artists" class="dropdown-item">Artists</a>
                                    <a href="/records" class="dropdown-item">Records</a>
                                    <a href="/genres" class="dropdown-item">Genres</a>
                                    @auth
                                        <a href="/collectors" class="dropdown-item">Collectors</a>
                                        @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Master'))
                                            <div class="dropdown-divider"></div>
                                            <a href="/colours" class="dropdown-item">Colours</a>
                                            <a href="/formats" class="dropdown-item">Formats</a>
                                        @endif                                      
                                    @endauth
                                </div>
                            </li>
                        </ul>

                        @auth
                            @if (auth()->user()->hasRole('Contributor') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Master'))
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</a>
                                        <div class="dropdown-menu gbNav font-nav">
                                            <a href="/labels/create" class="dropdown-item">Label</a>
                                            <a href="/artists/create" class="dropdown-item">Artist</a>
                                            <a href="/records/create" class="dropdown-item">Record</a>
                                            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Master'))
                                                <div class="dropdown-divider"></div>
                                                <a href="/genres/create" class="dropdown-item">Genre</a>
                                                <a href="/colours/create" class="dropdown-item">Colour</a>
                                                <a href="/formats/create" class="dropdown-item">Format</a>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>                                
                            @endif
                        @endauth
    
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
                                        @if (Auth::user()->image)
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="" class="img-thumbnail rounded avatar-thumbnail">
                                        @endif
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right font-nav gbNav" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/home/profile">Profile</a>
                                        <a class="dropdown-item" href="/home/collection">Collection</a>
                                        <a class="dropdown-item" href="/home/wishlist">Wishlist</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

            <footer class="navbar flex-row navbar-expand-md navbar-light gbNav text-center justify-content-between font-nav footer">
                <div class="d-flex flex-column text-left justify-content-center align-content-center footer">
                    <p class="p-1 m-0"><a href="/privacy-policy" class="text-decoration-none">Privacy Policy</a></p>
                    <p class="p-1 m-0"><a href="/terms-conditions" class="text-decoration-none">Terms and Conditions</a></p>
                </div>
                <div class="d-flex flex-column text-right footer">
                    <p class="p-1 m-0">All Rights Reserved</p>
                    <p class="p-1 m-0">Site Designed and Developed by <a href="https://blackfrog.tech" target="_blank" rel="noopener noreferrer" class="text-decoration-none"><img src="{{ asset('images/bfLogo.png') }}" alt="Black Frog Tech Logo" width="25px" height="25px"><span class="px-1 text-secondary text-uppercase">Black Frog</span></a></p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
