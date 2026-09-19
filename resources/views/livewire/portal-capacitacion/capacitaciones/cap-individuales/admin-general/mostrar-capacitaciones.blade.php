<div class="max-w-4xl px-10 my-6 py-8 bg-white rounded-lg shadow-md mx-auto relative">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 text-center w-full">
            📚
            <span class="bg-gradient-to-r from-blue-500 to-blue-400 text-transparent bg-clip-text">
                Capacitaciones Individuales
            </span>
            <span class="block text-sm text-gray-500 mt-2 uppercase tracking-widest">
                Mejora tus habilidades con cada curso
            </span>
        </h1>
        <a href="{{route('vermasUsuarios', Crypt::encrypt($userSeleccionado))}}"
            class="absolute top-4 right-4 text-gray-700 hover:text-blue-500 focus:text-blue-500 
            p-6 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110 z-50">
            <i class="fas fa-sign-out-alt text-3xl"></i>
    </a>
    </div>

        <!-- Tabs para seleccionar capacitaciones individuales o grupales -->
    @php
    $rutaActual = request()->route()->getName();
    @endphp

    <div class="flex space-x-4 border-b border-gray-300 mb-6">
        <a href="{{ route('verCapacitacionesInd', Crypt::encrypt($userSeleccionado)) }}"
            class="px-6 py-3 border-b-2 transition-all duration-300 
        {{ $rutaActual === 'verCapacitacionesInd' ? 'border-blue-500 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-500' }}">
            📌 Individuales
        </a>

        <a href="{{ route('verCapacitacionesGruGeneral', Crypt::encrypt($userSeleccionado)) }}"
            class="px-6 py-3 border-b-2 transition-all duration-300 
        {{ $rutaActual === 'verCapacitacionesGruGeneral' ? 'border-blue-500 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-500' }}">
            👥 Grupales
        </a>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-0">
            <select wire:model="selectedYear"
                class="px-5 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="">Seleccionar año</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

            <button wire:click="exportarTodasCapacitaciones" wire:loading.attr="disabled"
                wire:target="exportarTodasCapacitaciones"
                class="ml-2 bg-red-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-red-600 
                    flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
                <span wire:loading.remove wire:target="exportarTodasCapacitaciones" class="flex items-center gap-2">
                    <i class="fas fa-file-pdf"></i>
                    Exportar todo
                </span>
                <span wire:loading.flex wire:target="exportarTodasCapacitaciones" class="flex items-center gap-2">
                    <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                    Procesando...
                </span>
            </button>
        </div>

        <button onclick="window.location.href='{{ route('agregarCapacitacionesInd', Crypt::encrypt($userSeleccionado)) }}'" 
            class="bg-green-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-green-600 
            flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-plus"></i>
            Agregar Capacitación
        </button>
    </div>

    @if (session()->has('error'))
        <div class="text-red-500 bg-red-100 p-2 rounded-md text-center">
            {{ session('error') }}
        </div>
    @endif

    @if ($capacitaciones->isEmpty())
        <p class="mt-2 text-gray-600 text-center">Este usuario no tiene capacitaciones asignadas.</p>
    @else
        @foreach ($capacitaciones as $capacitacion)
            <div class="mt-8 p-4 border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-all relative">
                <div class="flex justify-between items-center">
                    <span class="font-light text-gray-600"><strong>Fecha inicio:
                        </strong>{{ $capacitacion->fechaIni }}</span>
                    <span class="font-light text-gray-600"><strong>Fecha fin:
                        </strong>{{ $capacitacion->fechaFin }}</span>

                    <div class="flex items-center gap-0">
                        <button wire:click="confirmDelete({{ $capacitacion->id }})"
                            class="text-red-500 hover:text-red-700 focus:text-red-700 p-2 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110">
                            <i class="fas fa-trash-alt text-xl"></i>
                        </button>
                        <button
                            onclick="window.location.href='{{ route('editarCapacitacionesInd', Crypt::encrypt($capacitacion->id)) }}'"
                            class="text-blue-500 hover:blue-red-700 focus:text-blue-700 p-2 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>

                    </div>

                </div>
                <div class="mt-2">
                    <h2 class="text-xl text-gray-700 font-bold">{{ $capacitacion->nombreCapacitacion }}</h2>
                    <p class="mt-2 text-gray-600"><strong>Objetivo: </strong>{{ $capacitacion->objetivoCapacitacion }}</p>
                    <a class="text-gray-700 text-gr"><strong>Curso: {{ $capacitacion->curso->nombre }}</strong></a>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <button wire:click="exportarPDF({{ $capacitacion->id }})" wire:loading.attr="disabled"
                        wire:target="exportarPDF"
                        class="bg-blue-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-blue-600 
                            flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
                        <span wire:loading.remove wire:target="exportarPDF" class="flex items-center gap-2">
                            <i class="fas fa-file-pdf"></i>
                            Exportar PDF
                        </span>
                        <span wire:loading.flex wire:target="exportarPDF" class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                            Procesando...
                        </span>
                    </button>
                    <a href="{{ route('verEvidenciasIndTrabajador', Crypt::encrypt($capacitacion->id)) }}"
                        class="bg-green-600 text-white px-2 py-1 rounded-lg hover:bg-green-700 transition-transform transform hover:scale-105 flex items-center gap-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          </svg>
                           Ver Evidencia
                     </a>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Modal de confirmación -->
    <div id="modalConfirm"
        class="{{ $showModal ? '' : 'hidden' }} fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
            <div class="flex justify-end p-2">
                <button wire:click="$set('showModal', false)" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">¿Estás seguro de que deseas eliminar esta
                    capacitación?</h3>
                <button wire:click="deleteFuncion"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                    Eliminar
                </button>
                <button wire:click="$set('showModal', false)"
                    class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

</div>
