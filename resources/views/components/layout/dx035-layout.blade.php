<!-- resources/views/components/layout/dx035-layout.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuestas Dx035</title>
    <style>
        /* Aquí van tus estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        h1 {
            color: #333;
        }

        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a Dx035</h1>
    </header>

    <div class="container">
        {{-- Aquí se mostrará el contenido del componente Livewire --}}
        {{ $slot }}
    </div>

    <footer>
        <p>&copy; 2025 Dx035. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
