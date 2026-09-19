<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-xl">
      <!-- Información del Usuario -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-semibold text-gray-700">Evaluación del Puesto</h2>
        <p class="text-lg text-gray-600 mt-2">
            <strong>{{ $userSeleccionado->name }}</strong> - 
            <span class="text-blue-600">{{ $perfilactual->nombre_puesto ?? 'Sin puesto asignado' }}</span>
        </p>
    </div>

    <form>
        <div class="space-y-6">
            @foreach ([
                ['title' => 'Funciones Específicas del Puesto', 'items' => $funcionesEspecificas, 'field' => 'nombre', 'prefix' => 'func_'],
                ['title' => 'Formación y Habilidades Humanas', 'items' => $habilidadesHumanas, 'field' => 'descripcion', 'prefix' => 'hum_'],
                ['title' => 'Formación y Habilidades Técnicas', 'items' => $habilidadesTecnicas, 'field' => 'descripcion', 'prefix' => 'tec_']
            ] as $category)
                <div class="bg-gray-50 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">{{ $category['title'] }}</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="p-2 border-b">Criterio</th>
                                <th class="p-2 border-b text-center">Evaluación (1-5)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category['items'] as $index => $item)
                                @php
                                    $uniqueKey = $category['prefix'] . $item->id;
                                @endphp
                                <tr class="border-t">
                                    <td class="p-2">{{ $item[$category['field']] }}</td>
                                    <td class="p-2 text-center">
                                        <input 
                                            type="range" 
                                            min="1" 
                                            max="5" 
                                            wire:model.live="evaluaciones.{{ $uniqueKey }}" 
                                            class="w-24 accent-blue-500">
                                        <span class="ml-2 text-gray-700">{{ $evaluaciones[$uniqueKey] ?? 3 }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

        <!-- Calificación Automática -->
        <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
            <label class="block text-lg font-semibold text-gray-800 mb-2">Calificación Final</label>
            
            <div class="flex items-center gap-4">
                <input type="text" wire:model="calificacionFinal" 
                       class="flex-1 p-3 border border-gray-300 rounded-lg bg-gray-100 text-center text-xl font-bold text-blue-600 shadow-sm" 
                       readonly>
                
                <button type="button" wire:click="calcularCalificacion" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium shadow-md transition duration-300 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                    Obtener Calificación
                </button>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-1">Tiempo en el Puesto Actual</label>
            <input type="text" wire:model="tiempoPuesto" 
                class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-400"
                placeholder="Ej: 2 años y 3 meses">
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-1">Comentarios</label>
            <textarea wire:model="comentarios" 
                class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-400" 
                rows="3" placeholder="Escribe aquí..."></textarea>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-1">Recomendaciones</label>
            <textarea wire:model="recomendaciones" 
                class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-400" 
                rows="3" placeholder="Escribe aquí..."></textarea>
        </div>

        <div class="text-center mt-6">
            <button wire:click="guardarEvaluacion" type="button" class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium shadow-md transition duration-300 hover:bg-green-700 focus:ring-2 focus:ring-green-400">
                Guardar Evaluación
            </button>

            <button onclick="window.history.back()" type="button" class="px-4 py-2 bg-gray-400 text-white rounded-lg font-medium shadow-md transition duration-300 hover:bg-gray-400 focus:ring-2 focus:ring-gray-400">
                Cancelar
            </button>
        </div>

       
        @if (session()->has('success') || session()->has('error'))
    <div class="fixed top-5 right-5 bg-green-600 text-white text-lg px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500"
        style="z-index: 1000;"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">

        @if (session()->has('success'))
            ✅ {{ session('success') }}
        @endif

        @if (session()->has('error'))
            ❌ {{ session('error') }}
        @endif
    </div>
    @endif
    </form>
</div>