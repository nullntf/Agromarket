<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMarket - <?php _e('home.title', 'Plataforma Agrícola Municipal de Santa Ana'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Sora', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Geist', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-seedling text-green-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-900">AgroMarket</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#inicio" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors"><?php _e('home.nav.home', 'Inicio'); ?></a>
                    <a href="#como-funciona" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors"><?php _e('home.nav.how_it_works', 'Cómo Funciona'); ?></a>
                    <a href="#beneficios" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors"><?php _e('home.nav.benefits', 'Beneficios'); ?></a>
                    <a href="/tienda" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors"><?php _e('home.nav.store', 'Tienda'); ?></a>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Language Switcher -->
                    <div id="language-switcher" class="relative">
                        <button id="language-button" 
                                class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition-colors focus:outline-none"
                                aria-expanded="false">
                            <i class="fas fa-globe text-lg"></i>
                            <span class="text-sm font-medium"><?php echo strtoupper(isset($_SESSION['language']) && $_SESSION['language'] === 'en' ? 'EN' : 'ES'); ?></span>
                            <i id="language-chevron" class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200"></i>
                        </button>
                        <div id="language-dropdown" 
                             class="hidden absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            <a href="?lang=es" 
                               class="language-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                                    <img src="https://flagcdn.com/w20/es.png" alt="Español" class="w-full h-full object-cover">
                                </span>
                                Español
                            </a>
                            <a href="?lang=en" 
                               class="language-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                                    <img src="https://flagcdn.com/w20/gb.png" alt="English" class="w-full h-full object-cover">
                                </span>
                                English
                            </a>
                        </div>
                    </div>
                    
                    <a href="/login" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        <?php _e('home.nav.login', 'Iniciar Sesión'); ?>
                    </a>
                    <a href="/tienda" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <?php _e('home.nav.view_products', 'Ver Productos'); ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="relative pt-24 pb-20 md:pt-32 md:pb-32 overflow-hidden">
        <!-- Background gradients -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-sky-50"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-sky-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-8 max-w-4xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-sky-100 border border-blue-200 text-blue-700 text-sm font-semibold rounded-full shadow-sm">
                    <i class="fas fa-building mr-2"></i>
                    <?php _e('home.hero.municipality', 'Alcaldía Municipal de Santa Ana'); ?>
                    <span class="ml-2 px-2 py-0.5 bg-blue-600 text-white text-xs rounded-full"><?php _e('home.hero.official', 'Oficial'); ?></span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                    <span class="block"><?php _e('home.hero.title', 'Plataforma Agrícola'); ?></span>
                    <span class="block bg-gradient-to-r from-blue-600 to-sky-600 bg-clip-text text-transparent"><?php _e('home.hero.subtitle', 'Municipal de Santa Ana'); ?></span>
                </h1>
                
                <!-- Description -->
                <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                    <?php _e('home.hero.description', 'Unimos productores locales con la comunidad. Una iniciativa de la Unidad de Agricultura y Ganadería para fortalecer el sector agrícola del municipio.'); ?>
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                    <a href="/tienda" class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-sky-600 hover:from-blue-700 hover:to-sky-700 text-white font-semibold rounded-xl transition-all hover:shadow-xl hover:scale-105">
                        <i class="fas fa-store mr-2"></i>
                        <?php _e('home.hero.cta.explore', 'Explorar Tienda'); ?>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#como-funciona" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-xl border-2 border-gray-200 transition-all hover:border-blue-300 hover:shadow-lg">
                        <i class="fas fa-info-circle mr-2"></i>
                        <?php _e('home.hero.cta.how_it_works', 'Cómo Funciona'); ?>
                    </a>
                </div>
                
                <!-- Trust indicators -->
                <div class="grid grid-cols-3 gap-8 pt-12 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-2xl mb-3">
                            <i class="fas fa-users text-2xl text-blue-600"></i>
                        </div>
                        <div class="text-sm text-gray-600"><?php _e('home.hero.stats.producers', 'Productores Locales'); ?></div>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-2xl mb-3">
                            <i class="fas fa-seedling text-2xl text-green-600"></i>
                        </div>
                        <div class="text-sm text-gray-600"><?php _e('home.hero.stats.products', 'Productos Frescos'); ?></div>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-100 rounded-2xl mb-3">
                            <i class="fas fa-shield-alt text-2xl text-sky-600"></i>
                        </div>
                        <div class="text-sm text-gray-600"><?php _e('home.hero.stats.support', 'Respaldo Municipal'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Como Funciona -->
    <section id="como-funciona" class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"><?php _e('home.how_it_works.title', 'Cómo Funciona'); ?></h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto"><?php _e('home.how_it_works.subtitle', 'Proceso simple y transparente para unir productores con la comunidad'); ?></p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors">
                        <i class="fas fa-search text-2xl text-blue-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3"><?php _e('home.how_it_works.steps.explore.title', 'Explora Productos'); ?></h3>
                    <p class="text-gray-600 leading-relaxed"><?php _e('home.how_it_works.steps.explore.description', 'Navega por la selección de productos agrícolas frescos de los productores de Santa Ana'); ?></p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-sky-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-sky-600 transition-colors">
                        <i class="fas fa-handshake text-2xl text-sky-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3"><?php _e('home.how_it_works.steps.contact.title', 'Contacta al Productor'); ?></h3>
                    <p class="text-gray-600 leading-relaxed"><?php _e('home.how_it_works.steps.contact.description', 'Comunícate directamente con los productores locales para consultar disponibilidad y precios'); ?></p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 transition-colors">
                        <i class="fas fa-truck text-2xl text-indigo-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3"><?php _e('home.how_it_works.steps.receive.title', 'Recibe tus Productos'); ?></h3>
                    <p class="text-gray-600 leading-relaxed"><?php _e('home.how_it_works.steps.receive.description', 'Coordina la entrega o recogida de tus productos frescos directamente del productor'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section id="beneficios" class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900"><?php _e('home.benefits.title', 'Beneficios para Todos'); ?></h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1"><?php _e('home.benefits.items.fresh_products.title', 'Productos Frescos'); ?></h4>
                                <p class="text-gray-600"><?php _e('home.benefits.items.fresh_products.description', 'Directamente del campo a tu mesa, sin intermediarios'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-sky-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1"><?php _e('home.benefits.items.fair_prices.title', 'Precios Justos'); ?></h4>
                                <p class="text-gray-600"><?php _e('home.benefits.items.fair_prices.description', 'Mejores precios para la comunidad y productores locales'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1"><?php _e('home.benefits.items.municipal_support.title', 'Apoyo Municipal'); ?></h4>
                                <p class="text-gray-600"><?php _e('home.benefits.items.municipal_support.description', 'Iniciativa de la Alcaldía de Santa Ana para fortalecer el sector agrícola'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-violet-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-violet-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1"><?php _e('home.benefits.items.transparency.title', 'Transparencia Total'); ?></h4>
                                <p class="text-gray-600"><?php _e('home.benefits.items.transparency.description', 'Conoce el origen de cada producto de nuestros agricultores'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-600 to-sky-700 rounded-2xl p-8 md:p-12 text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-6"><?php _e('home.benefits.producer_cta.title', '¿Eres Productor de Santa Ana?'); ?></h3>
                    <p class="text-blue-50 mb-8 leading-relaxed"><?php _e('home.benefits.producer_cta.description', 'Únete a esta iniciativa municipal y forma parte de la red de productores agrícolas de Santa Ana. Gestiona tu negocio de forma fácil y profesional con el respaldo de la Alcaldía.'); ?></p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-circle-check text-green-300"></i>
                            <span><?php _e('home.benefits.producer_cta.benefits.business_profile', 'Crea tu perfil de negocio'); ?></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-circle-check text-green-300"></i>
                            <span><?php _e('home.benefits.producer_cta.benefits.publish_products', 'Publica tus productos'); ?></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-circle-check text-green-300"></i>
                            <span><?php _e('home.benefits.producer_cta.benefits.manage_inventory', 'Gestiona tu inventario'); ?></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-circle-check text-green-300"></i>
                            <span><?php _e('home.benefits.producer_cta.benefits.connect_community', 'Conecta con la comunidad local'); ?></span>
                        </li>
                    </ul>
                    <a href="/registro/informacion" class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-blue-700 font-semibold rounded-lg transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>
                        <?php _e('home.benefits.producer_cta.register_button', 'Registrarse Ahora'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 text-gray-300 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Footer Content -->
            <div class="grid md:grid-cols-12 gap-8 mb-12">
                <!-- Brand Section -->
                <div class="md:col-span-4">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-seedling text-green-500 text-2xl"></i>
                        <span class="text-2xl font-bold text-white">AgroMarket</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">
                        <?php _e('home.footer.description', 'Plataforma municipal para unir productores agrícolas con la comunidad de Santa Ana.'); ?>
                    </p>
                    <div class="bg-gradient-to-r from-blue-900/50 to-sky-900/50 border border-blue-800/50 rounded-lg p-4">
                        <p class="text-xs text-blue-300 mb-1"><?php _e('home.footer.initiative_label', 'Una iniciativa de:'); ?></p>
                        <p class="text-sm text-white font-semibold"><?php _e('home.footer.municipality', 'Alcaldía Municipal de Santa Ana'); ?></p>
                        <p class="text-xs text-gray-400"><?php _e('home.footer.agriculture_unit', 'Unidad de Agricultura y Ganadería'); ?></p>
                    </div>
                </div>
                
                <!-- Alcaldía Info -->
                <div class="md:col-span-4">
                    <h4 class="text-white font-semibold mb-4 flex items-center">
                        <i class="fas fa-building text-blue-400 mr-2"></i>
                        <?php _e('home.footer.municipality', 'Alcaldía de Santa Ana'); ?>
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1 flex-shrink-0"></i>
                            <span>Av. Independencia Sur entre Calle Libertad y 2da Calle Poniente, Santa Ana</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-phone text-blue-400 flex-shrink-0"></i>
                            <span>2402-7500</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-clock text-blue-400 mt-1 flex-shrink-0"></i>
                            <div>
                                <div><?php _e('home.footer.hours.weekdays', 'Lunes a Viernes: 8:00 AM - 4:00 PM'); ?></div>
                                <div class="text-gray-500"><?php _e('home.footer.hours.weekend', 'Cerrado fines de semana'); ?></div>
                            </div>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-globe text-blue-400 flex-shrink-0"></i>
                            <a href="https://santaana.gob.sv/amsa/" target="_blank" class="hover:text-blue-400 transition-colors">santaana.gob.sv</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Unidad de Agricultura -->
                <div class="md:col-span-4">
                    <h4 class="text-white font-semibold mb-4 flex items-center">
                        <i class="fas fa-tractor text-green-400 mr-2"></i>
                        <?php _e('home.footer.agriculture', 'Agricultura y Ganadería'); ?>
                    </h4>
                    <ul class="space-y-3 text-sm mb-6">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-phone text-green-400 flex-shrink-0"></i>
                            <span>2432-0337</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fab fa-whatsapp text-green-400 flex-shrink-0"></i>
                            <span>7092-9496</span>
                        </li>
                    </ul>
                    
                    <div class="space-y-2 text-sm text-gray-400">
                        <p class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span><?php _e('home.footer.services.technical_support', 'Asistencia técnica agrícola'); ?></span>
                        </p>
                        <p class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span><?php _e('home.footer.services.animal_health', 'Programas de salud animal'); ?></span>
                        </p>
                        <p class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span><?php _e('home.footer.services.supplies', 'Entrega de insumos'); ?></span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Social Media & Links -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <!-- Links -->
                    <div class="flex flex-wrap justify-center gap-6 text-sm">
                        <a href="/tienda" class="hover:text-blue-400 transition-colors"><?php _e('home.footer.links.store', 'Tienda'); ?></a>
                        <a href="#como-funciona" class="hover:text-blue-400 transition-colors"><?php _e('home.footer.links.how_it_works', 'Cómo Funciona'); ?></a>
                        <a href="#beneficios" class="hover:text-blue-400 transition-colors"><?php _e('home.footer.links.benefits', 'Beneficios'); ?></a>
                        <a href="/login" class="hover:text-blue-400 transition-colors"><?php _e('home.footer.links.login', 'Iniciar Sesión'); ?></a>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-400"><?php _e('home.footer.follow_us', 'Síguenos:'); ?></span>
                        <a href="https://www.facebook.com/SantaAnaAlcaldia" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/alcaldia_sa/" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://x.com/alcaldia_SA" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-sky-500 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="https://www.tiktok.com/@alcaldiasa" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-gray-700 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-6 text-center">
                <p class="text-sm text-gray-400">
                    &copy; <?php echo date('Y'); ?> <?php _e('home.footer.copyright', 'Alcaldía Municipal de Santa Ana. Todos los derechos reservados.'); ?>
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Manejo del menú de idiomas con JavaScript puro
        document.addEventListener('DOMContentLoaded', function() {
            const languageButton = document.getElementById('language-button');
            const languageDropdown = document.getElementById('language-dropdown');
            const languageChevron = document.getElementById('language-chevron');
            const languageOptions = document.querySelectorAll('.language-option');
            
            if (languageButton && languageDropdown) {
                // Alternar menú desplegable
                languageButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = languageDropdown.classList.toggle('hidden');
                    languageChevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
                    languageButton.setAttribute('aria-expanded', !isOpen);
                });
                
                // Cerrar menú al hacer clic en una opción
                languageOptions.forEach(option => {
                    option.addEventListener('click', function() {
                        languageDropdown.classList.add('hidden');
                        languageChevron.style.transform = 'rotate(0deg)';
                        languageButton.setAttribute('aria-expanded', 'false');
                    });
                });
                
                // Cerrar menú al hacer clic fuera
                document.addEventListener('click', function(e) {
                    if (!languageButton.contains(e.target) && !languageDropdown.contains(e.target)) {
                        languageDropdown.classList.add('hidden');
                        languageChevron.style.transform = 'rotate(0deg)';
                        languageButton.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Prevenir que el clic en el menú lo cierre
                languageDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>
</body>
</html>