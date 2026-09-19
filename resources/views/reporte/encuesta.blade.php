<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Encuesta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .portada {
            position: relative;
            text-align: center;
            padding: 50px;
        }
        .logo-left {
            position: absolute;
            top: 20px;
            left: 20px;
            max-width: 100px;
        }
        .logo-right {
            position: absolute;
            top: 20px;
            right: 20px;
            max-width: 100px;
        }
        .logo-center {
            max-width: 150px;
            margin: 20px auto;
        }
        .titulo-reporte {
            font-size: 24px;
            color: #333;
            margin-top: 20px;
        }
        .confidencial {
            font-size: 18px;
            color: #ff0000;
            margin: 10px 0;
        }
        .cuadro-azul {
            background-color: #1a237e;
            color: #fff;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .cuadro-azul h3 {
            font-size: 20px;
            margin: 0;
        }
        .cuadro-azul p {
            font-size: 16px;
            margin: 5px 0;
        }
        .introduccion, .datos-participantes, .resultados-generales {
            margin: 20px 0;
            page-break-inside: avoid; /* Evita que se divida en varias páginas */
        }
        .introduccion h4, .datos-participantes h4, .resultados-generales h4 {
            color: #1a237e;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .introduccion p, .datos-participantes p, .resultados-generales p {
            font-size: 14px;
            color: #000;
            margin: 5px 0;
        }
        .grafica {
            width: 100%;
            height: auto;
            margin: 10px 0;
        }
        .page-break {
            page-break-before: always; /* Forza un salto de página */
        }
    </style>
</head>
<body>
    <!-- Portada -->
    <div class="portada">
        <!-- Logos y título -->
        <img src="{{ asset('public/Imagenes/Logos/CESRH-logo.png') }}" alt="Logo CESRH" class="logo-left">
        <img src="{{ asset('public/Imagenes/Logos/CESRH-logo.png') }}" alt="Logo CESRH" class="logo-right">
        <img src="{{ asset('public/Imagenes/Logos/CESRH-logo.png') }}" alt="Logo CESRH" class="logo-center">
        <h1 class="titulo-reporte">Reporte de la Norma 035</h1>
        <h2 class="confidencial">Privado y confidencial</h2>
        <div class="cuadro-azul">
            <h3>CESRH CONSULTORÍA Y COACHING</h3>
            <h3>Reporte Estadístico</h3>
            <p>Periodo de aplicación: {{ $encuesta->FechaInicio }} al {{ $encuesta->FechaFinal }}</p>
        </div>
    </div>

    <!-- Introducción -->
    <div class="introduccion page-break">
        <h4>Introducción</h4>
        <p><strong style="color: #1a237e;">Objetivo</strong></p>
        <p>El objetivo del diagnóstico es apoyar en la identificación, el análisis y la prevención de los elementos que repercuten en los factores de riesgo psicosocial, así como para promover un entorno organizacional favorable en los centros de trabajo, cuidando en todo momento la integridad de los trabajadores.</p>
        <p><strong style="color: #1a237e;">Método de evaluación</strong></p>
        <p>La evaluación se llevó a cabo mediante una plataforma digital, respetando la guía de referencia III (incluyendo su numeral III.2 y III.3), y utilizando los valores de referencia dados para la calificación de esta. Todos los trabajadores estuvieron en presencia de un aplicador capacitado para presentarles la encuesta, apoyarles en sus dudas y acompañarlos durante la aplicación de la encuesta.</p>
        <p><strong style="color: #1a237e;">Aplicador:</strong></p>
        <p>Karen xd</p>
        <p><strong style="color: #1a237e;">Principal Actividad del centro de trabajo:</strong></p>
        <p>SOLUCIONES EN RECURSOS HUMANOS</p>
    </div>

    <!-- Datos de los participantes -->
    <div class="datos-participantes page-break">
        <h4>Datos de los participantes</h4>
        <p>Conoce el índice de participación de tu encuesta y el perfil de los participantes.</p>
        <h4>Índice de Participación</h4>
        <p>De {{ $indiceParticipacion['contestadas'] + $indiceParticipacion['sin_contestar'] }} trabajadores</p>
        <div class="grafica">
            {!! $graficaParticipacion->render() !!}
        </div>
        <p>Periodo de aplicación: {{ $encuesta->FechaInicio }} al {{ $encuesta->FechaFinal }}</p>
        <p>Días totales: {{ \Carbon\Carbon::parse($encuesta->FechaInicio)->diffInDays($encuesta->FechaFinal) }}</p>
    </div>

    <!-- Perfil de los participantes -->
    <div class="perfil-participantes page-break">
        <h4>Perfil de los participantes</h4>
        <p>Tenga en cuenta que al tratarse de una encuesta de carácter confidencial, esta encuesta fue llenada libremente por cada uno de los participantes.</p>
        <div class="grafica">
            {!! $graficaGenero->render() !!}
        </div>
        <div class="grafica">
            {!! $graficaEdad->render() !!}
        </div>
        <div class="grafica">
            {!! $graficaEstadoCivil->render() !!}
        </div>
        <div class="grafica">
            {!! $graficaEstudios->render() !!}
        </div>
    </div>

    <!-- Resultados Generales -->
    <div class="resultados-generales page-break">
        <h4>Resultados Generales</h4>
        <p>Los resultados se muestran por categoría de evaluación y por cada dominio, mostrando el promedio final de todas las encuestas contestadas.</p>
        @foreach ($categorias as $categoria => $detalles)
            <h4>{{ $categoria }}</h4>
            <p>Dominios: {{ implode(', ', $detalles['dominios']) }}</p>
            <p>Dimensiones: {{ $detalles['dimensiones'] }}</p>
            <p>Preguntas: {{ $detalles['preguntas'] }}</p>
        @endforeach
    </div>
</body>
</html>
