<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Negocio - AgroCompra</title>
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
                        <i class="fas fa-store text-green-600 text-xl"></i>
                        <h1 class="text-xl font-bold text-gray-900">Mi Negocio</h1>
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
                <div class="max-w-7xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                        <p class="text-green-800 flex-1"><?= htmlspecialchars($success) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($business) && is_array($business)): ?>
            <!-- Business Exists -->
            <div class="max-w-7xl mx-auto">
                <!-- Business Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <!-- Hero Section con gradiente -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-6 md:p-8 text-center">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <i class="fas fa-store text-3xl text-white"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2"><?= htmlspecialchars($business['name']) ?></h2>
                        <p class="text-green-50">
                            <i class="fas fa-user mr-2"></i>
                            <?= htmlspecialchars($user['name'] . ' ' . ($user['lastname'] ?? '')) ?>
                        </p>
                    </div>

                    <!-- Business Info -->
                    <div class="px-6 pb-6">
                        <div class="flex justify-end pt-6 mb-6">
                            <a href="<?= BASE_URL ?>/producer/business/edit" class="inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-semibold">
                                <i class="fas fa-edit"></i>
                                <span>Editar Negocio</span>
                            </a>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-phone text-green-600"></i>
                                    <span>Teléfono</span>
                                </label>
                                <p class="text-gray-900 font-medium mt-2"><?= htmlspecialchars($business['phone']) ?></p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                    <span>Ubicación</span>
                                </label>
                                <p class="text-gray-900 font-medium mt-2"><?= htmlspecialchars($business['municipality_name'] . ', ' . $business['department_name']) ?></p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-circle text-green-600"></i>
                                    <span>Estado</span>
                                </label>
                                <div class="mt-2">
                                    <span class="inline-flex items-center space-x-2 <?= $business['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?> px-3 py-1.5 rounded-full text-sm font-semibold">
                                        <i class="fas fa-<?= $business['status'] === 'active' ? 'check-circle' : 'times-circle' ?>"></i>
                                        <span><?= $business['status'] === 'active' ? 'Activo' : 'Inactivo' ?></span>
                                    </span>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 md:col-span-2 lg:col-span-3">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-home text-green-600"></i>
                                    <span>Dirección</span>
                                </label>
                                <p class="text-gray-900 font-medium mt-2"><?= htmlspecialchars($business['address']) ?></p>
                            </div>

                            <?php if (!empty($business['description'])): ?>
                            <div class="bg-gray-50 rounded-lg p-4 md:col-span-2 lg:col-span-3">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-align-left text-green-600"></i>
                                    <span>Descripción</span>
                                </label>
                                <p class="text-gray-700 mt-2 leading-relaxed"><?= nl2br(htmlspecialchars($business['description'])) ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">Mis Productos</h3>
                            <p class="text-gray-600">Gestiona el catálogo de productos de tu negocio</p>
                        </div>
                        <a href="<?= BASE_URL ?>/producer/business/products/create" class="inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-semibold mt-4 sm:mt-0">
                            <i class="fas fa-plus"></i>
                            <span>Agregar Producto</span>
                        </a>
                    </div>

                    <?php if (!empty($products)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach ($products as $product): ?>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                            <!-- Product Image -->
                            <div class="relative h-48 bg-gray-100">
                                <?php if (!empty($product['main_photo'])): ?>
                                    <img src="<?= BASE_URL ?>/uploads/products/<?= htmlspecialchars($product['main_photo']) ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?>"
                                         class="h-full w-full object-cover">
                                <?php else: ?>
                                    <div class="h-full w-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-image text-6xl"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Status Badge -->
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center space-x-1 px-2 py-1 text-xs font-semibold rounded-lg <?= $product['status'] === 'active' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' ?>">
                                        <i class="fas fa-circle text-xs"></i>
                                        <span><?= $product['status'] === 'active' ? 'Activo' : 'Inactivo' ?></span>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-4">
                                <div class="mb-3">
                                    <h4 class="text-lg font-bold text-gray-900 mb-1"><?= htmlspecialchars($product['name']) ?></h4>
                                    <p class="text-2xl font-bold text-green-600">$<?= number_format($product['price'], 2) ?></p>
                                </div>
                                
                                <p class="text-xs text-gray-500 mb-2 flex items-center space-x-1">
                                    <i class="fas fa-tag"></i>
                                    <span><?= htmlspecialchars($product['category_name']) ?></span>
                                </p>
                                
                                <?php if (!empty($product['description'])): ?>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    <?= htmlspecialchars(strlen($product['description']) > 80 ? substr($product['description'], 0, 80) . '...' : $product['description']) ?>
                                </p>
                                <?php endif; ?>
                                
                                <!-- Actions -->
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="<?= BASE_URL ?>/producer/business/products/view/<?= $product['id'] ?>" 
                                       class="inline-flex items-center justify-center space-x-1 bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-3 rounded-lg transition-colors">
                                        <i class="fas fa-eye"></i>
                                        <span>Ver</span>
                                    </a>
                                    <a href="<?= BASE_URL ?>/producer/business/products/edit/<?= $product['id'] ?>" 
                                       class="inline-flex items-center justify-center space-x-1 bg-yellow-600 hover:bg-yellow-700 text-white text-sm py-2 px-3 rounded-lg transition-colors">
                                        <i class="fas fa-edit"></i>
                                        <span>Editar</span>
                                    </a>
                                    <?php if ($product['status'] === 'active'): ?>
                                    <button onclick="confirmToggle(<?= $product['id'] ?>, 'inactivar')" 
                                            class="inline-flex items-center justify-center space-x-1 bg-orange-600 hover:bg-orange-700 text-white text-sm py-2 px-3 rounded-lg transition-colors">
                                        <i class="fas fa-pause"></i>
                                        <span>Pausar</span>
                                    </button>
                                    <?php else: ?>
                                    <button onclick="confirmToggle(<?= $product['id'] ?>, 'activar')" 
                                            class="inline-flex items-center justify-center space-x-1 bg-green-600 hover:bg-green-700 text-white text-sm py-2 px-3 rounded-lg transition-colors">
                                        <i class="fas fa-play"></i>
                                        <span>Activar</span>
                                    </button>
                                    <?php endif; ?>
                                    <button onclick="confirmDelete(<?= $product['id'] ?>)" 
                                            class="inline-flex items-center justify-center space-x-1 bg-red-600 hover:bg-red-700 text-white text-sm py-2 px-3 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                        <span>Eliminar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <!-- No Products -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">No tienes productos</h4>
                        <p class="text-gray-600 mb-6">Comienza agregando tu primer producto para que los clientes puedan verlo</p>
                        <a href="<?= BASE_URL ?>/producer/business/products/create" 
                           class="inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-plus"></i>
                            <span>Agregar Primer Producto</span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
            <!-- No Business -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-store text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No tienes un negocio registrado</h3>
                    <p class="text-gray-600 mb-6">Para comenzar a vender tus productos, necesitas crear tu negocio primero</p>
                    <a href="<?= BASE_URL ?>/producer/business/create" class="inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg transition-colors font-semibold text-lg">
                        <i class="fas fa-plus-circle"></i>
                        <span>Crear Mi Negocio</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </div>

<script>
function confirmToggle(productId, action) {
    if (confirm(`¿Estás seguro de que deseas ${action} este producto?`)) {
        window.location.href = `/producer/business/products/toggle/${productId}`;
    }
}

function confirmDelete(productId) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')) {
        window.location.href = `/producer/business/products/delete/${productId}`;
    }
}
</script>
</body>
</html>
