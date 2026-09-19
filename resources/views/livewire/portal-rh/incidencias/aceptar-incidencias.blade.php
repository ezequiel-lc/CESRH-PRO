<div>
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Revisar Solicitudes</h1>
                </div>
            </div>

            <div class="relative mb-4">
                <div class="flex items-center justify-between">
                    <!-- Alert (solo se muestra si hay mensaje en sesión) -->
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" x-show="show"
                            class="ml-4 bg-green-500 text-white shadow-lg rounded-lg p-4 flex items-center space-x-3
                                    transition-transform transform hover:scale-105 z-50"
                            style="min-width: 300px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416l400 0c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4l0-25.4c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112l0 25.4c0 47.9 13.9 94.6 39.7 134.6L72.3 368C98.1 328 112 281.3 112 233.4l0-25.4c0-61.9 50.1-112 112-112zm64 352l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                            </svg>
                            <div class="flex-1">
                                <p class="font-bold">
                                    {{ session('message') }}
                                </p>
                                <!-- Mensaje extra, opcional -->
                                @if (session('message') == 'Incidencia enviada para aprobación.')
                                    <p class="text-sm">La solicitud se ha enviado y está pendiente de revisión.</p>
                                @elseif(session('message') == 'Incidencia aprobada y registrada.')
                                    <p class="text-sm">La incidencia se aprobó y se agrego al historial.</p>
                                @elseif(session('message') == 'Incidencia rechazada.')
                                    <p class="text-sm">La incidencia fue rechazada y agregada al historial.</p>
                                @endif
                            </div>
                            <button @click="show = false" class="text-white hover:text-gray-300 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0
                                             011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414
                                             1.414L10 11.414l-4.293 4.293a1 1 0
                                             01-1.414-1.414L8.586 10 4.293 5.707a1
                                             1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
                @foreach ($incidencias_pendientes as $incidencia)
                <div class="w-full mx-auto bg-white shadow-xl rounded-lg text-gray-900 p-4">
                    <div class="rounded-t-lg h-32 overflow-hidden">
                        <img class="object-cover object-top w-full" 
                            src="{{ asset('img/cesrh.jpeg') }}"
                            alt="Background">
                    </div>
            
                    <div class="text-center mt-2">
                        <h2><strong>Usuario:</strong>
                            {{ $incidencia->users->first() ? $incidencia->users->first()->name : 'Sin asignar' }}
                        </h2>
                        <p><strong>Tipo de incidencia:</strong> {{ $incidencia->tipo_incidencia }}</p>
                        <p><strong>Fecha inicio:</strong> {{ $incidencia->fecha_inicio }}</p>
                        <p><strong>Fecha final:</strong> {{ $incidencia->fecha_final }}</p>
                    </div>
            
                    <div class="flex gap-4 mt-4">
                        <button wire:click="aprobar({{ $incidencia->id }})"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Aprobar
                        </button>

                        <button wire:click="rechazar({{ $incidencia->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Rechazar
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
