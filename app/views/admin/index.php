<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMarket - Panel de Administrador</title>
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
                <h1 class="text-xl font-bold text-gray-100">Panel de Administrador</h1>
                <div class="flex items-center space-x-2">
                    <div class="hidden sm:flex items-center space-x-2 px-3 py-1.5 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/20">
                        <i class="fas fa-shield-halved text-sm"></i>
                        <span class="text-sm font-medium"><?= htmlspecialchars($currentUser['rol']) ?></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-100 mb-2">Bienvenido, <?= htmlspecialchars($currentUser['name']) ?></h2>
                <p class="text-gray-400">Gestiona usuarios, categorías, negocios y configuraciones del sistema.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <!-- Total Usuarios -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Usuarios</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalUsers) ?></h3>
                    <p class="text-sm text-gray-400">Total registrados</p>
                </div>

                <!-- Categorías Activas -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tags text-green-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Categorías</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalCategories) ?></h3>
                    <p class="text-sm text-gray-400">Activas en sistema</p>
                </div>

                <!-- Negocios Registrados -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-store text-yellow-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Negocios</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalBusinesses) ?></h3>
                    <p class="text-sm text-gray-400">Registrados activos</p>
                </div>

                <!-- Productos -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-purple-500 text-xl"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-100 mb-1"><?= number_format($totalProducts) ?></h3>
                    <p class="text-sm text-gray-400">Publicados total</p>
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-100">Usuarios Registrados Recientemente</h2>
                    <i class="fas fa-history text-gray-500"></i>
                </div>
                <div class="space-y-4">
                    <?php if (empty($recentUsers)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-600 text-4xl mb-3"></i>
                            <p class="text-gray-400">No hay actividad reciente</p>
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
</body>
</html>