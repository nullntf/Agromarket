<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMarket - Editar Mi Perfil</title>
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
                <h1 class="text-xl font-bold text-gray-100">Editar Mi Perfil</h1>
                <a href="/admin/settings" class="inline-flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg transition-colors border border-gray-700">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3 max-w-3xl mx-auto">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>
            
            <div class="max-w-3xl mx-auto">
                <form method="POST" enctype="multipart/form-data" class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8">
                <?php
                require_once '../helpers/Session.php';
                Session::start();
                ?>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                
                <h2 class="text-lg font-bold text-gray-100 mb-6 flex items-center space-x-2">
                    <i class="fas fa-user-edit text-blue-400"></i>
                    <span>Información Personal</span>
                </h2>
                
                <div class="mb-6 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                    <label class="block text-sm font-medium text-gray-300 mb-3">Foto de Perfil Actual</label>
                    <div class="flex items-center">
                        <?php if (!empty($user['profile_photo'])): ?>
                            <img src="/uploads/profiles/<?= htmlspecialchars($user['profile_photo']) ?>" 
                                 alt="Foto actual" 
                                 class="w-20 h-20 rounded-full object-cover border-4 border-gray-800">
                        <?php else: ?>
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-2xl font-bold border-4 border-gray-800">
                                <?= strtoupper(substr($user['name'], 0, 1) . substr($user['lastname'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="profile_photo" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-camera text-gray-500"></i>
                        <span>Cambiar Foto de Perfil</span>
                    </label>
                    <input type="file" 
                           id="profile_photo" 
                           name="profile_photo" 
                           accept="image/*"
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all">
                    <p class="text-xs text-gray-500 mt-2 flex items-center space-x-1">
                        <i class="fas fa-info-circle"></i>
                        <span>Máximo 5MB. Formatos: JPG, PNG, GIF</span>
                    </p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user text-gray-500"></i>
                            <span>Nombre</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                               value="<?= htmlspecialchars($user['name']) ?>">
                    </div>
                    
                    <div>
                        <label for="lastname" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user text-gray-500"></i>
                            <span>Apellido</span>
                        </label>
                        <input type="text" 
                               id="lastname" 
                               name="lastname" 
                               required
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                               value="<?= htmlspecialchars($user['lastname']) ?>">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="email" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-envelope text-gray-500"></i>
                        <span>Email</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                           value="<?= htmlspecialchars($user['email']) ?>">
                </div>
                
                <div class="border-t border-gray-800 my-6"></div>
                
                <h2 class="text-lg font-bold text-gray-100 mb-2 flex items-center space-x-2">
                    <i class="fas fa-lock text-yellow-400"></i>
                    <span>Cambiar Contraseña</span>
                    <span class="text-xs font-normal text-gray-500">(Opcional)</span>
                </h2>
                <p class="text-sm text-gray-500 mb-4">Deja estos campos vacíos si no deseas cambiar tu contraseña</p>
                
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="current_password" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-key text-gray-500"></i>
                            <span>Contraseña Actual</span>
                        </label>
                        <input type="password" 
                               id="current_password" 
                               name="current_password"
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    
                    <div>
                        <label for="new_password" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock text-gray-500"></i>
                            <span>Nueva Contraseña</span>
                        </label>
                        <input type="password" 
                               id="new_password" 
                               name="new_password"
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <p class="text-xs text-gray-500 mt-2">Mínimo 6 caracteres</p>
                    </div>
                    
                    <div>
                        <label for="confirm_password" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-check-circle text-gray-500"></i>
                            <span>Confirmar Nueva Contraseña</span>
                        </label>
                        <input type="password" 
                               id="confirm_password" 
                               name="confirm_password"
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold">
                        <i class="fas fa-save"></i>
                        <span>Guardar Cambios</span>
                    </button>
                    <a href="/admin/settings" class="flex-1 inline-flex items-center justify-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 py-3 px-6 rounded-lg transition-colors border border-gray-700 font-medium">
                        <i class="fas fa-times"></i>
                        <span>Cancelar</span>
                    </a>
                </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>