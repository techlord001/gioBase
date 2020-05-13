<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- SEO --}}
        <meta name="description" content="GioBase is the world first & only dedicated database to the musical genre of Vaporwave. GioBase is not only the Wiki of Vaporwave but a must for all Vaporwave record collectors and aficionados keeping digital notes of all Vaporwave records, artists & labels. As a guest you're free to peruse our pages. By signing up however, users can keep track of their personal collections better than before in a clean and concise way all at the touch of a button.">
        <meta name="keywords" content="giobase, vaporwave, database, collection, collector, music">
        <meta name="author" content="Black Frog Tech Ltd">

        <title>GioBase</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 20px;
            }

            .bottom {
                position: absolute;
                bottom: 20px;
            }
            
            .bottom > a {
                font-size: 0.9rem !important;
            }

            .content {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="background">
            <div class="foreground flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
    
                <div class="content">
                    <div class="font-logo">
                        GioBase
                    </div>
    
                    <p class="lead">The world's only dedicated Vaporwave database</p>
    
                    <div class="links">
                        <a href="/labels">Labels</a>
                        <a href="/artists">Artists</a>
                        <a href="/records">Records</a>
                        <a href="/genres">Genres</a>
                    </div>
                </div>

                <div class="links bottom w-75 row justify-content-around">
                    <a href="/privacy-policy" class="w-25 text-center">Privacy Policy</a>
                    {{-- <a href="/about/faq" class="w-25 text-center">FAQ</a> --}}
                    <a href="/terms-conditions" class="w-25 text-center">Terms and Conditions</a>
                </div>
            </div>
        </div>
    </body>
</html>
