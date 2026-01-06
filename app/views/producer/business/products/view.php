<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto - AgroCompra</title>
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
    <?php include __DIR__ . '/../../sidebar.php'; ?>
    
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
                        <i class="fas fa-eye text-green-600 text-xl"></i>
                        <h1 class="text-xl font-bold text-gray-900">Detalles del Producto</h1>
                    </div>
                    <a href="<?= BASE_URL ?>/producer/business" class="text-sm text-gray-600 hover:text-green-600 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span class="hidden sm:inline">Volver</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                        <!-- Photo Gallery -->
                        <div>
                            <?php if (!empty($photos)): ?>
                            <div class="mb-4">
                                <img id="main-image" 
                                     src="<?= BASE_URL ?>/uploads/products/<?= htmlspecialchars($photos[0]['photo']) ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>"
                                     class="w-full h-96 object-cover rounded-lg border-2 border-gray-200">
                            </div>
                            
                            <?php if (count($photos) > 1): ?>
                            <div class="grid grid-cols-4 gap-2">
                                <?php foreach ($photos as $index => $photo): ?>
                                <img src="<?= BASE_URL ?>/uploads/products/<?= htmlspecialchars($photo['photo']) ?>" 
                                     alt="Foto <?= $index + 1 ?>"
                                     onclick="changeMainImage(this.src)"
                                     class="w-full h-20 object-cover rounded-lg cursor-pointer border-2 border-gray-200 hover:border-green-500 transition-all">
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <?php else: ?>
                            <div class="w-full h-96 bg-gray-100 rounded-lg flex items-center justify-center">
                                <div class="text-center text-gray-400">
                                    <i class="fas fa-image text-6xl mb-3"></i>
                                    <p>Sin fotos</p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Product Information -->
                        <div class="space-y-6">
                            <!-- Status Badge -->
                            <div>
                                <span class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full text-sm font-semibold <?= $product['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                    <i class="fas fa-circle text-xs"></i>
                                    <span><?= $product['status'] === 'active' ? 'Activo' : 'Inactivo' ?></span>
                                </span>
                            </div>
                            
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900 mb-3"><?= htmlspecialchars($product['name']) ?></h2>
                                <p class="text-4xl font-bold text-green-600">$<?= number_format($product['price'], 2) ?></p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-tag text-green-600"></i>
                                    <span>Categoría</span>
                                </label>
                                <p class="text-gray-900 font-medium mt-2"><?= htmlspecialchars($product['category_name']) ?></p>
                            </div>
                            
                            <?php if (!empty($product['description'])): ?>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-align-left text-green-600"></i>
                                    <span>Descripción</span>
                                </label>
                                <p class="text-gray-700 leading-relaxed mt-2"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                            </div>
                            <?php endif; ?>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center space-x-1">
                                    <i class="fas fa-store text-green-600"></i>
                                    <span>Negocio</span>
                                </label>
                                <p class="text-gray-900 font-medium mt-2"><?= htmlspecialchars($product['business_name']) ?></p>
                            </div>
                            
                            <!-- Actions -->
                            <div class="space-y-3 pt-4 border-t border-gray-200">
                                <a href="<?= BASE_URL ?>/producer/business/products/edit/<?= $product['id'] ?>" 
                                   class="block w-full text-center inline-flex items-center justify-center space-x-2 bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                                    <i class="fas fa-edit"></i>
                                    <span>Editar Producto</span>
                                </a>
                                
                                <?php if ($product['status'] === 'active'): ?>
                                <button onclick="confirmToggle('inactivar')" 
                                        class="w-full inline-flex items-center justify-center space-x-2 bg-orange-600 hover:bg-orange-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                                    <i class="fas fa-pause"></i>
                                    <span>Inactivar Producto</span>
                                </button>
                                <?php else: ?>
                                    <?php if (!empty($product['disabled_by_admin']) && $product['disabled_by_admin'] == 1): ?>
                                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                                            <i class="fas fa-ban text-red-600 text-2xl mb-2"></i>
                                            <p class="text-red-800 font-semibold">Desactivado por Administrador</p>
                                            <p class="text-xs text-red-600 mt-1">Contacta al soporte para más información</p>
                                        </div>
                                    <?php else: ?>
                                        <button onclick="confirmToggle('activar')" 
                                                class="w-full inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                                            <i class="fas fa-play"></i>
                                            <span>Activar Producto</span>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <button onclick="confirmDelete()" 
                                        class="w-full inline-flex items-center justify-center space-x-2 bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                                    <i class="fas fa-trash"></i>
                                    <span>Eliminar Producto</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha de Creación</label>
                                <p class="text-gray-900 font-medium mt-1"><?= date('d/m/Y H:i', strtotime($product['created_at'])) ?></p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Última Actualización</label>
                                <p class="text-gray-900 font-medium mt-1"><?= date('d/m/Y H:i', strtotime($product['updated_at'])) ?></p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total de Fotos</label>
                                <p class="text-gray-900 font-medium mt-1"><?= count($photos) ?> imagen<?= count($photos) != 1 ? 'es' : '' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
function changeMainImage(src) {
    document.getElementById('main-image').src = src;
}

function confirmToggle(action) {
    if (confirm(`¿Estás seguro de que deseas ${action} este producto?`)) {
        window.location.href = `/producer/business/products/toggle/<?= $product['id'] ?>`;
    }
}

function confirmDelete() {
    if (confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')) {
        window.location.href = `/producer/business/products/delete/<?= $product['id'] ?>`;
    }
}
</script>
</body>
</html>
