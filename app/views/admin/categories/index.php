<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - Gestión de Categorías</title>
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
    <?php 
    require_once '../helpers/Session.php';
    Session::start();
    $currentUser = Session::getCurrentUser();
    $isMaster = $currentUser['rol'] === 'master';
    
    include __DIR__ . '/../sidebar.php'; 
    ?>
    
    <div class="lg:ml-72 min-h-screen">
        <header class="sticky top-0 z-30 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-gray-200 text-xl focus:outline-none transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-100">Gestión de Categorías</h1>
                <?php if ($isMaster): ?>
                    <a href="/admin/categories/create" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Crear Categoría</span>
                    </a>
                <?php else: ?>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Solo lectura</span>
                <?php endif; ?>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($success)): ?>
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>
            <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-800/50 border-b border-gray-800">
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider hidden sm:table-cell">Fecha Creación</th>
                                <?php if ($isMaster): ?>
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                    <?php if (isset($categories) && is_array($categories) && count($categories) > 0): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr class="hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 py-4 text-sm text-gray-300"><?= htmlspecialchars($category['id']) ?></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-green-500/10 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-tag text-green-400 text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-200"><?= htmlspecialchars($category['name']) ?></span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400 hidden sm:table-cell"><?= htmlspecialchars(date('d/m/Y', strtotime($category['created_at']))) ?></td>
                                <?php if ($isMaster): ?>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="/admin/categories/edit/<?= $category['id'] ?>" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500/20 transition-colors" 
                                               title="Editar">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <a href="/admin/categories/delete/<?= $category['id'] ?>" 
                                               onclick="return confirm('¿Estás seguro de eliminar esta categoría?')" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors"
                                               title="Eliminar">
                                                <i class="fas fa-trash text-sm"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                            <tr>
                                <td colspan="<?= $isMaster ? '4' : '3' ?>" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center space-y-3">
                                        <i class="fas fa-tags text-4xl text-gray-700"></i>
                                        <p class="text-gray-400 font-medium">No hay categorías registradas</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>