<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg relative 
            animate-fade-in-up transition-all duration-500">

    <button onclick="window.history.back()" 
        class="absolute top-4 right-4 text-gray-700 hover:text-red-500 focus:text-red-500 
           p-3 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110 z-50">
           <i class="fa-solid fa-circle-xmark text-2xl"></i>
    </button>

    <div class="flex items-center gap-4 mb-6">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($userSeleccionado->name ?? 'Usuario') }}&background=random" 
             alt="Foto de {{ $userSeleccionado->name ?? 'Usuario' }}" 
             class="w-24 h-24 rounded-full shadow-md transform transition-all duration-500 hover:scale-110">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700">Historial de Calificaciones</h2>
            <p class="text-lg text-gray-600 mt-1">
                <strong>{{ $userSeleccionado->name }}</strong>
            </p>
            <p class="text-gray-700">Puesto: {{ $userSeleccionado->perfilActual()?->nombre_puesto ?? 'Sin asignar' }}</p>
        </div>
    </div>

    <div class="mb-6 flex justify-end">
        <button wire:click="exportarTodasPDF" 
                wire:loading.attr="disabled" 
                wire:target="exportarTodasPDF"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 
                    flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
            
            <span wire:loading.remove wire:target="exportarTodasPDF" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2-2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                Exportar Todas
            </span>
            
            <span wire:loading.flex wire:target="exportarTodasPDF" class="flex items-center gap-2">
                <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                Procesando...
            </span>

        </button>

    </div>

    <div class="mb-4">
        <label for="fecha" class="block font-bold mb-2">Selecciona una fecha:</label>
        <select wire:model.live="fechaSeleccionada" id="fecha" 
            class="border p-2 rounded-lg w-full bg-gray-100 text-gray-700 focus:ring-2 focus:ring-blue-300 transition-all duration-300">
            <option value="">-- Selecciona una fecha --</option>
            @foreach ($fechas as $fecha)
                <option value="{{ $fecha }}">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</option>
            @endforeach
        </select>
    </div>

    @if ($fechaSeleccionada && $evaluaciones->isNotEmpty())
        <div class="mt-6 animate-fade-in">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-700">Evaluaciones del {{ \Carbon\Carbon::parse($fechaSeleccionada)->format('d/m/Y') }}</h3>
                
                <button wire:click="exportarPDF" 
                        wire:loading.attr="disabled" 
                        wire:target="exportarPDF"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 
                            flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
                    
                    <span wire:loading.remove wire:target="exportarPDF" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2-2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        Exportar PDF
                    </span>
                    
                    <span wire:loading.flex wire:target="exportarPDF" class="flex items-center gap-2">
                        <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                        Procesando...
                    </span>
                </button>

            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md animate-fade-in-up">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border p-3">Criterio</th>
                            <th class="border p-3">Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $evaluacion)
                            <tr class="border border-gray-200 transition-all duration-300 hover:bg-blue-50">
                                <td class="p-3">{{ $evaluacion->criterio }}</td>
                                <td class="p-3 text-center font-semibold">{{ $evaluacion->calificacion_desempeno }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100 font-bold">
                            <td class="border p-3 text-right">Calificación final:</td>
                            <td class="border p-3 text-center text-blue-600">
                                {{ number_format($evaluaciones->avg('calificacion_desempeno'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            
                <!-- Sección para comentarios y recomendaciones -->
                <div class="mt-4 p-4 border rounded-lg shadow-md bg-gray-100">
                    <h3 class="font-bold text-lg text-gray-700">Comentarios</h3>
                    <p class="text-gray-600">
                        {{ $evaluaciones->pluck('comentarios')->filter()->unique()->implode('. ') }}
                    </p>
            
                    <h3 class="font-bold text-lg text-gray-700 mt-4">Recomendaciones</h3>
                    <p class="text-gray-600">
                        {{ $evaluaciones->pluck('recomendaciones')->filter()->unique()->implode('. ') }}
                    </p>
                </div>
            </div>
            
        </div>
    @else
        <p class="mt-6 text-gray-600 text-center animate-fade-in">No hay evaluaciones disponibles para esta fecha.</p>
    @endif
</div>
