<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        @page {
            margin-left: 0.8cm !important;
            margin-right: 0.8cm !important;
            margin-top: 0.8cm !important;
            margin-bottom: 0.8cm !important;
        }

        html, body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
        }

        .header h1 {
            font-size: 32px;
            color: #0e0138;
            padding-bottom: 10px;
            display: inline-block;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-align: left;
        }

        .header {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .capacitacion {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #0056b3;
        }

        .capacitacion:nth-child(even) {
            background-color: #f8f9fa; /* Alternar colores */
        }

        .capacitacion h2 {
            font-size: 28px;
            color: #000;
            margin: 0 0 10px 0;
            font-weight: bold;
            text-transform: capitalize;
        }

        .info {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px dashed #ddd;
            font-style: italic;
        }

        .info span {
            margin: 0 10px;
        }

        .label {
            font-weight: bold;
            color: #0056b3;
        }

        .bold {
            font-weight: bold;
            color: #333;
        }

        p {
            margin: 8px 0;
            line-height: 1.6;
            color: #555;
        }

        @page {
            margin: 1cm;
        }

        .tarjetas {
            width: 100%;
            margin: 0 auto;
            padding: 40px;
        }

        .page-break {
            page-break-before: always;
        }

        .titulo {
            color: rgb(7, 65, 107);
            font-size: 20pt;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 1cm;
        }

        .separador {
            border-top: 4px solid rgb(7, 65, 107);
            margin-bottom: 1cm;
        }

        .contenedor {
            height: 100vh;
            width: 100vw;
            /* Anchura Carta en puntos */
            margin: 0% !important;
        }

        .full-page {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            /* Coloca la imagen detrás del contenido */
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <img src="{{ asset('img/doc.png') }}" class="full-page" alt="portada">
         <!--<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOa-NXzx-mmUk3IdQOC7ep03bvzV1ZjoHzEw&s" alt="Logo" style="position: absolute; top: 3cm; left: 9cm; width: 150px; height: 110px;"> -->
        <div
            style="position: absolute; top: 11cm; left: 0.5cm; color: rgb(7, 65, 107); font-size: 15pt; font-family: 'Nourd', sans-serif;">
            Año de capacitación: {{ $selectedYear }}
        </div>
        <div style="position: absolute; top: 12cm; left: 0.5cm;">
            <div style="color: rgb(7, 65, 107); font-size: 36pt; font-family: 'Nourd', sans-serif; font-weight: 700;">
                Reporte de Capacitación
            </div>
        </div>
        <div style="position: absolute; top: 19.5cm; left: 11cm;">
            <div style="color: rgb(7, 65, 107); font-size: 18pt; font-family: 'Nourd', sans-serif; font-weight: 700;">
                Reporte de Capacitaciones Individuales
            </div>
            <div style="color: rgb(7, 65, 107); font-size: 15pt; font-family: 'Nourd', sans-serif;">
                {{ $usuario->name }}
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div style="font-family: 'Arial', sans-serif; margin: 0; padding: 20px; background-color: #ffffff;">
        <h2 class="titulo">Información del Evaluado</h2>
        <div class="separador"></div>

        <div>
            @if($usuario->tipo_user == 'Becario')
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background: url('{{ asset('img/fondo.jpg') }}') no-repeat center center/cover;">
                    <!-- Tarjeta contenedora -->
                    <div style="display: flex; justify-content: center; align-items: center; height: 90vh; width: 80%; margin-left: 10%; background-color: rgb(255, 255, 255) border-radius: 15px; border: 2px">
                        
                        <!-- Imagen de usuario flotante arriba -->
                        <div style="justify-items: center; justify-content: center; margin-left: 40%">
                            <img src="https://www.shutterstock.com/image-photo/attractive-elegant-young-asian-business-260nw-2401137563.jpg" class="imagenPerfil"
                                alt="Foto" style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid white; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
                        </div>
                        
                        <!-- Información principal -->
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                            <tr>
                                <td style="padding: 10px; text-align: left; text-align: center; ">
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Nombre:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $usuario->name }}</p>
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Clave Becario:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $becario->clave_becario }}</p>
                                </td>
                            </tr>
                        </table>
                
                        <!-- Tarjeta de información adicional -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center; background: #e3efff; margin-top: 15px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">RFC:</p>
                                        <p style="color: #333;">{{ $becario->rfc }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">CURP:</p>
                                        <p style="color: #333;">{{ $becario->curp }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Teléfono:</p>
                                        <p style="color: #333;">{{ $becario->numero_celular }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Sexo:</p>
                                        <p style="color: #333;">
                                            {{ $becario->sexo == 'F' ? 'Femenino' : ($becario->sexo == 'M' ? 'Masculino' : $becario->sexo) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Ocupación:</p>
                                        <p style="color: #333;">{{ $becario->ocupacion }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Puesto:</p>
                                        <p style="color: #333;">
                                            {{ $usuario->puesto->nombre_puesto }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                
                        <!-- Tarjeta de empresa -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center;">
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Empresa:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->empresa->nombre }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Sucursal:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->sucursal->nombre_sucursal }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Departamento:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->departamento->nombre_departamento }}</p>
                        </div>
                    </div>
                </div>

            @elseif($usuario->tipo_user == 'Trabajador')
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background: url('{{ asset('img/fondo.jpg') }}') no-repeat center center/cover;">
                    <!-- Tarjeta contenedora -->
                    <div style="display: flex; justify-content: center; align-items: center; height: 90vh; width: 80%; margin-left: 10%; background-color: rgb(255, 255, 255) border-radius: 15px; border: 2px">
                        
                        <!-- Imagen de usuario flotante arriba -->
                        <div style="justify-items: center; justify-content: center; margin-left: 40%">
                            <img src="https://www.shutterstock.com/image-photo/attractive-elegant-young-asian-business-260nw-2401137563.jpg" class="imagenPerfil"
                                alt="Foto" style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid white; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
                        </div>
                        
                        <!-- Información principal -->
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                            <tr>
                                <td style="padding: 10px; text-align: left; text-align: center; ">
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Nombre:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $usuario->name }}</p>
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Clave Trabajador:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $trabajador->clave_trabajador }}</p>
                                </td>
                            </tr>
                        </table>
                
                        <!-- Tarjeta de información adicional -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center; background: #e3efff; margin-top: 15px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">RFC:</p>
                                        <p style="color: #333;">{{ $trabajador->rfc }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">CURP:</p>
                                        <p style="color: #333;">{{ $trabajador->curp }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Teléfono:</p>
                                        <p style="color: #333;">{{ $trabajador->numero_celular }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Sexo:</p>
                                        <p style="color: #333;">
                                            {{ $trabajador->sexo == 'F' ? 'Femenino' : ($trabajador->sexo == 'M' ? 'Masculino' : $trabajador->sexo) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Ocupación:</p>
                                        <p style="color: #333;">{{ $trabajador->ocupacion }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Puesto:</p>
                                        <p style="color: #333;">
                                            {{ $usuario->puesto->nombre_puesto }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                
                        <!-- Tarjeta de empresa -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center;">
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Empresa:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->empresa->nombre }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Sucursal:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->sucursal->nombre_sucursal }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Departamento:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->departamento->nombre_departamento }}</p>
                        </div>
                    </div>
                </div>
            
            @elseif($usuario->tipo_user == 'Practicante')
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background: url('{{ asset('img/fondo.jpg') }}') no-repeat center center/cover;">
                    <!-- Tarjeta contenedora -->
                    <div style="display: flex; justify-content: center; align-items: center; height: 90vh; width: 80%; margin-left: 10%; background-color: rgb(255, 255, 255) border-radius: 15px; border: 2px">
                        
                        <!-- Imagen de usuario flotante arriba -->
                        <div style="justify-items: center; justify-content: center; margin-left: 40%">
                            <img src="https://www.shutterstock.com/image-photo/attractive-elegant-young-asian-business-260nw-2401137563.jpg" class="imagenPerfil"
                                alt="Foto" style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid white; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
                        </div>
                        
                        <!-- Información principal -->
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                            <tr>
                                <td style="padding: 10px; text-align: left; text-align: center; ">
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Nombre:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $usuario->name }}</p>
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Clave Practicante:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $practicante->clave_practicante }}</p>
                                </td>
                            </tr>
                        </table>
                
                        <!-- Tarjeta de información adicional -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center; background: #e3efff; margin-top: 15px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">RFC:</p>
                                        <p style="color: #333;">{{ $practicante->rfc }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">CURP:</p>
                                        <p style="color: #333;">{{ $practicante->curp }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Teléfono:</p>
                                        <p style="color: #333;">{{ $practicante->numero_celular }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Sexo:</p>
                                        <p style="color: #333;">
                                            {{ $practicante->sexo == 'F' ? 'Femenino' : ($practicante->sexo == 'M' ? 'Masculino' : $practicante->sexo) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Ocupación:</p>
                                        <p style="color: #333;">{{ $practicante->ocupacion }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Puesto:</p>
                                        <p style="color: #333;">
                                            {{ $usuario->puesto->nombre_puesto }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                
                        <!-- Tarjeta de empresa -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center;">
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Empresa:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->empresa->nombre }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Sucursal:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->sucursal->nombre_sucursal }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Departamento:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->departamento->nombre_departamento }}</p>
                        </div>
                    </div>
                </div>

            @elseif($usuario->tipo_user == 'Instructor')
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background: url('{{ asset('img/fondo.jpg') }}') no-repeat center center/cover;">
                    <!-- Tarjeta contenedora -->
                    <div style="display: flex; justify-content: center; align-items: center; height: 90vh; width: 80%; margin-left: 10%; background-color: rgb(255, 255, 255) border-radius: 15px; border: 2px">
                        
                        <!-- Imagen de usuario flotante arriba -->
                        <div style="justify-items: center; justify-content: center; margin-left: 40%">
                            <img src="https://www.shutterstock.com/image-photo/attractive-elegant-young-asian-business-260nw-2401137563.jpg" class="imagenPerfil"
                                alt="Foto" style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid white; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
                        </div>
                        
                        <!-- Información principal -->
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                            <tr>
                                <td style="padding: 10px; text-align: left; text-align: center; ">
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Nombre:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $usuario->name }}</p>
                                    <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Clave Instructor:</p>
                                    <p style="font-size: 14pt; color: #333;">{{ $instructor->clave_instructor }}</p>
                                </td>
                            </tr>
                        </table>
                
                        <!-- Tarjeta de información adicional -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center; background: #e3efff; margin-top: 15px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">RFC:</p>
                                        <p style="color: #333;">{{ $instructor->rfc }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">CURP:</p>
                                        <p style="color: #333;">{{ $instructor->curp }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Teléfono:</p>
                                        <p style="color: #333;">{{ $instructor->numero_celular }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Sexo:</p>
                                        <p style="color: #333;">
                                            {{ $instructor->sexo == 'F' ? 'Femenino' : ($instructor->sexo == 'M' ? 'Masculino' : $instructor->sexo) }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Ocupación:</p>
                                        <p style="color: #333;">{{ $instructor->ocupacion }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <p style="font-size: 12pt; font-weight: bold; color: #07416B;">Puesto:</p>
                                        <p style="color: #333;">
                                            {{ $usuario->puesto->nombre_puesto }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                
                        <!-- Tarjeta de empresa -->
                        <div style="padding: 8px; border-radius: 10px; text-align: center;">
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Empresa:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->empresa->nombre }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Sucursal:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->sucursal->nombre_sucursal }}</p>
                            <p style="font-size: 14pt; font-weight: bold; color: #07416B;">Departamento:</p>
                            <p style="font-size: 13pt; color: #333;">{{ $usuario->departamento->nombre_departamento }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="page-break"></div>

    <div class="tarjetas">
        <div class="header">
            <h1>Capacitaciones del Año {{ $selectedYear }}</h1>
            <div class="separador"></div>
        </div>

        @foreach ($capacitaciones as $capacitacion)
            <div class="capacitacion">
                <div class="info">
                    <span>Fecha inicio: {{ $capacitacion->fechaIni }}</span>
                    <span>Fecha fin: {{ $capacitacion->fechaFin }}</span>
                </div>
                <h2>{{ $capacitacion->nombreCapacitacion }}</h2>
                <p><span class="bold">Objetivo:</span> {{ $capacitacion->objetivoCapacitacion }}</p>
                <p><span class="bold">Curso:</span> {{ $capacitacion->curso->nombre }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>