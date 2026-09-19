<div class="max-w-4xl px-10 my-6 py-8 bg-white rounded-lg shadow-md mx-auto relative">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 text-center w-full">
            📚
            <span class="bg-gradient-to-r from-blue-500 to-blue-400 text-transparent bg-clip-text">
                Mis Capacitaciones <br>
                Grupales
            </span>
            <span class="block text-sm text-gray-500 mt-2 uppercase tracking-widest">
                Mejora tus habilidades con cada curso
            </span>
        </h1>
        <a href="{{ route('vermasUsuariosTrabajador', Crypt::encrypt($userSeleccionado)) }}"
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
        <a href="{{ route('verCapacitacionesIndTrabajador', Crypt::encrypt($userSeleccionado)) }}"
            class="px-6 py-3 border-b-2 transition-all duration-300 
        {{ $rutaActual === 'verCapacitacionesIndTrabajador' ? 'border-blue-500 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-500' }}">
            📌 Individuales
        </a>

        <a href="{{ route('verCapacitacionesGruGeneral', Crypt::encrypt($userSeleccionado)) }}"
            class="px-6 py-3 border-b-2 transition-all duration-300 
        {{ $rutaActual === 'verCapacitacionesGruGeneral' ? 'border-blue-500 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-500' }}">
            👥 Grupales
        </a>
    </div>

    <div class="flex justify-between items-center mb-4">
        <select wire:model="selectedYear"
            class="px-5 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <option value="">Seleccionar año</option>
        </select>

        <button onclick="validateAndExport()" wire:loading.attr="disabled" wire:target="exportarTodasCapacitaciones"
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

    <!-- Mensaje de error si no se selecciona año -->
    <div id="year-error" class="text-red-500 bg-red-100 p-2 rounded-md text-center hidden">
        Por favor, selecciona un año antes de exportar.
    </div>

    @if ($capacitaciones->isEmpty())
        <p class="mt-2 text-gray-600 text-center">No hay capacitaciones disponibles para esta empresa y sucursal.</p>
    @else
        @foreach ($capacitaciones as $capacitacion)
            <div
                class="mt-8 p-6 border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-all relative bg-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div class="mb-4 sm:mb-0">
                        <h2 class="text-2xl text-gray-800 font-bold">{{ $capacitacion->nombreCapacitacion }}</h2>
                        <p class="text-gray-700 font-semibold mt-3">Grupo: {{ $capacitacion->nombreGrupo }}</p>
                    </div>
                    <div class="text-sm text-gray-600 flex flex-col sm:flex-row sm:gap-4">
                        <span><strong>Fecha inicio:</strong> {{ $capacitacion->fechaIni }}</span>
                        <span><strong>Fecha fin:</strong> {{ $capacitacion->fechaFin }}</span>
                    </div>
                </div>

                <p class="mt-4 text-gray-600">Objetivo: {{ $capacitacion->objetivo_capacitacion }}</p>
                <p class="text-gray-700 font-semibold mt-2">Curso: {{ $capacitacion->curso->nombre }}</p>

                <div class="flex justify-between items-center mt-6 border-t pt-4">
                    <div class="flex gap-3">
                        <button wire:click="exportarPDF({{ $capacitacion->id }})" wire:loading.attr="disabled"
                            wire:target="exportarPDF"
                            class="bg-blue-500 text-white px-3 py-1.5 rounded-lg shadow-md hover:bg-blue-600 flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
                            <span wire:loading.remove wire:target="exportarPDF">
                                <i class="fas fa-file-pdf"></i>
                                Exportar PDF
                            </span>
                            <span wire:loading.flex wire:target="exportarPDF">
                                <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                                Procesando...
                            </span>
                        </button>
                
                        <a href="{{ route('verEvidenciasGruTrabajador', Crypt::encrypt($capacitacion->id)) }}"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-transform transform hover:scale-105 flex items-center gap-2 shadow-md">
                             <i class="fas fa-upload"></i> Ver Evidencia
                         </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


</div>

<script>
    function validateAndExport() {
        var selectedYear = document.querySelector('select[wire\\:model="selectedYear"]').value;
        var errorMessage = document.getElementById('year-error');

        if (!selectedYear) {
            errorMessage.classList.remove('hidden');
        } else {
            errorMessage.classList.add('hidden');
            // Proceed with the export function
            @this.call('exportarTodasCapacitaciones');
        }
    }
</script>
