<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Productor - AgroCompra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Sora', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Geist', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50 text-gray-900 antialiased">
    <?php include 'sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen">
        <!-- Top Navigation Bar -->
        <header class="bg-white/95 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <button onclick="toggleSidebar()" class="lg:hidden text-gray-700 hover:text-green-600 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                        <h1 class="text-xl font-bold text-gray-900">Panel de Productor</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/producer/profile" class="hidden sm:flex items-center space-x-2 text-sm text-gray-700 hover:text-green-600 transition-colors">
                            <i class="fas fa-user-circle text-lg"></i>
                            <span class="font-medium">Mi Cuenta</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bienvenido de nuevo</h2>
                <p class="text-gray-600">Gestiona tu negocio, productos y cuenta personal desde este panel.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Card 1: Productos -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box-open text-green-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">Activo</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Productos Activos</h3>
                    <p class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($activeProductsCount ?? 0) ?></p>
                    <a href="/producer/business" class="inline-flex items-center text-sm text-green-600 hover:text-green-700 font-medium mt-4 group">
                        <span>Ver productos</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Card 2: Negocio -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-store text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Activo</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Mi Negocio</h3>
                    <p class="text-3xl font-bold text-gray-900">1</p>
                    <a href="/producer/business" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium mt-4 group">
                        <span>Gestionar</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Card 3: Perfil -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-circle text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-purple-600 bg-purple-50 px-3 py-1 rounded-full">Completo</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Mi Perfil</h3>
                    <p class="text-3xl font-bold text-gray-900">100%</p>
                    <a href="/producer/profile" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-700 font-medium mt-4 group">
                        <span>Ver perfil</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Acciones Rápidas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="/producer/business" class="flex items-center space-x-4 p-4 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all group">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Agregar Producto</h4>
                            <p class="text-sm text-gray-600">Publica un nuevo producto</p>
                        </div>
                    </a>
                    
                    <a href="/producer/business" class="flex items-center space-x-4 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-edit text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Editar Negocio</h4>
                            <p class="text-sm text-gray-600">Actualiza tu información</p>
                        </div>
                    </a>
                    
                    <a href="/tienda" target="_blank" class="flex items-center space-x-4 p-4 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all group">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-external-link-alt text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Ver Tienda</h4>
                            <p class="text-sm text-gray-600">Vista pública</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Getting Started Guide -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200 p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-lightbulb text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Guía de Inicio</h3>
                        <p class="text-gray-700 mb-4">Sigue estos pasos para comenzar a vender tus productos en AgroCompra:</p>
                        <ul class="space-y-3">
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-600 mt-1"></i>
                                <span class="text-gray-700"><strong>Paso 1:</strong> Completa la información de tu negocio con fotos y descripción atractiva</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-600 mt-1"></i>
                                <span class="text-gray-700"><strong>Paso 2:</strong> Agrega productos con fotos de calidad y precios competitivos</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-600 mt-1"></i>
                                <span class="text-gray-700"><strong>Paso 3:</strong> Comparte tu tienda y comienza a recibir consultas por WhatsApp</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>