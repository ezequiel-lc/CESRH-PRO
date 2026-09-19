<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconocimiento</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { margin: 50px; }
        .title { font-size: 24px; font-weight: bold; }
        .details { font-size: 18px; margin-top: 20px; }
        .info { margin-top: 30px; font-size: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Reconocimiento de Participación</h1>
        <p class="details">
            Se certifica que el participante ha completado el curso <strong>{{ $curso->nombre }}</strong><br>
            con una duración de <strong>{{ $curso->horas }} horas</strong>.<br>
            Fecha de inicio: <strong>{{ \Carbon\Carbon::parse($fechas->fechaIni)->format('d/m/Y') }}</strong><br>
            Fecha de fin: <strong>{{ \Carbon\Carbon::parse($fechas->fechaFin)->format('d/m/Y') }}</strong><br>
        </p>

        <div class="info">
            <p>Certificado por: <strong>{{ $user->name }}</strong></p>
        </div>
    </div>
</body>
</html>
