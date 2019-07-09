<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}" ></script>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   
                    TIENDA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/product') }}">PRODUCTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/customer') }}">CLIENTES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/sale') }}">VENTAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/informes') }}">INFORMES</a>
                        </li>
                           
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4"  id="app" >
            <div class="container">
                @yield('content')
            </div>
            <div class="text-center" style="color:black; padding-top:20px">
                    Desarrollado por Oscar Huertas - oshunu@gmail.com
            </div>
             @yield('scripts')
        </main>
       
    </div>
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
  
</body>
</html>