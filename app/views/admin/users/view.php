<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - Ver Usuario</title>
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
    <?php include __DIR__ . '/../sidebar.php'; ?>
    
    <div class="lg:ml-72 min-h-screen">
        <header class="sticky top-0 z-30 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-gray-200 text-xl focus:outline-none transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-100">Detalle de Usuario</h1>
                <a href="/admin/users" class="inline-flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg transition-colors border border-gray-700">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($user) && is_array($user)): ?>
            <div class="max-w-5xl mx-auto">
                <!-- Profile Header Card -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8 mb-6">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                        <!-- Profile Photo -->
                        <div class="flex-shrink-0">
                            <?php if (!empty($user['profile_photo'])): ?>
                                <img src="/uploads/profiles/<?= htmlspecialchars($user['profile_photo']) ?>" 
                                     alt="Foto de perfil" 
                                     class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-gray-800 shadow-lg">
                            <?php else: ?>
                                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-3xl sm:text-4xl font-bold border-4 border-gray-800 shadow-lg">
                                    <?= strtoupper(substr($user['name'], 0, 1) . substr($user['lastname'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- User Info -->
                        <div class="flex-1 text-center sm:text-left">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-100 mb-2">
                                <?= htmlspecialchars($user['name'] . ' ' . $user['lastname']) ?>
                            </h2>
                            <p class="text-gray-400 mb-4"><?= htmlspecialchars($user['email']) ?></p>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                                    <?= $user['rol'] === 'master' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 
                                       ($user['rol'] === 'admin' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : 'bg-green-500/10 text-green-400 border border-green-500/20') ?>">
                                    <i class="fas fa-user-tag mr-2"></i>
                                    <?= htmlspecialchars(ucfirst($user['rol'])) ?>
                                </span>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                                    <?= $user['status'] === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' ?>">
                                    <i class="fas fa-circle text-[6px] mr-2"></i>
                                    <?= $user['status'] === 'active' ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Details Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Personal Information -->
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-gray-100 mb-4 flex items-center space-x-2">
                            <i class="fas fa-user text-blue-400"></i>
                            <span>Información Personal</span>
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                                <i class="fas fa-hashtag text-gray-500 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">ID</p>
                                    <p class="text-gray-200 font-medium"><?= htmlspecialchars($user['id']) ?></p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                                <i class="fas fa-user text-gray-500 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Nombre</p>
                                    <p class="text-gray-200 font-medium"><?= htmlspecialchars($user['name']) ?></p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                                <i class="fas fa-user text-gray-500 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Apellido</p>
                                    <p class="text-gray-200 font-medium"><?= htmlspecialchars($user['lastname']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Account Information -->
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-gray-100 mb-4 flex items-center space-x-2">
                            <i class="fas fa-shield-halved text-purple-400"></i>
                            <span>Información de Cuenta</span>
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                                <i class="fas fa-envelope text-gray-500 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Email</p>
                                    <p class="text-gray-200 font-medium break-all"><?= htmlspecialchars($user['email']) ?></p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                                <i class="fas fa-clock text-gray-500 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Último Login</p>
                                    <p class="text-gray-200 font-medium">
                                        <?= $user['last_login'] ? htmlspecialchars(date('d/m/Y H:i:s', strtotime($user['last_login']))) : 'Nunca' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Timestamps -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-100 mb-4 flex items-center space-x-2">
                        <i class="fas fa-calendar text-green-400"></i>
                        <span>Registro de Fechas</span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-calendar-plus text-gray-500 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Fecha de Creación</p>
                                <p class="text-gray-200 font-medium">
                                    <?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($user['created_at']))) ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-calendar-check text-gray-500 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Última Actualización</p>
                                <p class="text-gray-200 font-medium">
                                    <?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($user['updated_at']))) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="/admin/users/edit/<?= $user['id'] ?>" 
                           class="flex-1 inline-flex items-center justify-center space-x-2 bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                            <i class="fas fa-edit"></i>
                            <span>Editar Usuario</span>
                        </a>
                        <button onclick="window.location.href='/admin/users/toggle/<?= $user['id'] ?>'" 
                                class="flex-1 inline-flex items-center justify-center space-x-2 bg-<?= $user['status'] === 'active' ? 'orange' : 'green' ?>-600 hover:bg-<?= $user['status'] === 'active' ? 'orange' : 'green' ?>-700 text-white px-6 py-3 rounded-lg transition-colors font-medium">
                            <i class="fas fa-power-off"></i>
                            <span><?= $user['status'] === 'active' ? 'Inactivar Usuario' : 'Activar Usuario' ?></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-12 text-center max-w-md mx-auto">
                <i class="fas fa-user-slash text-5xl text-gray-700 mb-4"></i>
                <p class="text-gray-400 mb-6">Usuario no encontrado.</p>
                <a href="/admin/users" class="inline-flex items-center space-x-2 text-blue-400 hover:text-blue-300 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver a Usuarios</span>
                </a>
            </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>