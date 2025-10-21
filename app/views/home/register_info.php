<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Registro - AgroMarket</title>
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
<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 text-gray-900 antialiased">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2">
                    <i class="fas fa-seedling text-green-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-900">AgroMarket</span>
                </a>
                <div class="flex items-center space-x-3">
                    <a href="/" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Volver al Inicio
                    </a>
                    <a href="/login" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 pb-16 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-sky-500 rounded-2xl mb-6 shadow-lg">
                    <i class="fas fa-user-plus text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    ¿Cómo Registrarse como Productor?
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Para formar parte de AgroMarket, es necesario contactar con la Unidad de Agricultura y Ganadería de la Alcaldía de Santa Ana
                </p>
            </div>

            <!-- Process Steps -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                    <i class="fas fa-list-ol text-blue-600 mr-3"></i>
                    Proceso de Registro
                </h2>

                <div class="space-y-6">
                    <!-- Step 1 -->
                    <div class="flex items-start space-x-4 p-6 bg-blue-50 rounded-xl border border-blue-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            1
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Contacta con la Unidad de Agricultura</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Comunícate con la Unidad de Agricultura y Ganadería de la Alcaldía de Santa Ana para solicitar información sobre el proceso de registro.
                            </p>
                            <div class="flex flex-wrap gap-3 text-sm">
                                <a href="tel:24320337" class="inline-flex items-center px-4 py-2 bg-white border border-blue-300 text-blue-700 rounded-lg hover:bg-blue-50 transition-colors">
                                    <i class="fas fa-phone mr-2"></i>
                                    2432-0337
                                </a>
                                <a href="https://wa.me/50370929496" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    7092-9496
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-4 p-6 bg-sky-50 rounded-xl border border-sky-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-sky-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            2
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Verificación de Requisitos</h3>
                            <p class="text-gray-700 leading-relaxed">
                                El personal de la Unidad verificará que cumples con los requisitos necesarios para ser parte de la plataforma. Esto incluye ser productor agrícola activo en el municipio de Santa Ana.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-4 p-6 bg-indigo-50 rounded-xl border border-indigo-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            3
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Habilitación de Cuenta</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Una vez verificados los requisitos, la Unidad de Agricultura habilitará tu cuenta y recibirás tus credenciales de acceso para comenzar a publicar tus productos.
                            </p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start space-x-4 p-6 bg-green-50 rounded-xl border border-green-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            4
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Comienza a Anunciar</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Con tu cuenta activa podrás crear tu perfil de negocio, publicar tus productos agrícolas y conectar con la comunidad de Santa Ana.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requirements Card -->
            <div class="bg-gradient-to-br from-blue-600 to-sky-600 rounded-2xl shadow-xl p-8 md:p-12 text-white mb-8">
                <h2 class="text-2xl font-bold mb-6 flex items-center">
                    <i class="fas fa-clipboard-check mr-3"></i>
                    Requisitos Básicos
                </h2>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-300 mt-1 flex-shrink-0"></i>
                        <span>Ser productor agrícola activo en el municipio de Santa Ana</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-300 mt-1 flex-shrink-0"></i>
                        <span>Contar con producción agrícola para comercializar</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-300 mt-1 flex-shrink-0"></i>
                        <span>Documentos de identificación personal</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-300 mt-1 flex-shrink-0"></i>
                        <span>Compromiso con prácticas agrícolas responsables</span>
                    </li>
                </ul>
                <p class="mt-6 text-blue-100 text-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    Los requisitos específicos serán verificados por la Unidad de Agricultura y Ganadería
                </p>
            </div>

            <!-- Contact Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-2xl mb-6">
                        <i class="fas fa-headset text-3xl text-blue-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">¿Necesitas Ayuda?</h2>
                    <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                        Estamos aquí para ayudarte. Contacta con la Unidad de Agricultura y Ganadería de la Alcaldía Municipal de Santa Ana.
                    </p>
                    
                    <div class="grid md:grid-cols-2 gap-4 max-w-lg mx-auto mb-6">
                        <div class="bg-gray-50 rounded-xl p-4 text-left">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-phone text-blue-600 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Teléfono</p>
                                    <p class="font-semibold text-gray-900">2432-0337</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-left">
                            <div class="flex items-start space-x-3">
                                <i class="fab fa-whatsapp text-green-600 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">WhatsApp</p>
                                    <p class="font-semibold text-gray-900">7092-9496</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl p-4 text-left border border-blue-100">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-clock text-blue-600 mt-1"></i>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Horario de Atención</p>
                                <p class="font-semibold text-gray-900">Lunes a Viernes: 8:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-12">
                <a href="tel:24320337" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-sky-600 hover:from-blue-700 hover:to-sky-700 text-white font-semibold rounded-xl transition-all hover:shadow-xl hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>
                    Llamar Ahora
                </a>
                <a href="https://wa.me/50370929496" target="_blank" class="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all hover:shadow-xl hover:scale-105">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Contactar por WhatsApp
                </a>
                <a href="/" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-xl border-2 border-gray-200 transition-all hover:border-blue-300 hover:shadow-lg">
                    <i class="fas fa-home mr-2"></i>
                    Volver al Inicio
                </a>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <i class="fas fa-seedling text-green-500 text-2xl"></i>
                    <span class="text-xl font-bold text-white">AgroMarket</span>
                </div>
                <p class="text-sm text-gray-400 mb-4">
                    Plataforma municipal para unir productores agrícolas con la comunidad de Santa Ana
                </p>
                <div class="border-t border-gray-800 pt-4">
                    <p class="text-sm text-gray-400">
                        &copy; 2025 Alcaldía Municipal de Santa Ana. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
