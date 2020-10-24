<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div id="app">
        @if (!Request::is('login'))
            <nav class="navbar navbar-expand-lg navbar-dark bg-tecnol static-top">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('img/LOGO_PASSWORDS_FFFFFF.svg') }}" height="40px" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @else
                                <li class="nav-item active">
                                    <a class="nav-link" href="/passwords">Passwords</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      {{ Auth()->user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a href="/profile" class="dropdown-item">Mi perfil</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" id="logoutBtn" href="#" onclick="event.preventDefault();
                                      document.getElementById('logoutForm').submit();">Logout</a>
                                      <form action="{{ route('logout') }}" method="POST" id="logoutForm">@csrf</form>
                                    </div>
                                  </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>

        @if (!Request::is('login'))
            <footer class="page-footer font-small pt-4 fixed-bottom">
                <div class="footer-copyright text-center bg-tecnol py-3 text-white">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    TQ TECNOL S.A.U. &copy; 2020
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="mt-2 mb-0">Desarrollado por:</p>
                                    <img src="{{ asset('img/MY_LOGO.svg') }}" width="4%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        @endif

        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        
    </div>
</body>
</html>
