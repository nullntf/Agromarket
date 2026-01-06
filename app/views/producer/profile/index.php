<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - AgroCompra</title>
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
    <?php include __DIR__ . '/../sidebar.php'; ?>
    
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
                        <i class="fas fa-user-circle text-green-600 text-xl"></i>
                        <h1 class="text-xl font-bold text-gray-900">Mi Perfil</h1>
                    </div>
                    <a href="<?= BASE_URL ?>/producer" class="text-sm text-gray-600 hover:text-green-600 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span class="hidden sm:inline">Volver</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Success Message -->
            <?php if (isset($success)): ?>
                <div class="max-w-4xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                        <p class="text-green-800 flex-1"><?= htmlspecialchars($success) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Profile Card -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header with gradient -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 h-32"></div>
                    
                    <!-- Profile Content -->
                    <div class="px-6 pb-6">
                        <!-- Avatar and Name -->
                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between -mt-16 mb-6">
                            <div class="flex flex-col sm:flex-row items-center sm:items-end space-y-4 sm:space-y-0 sm:space-x-4">
                                <?php if (!empty($user['profile_photo'])): ?>
                                    <img src="<?= BASE_URL ?>/uploads/profiles/<?= htmlspecialchars($user['profile_photo']) ?>?t=<?= time() ?>"
                                         alt="Foto de perfil"
                                         class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-lg">
                                <?php else: ?>
                                    <div class="w-32 h-32 rounded-full border-4 border-white bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg">
                                        <span class="text-4xl font-bold text-white">
                                            <?= strtoupper(substr($user['name'], 0, 1) . substr($user['lastname'], 0, 1)) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="text-center sm:text-left mb-4 sm:mb-0">
                                    <h2 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($user['name'] . ' ' . $user['lastname']) ?></h2>
                                    <p class="text-gray-600 flex items-center justify-center sm:justify-start space-x-2 mt-1">
                                        <i class="fas fa-seedling text-green-600"></i>
                                        <span><?= htmlspecialchars(ucfirst($user['rol'])) ?></span>
                                    </p>
                                </div>
                            </div>
                            
                            <a href="<?= BASE_URL ?>/producer/profile/edit" class="inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-semibold">
                                <i class="fas fa-edit"></i>
                                <span>Editar Perfil</span>
                            </a>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Info -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center space-x-2">
                                    <i class="fas fa-user text-green-600"></i>
                                    <span>Información Personal</span>
                                </h3>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</label>
                                    <p class="text-gray-900 font-medium mt-1"><?= htmlspecialchars($user['name']) ?></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Apellido</label>
                                    <p class="text-gray-900 font-medium mt-1"><?= htmlspecialchars($user['lastname']) ?></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Correo Electrónico</label>
                                    <p class="text-gray-900 font-medium mt-1 flex items-center space-x-2">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                        <span><?= htmlspecialchars($user['email']) ?></span>
                                    </p>
                                </div>
                            </div>

                            <!-- Account Status -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center space-x-2">
                                    <i class="fas fa-shield-alt text-green-600"></i>
                                    <span>Estado de Cuenta</span>
                                </h3>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</label>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center space-x-2 <?= $user['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?> px-3 py-1.5 rounded-full text-sm font-semibold">
                                            <i class="fas fa-<?= $user['status'] === 'active' ? 'check-circle' : 'times-circle' ?>"></i>
                                            <span><?= $user['status'] === 'active' ? 'Activo' : 'Inactivo' ?></span>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Rol</label>
                                    <p class="text-gray-900 font-medium mt-1 capitalize"><?= htmlspecialchars($user['rol']) ?></p>
                                </div>

                                <!-- Account Actions -->
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-1">Seguridad de Cuenta</h4>
                                            <p class="text-sm text-gray-700">Mantén tu información actualizada y cambia tu contraseña regularmente.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
