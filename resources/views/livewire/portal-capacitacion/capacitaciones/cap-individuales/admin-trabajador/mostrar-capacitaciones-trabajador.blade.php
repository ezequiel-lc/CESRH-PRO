<div class="max-w-4xl px-10 my-6 py-8 bg-white rounded-lg shadow-md mx-auto relative">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 text-center w-full">
            📚
            <span class="bg-gradient-to-r from-blue-500 to-blue-400 text-transparent bg-clip-text">
                 Mis Capacitaciones Individuales
            </span>
            <span class="block text-sm text-gray-500 mt-2 uppercase tracking-widest">
                Mejora tus habilidades con cada curso
            </span>
        </h1>
        <a href="{{route('vermasUsuariosTrabajador', Crypt::encrypt($userSeleccionado))}}"
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
    <a href="{{ route('verCapacitacionesIndTrabajador', Crypt::encrypt($userSeleccionado))}}"
        class="px-6 py-3 border-b-2 transition-all duration-300 
        {{ $rutaActual === 'verCapacitacionesIndTrabajador' ? 'border-blue-500 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-500' }}">
        📌 Individuales
    </a>

    <a href="{{ route('verCapacitacionesGruTrabajador', Crypt::encrypt($userSeleccionado))}}"
        class="px-6 py-3 border-b-2 transition-all duration-300 
        {{ $rutaActual === 'verCapacitacionesGruTrabajador' ? 'border-blue-500 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-500' }}">
        👥 Grupales
    </a>
    </div>

    
    <div class="flex justify-between items-center mb-4">
        <select wire:model="selectedYear"
            class="px-8 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <option value="">Seleccionar año</option>
            @foreach ($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>

        <button wire:click="exportarTodasCapacitaciones" wire:loading.attr="disabled"
            wire:target="exportarTodasCapacitaciones"
            class="bg-red-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-red-600 
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
                </div>
                <div class="mt-2">
                    <h2 class="text-xl text-gray-700 font-bold">{{ $capacitacion->nombreCapacitacion }}</h2>
                    <p class="mt-2 text-gray-600">{{ $capacitacion->objetivoCapacitacion }}</p>
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
                    <div class="mt-6">
                        <a href="{{ route('verEvidenciasIndTrabajador', Crypt::encrypt($capacitacion->id)) }}"
                           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-transform transform hover:scale-105 flex items-center gap-2 shadow-md">
                            <i class="fas fa-upload"></i> Ver Evidencia
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="mt-6 flex justify-center">
        {{ $capacitaciones->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>
</div>
