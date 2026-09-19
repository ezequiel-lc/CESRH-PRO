<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de Asignación de Activo Tecnológico</title>
    <style>
        @page {
            margin: 10mm; /* Márgenes de la página para optimizar el espacio */
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%; /* Usamos 100% para abarcar toda la hoja */
            max-width: 800px; /* Límite máximo para mantener legibilidad */
            margin: 0 auto;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #007bff; /* Fondo azul sólido */
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            overflow: hidden; /* Limpiamos el float */
        }
        .header .logo-container {
            float: left; /* Posicionamos el logo a la izquierda */
            background: #fff; /* Fondo blanco para contraste */
            padding: 5px;
            border-radius: 5px;
            margin-right: 15px; /* Espacio entre logo y título */
        }
        .header img.logo {
            max-height: 60px; /* Tamaño ajustado */
            width: auto;
            vertical-align: middle;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            line-height: 1.2;
            display: inline-block;
            vertical-align: middle;
        }
        .header .subtitle {
            font-size: 14px;
            margin-top: 5px;
            color: #fff;
        }
        .section {
            margin: 15px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #007bff;
            border-radius: 5px;
        }
        .section h2 {
            color: #0056b3;
            font-size: 20px;
            margin: 0 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        .section p {
            margin: 8px 0;
            line-height: 1.6;
        }
        .strong {
            font-weight: bold;
            color: #333;
            display: inline-block;
            width: 150px;
        }
        .images {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .images img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
        .footer .company {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ public_path('ModuloActivo/recursos/logoaf.png') }}" alt="Logo Empresa" class="logo">
            </div>
            <h1>Acta de Asignación de Activo Tecnológico</h1>
            <div class="subtitle">Sistema de Gestión de Activos</div>
        </div>

        <div class="section">
            <h2>Datos del Activo</h2>
            <p><span class="strong">Nombre:</span> {{ $data->activo }}</p>
            <p><span class="strong">Sucursal:</span> {{ $data->sucursal }}</p>
            <p><span class="strong">Empresa:</span> {{ $data->empresa }}</p>
            <p><span class="strong">Estado:</span> {{ $data->status == 1 ? 'Asignado' : 'Devuelto' }}</p>
        </div>

        <div class="section">
            <h2>Datos del Responsable</h2>
            <p><span class="strong">Nombre:</span> {{ $data->usuario }}</p>
            <p><span class="strong">Correo:</span> {{ $data->correo ?? 'No disponible' }}</p>
            <p><span class="strong">Empresa:</span> {{ $data->empresa }}</p>
            <p><span class="strong">Sucursal:</span> {{ $data->sucursal }}</p>
        </div>

        <div class="section">
            <h2>Detalles de la Asignación</h2>
            <p><span class="strong">Fecha Asignación:</span> {{ Carbon\Carbon::parse($data->fecha_asignacion)->format('d/m/Y H:i') }}</p>
            <p><span class="strong">Fecha Devolución:</span> {{ $data->fecha_devolucion ? Carbon\Carbon::parse($data->fecha_devolucion)->format('d/m/Y H:i') : 'No definida' }}</p>
            <p><span class="strong">Observaciones:</span> {{ $data->observaciones }}</p>
        </div>

        @if($data->foto1 || $data->foto2 || $data->foto3)
        <div class="section">
            <h2>Evidencia Fotográfica</h2>
            <div class="images">
                @if($data->foto1)
                    <img src="{{ public_path('storage/' . $data->foto1) }}" alt="Evidencia 1">
                @endif
                @if($data->foto2)
                    <img src="{{ public_path('storage/' . $data->foto2) }}" alt="Evidencia 2">
                @endif
                @if($data->foto3)
                    <img src="{{ public_path('storage/' . $data->foto3) }}" alt="Evidencia 3">
                @endif
            </div>
        </div>
        @endif

        <div class="footer">
            <p>Documento generado el {{ now()->format('d/m/Y H:i') }}</p>
            <p>Sistema de Gestión de Activos - <span class="company">{{ $data->empresa }}</span></p>
        </div>
    </div>
</body>
</html>