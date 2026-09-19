<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte Estadístico</title>
    <style>
        /* Ajustar el margen inferior del cuerpo para dejar espacio para la paginación */
        body {
            margin-bottom: 50px; /* Espacio para la paginación */
        }
        .portada {
            text-align: center;
            padding: 50px;
        }
        .portada img {
            max-width: 100%;
            height: auto;
        }
        .portada h1 {
            color: #333;
            font-size: 24px;
            margin-top: 20px;
        }
        .portada .confidencial {
            color: red;
            font-size: 18px;
        }
        .portada .fondo-azul {
            background-color: #1a237e;
            color: white;
            padding: 20px;
            margin-top: 20px;
        }
        .grafica {
            text-align: center;
            margin: 20px 0;
        }
        .grafica img {
            max-width: 100%;
            height: auto;
        }
        /* Estilo para la paginación */
        .paginacion {
            position: fixed;
            bottom: 10px; /* Ajusta la posición vertical */
            right: 20px;
            font-size: 12px;
            background-color: white; /* Fondo blanco para que el texto sea legible */
            padding: 5px 10px; /* Espaciado interno */
            border: 1px solid #ccc; /* Borde para resaltar */
        }
        .page-break {
            page-break-before: always;
        }
        .titulo {
            font-size: 24px;
            font-weight: bold;
            color: blue;
        }
        .subtitulo {
            font-size: 18px;
            color: blue;
        }
        .texto {
            font-size: 14px;
            color: black;
        }
        .fondo-gris {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
        }
        .fondo-gris h2 {
            color: blue;
            text-transform: uppercase;
        }
        .tabla-escala {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .tabla-escala th, .tabla-escala td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .tabla-escala th {
            background-color: #f2f2f2;
        }
    </style>
</head>
    <body>
            <!-- Portada -->
        <div class="portada">
            <!-- Logo a la derecha -->
            <img src="{{ public_path('Imagenes/Logos/CESRH-logo.png') }}" alt="Logo del Software" style="width: 150px; float: right;">

            <!-- Logo a la izquierda -->
            <img src="{{ public_path('Imagenes/Dx035logo_envolvente.png') }}" alt="Logo del Software" style="width: 150px; float: left;">

            <!-- Limpiar floats -->
            <div style="clear: both;"></div>

            <!-- Logo del centro con margen superior aumentado -->
            <img src="{{ asset('Imagenes/Dx035logo2.png') }}" alt="Logo del Software" style="width: 600px; margin: 100px auto 20px auto; display: block;">
            <br>
            <h1>Reporte de la Norma 035</h1>
            <br>
            <p class="confidencial">Privado y confidencial</p>
            <br>
            <div class="fondo-azul">
                <p>CESRH CONSULTORIA Y COACHING</p>
                <p>Reporte estadistico</p>
                <br>
                <br>
                <p>Periodo de aplicación: {{ $encuesta['FechaInicio'] }} al {{ $encuesta['FechaFinal'] }}</p>
            </div>
        </div>
        <div class="paginacion">Página 1</div>

        <!-- Página 1: Introducción -->
        <div class="page-break">
            <h2 class="titulo">Introducción</h2>
            <p class="subtitulo">Objetivo</p>
            <p class="texto">El objetivo del diagnóstico es apoyar en la identificación, el análisis y la prevención de los elementos que repercuten en los factores de riesgo psicosocial, así como para promover un entorno organizacional favorable en los centros de trabajo, cuidando en todo momento la integridad de los trabajadores.</p>
            <p class="subtitulo">Método de evaluación</p>
            <p class="texto">La evaluación se llevó a cabo mediante una plataforma digital, respetando la guía de referencia III (incluyendo su numeral III.2 y III.3), y utilizando los valores de referencia dados para la calificación de esta. Todos los trabajadores estuvieron en presencia de un aplicador capacitado para presentarles la encuesta, apoyarles en sus dudas y acompañarlos durante la aplicación de la encuesta.</p>
            <p class="subtitulo">Aplicador</p>
            <p class="texto">Karen owo</p>
            <p class="subtitulo">Principal Actividad del centro de trabajo:</p>
            <p class="texto">SOLUCIONES EN RECURSOS HUMANOS</p>
        </div>
        <div class="paginacion">Página 2</div>

        <!-- Página 2: Datos de los participantes -->
        <div class="page-break">
            <h2 class="titulo">Datos de los participantes</h2>
            <p class="texto">Conoce el índice de participación de tu encuesta y el perfil de los participantes.</p>
            <h2 class="subtitulo">Índice de Participación</h2>
            <p class="texto" style="color: blue; font-size: 16px;">
                De {{ $encuesta['NumeroEncuestas'] }} trabajadores
            </p>
            @if(isset($graficas['participacion']))
                <div class="grafica">
                    <img src="{{ $graficas['participacion'] }}" alt="Gráfica de Participación">
                </div>
            @else
                <p>No se pudo generar la gráfica de participación.</p>
            @endif
            <p class="subtitulo">Periodo de aplicación: Del {{ $encuesta['FechaInicio'] }} al {{ $encuesta['FechaFinal'] }}</p>
            <p class="texto">Días totales: {{ $encuesta['diasTotales'] }} días</p>
        </div>
        <div class="paginacion">Página 3</div>

        <!-- Página 3: Perfil de los participantes -->
        <div class="page-break">
            <h2 class="titulo">Perfil de los participantes</h2>
            <p class="texto">Tenga en cuenta que al tratarse de una encuesta de carácter confidencial, esta encuesta fue llenada libremente por cada uno de los participantes.</p>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="width: 50%;">
                    <div class="grafica">
                        <img src="{{ $graficas['genero'] }}" alt="Gráfica de Género">
                    </div>
                    <div class="grafica">
                        <img src="{{ $graficas['estadoCivil'] }}" alt="Gráfica de Estado Civil">
                    </div>
                </div>
                <div style="width: 50%;">
                    <div class="grafica">
                        <img src="{{ $graficas['edades'] }}" alt="Gráfica de Edades">
                    </div>
                </div>
            </div>
        </div>
        <div class="paginacion">Página 4</div>

        <!-- Página 4: Perfil laboral -->
        <div class="page-break">
            <h2 class="titulo">Perfil laboral</h2>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="width: 50%;">
                    <div class="grafica">
                        <img src="{{ $graficas['contratacion'] }}" alt="Gráfica de Contratación">
                    </div>
                </div>
                <div style="width: 50%;">
                    <div class="grafica">
                        <img src="{{ $graficas['tipoPuesto'] }}" alt="Gráfica de Tipo de Puesto">
                    </div>
                    <div class="grafica">
                        <img src="{{ $graficas['tipoPersonal'] }}" alt="Gráfica de Tipo de Personal">
                    </div>
                </div>
            </div>
        </div>
        <div class="paginacion">Página 5</div>

        <!-- Página 5: Jornada laboral y experiencia -->
        <div class="page-break">
            <h2 class="titulo">Jornada laboral y experiencia</h2>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="width: 50%;">
                    <div class="grafica">
                        <img src="{{ $graficas['jornadaLaboral'] }}" alt="Gráfica de Jornada Laboral">
                    </div>
                    <div class="grafica">
                        <img src="{{ $graficas['experiencia'] }}" alt="Gráfica de Experiencia">
                    </div>
                </div>
                <div style="width: 50%;">
                    <div class="grafica">
                        <img src="{{ $graficas['rotacionTurnos'] }}" alt="Gráfica de Rotación de Turnos">
                    </div>
                    <div class="grafica">
                        <img src="{{ $graficas['tiempoPuesto'] }}" alt="Gráfica de Tiempo en el Puesto">
                    </div>
                </div>
            </div>
        </div>
        <div class="paginacion">Página 6</div>

        <!-- Página 6: Cuestionario para identificar factores de riesgo -->
        <div class="page-break">
            <div class="fondo-gris">
                <h2>CUESTIONARIO PARA IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUAR EL ENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO</h2>
            </div>
            <h2 class="subtitulo">¿Qué se evaluó?</h2>
            <p class="texto">Conoce los aspectos evaluados y la escala para la calificación.</p>
            <h2 class="subtitulo">Categorías evaluadas</h2>
            <p class="texto"><strong>Ambiente de trabajo:</strong> 1 dominio / 3 dimensiones / 5 preguntas</p>
            <p class="texto"><strong>Organización del tiempo de trabajo:</strong> 1 dominio / 2 dimensiones / 4 preguntas</p>
            <p class="texto"><strong>Entorno Organizacional:</strong> 1 dominio / 3 dimensiones / 6 preguntas</p>
            <p class="texto"><strong>Factores propios de la actividad:</strong> 1 dominio / 2 dimensiones / 4 preguntas</p>
            <p class="texto"><strong>Liderazgo y relaciones en el trabajo:</strong> 1 dominio / 3 dimensiones / 5 preguntas</p>
            <h2 class="subtitulo">Escala de la encuesta</h2>
            <p class="texto">Esta encuesta utiliza el sistema de calificación de escala del 0 al 5 en donde el usuario determina qué tan de acuerdo está con la afirmación que se le presenta tal como se muestra a continuación.</p>
            <table class="tabla-escala">
                <thead>
                    <tr>
                        <th>Valor</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0</td>
                        <td>Nunca</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Casi Nunca</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Algunas Veces</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Frecuentemente</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Casi Siempre</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Siempre</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="paginacion">Página 7</div>

        <!-- Página 7: Resultados Generales -->
        <div class="page-break">
            <h2 class="titulo">Resultados Generales</h2>
            <p class="texto">Los resultados se muestran por categoría de evaluación y por cada dominio, mostrando el promedio final de todas las encuestas contestadas.</p>
            <!-- Aquí irían las gráficas de barras invertidas -->
        </div>
        <div class="paginacion">Página 8</div>

        <!-- Página 8: Resultado general de Departamento -->
        <div class="page-break">
            <h2 class="titulo">Resultado general de Departamento</h2>
            <p class="texto">Los resultados de esta página muestran a cada departamento con su respectiva calificación general. Si desea conocer más a fondo la situación del departamento, sugerimos consultar el reporte de dicho departamento.</p>
            <!-- Aquí iría la gráfica de departamento y puntaje -->
        </div>
        <div class="paginacion">Página 9</div>

        <!-- Página 9: Desglosamiento de las preguntas -->
        <div class="page-break">
            <h2 class="titulo">Desglosamiento de las preguntas</h2>
            <p class="texto">Se muestran las categorías, los dominios y las preguntas que integran este cuestionario junto con una tabla que muestra cuántas veces fue seleccionada cada opción según cada pregunta, para la mejor interpretación de la norma 035.</p>
            <!-- Aquí irían las tablas con el desglose de las preguntas -->
        </div>
        <div class="paginacion">Página 10</div>

        <!-- Página 10: Conclusión -->
        <div class="page-break">
            <h2 class="titulo">Conclusión</h2>
            <p class="texto">De acuerdo a los resultados del diagnóstico, se generan las siguientes conclusiones para servir de apoyo en el plan de acción a tomar para prevenir los factores del riesgo psicosocial.</p>
            <h2 class="subtitulo">Nivel de riesgo</h2>
            <!-- Aquí iría la imagen del nivel de riesgo -->
            <h2 class="subtitulo">Criterios para la toma de decisiones</h2>
            <p class="texto">Aquí se pone según viene en la norma 035 del Word.</p>
        </div>
        <div class="paginacion">Página 11</div>
    </body>
</html>
