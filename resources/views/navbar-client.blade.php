<div id="app">
    <!-- Barra superior -->
    <nav
        class="navbar bg-gray-800 text-white flex items-center justify-between px-6 py-4 fixed top-0 left-0 w-full z-50">
        <div class="flex items-center space-x-4">
            <button id="menu-toggle" class="focus:outline-none">
                <span class="icon">
                    <i class="mdi mdi-menu text-white text-2xl"></i>
                </span>
            </button>
            <img src="{{ asset('img/cesrh.jpeg') }}" alt="Logo CESRH" class="h-12 rounded-lg">
        </div>

        <!-- Settings Dropdown con Alpine.js -->
        <div class="relative" x-data="{ open: false }">
            <!-- Botón de usuario -->
            <button @click="open = !open"
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                @else
                    <span class="inline-flex rounded-md">
                        <span
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            {{ Auth::user()->name }}
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </span>
                @endif
            </button>

            <!-- Contenido del Dropdown -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 shadow-lg rounded-md">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Administrar Cuenta') }}
                </div>
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    {{ __('Perfil') }}
                </a>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <a href="{{ route('api-tokens.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        {{ __('API Tokens') }}
                    </a>
                @endif
                <div class="border-t border-gray-200"></div>
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                        {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Barra lateral -->
    <aside id="sidebar" class="bg-gray-800 text-white w-64 h-full fixed top-0 left-0 z-40 overflow-auto">
        <div class="p-4 text-lg font-bold border-b border-gray-600">
            A
        </div>
        <div class="p-4 text-lg font-bold border-b border-gray-600">
            Recursos Humanos
        </div>
        <nav class="mt-4">
            <ul class="space-y-2">
                <!--  -->
                @can('Mostrar Rol')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="12.25"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z" />
                            </svg>
                            <span class="flex-1">Roles</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarrol') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Roles
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agregarrol') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Agregar Rol
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan



                <!--  -->
                @can('Mostrar Usuario')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="17.5"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l362.8 0c-5.4-9.4-8.6-20.3-8.6-32l0-128c0-2.1 .1-4.2 .3-6.3c-31-26-71-41.7-114.6-41.7l-91.4 0zM528 240c17.7 0 32 14.3 32 32l0 48-64 0 0-48c0-17.7 14.3-32 32-32zm-80 32l0 48c-17.7 0-32 14.3-32 32l0 128c0 17.7 14.3 32 32 32l160 0c17.7 0 32-14.3 32-32l0-128c0-17.7-14.3-32-32-32l0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80z" />
                            </svg>
                            <span class="flex-1">Usuarios</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostraruser') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Gestionar Usuarios
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <!-- Registros Patronales -->
                <li class="opcion-con-desplegable">
                    <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                        <i class="fas fa-file-alt mr-2"></i>
                        <span class="flex-1">Registros Patronales</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <ul class="desplegable ml-8 hidden">
                        <li>
                            <a href="{{ route('mostrarregpatronal') }}"
                                class="p-2 hover:bg-gray-700 flex items-center">
                                <i class="mr-2 text-xs"></i> Mostrar
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('agregarregpatronal') }}"
                                class="p-2 hover:bg-gray-700 flex items-center">
                                <i class="mr-2 text-xs"></i> Mostrar
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Empresas -->
                @can('Mostrar Empresas')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <i class="fas fa-building mr-2"></i>
                            <span class="flex-1">Empresas</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarempresas') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Empresas
                                </a>
                            </li>

                            @can('Agregar Empresa')
                                <li>
                                    <a href="{{ route('agregarempresa') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Empresa
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Sucursales -->
                @can('Mostrar Sucursales')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="17.5"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M36.8 192l566.3 0c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0L121.7 0c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224l0 160 0 80c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-80 0-160-64 0 0 160-192 0 0-160-64 0zm448 0l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32l0-256-64 0z" />
                            </svg><!-- Icono de casita -->
                            <span class="flex-1">Sucursales</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarsucursal') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Sucursales
                                </a>
                            </li>
                            @can('Agregar Sucursal')
                                <li>
                                    <a href="{{ route('agregarsucursal') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Sucursales
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan

                <!-- Departamentos -->
                @can('Mostrar Departamentos')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="15.75"
                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                            </svg> <!-- Icono -->
                            <span class="flex-1">Departamentos</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrardepa') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Departamentos
                                </a>
                            </li>

                            @can('Agregar Departamento')
                                <li>
                                    <a href="{{ route('agregardepa') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Departamento
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                <!-- Puestos -->
                @can('Mostrar Puestos')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="14"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                            </svg>
                            <span class="flex-1">Puestos</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarpuesto') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Puestos
                                </a>
                            </li>

                            @can('Agregar Puesto')
                                <li>
                                    <a href="{{ route('agregarpuesto') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Puesto
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Incidencias -->
                @can('Mostrar Incapacidad')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="15.75"
                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 47-92.8 37.1c-21.3 8.5-35.2 29.1-35.2 52c0 56.6 18.9 148 94.2 208.3c-9 4.8-19.3 7.6-30.2 7.6L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zm39.1 97.7c5.7-2.3 12.1-2.3 17.8 0l120 48C570 277.4 576 286.2 576 296c0 63.3-25.9 168.8-134.8 214.2c-5.9 2.5-12.6 2.5-18.5 0C313.9 464.8 288 359.3 288 296c0-9.8 6-18.6 15.1-22.3l120-48zM527.4 312L432 273.8l0 187.8c68.2-33 91.5-99 95.4-149.7z" />
                            </svg>
                            <span class="flex-1">Incapacidades</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarincapacidad') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Incapacidades
                                </a>
                            </li>

                            @can('Aceptar Incapacidad')
                                <li>
                                    <a href="{{ route('aceptarincapacidad') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Aprobar Solicitudes
                                    </a>
                                </li>
                            @endcan

                            @can('Agregar Incapacidad')
                                <li>
                                    <a href="{{ route('agregarincapacidad') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Solicitar Incapacidad
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Incidencias -->
                @can('Mostrar Incidencias')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="14"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                            </svg>
                            <span class="flex-1">Incidencias</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            @can('Agregar Incidencia')
                                <li>
                                    <a href="{{ route('mostrarincidencia') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Mostrar Incidencias
                                    </a>
                                </li>
                            @endcan

                            @can('Agregar Incidencia')
                                <li>
                                    <a href="{{ route('agregarincidencia') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Incidencia
                                    </a>
                                </li>
                            @endcan

                            @can('Ver Incidencias')
                                <li>
                                    <a href="{{ route('verincidencia') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Mis Incidencias
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Retardos -->
                @can('Mostrar Retardos')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="14"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                            </svg>
                            <span class="flex-1">Retardos</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            @can('Agregar Retardo')
                                <li>
                                    <a href="{{ route('mostrarretardo') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Mostrar Retardos
                                    </a>
                                </li>
                            @endcan

                            @can('Agregar Retardo')
                                <li>
                                    <a href="{{ route('agregarretardo') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Retardo
                                    </a>
                                </li>
                            @endcan

                            @can('Ver Retardos')
                                <li>
                                    <a href="{{ route('verretardo') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Mis Retardos
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Bajas -->
                @can('Mostrar Baja')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="17.5"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                            </svg>
                            <span class="flex-1">Bajas</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarbaja') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Bajas
                                </a>
                            </li>

                            @can('Agregar Baja')
                                <li>
                                    <a href="{{ route('agregarbaja') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Baja
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Cambio salario class="mr-2" -->
                @can('Mostrar Cambio Salario')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="8.75"
                                viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M160 0c17.7 0 32 14.3 32 32l0 35.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11l0 33.4c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-34.9c-.4-.1-.9-.1-1.3-.2l-.2 0s0 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7s0 0 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11L128 32c0-17.7 14.3-32 32-32z" />
                            </svg>
                            <span class="flex-1">Cambios de Salario</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarcambiosal') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Cambios de Salario
                                </a>
                            </li>

                            @can('Agregar Cambio Salario')
                                <li>
                                    <a href="{{ route('agregarcambiosal') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Cambio de Salario
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('Ver Cumpleaños')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="12.25"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M86.4 5.5L61.8 47.6C58 54.1 56 61.6 56 69.2L56 72c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L105.6 5.5C103.6 2.1 100 0 96 0s-7.6 2.1-9.6 5.5zm128 0L189.8 47.6c-3.8 6.5-5.8 14-5.8 21.6l0 2.8c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L233.6 5.5C231.6 2.1 228 0 224 0s-7.6 2.1-9.6 5.5zM317.8 47.6c-3.8 6.5-5.8 14-5.8 21.6l0 2.8c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L361.6 5.5C359.6 2.1 356 0 352 0s-7.6 2.1-9.6 5.5L317.8 47.6zM128 176c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48c-35.3 0-64 28.7-64 64l0 71c8.3 5.2 18.1 9 28.8 9c13.5 0 27.2-6.1 38.4-13.4c5.4-3.5 9.9-7.1 13-9.7c1.5-1.3 2.7-2.4 3.5-3.1c.4-.4 .7-.6 .8-.8l.1-.1s0 0 0 0s0 0 0 0s0 0 0 0s0 0 0 0c3.1-3.2 7.4-4.9 11.9-4.8s8.6 2.1 11.6 5.4c0 0 0 0 0 0s0 0 0 0l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c3-3.5 7.4-5.4 12-5.4s9 2 12 5.4l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c2.9-3.4 7.1-5.3 11.6-5.4s8.7 1.6 11.9 4.8c0 0 0 0 0 0s0 0 0 0s0 0 0 0l.1 .1c.2 .2 .4 .4 .8 .8c.8 .7 1.9 1.8 3.5 3.1c3.1 2.6 7.5 6.2 13 9.7c11.2 7.3 24.9 13.4 38.4 13.4c10.7 0 20.5-3.9 28.8-9l0-71c0-35.3-28.7-64-64-64l0-48c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48-64 0 0-48c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48-64 0 0-48zM448 394.6c-8.5 3.3-18.2 5.4-28.8 5.4c-22.5 0-42.4-9.9-55.8-18.6c-4.1-2.7-7.8-5.4-10.9-7.8c-2.8 2.4-6.1 5-9.8 7.5C329.8 390 310.6 400 288 400s-41.8-10-54.6-18.9c-3.5-2.4-6.7-4.9-9.4-7.2c-2.7 2.3-5.9 4.7-9.4 7.2C201.8 390 182.6 400 160 400s-41.8-10-54.6-18.9c-3.7-2.6-7-5.2-9.8-7.5c-3.1 2.4-6.8 5.1-10.9 7.8C71.2 390.1 51.3 400 28.8 400c-10.6 0-20.3-2.2-28.8-5.4L0 480c0 17.7 14.3 32 32 32l384 0c17.7 0 32-14.3 32-32l0-85.4z" />
                            </svg>
                            <span class="flex-1">Cumpleaños</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('vercumple') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Ver Cumpleaños
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <!-- Trabajadores -->
                @can('Mostrar Trabajadores')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="17.5"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 0a128 128 0 1 1 0 256A128 128 0 1 1 224 0zM178.3 304l91.4 0c11.8 0 23.4 1.2 34.5 3.3c-2.1 18.5 7.4 35.6 21.8 44.8c-16.6 10.6-26.7 31.6-20 53.3c4 12.9 9.4 25.5 16.4 37.6s15.2 23.1 24.4 33c15.7 16.9 39.6 18.4 57.2 8.7l0 .9c0 9.2 2.7 18.5 7.9 26.3L29.7 512C13.3 512 0 498.7 0 482.3C0 383.8 79.8 304 178.3 304zM436 218.2c0-7 4.5-13.3 11.3-14.8c10.5-2.4 21.5-3.7 32.7-3.7s22.2 1.3 32.7 3.7c6.8 1.5 11.3 7.8 11.3 14.8l0 30.6c7.9 3.4 15.4 7.7 22.3 12.8l24.9-14.3c6.1-3.5 13.7-2.7 18.5 2.4c7.6 8.1 14.3 17.2 20.1 27.2s10.3 20.4 13.5 31c2.1 6.7-1.1 13.7-7.2 17.2l-25 14.4c.4 4 .7 8.1 .7 12.3s-.2 8.2-.7 12.3l25 14.4c6.1 3.5 9.2 10.5 7.2 17.2c-3.3 10.6-7.8 21-13.5 31s-12.5 19.1-20.1 27.2c-4.8 5.1-12.5 5.9-18.5 2.4l-24.9-14.3c-6.9 5.1-14.3 9.4-22.3 12.8l0 30.6c0 7-4.5 13.3-11.3 14.8c-10.5 2.4-21.5 3.7-32.7 3.7s-22.2-1.3-32.7-3.7c-6.8-1.5-11.3-7.8-11.3-14.8l0-30.5c-8-3.4-15.6-7.7-22.5-12.9l-24.7 14.3c-6.1 3.5-13.7 2.7-18.5-2.4c-7.6-8.1-14.3-17.2-20.1-27.2s-10.3-20.4-13.5-31c-2.1-6.7 1.1-13.7 7.2-17.2l24.8-14.3c-.4-4.1-.7-8.2-.7-12.4s.2-8.3 .7-12.4L343.8 325c-6.1-3.5-9.2-10.5-7.2-17.2c3.3-10.6 7.7-21 13.5-31s12.5-19.1 20.1-27.2c4.8-5.1 12.4-5.9 18.5-2.4l24.8 14.3c6.9-5.1 14.5-9.4 22.5-12.9l0-30.5zm92.1 133.5a48.1 48.1 0 1 0 -96.1 0 48.1 48.1 0 1 0 96.1 0z" />
                            </svg>
                            <span class="flex-1">Trabajadores</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrartrabajador') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Trabajadores
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mostrarcardtrabajador') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Cards Trabajadores
                                </a>
                            </li>

                            @can('Agregar Trabajador')
                                <li>
                                    <a href="{{ route('agregartrabajador') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Trabajador
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan


                <!-- instructores -->
                @can('Mostrar Instructores')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="12.25"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z" />
                            </svg>
                            <span class="flex-1">Instructores</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarinstructor') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Instructores
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mostrarcardinstructor') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Cards Instructores
                                </a>
                            </li>

                            @can('Agregar Instructor')
                                <li>
                                    <a href="{{ route('agregarinstructor') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Instructor
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                <!-- becarios -->
                @can('Mostrar Becarios')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="17.5"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                            </svg> <span class="flex-1">Becarios</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarbecario') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Becarios
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mostrarcardbecario') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Cards Becarios
                                </a>
                            </li>

                            @can('Agregar Becario')
                                <li>
                                    <a href="{{ route('agregarbecario') }}" class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Becario
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                <!-- Practicante -->
                @can('Mostrar Practicantes')
                    <li class="opcion-con-desplegable">
                        <div class="flex items-center justify-between px-2 py-2 hover:bg-gray-700 cursor-pointer">
                            <!-- Icono -->
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="14" width="12.25"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z" />
                            </svg>
                            <span class="flex-1">Practicantes</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="desplegable ml-8 hidden">
                            <li>
                                <a href="{{ route('mostrarpracticante') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Mostrar Practicantes
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mostrarcardpracticante') }}"
                                    class="p-2 hover:bg-gray-700 flex items-center">
                                    <i class="mr-2 text-xs"></i> Cards Practicantes
                                </a>
                            </li>

                            @can('Agregar Practicante')
                                <li>
                                    <a href="{{ route('agregarpracticante') }}"
                                        class="p-2 hover:bg-gray-700 flex items-center">
                                        <i class="mr-2 text-xs"></i> Agregar Practicante
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan



            </ul>
        </nav>
    </aside>
</div>

<!-- Scripts -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        const opcionesConDesplegable = document.querySelectorAll('.opcion-con-desplegable');
        opcionesConDesplegable.forEach(opcion => {
            opcion.addEventListener('click', () => {
                const desplegable = opcion.querySelector('.desplegable');
                desplegable.classList.toggle('hidden');
            });
        });
    });
</script>

<!-- FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
