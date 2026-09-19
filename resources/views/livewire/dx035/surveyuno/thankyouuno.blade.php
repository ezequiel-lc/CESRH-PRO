<!-- resources/views/livewire/dx035/surveyuno/thankyouuno.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por responder</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Fuente de Google para un toque moderno -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100">
    <!-- Contenedor principal -->
    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        <!-- Tarjeta de agradecimiento -->
        <div class="bg-white rounded-lg shadow-2xl p-8 max-w-md w-full text-center transform transition-transform hover:scale-105">
            <!-- Icono de check -->
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Título -->
            <h1 class="text-3xl font-bold text-blue-800 mb-4">¡Gracias por responder!</h1>

            <!-- Mensaje dinámico -->
            @if(session('requiereAtencion'))
                <p class="text-lg text-gray-700 mb-6">
                    Tu encuesta ha sido revisada y <span class="font-semibold text-red-600">requiere atención adicional</span>.
                </p>
            @else
                <p class="text-lg text-gray-700 mb-6">
                    Tu encuesta ha sido completada con éxito. ¡Apreciamos tu tiempo!
                </p>
            @endif

            <!-- Botón para volver al inicio -->
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                Volver al inicio
            </a>
        </div>

        <!-- Pie de página -->
        <footer class="mt-8 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} DX035. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>