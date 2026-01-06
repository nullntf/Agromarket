<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - Gestión de Negocios</title>
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
                <h1 class="text-xl font-bold text-gray-100">Gestión de Negocios</h1>
                <div class="text-sm">
                    <span class="px-3 py-1.5 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/20">
                        <i class="fas fa-store mr-1.5"></i>
                        <span class="font-semibold"><?= count($businesses) ?></span> negocios
                    </span>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($_GET['success']) ?></span>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($_GET['error']) ?></span>
                </div>
            <?php endif; ?>
            
            <?php if (empty($businesses)): ?>
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-12 text-center">
                    <i class="fas fa-store-slash text-5xl text-gray-700 mb-4"></i>
                    <p class="text-gray-400 font-medium text-lg">No hay negocios registrados</p>
                </div>
            <?php else: ?>
                <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-800/50 border-b border-gray-800">
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Negocio</th>
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider hidden lg:table-cell">Productor</th>
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">Ubicación</th>
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider hidden sm:table-cell">Teléfono</th>
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                <?php foreach ($businesses as $business): ?>
                                <tr class="hover:bg-gray-800/50 transition-colors">
                                    <td class="px-4 py-4">
                                        <div class="font-medium text-gray-200"><?= htmlspecialchars($business['name']) ?></div>
                                        <div class="text-sm text-gray-500">ID: <?= $business['id'] ?></div>
                                        <div class="lg:hidden mt-1 text-sm text-gray-400">
                                            <i class="fas fa-user text-xs mr-1"></i>
                                            <?= htmlspecialchars($business['producer_name'] . ' ' . $business['producer_lastname']) ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 hidden lg:table-cell">
                                        <div class="text-sm text-gray-200">
                                            <?= htmlspecialchars($business['producer_name'] . ' ' . $business['producer_lastname']) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?= htmlspecialchars($business['producer_email']) ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-300 hidden md:table-cell">
                                        <div class="flex items-start space-x-2">
                                            <i class="fas fa-map-marker-alt text-gray-500 mt-0.5"></i>
                                            <div>
                                                <div><?= htmlspecialchars($business['municipality_name']) ?></div>
                                                <div class="text-gray-500"><?= htmlspecialchars($business['department_name']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-300 hidden sm:table-cell">
                                        <i class="fas fa-phone text-gray-500 mr-2"></i>
                                        <?= htmlspecialchars($business['phone']) ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                            <?= $business['status'] === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' ?>">
                                            <i class="fas fa-circle text-[6px] mr-1.5"></i>
                                            <?= $business['status'] === 'active' ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="<?= BASE_URL ?>/admin/business/view/<?= $business['id'] ?>" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors" 
                                               title="Ver">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>
                                            
                                            <?php if ($user['rol'] === 'admin' || $user['rol'] === 'master'): ?>
                                                <form method="POST" action="<?= BASE_URL ?>/admin/business/toggle/<?= $business['id'] ?>" class="inline">
                                                    <?php
                                                    require_once '../helpers/Session.php';
                                                    // Session::start();
                                                    ?>
                                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                                                    <button type="submit" 
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500/20 transition-colors"
                                                            title="<?= $business['status'] === 'active' ? 'Desactivar' : 'Activar' ?>">
                                                        <i class="fas fa-power-off text-sm"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            
                                            <?php if ($user['rol'] === 'master'): ?>
                                                <button onclick="confirmDelete(<?= $business['id'] ?>)" 
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('-translate-x-full');
}

function confirmDelete(businessId) {
    if (confirm('¿Estás seguro de que deseas eliminar este negocio? Esta acción también eliminará todos sus productos.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/business/delete/${businessId}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = 'csrf_token';
        csrfInput.value = '<?= Session::getCsrfToken() ?>';
        
        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
</body>
</html>
