<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - Mi Configuración</title>
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
                <h1 class="text-xl font-bold text-gray-100">Mi Configuración</h1>
                <div></div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($success)): ?>
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3 max-w-3xl mx-auto">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>
            
            <div class="max-w-3xl mx-auto">
                <!-- Profile Header -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8 mb-6">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="flex-shrink-0">
                            <?php if (!empty($user['profile_photo'])): ?>
                                <img src="/uploads/profiles/<?= htmlspecialchars($user['profile_photo']) ?>" 
                                     alt="Foto de perfil" 
                                     class="w-24 h-24 rounded-full object-cover border-4 border-gray-800 shadow-lg">
                            <?php else: ?>
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-3xl font-bold border-4 border-gray-800 shadow-lg">
                                    <?= strtoupper(substr($user['name'], 0, 1) . substr($user['lastname'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <h2 class="text-2xl font-bold text-gray-100 mb-2">
                                <?= htmlspecialchars($user['name'] . ' ' . $user['lastname']) ?>
                            </h2>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
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

                <!-- User Details -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8 mb-6">
                    <h3 class="text-lg font-bold text-gray-100 mb-6 flex items-center space-x-2">
                        <i class="fas fa-info-circle text-blue-400"></i>
                        <span>Información Personal</span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-user text-gray-500 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Nombre</p>
                                <p class="text-gray-200 font-medium"><?= htmlspecialchars($user['name']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-user text-gray-500 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Apellido</p>
                                <p class="text-gray-200 font-medium"><?= htmlspecialchars($user['lastname']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800 sm:col-span-2">
                            <i class="fas fa-envelope text-gray-500 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Email</p>
                                <p class="text-gray-200 font-medium break-all"><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                    <a href="/admin/settings/edit" 
                       class="w-full inline-flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold">
                        <i class="fas fa-edit"></i>
                        <span>Editar Mi Perfil</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>