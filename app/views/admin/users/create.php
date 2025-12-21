<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - Generar Token de Invitación</title>
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
    
    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen">
        <!-- Top Header -->
        <header class="sticky top-0 z-30 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-gray-200 text-xl focus:outline-none transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-100">Generar Token de Invitación</h1>
                <a href="/admin/users" class="inline-flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg transition-colors border border-gray-700">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Error Message -->
            <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <!-- Form Container -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8">
                    <!-- Info Alert -->
                    <div class="bg-blue-500/10 border border-blue-500/30 rounded-lg p-4 mb-6">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-info-circle text-blue-400 text-lg mt-0.5"></i>
                            <div>
                                <p class="text-sm text-blue-300 font-medium mb-1">Información del Token</p>
                                <p class="text-sm text-blue-200/80">El token generado se enviará por WhatsApp con una URL de registro.</p>
                                <code class="block mt-2 bg-gray-950/50 px-3 py-2 rounded text-xs text-blue-300 border border-blue-500/20">http://localhost:8000/registro?{rol}_token=abc123...</code>
                            </div>
                        </div>
                    </div>

                    <form method="POST" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                
                        <!-- Role Selection -->
                        <div>
                            <label for="roleSelect" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-user-tag text-gray-500"></i>
                                <span>Seleccionar Rol para el Token</span>
                            </label>
                            <select name="roleSelect" id="roleSelect" required 
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <option value="producer" selected>Producer</option>
                                <?php 
                                require_once '../helpers/Session.php';
                                // Session::start();
                                $currentUser = Session::getCurrentUser();
                                if ($currentUser['rol'] === 'master'): 
                                ?>
                                    <option value="admin">Admin</option>
                                    <option value="master">Master</option>
                                <?php endif; ?>
                            </select>
                        </div>
                
                        <!-- Guest Name -->
                        <div>
                            <label for="nameInput" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-user text-gray-500"></i>
                                <span>Nombre del Invitado</span>
                            </label>
                            <input type="text" name="nameInput" id="nameInput" required
                                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                   placeholder="Ej: Juan Pérez"
                                   autocomplete="name">
                        </div>
                
                        <!-- Phone Number -->
                        <div>
                            <label for="phoneInput" class="flex items-center space-x-2 text-sm font-medium text-gray-300 mb-2">
                                <i class="fab fa-whatsapp text-gray-500"></i>
                                <span>Número de Teléfono (con código de país)</span>
                            </label>
                            <input type="tel" name="phoneInput" id="phoneInput" required
                                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                   placeholder="Ej: 70123456"
                                   autocomplete="tel">
                            <p class="mt-2 text-xs text-gray-500 flex items-center space-x-1">
                                <i class="fas fa-info-circle"></i>
                                <span>8 dígitos sin código de país (ej: 70123456). Se agregará +503 automáticamente.</span>
                            </p>
                        </div>
                
                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                            <i class="fab fa-whatsapp"></i>
                            <span>Generar Token y Enviar por WhatsApp</span>
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>