<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMarket - Editar Usuario</title>
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
                <h1 class="text-xl font-bold text-gray-100">Editar Usuario</h1>
                <a href="/admin/users" class="inline-flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg transition-colors border border-gray-700">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if (isset($user) && is_array($user)): ?>
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8">
                    <form method="POST" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-user text-gray-500"></i>
                                    <span>Nombre</span>
                                </label>
                                <input type="text" name="name" required
                                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                       value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                            </div>

                            <div>
                                <label class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-user text-gray-500"></i>
                                    <span>Apellido</span>
                                </label>
                                <input type="text" name="lastname" required
                                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                       value="<?= htmlspecialchars($user['lastname'] ?? '') ?>">
                            </div>
                        </div>

                        <div>
                            <label class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-envelope text-gray-500"></i>
                                <span>Email</span>
                            </label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-user-tag text-gray-500"></i>
                                    <span>Rol</span>
                                </label>
                                <select name="role" required class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="master" <?= ($user['rol'] ?? '') === 'master' ? 'selected' : '' ?>>Master</option>
                                    <option value="admin" <?= ($user['rol'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="producer" <?= ($user['rol'] ?? '') === 'producer' ? 'selected' : '' ?>>Producer</option>
                                </select>
                            </div>

                            <div>
                                <label class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-toggle-on text-gray-500"></i>
                                    <span>Estado</span>
                                </label>
                                <select name="status" required class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="active" <?= ($user['status'] ?? '') === 'active' ? 'selected' : '' ?>>Activo</option>
                                    <option value="inactive" <?= ($user['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Actualizar Usuario</span>
                        </button>
                    </form>
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