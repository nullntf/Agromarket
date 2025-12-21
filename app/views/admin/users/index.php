<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - Gestión de Usuarios</title>
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
                <h1 class="text-xl font-bold text-gray-100">Gestión de Usuarios</h1>
                <a href="/admin/users/create" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                    <i class="fas fa-plus"></i>
                    <span class="hidden sm:inline">Generar Token</span>
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Success Message -->
            <?php if (isset($success)): ?>
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <!-- Users Table -->
            <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-800/50 border-b border-gray-800">
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">Email</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Rol</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider hidden lg:table-cell">Último Login</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                    <?php if (isset($users) && is_array($users)): ?>
                        <?php 
                        require_once '../helpers/Session.php';
                        // Session::start();
                        $currentUser = Session::getCurrentUser();
                        $isMaster = $currentUser['rol'] === 'master';
                        
                        foreach ($users as $user): 
                            // Admin no puede ver masters ni otros admins
                            if (!$isMaster && ($user['rol'] === 'master' || $user['rol'] === 'admin')) {
                                continue;
                            }
                            
                            // Verificar permisos para cada acción
                            $canEdit = $isMaster; // Solo master puede editar
                            $canToggle = $isMaster || ($user['rol'] === 'producer'); // Master todo, Admin solo producers
                            $canDelete = $isMaster; // Solo master puede eliminar
                        ?>
                            <tr class="hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 py-4 text-sm text-gray-300"><?= htmlspecialchars($user['id']) ?></td>
                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-200"><?= htmlspecialchars($user['name'] . ' ' . $user['lastname']) ?></div>
                                    <div class="text-sm text-gray-500 md:hidden"><?= htmlspecialchars($user['email']) ?></div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400 hidden md:table-cell"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        <?= $user['rol'] === 'master' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 
                                           ($user['rol'] === 'admin' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : 'bg-green-500/10 text-green-400 border border-green-500/20') ?>">
                                        <?= htmlspecialchars(ucfirst($user['rol'])) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        <?= $user['status'] === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' ?>">
                                        <i class="fas fa-circle text-[6px] mr-1.5"></i>
                                        <?= $user['status'] === 'active' ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400 hidden lg:table-cell">
                                    <?= $user['last_login'] ? htmlspecialchars(date('d/m/Y H:i', strtotime($user['last_login']))) : 'Nunca' ?>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="/admin/users/view/<?= $user['id'] ?>" 
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors" 
                                           title="Ver">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        
                                        <?php if ($canEdit): ?>
                                            <a href="/admin/users/edit/<?= $user['id'] ?>" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500/20 transition-colors" 
                                               title="Editar">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if ($canToggle): ?>
                                            <button onclick="window.location.href='/admin/users/toggle/<?= $user['id'] ?>'" 
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-<?= $user['status'] === 'active' ? 'orange' : 'green' ?>-500/10 text-<?= $user['status'] === 'active' ? 'orange' : 'green' ?>-400 hover:bg-<?= $user['status'] === 'active' ? 'orange' : 'green' ?>-500/20 transition-colors"
                                                    title="<?= $user['status'] === 'active' ? 'Inactivar' : 'Activar' ?>">
                                                <i class="fas fa-power-off text-sm"></i>
                                            </button>
                                        <?php endif; ?>
                                        
                                        <?php if ($canDelete): ?>
                                            <a href="/admin/users/delete/<?= $user['id'] ?>" 
                                               onclick="return confirm('¿Estás seguro de eliminar este usuario?')" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors"
                                               title="Eliminar">
                                                <i class="fas fa-trash text-sm"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center space-y-3">
                                        <i class="fas fa-users text-4xl text-gray-700"></i>
                                        <p class="text-gray-400 font-medium">No hay usuarios registrados</p>
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