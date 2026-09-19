<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados Evaluación 360 - {{ $calificadoNombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10mm;
            color: #333;
        }
        .container {
            width: 100%;
            margin-top: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1a202c;
            margin: 0;
        }
        .subtitle {
            font-size: 14px;
            color: #4a5568;
            margin: 3px 0;
        }
        .status {
            text-align: center;
            margin: 15px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .table th, .table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f7fafc;
            font-weight: bold;
            color: #4a5568;
        }
        .final-score {
            background-color: #f7fafc;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            margin: 15px 0;
        }
        .chart-container {
            margin: 15px 0;
            text-align: center;
            page-break-inside: avoid; /* Evita que esta sección se divida entre páginas */
        }
        .chart-container img {
            max-width: 100%;
            height: auto;
        }
        .text-green { color: #2f855a; }
        .text-red { color: #c53030; }
        .text-orange { color: #dd6b20; }
        .text-yellow { color: #d69e2e; }
        .bg-red { background-color: #c53030; color: white; }
        .bg-yellow { background-color: #d69e2e; color: white; }
        .bg-green { background-color: #2f855a; color: white; }
        .badge {
            padding: 8px 15px;
            border-radius: 9999px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <h1 class="title">RESULTADOS EVALUACIÓN 360 - ADMINISTRADOR</h1>
            <p class="subtitle">{{ $calificadoNombre }}</p>
            <p class="subtitle">Evaluado por: {{ $calificadorNombre }}</p>
            <p class="subtitle">{{ $empresaNombre }} - {{ $sucursalNombre }}</p>
            <p class="subtitle">{{ $departamentoNombre }} - {{ $puestoNombre }}</p>
        </div>

        <!-- Estado -->
        <div class="status">
            <h3>Estado de la Evaluación</h3>
            <p class="text-{{ $realizada ? 'green' : 'red' }}" style="font-size: 20px; font-weight: bold;">
                {{ $realizada ? 'Completada' : 'Pendiente' }}
            </p>
        </div>

        @if($realizada)
            <!-- Tabla de Clasificación -->
            <div>
                <h3 style="text-align: center; margin: 15px 0 10px;">Clasificación de Evaluaciones 360° por Niveles</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Rango</th>
                            <th>Resultado</th>
                            <th>Color</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0-1</td>
                            <td>Bajo</td>
                            <td class="text-red">Rojo</td>
                        </tr>
                        <tr>
                            <td>1-2</td>
                            <td>Regular</td>
                            <td class="text-orange">Anaranjado</td>
                        </tr>
                        <tr>
                            <td>2-3</td>
                            <td>Bueno</td>
                            <td class="text-yellow">Amarillo</td>
                        </tr>
                        <tr>
                            <td>3-4</td>
                            <td>Sobresaliente</td>
                            <td class="text-green">Verde</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tabla de Resultados -->
            <div>
                <h3 style="text-align: center; margin: 15px 0 10px;">Resultados por Competencia</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Competencias Evaluadas</th>
                            <th>Autoevaluación</th>
                            <th>Promedio</th>
                            <th>Diferencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datosTabla['items'] as $dato)
                            <tr>
                                <td>{{ $dato['competencia'] }}</td>
                                <td>{{ $dato['autoevaluacion'] }}</td>
                                <td>{{ $dato['promedio'] }}</td>
                                <td class="{{ $dato['diferencia'] < 0 ? 'text-red' : 'text-green' }}">
                                    {{ $dato['diferencia'] }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay datos disponibles</td>
                            </tr>
                        @endforelse
                        @if(!empty($datosTabla['items']))
                            <tr style="font-weight: bold; background-color: #f7fafc;">
                                <td>Promedio</td>
                                <td>{{ $datosTabla['promedioAutoevaluacion'] }}</td>
                                <td>{{ $datosTabla['promedioOtros'] }}</td>
                                <td class="{{ $datosTabla['promedioDiferencia'] < 0 ? 'text-red' : 'text-green' }}">
                                    {{ $datosTabla['promedioDiferencia'] }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Promedio Final -->
            <div class="final-score">
                <table width="100%">
                    <tr>
                        <td style="font-size: 18px; font-weight: bold;">Promedio Final:</td>
                        <td style="text-align: right;">
                            <span style="font-size: 24px; font-weight: bold;">{{ number_format($promedioFinal, 2) }}</span>
                            <span class="badge bg-{{ strtolower($resultadoFinal == 'Bajo' ? 'red' : ($resultadoFinal == 'Regular' ? 'yellow' : ($resultadoFinal == 'Sobresaliente' ? 'green' : 'yellow'))) }}">
                                {{ $resultadoFinal }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Gráfica -->
            <div class="chart-container">
                <h3>Puntuaciones y Respuestas por Pregunta</h3>
                @if($chartBase64)
                    <img src="{{ $chartBase64 }}" style="max-width: 100%; height: auto;" alt="Gráfica de Desempeño">
                @elseif(!empty($datosGrafica))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th>Puntuación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datosGrafica as $dato)
                                <tr>
                                    <td>{{ $dato['pregunta'] }}</td>
                                    <td>{{ $dato['puntuacion'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay datos disponibles para mostrar la gráfica.</p>
                @endif
            </div>
        @endif
    </div>
</body>
</html>