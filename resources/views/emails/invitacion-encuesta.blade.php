<!-- resources/views/emails/invitacion-encuesta.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitación a Encuesta</title>
</head>
<body>
    <h1>¡Hola!</h1>
    <p>{{ nl2br(e($mensaje)) }}</p>
    <p>Gracias por tu participación.</p>
</body>
</html>