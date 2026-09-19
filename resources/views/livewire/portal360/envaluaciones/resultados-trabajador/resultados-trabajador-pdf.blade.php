<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resultados Evaluación 360 Grados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .text-center {
            text-align: center;
        }
        .header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info {
            font-size: 14px;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }
        .color-red {
            color: #e53e3e;
            font-weight: bold;
        }
        .color-orange {
            color: #ed8936;
            font-weight: bold;
        }
        .color-yellow {
            color: #ecc94b;
            font-weight: bold;
        }
        .color-green {
            color: #38a169;
            font-weight: bold;
        }
        .result-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .result-label {
            font-size: 16px;
            font-weight: bold;
        }
        .result-value {
            font-size: 18px;
            font-weight: bold;
        }
        .result-badge {
            padding: 5px 15px;
            border-radius: 15px;
            color: white;
            font-weight: bold;
        }
        .badge-low {
            background-color: #e53e3e;
        }
        .badge-regular {
            background-color: #ed8936;
        }
        .badge-good {
            background-color: #ecc94b;
        }
        .badge-excellent {
            background-color: #38a169;
        }
        .chart-container {
            margin: 20px 0;
            text-align: center;
        }
        .chart-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Encabezado del reporte -->
    <div class="header text-center">
        <h1 class="title">REPORTE DE RESULTADOS EVALUACIÓN 360 GRADOS</h1>
        <p class="subtitle">{{ $calificadoNombre }}</p>
        <p class="info">{{ $empresaNombre }}</p>
        <p class="info">{{ $sucursalNombre }}</p>
    </div>

    <!-- Tabla de clasificación por niveles -->
    <div>
        <h3 class="chart-title">Clasificación de Evaluaciones 360° por Niveles</h3>
        <table>
            <thead>
                <tr>
                    <th>Rango de evaluaciones</th>
                    <th>Resultado</th>
                    <th>Color</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0-1</td>
                    <td>Bajo</td>
                    <td class="color-red">Rojo</td>
                </tr>
                <tr>
                    <td>1-2</td>
                    <td>Regular</td>
                    <td class="color-orange">Anaranjado</td>
                </tr>
                <tr>
                    <td>2-3</td>
                    <td>Bueno</td>
                    <td class="color-yellow">Amarillo</td>
                </tr>
                <tr>
                    <td>3-4</td>
                    <td>Sobresaliente</td>
                    <td class="color-green">Verde</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Sección de promedio final -->
    <div class="result-box">
        <table style="border: none; width: 100%;">
            <tr>
                <td style="border: none; width: 50%; text-align: left; font-weight: bold; font-size: 16px;">Promedio Final:</td>
                <td style="border: none; width: 30%; text-align: right; font-weight: bold; font-size: 18px;">{{ number_format($promedioFinal, 2) }}</td>
                <td style="border: none; width: 20%; text-align: right;">
                    <div style="
                        padding: 5px 15px;
                        border-radius: 15px;
                        color: white;
                        font-weight: bold;
                        display: inline-block;
                        @if($resultadoFinal == 'Bajo') background-color: #e53e3e;
                        @elseif($resultadoFinal == 'Regular') background-color: #ed8936;
                        @elseif($resultadoFinal == 'Bueno') background-color: #ecc94b;
                        @elseif($resultadoFinal == 'Sobresaliente') background-color: #38a169;
                        @else background-color: #718096;
                        @endif
                    ">
                        {{ $resultadoFinal }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Sección de la gráfica de desempeño -->
    <div>
        <h3 class="chart-title">Puntuaciones y Respuestas por Pregunta</h3>
        
        @if($chartBase64)
        <div class="chart-container">
            <img src="{{ $chartBase64 }}" alt="Gráfica de Desempeño" style="max-width: 100%; height: auto;" />
        </div>
        @elseif(!empty($datosGrafica))
        <table>
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Puntuación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datosGrafica as $dato)
                <tr>
                    <td style="text-align: left;">{{ $dato['pregunta'] }}</td>
                    <td>{{ $dato['puntuacion'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center">No hay datos disponibles para mostrar la gráfica.</p>
        @endif
    </div>
</body>
</html>