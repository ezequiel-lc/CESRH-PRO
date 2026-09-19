<div class="p-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Encabezado del reporte -->
        <div class="text-center border-b border-gray-300 pb-4">
            <h2 class="text-3xl font-bold text-gray-900" style="font-family: Arial, sans-serif;">RESULTADOS EVALUACIÓN 360 - ADMINISTRADOR</h2>
            <p class="text-lg font-semibold mt-4 text-gray-800" style="font-family: Arial, sans-serif; line-height: 1.5;">{{ $calificadoNombre }}</p>
            <p class="text-sm text-gray-600" style="font-family: Arial, sans-serif; line-height: 1.5;">Evaluado por: {{ $calificadorNombre }}</p>
            <p class="text-sm text-gray-600" style="font-family: Arial, sans-serif; line-height: 1.5;">{{ $empresaNombre }} - {{ $sucursalNombre }}</p>
            <p class="text-sm text-gray-600" style="font-family: Arial, sans-serif; line-height: 1.5;">{{ $departamentoNombre }} - {{ $puestoNombre }}</p>
        </div>

        <!-- Estado de la evaluación -->
        <div class="mt-6 text-center">
            <h3 class="text-lg font-semibold text-gray-800">Estado de la Evaluación</h3>
            <p class="text-xl font-bold mt-2 @if($realizada) text-green-600 @else text-red-600 @endif">
                {{ $realizada ? 'Completada' : 'Pendiente' }}
            </p>
        </div>

        @if($realizada)
            <!-- Clasificación de Evaluaciones -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 text-center">Clasificación de Evaluaciones 360° por Niveles</h3>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-4 py-2 border">Rango</th>
                                <th class="px-4 py-2 border">Resultado</th>
                                <th class="px-4 py-2 border">Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="px-4 py-2 border">0-1</td>
                                <td class="px-4 py-2 border">Bajo</td>
                                <td class="px-4 py-2 border text-red-600 font-semibold">Rojo</td>
                            </tr>
                            <tr class="text-center">
                                <td class="px-4 py-2 border">1-2</td>
                                <td class="px-4 py-2 border">Regular</td>
                                <td class="px-4 py-2 border text-orange-500 font-semibold">Anaranjado</td>
                            </tr>
                            <tr class="text-center">
                                <td class="px-4 py-2 border">2-3</td>
                                <td class="px-4 py-2 border">Bueno</td>
                                <td class="px-4 py-2 border text-yellow-500 font-semibold">Amarillo</td>
                            </tr>
                            <tr class="text-center">
                                <td class="px-4 py-2 border">3-4</td>
                                <td class="px-4 py-2 border">Sobresaliente</td>
                                <td class="px-4 py-2 border text-green-600 font-semibold">Verde</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Nueva tabla de Autoevaluación, Promedio y Diferencia -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 text-center">Resultados por Competencia</h3>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-4 py-2 border">Competencias Evaluadas</th>
                                <th class="px-4 py-2 border">Autoevaluación</th>
                                <th class="px-4 py-2 border">Promedio</th>
                                <th class="px-4 py-2 border">Diferencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datosTabla['items'] as $dato)
                            <tr class="text-center">
                                <td class="px-4 py-2 border">{{ $dato['competencia'] }}</td>
                                <td class="px-4 py-2 border">{{ $dato['autoevaluacion'] }}</td>
                                <td class="px-4 py-2 border">{{ $dato['promedio'] }}</td>
                                <td class="px-4 py-2 border {{ $dato['diferencia'] < 0 ? 'text-red-600' : 'text-green-600' }}">{{ $dato['diferencia'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 border text-center">No hay datos disponibles</td>
                            </tr>
                            @endforelse
                            @if(!empty($datosTabla['items']))
                            <tr class="text-center font-bold bg-gray-50">
                                <td class="px-4 py-2 border">Promedio</td>
                                <td class="px-4 py-2 border">{{ $datosTabla['promedioAutoevaluacion'] }}</td>
                                <td class="px-4 py-2 border">{{ $datosTabla['promedioOtros'] }}</td>
                                <td class="px-4 py-2 border {{ $datosTabla['promedioDiferencia'] < 0 ? 'text-red-600' : 'text-green-600' }}">{{ $datosTabla['promedioDiferencia'] }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Promedio Final -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200 shadow-md">
                <div class="flex justify-between items-center">
                    <div class="text-xl font-bold text-gray-900">Promedio Final:</div>
                    <div class="flex items-center space-x-4">
                        <div class="text-2xl font-extrabold text-gray-800">
                            {{ number_format($promedioFinal, 2) }}
                        </div>
                        <span class="px-5 py-2 text-lg font-semibold text-white rounded-full shadow-md
                            @if($resultadoFinal == 'Bajo') bg-red-600
                            @elseif($resultadoFinal == 'Regular') bg-yellow-500
                            @elseif($resultadoFinal == 'Bueno') bg-blue-600
                            @elseif($resultadoFinal == 'Sobresaliente') bg-green-600
                            @else bg-gray-500
                            @endif">
                            {{ $resultadoFinal }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gráfica de Desempeño -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200 shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 text-center">Puntuaciones y Respuestas por Pregunta</h3>
                @if($chartBase64)
                <img src="{{ $chartBase64 }}" alt="Gráfica de Desempeño" style="max-width: 100%; height: auto;" />
                @elseif(!empty($datosGrafica))
                <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-md mt-4">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-2 border">Pregunta</th>
                            <th class="px-4 py-2 border">Puntuación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datosGrafica as $dato)
                        <tr class="text-center">
                            <td class="px-4 py-2 border">{{ $dato['pregunta'] }}</td>
                            <td class="px-4 py-2 border">{{ $dato['puntuacion'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center mt-4">No hay datos disponibles para mostrar la gráfica.</p>
                @endif
            </div>

            <!-- Botón Exportar PDF -->
            <div class="mt-6 text-center">
                <button wire:click="exportarPDF" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Exportar a PDF
                </button>
            </div>
        @endif
    </div>
</div>