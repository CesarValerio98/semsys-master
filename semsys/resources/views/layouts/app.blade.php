<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest


                        @else
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios</a>
                            <div class="dropdown-menu">
                                <a href="{{ url('/root/user/all') }}" class="dropdown-item">Usuarios</a>
                                <a href="{{ url('/root/rol/all') }}" class="dropdown-item">Roles</a>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Univesidades</a>
                            <div class="dropdown-menu">
                                <a href="{{ url('/root/university/all') }}" class="dropdown-item">Universidades</a>
                                <a href="{{ url('/root/university/services') }}" class="dropdown-item">Servicios</a>
                                <a href="{{ url('/root/university/modalities') }}" class="dropdown-item">Modalidad</a>
                                <a href="{{ url('/root/university/systems') }}" class="dropdown-item">Sistema</a>
                                <a href="{{ url('/root/university/programs') }}" class="dropdown-item">Programas</a>
                                <a href="{{ url('/root/university/projects') }}" class="dropdown-item">Proyectos</a>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estudiantes</a>
                            <div class="dropdown-menu">
                                <a href="{{ url('/root/university/students') }}" class="dropdown-item">Estudiantes</a>
                            </div>
                        </div>
                        
                        @endguest
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

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/3.3.11/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    @yield('js')
</body>
</html>
