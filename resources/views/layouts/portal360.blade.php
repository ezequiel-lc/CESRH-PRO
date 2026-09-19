<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Portal 360 - Encuesta') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,700&display=swap" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <!-- Select2 CSS (ya lo tienes correcto) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-blue-50">
    <!-- Incluye el componente Livewire para el menú lateral -->
    @livewire('portal360.navigation-menu')

    <!-- Incluye la barra de navegación superior (si es necesario) -->
    @include('navigation-menudev')
    <!-- Mueve la searchbar arriba del main -->
    @include('searchbar')

    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 transition-all main">
        <!-- Content -->
        <div class="pt-5">
            <main class="">
                {{ $slot }}
            </main>
        </div>
    </main>


    @livewireScripts
    <!-- jQuery (requerido por Toastr y Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery (requerido por Toastr y Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Script para manejar notificaciones -->
    <script>
        $(document).ready(function() {
            // Configuración de Toastr
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-right",
                "closeButton": true,
                "timeOut": 4000, // Duración de la notificación
            };
        });

        // Escuchar eventos de Livewire para mostrar notificaciones
        window.addEventListener('toastr-success', event => {
            toastr.success(event.detail.message);
        });

        window.addEventListener('toastr-error', event => {
            toastr.error(event.detail.message);
        });

        window.addEventListener('toastr-warning', event => {
            toastr.warning(event.detail.message);
        });
    </script>

    <script>
        $(document).ready(function() {
            // Configuración de Toastr
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-right",
                "closeButton": true,
                "timeOut": 4000,
            };

            // Inicialización de Select2
            $('.select2').select2({
                placeholder: "Selecciona una opción",
                allowClear: true
            });
        });
    </script>

    @yield('content')
    @stack('scripts') <!-- Aquí se incluirán los scripts push -->
</body>

</html>