<!-- resources/views/layouts/cuestionariosdx035.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cuestionarios DX035')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Contenedor principal -->
    <div class="min-h-screen flex flex-col items-center p-6">
        <!-- Cabecera -->
        <header class="w-full max-w-4xl bg-blue-600 text-white p-6 rounded-t-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center">Cuestionarios DX035</h1>
        </header>

        <!-- Contenido Principal -->
        <main class="w-full max-w-4xl bg-white p-8 rounded-b-lg shadow-lg mt-6">
            {{ $slot }}
        </main>

        <!-- Pie de página -->
        <footer class="mt-6 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} DX035. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>