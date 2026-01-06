<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - AgroCompra</title>
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
                        <i class="fas fa-user-edit text-green-600 text-xl"></i>
                        <h1 class="text-xl font-bold text-gray-900">Editar Perfil</h1>
                    </div>
                    <a href="<?= BASE_URL ?>/producer/profile" class="inline-flex items-center space-x-2 text-sm text-gray-600 hover:text-green-600 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span class="hidden sm:inline">Volver</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Error Message -->
            <?php if (isset($error)): ?>
                <div class="max-w-3xl mx-auto mb-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start space-x-3">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                        <p class="text-red-800 flex-1"><?= htmlspecialchars($error) ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <?php
                    require_once '../helpers/Session.php';
                    // Session::start();
                    ?>
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                    
                    <!-- Personal Information Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                            <i class="fas fa-user text-green-600"></i>
                            <span>Información Personal</span>
                        </h2>
                        
                        <!-- Current Photo Preview -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Foto de Perfil Actual</label>
                            <div class="flex items-center space-x-4">
                                <?php if (!empty($user['profile_photo'])): ?>
                                    <img src="<?= BASE_URL ?>/uploads/profiles/<?= htmlspecialchars($user['profile_photo']) ?>?t=<?= time() ?>"
                                         alt="Foto actual"
                                         class="w-20 h-20 rounded-full object-cover border-4 border-gray-200">
                                <?php else: ?>
                                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center border-4 border-gray-200">
                                        <span class="text-2xl font-bold text-white">
                                            <?= strtoupper(substr($user['name'], 0, 1) . substr($user['lastname'], 0, 1)) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($user['profile_photo'])): ?>
                                <label class="flex items-center space-x-2 mt-3">
                                    <input type="checkbox"
                                           name="delete_photo"
                                           id="delete_photo"
                                           class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    <span class="text-sm text-gray-700">Eliminar foto de perfil actual</span>
                                </label>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Change Photo -->
                        <div class="mb-6">
                            <label for="profile_photo" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-camera text-gray-500"></i>
                                <span>Cambiar Foto de Perfil</span>
                            </label>
                            <input type="file" 
                                   id="profile_photo" 
                                   name="profile_photo" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-600 file:text-white file:font-medium hover:file:bg-green-700 transition-colors">
                            <p class="text-xs text-gray-500 mt-2 flex items-center space-x-1">
                                <i class="fas fa-info-circle"></i>
                                <span>Máximo 5MB. Formatos: JPG, PNG, GIF</span>
                            </p>
                        </div>
                        
                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-user text-gray-500"></i>
                                    <span>Nombre</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       required
                                       class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                       value="<?= htmlspecialchars($user['name']) ?>">
                            </div>
                            
                            <div>
                                <label for="lastname" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-user text-gray-500"></i>
                                    <span>Apellido</span>
                                </label>
                                <input type="text" 
                                       id="lastname" 
                                       name="lastname" 
                                       required
                                       class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                       value="<?= htmlspecialchars($user['lastname']) ?>">
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-envelope text-gray-500"></i>
                                <span>Correo Electrónico</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   value="<?= htmlspecialchars($user['email']) ?>">
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-8"></div>
                    
                    <!-- Password Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-2 flex items-center space-x-2">
                            <i class="fas fa-lock text-green-600"></i>
                            <span>Cambiar Contraseña</span>
                        </h2>
                        <p class="text-sm text-gray-600 mb-6">Deja estos campos vacíos si no deseas cambiar tu contraseña</p>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-key text-gray-500"></i>
                                    <span>Contraseña Actual</span>
                                </label>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password"
                                       autocomplete="current-password"
                                       class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-lock text-gray-500"></i>
                                    <span>Nueva Contraseña</span>
                                </label>
                                <input type="password" 
                                       id="new_password" 
                                       name="new_password"
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-2 flex items-center space-x-1">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Mínimo 6 caracteres</span>
                                </p>
                            </div>
                            
                            <div>
                                <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-check-circle text-gray-500"></i>
                                    <span>Confirmar Nueva Contraseña</span>
                                </label>
                                <input type="password" 
                                       id="confirm_password" 
                                       name="confirm_password"
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Guardar Cambios</span>
                        </button>
                        <a href="<?= BASE_URL ?>/producer/profile" class="flex-1 inline-flex items-center justify-center space-x-2 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </a>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
