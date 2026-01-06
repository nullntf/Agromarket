<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketUnit - Sesión Cerrada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/producer.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-center">
        <div class="mb-6">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Sesión Cerrada</h1>
            <p class="text-gray-600">Has cerrado sesión exitosamente. Redirigiendo...</p>
        </div>

        <div class="space-y-4">
            <a href="<?= BASE_URL ?>/" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Ir al Inicio
            </a>
            <a href="<?= BASE_URL ?>/login" class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Iniciar Sesión Nuevamente
            </a>
        </div>

        <script>
            // Redirigir automáticamente después de 3 segundos
            setTimeout(function() {
                window.location.href = '/';
            }, 3000);
        </script>
    </div>
</body>
</html>
