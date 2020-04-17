<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                top: 18px;
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
