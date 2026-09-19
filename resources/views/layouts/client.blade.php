<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Contenido principal */
        .content {
            margin-left: 250px; /* Espacio igual al ancho de la barra lateral */
            margin-top: 100px; /* Espacio bajo la barra superior */
            padding: 20px;
            flex: 1; /* Se expande automáticamente para ocupar el espacio restante */
            overflow-x: auto;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <!-- Enlace a estilos específicos  -->
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">

    @livewireStyles
    @yield('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <div class="class">
        @include('navbar-client')
    </div>

    <!-- Contenido principal -->
    <div class="content">
        {{$slot}}
    </div>

    
    
    <!-- Footer -->
    {{-- @include('layouts.footer.footer-client') --}}

    <!-- Scripts -->
    @yield('js')
    @livewireScripts
    <script src="{{ asset('js/client.js') }}"></script>
</body>
</html>
