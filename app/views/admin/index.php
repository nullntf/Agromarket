<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - <?php _e('admin.dashboard.title'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Sora', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Geist', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-950 text-gray-100 antialiased">
    <?php include 'sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen">
        <!-- Top Header -->
        <header class="sticky top-0 z-30 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-gray-200 text-xl focus:outline-none transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-100"><?php _e('admin.dashboard.title'); ?></h1>
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div id="language-switcher" class="relative">
                        <button id="language-button" 
                                class="flex items-center space-x-1 text-gray-400 hover:text-gray-200 transition-colors focus:outline-none"
                                aria-expanded="false">
                            <i class="fas fa-globe text-lg"></i>
                            <span class="text-sm font-medium"><?php echo strtoupper($this->getLanguage() === 'es' ? 'ES' : 'EN'); ?></span>
                            <i id="language-chevron" class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200"></i>
                        </button>
                        <div id="language-dropdown" 
                             class="hidden absolute right-0 mt-2 w-36 bg-gray-800 rounded-lg shadow-lg border border-gray-700 py-1 z-50">
                            <a href="?lang=es" 
                               class="language-option flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                                <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                                    <img src="https://flagcdn.com/w20/es.png" alt="Español" class="w-full h-full object-cover">
                                </span>
                                Español
                            </a>
                            <a href="?lang=en" 
                               class="language-option flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                                <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                                    <img src="https://flagcdn.com/w20/gb.png" alt="English" class="w-full h-full object-cover">
                                </span>
                                English
                            </a>
                        </div>
                    </div>
                    
                    <!-- View All Users Button -->
                    <div class="hidden sm:flex items-center space-x-2 px-3 py-1.5 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/20">
                        <i class="fas fa-shield-halved text-sm"></i>
                        <a href="/admin/users" class="text-blue-400 hover:text-blue-300 text-sm font-medium"><?php _e('admin.dashboard.view_all_users'); ?></a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-100 mb-2"><?php echo sprintf(_e('welcome') . ', %s', htmlspecialchars($currentUser['name'])); ?></h2>
                <p class="text-gray-400"><?php _e('admin.dashboard.description'); ?></p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <!-- Total Usuarios -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('admin.users.title'); ?></span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalUsers) ?></h3>
                    <p class="text-sm text-gray-400"><?php _e('admin.dashboard.stats.total_registered'); ?></p>
                </div>

                <!-- Categorías Activas -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tags text-green-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('admin.categories.title'); ?></span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalCategories) ?></h3>
                    <p class="text-sm text-gray-400"><?php _e('admin.dashboard.stats.active_in_system'); ?></p>
                </div>

                <!-- Negocios Registrados -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-store text-yellow-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('admin.business.title'); ?></span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalBusinesses) ?></h3>
                    <p class="text-sm text-gray-400"><?php _e('admin.dashboard.stats.active_businesses'); ?></p>
                </div>

                <!-- Productos -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-purple-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('admin.products.title'); ?></span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalProducts) ?></h3>
                    <p class="text-sm text-gray-400"><?php _e('admin.dashboard.stats.total_published'); ?></p>
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-100"><?php _e('admin.dashboard.recent_users'); ?></h2>
                    <i class="fas fa-history text-gray-500"></i>
                </div>
                <div class="space-y-4">
                    <?php if (empty($recentUsers)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-600 text-4xl mb-3"></i>
                            <p class="text-gray-400"><?php _e('admin.dashboard.no_recent_activity'); ?></p>
                        </div>
                    <?php else: ?>
                        <?php 
                        // Función para calcular tiempo relativo
                        function timeAgo($datetime) {
                            $timezone = new DateTimeZone('America/El_Salvador');
                            $now = new DateTime('now', $timezone);
                            $ago = new DateTime($datetime, $timezone);
                            $diff = $now->diff($ago);
                            
                            if ($diff->y > 0) return $diff->y . ' año' . ($diff->y > 1 ? 's' : '');
                            if ($diff->m > 0) return $diff->m . ' mes' . ($diff->m > 1 ? 'es' : '');
                            if ($diff->d > 0) return $diff->d . ' día' . ($diff->d > 1 ? 's' : '');
                            if ($diff->h > 0) return $diff->h . ' hora' . ($diff->h > 1 ? 's' : '');
                            if ($diff->i > 0) return $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '');
                            return 'justo ahora';
                        }
                        
                        // Colores según rol
                        $roleColors = [
                            'master' => 'red',
                            'admin' => 'blue',
                            'producer' => 'green'
                        ];
                        ?>
                        <?php foreach ($recentUsers as $user): ?>
                            <?php 
                            $color = $roleColors[$user['rol']] ?? 'gray';
                            $timeago = timeAgo($user['created_at']);
                            ?>
                            <div class="flex items-start space-x-4 p-4 bg-gray-950/50 rounded-lg border border-gray-800 hover:border-gray-700 transition-colors">
                                <div class="w-2 h-2 mt-2 bg-<?= $color ?>-500 rounded-full flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-4">
                                        <p class="text-gray-300 font-medium truncate">
                                            <?= htmlspecialchars($user['name'] . ' ' . $user['lastname']) ?>
                                        </p>
                                        <span class="text-xs px-2 py-1 bg-<?= $color ?>-500/10 text-<?= $color ?>-400 rounded-md border border-<?= $color ?>-500/20 flex-shrink-0">
                                            <?= htmlspecialchars(ucfirst($user['rol'])) ?>
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1 truncate"><?= htmlspecialchars($user['email']) ?></p>
                                    <p class="text-xs text-gray-600 mt-1">Registrado hace <?= $timeago ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Inicializar Alpine.js
        document.addEventListener('alpine:init', () => {
            // Código de inicialización si es necesario
        });
        
        // Función para el sidebar en móviles
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('lg:flex');
            }
        }
        
        // Manejo del menú de idiomas con JavaScript puro
        document.addEventListener('DOMContentLoaded', function() {
            const languageButton = document.getElementById('language-button');
            const languageDropdown = document.getElementById('language-dropdown');
            const languageChevron = document.getElementById('language-chevron');
            const languageOptions = document.querySelectorAll('.language-option');
            
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
        });
        
        // Asegurar que los colores dinámicos se procesen correctamente
        const colors = ['red', 'blue', 'green', 'yellow', 'purple', 'pink', 'indigo'];
        colors.forEach(color => {
            const elements = document.querySelectorAll(`.bg-${color}-500, .text-${color}-500, .border-${color}-500`);
            elements.forEach(el => {
                el.classList.add(`bg-${color}-500/10`, `text-${color}-500`, `border-${color}-500/20`);
            });
        });
    </script>
</body>
</html>