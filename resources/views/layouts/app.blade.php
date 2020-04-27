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
    <link href="{{ asset('css/themify/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ $body ?? '' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light {{ $random_gradient_class }} py-0">
            <div class="container">
                <ul class="nav">
                    @foreach($modules as $mod)
                        <li class="nav-item">
                            <a style="border-radius: 0" class="btn btn-outline-primary border-0 btn-sm px-3 text-white text-uppercase font-weight-bold @if($mod->id === $module->id) active @endif" href="{{route('module.show', [$mod])}}">
                                {{ $mod->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <nav class="navbar main navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <div class="row flex-nowrap justify-content-between" style="width: 100%">
                    <ul class="nav col-auto flex-grow-1">
                        <li class="col-auto nav-item">
                            <a class="navbar-brand text-secondary" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </li>
                        <li class="nav-item col-auto">
                            <a class="nav-link font-weight-bold" href="{{ url('/module') }}">
                                Central de dúvidas
                            </a>
                        </li>
                        <li class="nav-item col-auto">
                            <a class="nav-link" href="{{ url('/') }}">
                                Artigos
                            </a>
                        </li>
                        <li class="px-3 nav-item col-auto flex-grow-1">
                            <form action="/search" class="position-relative">
                                <i class="ti-search position-absolute p-2 m-1"></i>
                                <input name="q" class="form-control" style="padding-left: 2.5em" placeholder="Buscar por..." style="width: 90%"/>
                            </form>
                        </li>
                    </ul>

                    <div class="col-auto">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Entrar
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right bg-secondary text-white" style="width: 300px">
                                                <form class="px-4 pt-3" action="{{route('login')}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleDropdownFormEmail1">Email</label>
                                                        <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleDropdownFormPassword1">Senha</label>
                                                        <input name="password" type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Digita sua senha...">
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="remember" type="checkbox" class="form-check-input" id="dropdownCheck">
                                                        <label class="form-check-label" for="dropdownCheck">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    <p class="text-right">
                                                        <a class="btn-link float-left mt-3" href="#">Esqueceu sua senha?</a>
                                                        <button type="submit" class="btn btn-primary">Entrar</button>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link text-secondary" href="{{route('profile')}}" role="button">
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                            <img class="avatar header" src="{{ auth()->user()->avatar_url }}" />
                                        </a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="{{ !empty($banner) ? 'pb-4' : 'py-4' }}">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
