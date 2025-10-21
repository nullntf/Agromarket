<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMarket - <?= htmlspecialchars($product['name']) ?></title>
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
    <?php include __DIR__ . '/../../sidebar.php'; ?>
    
    <div class="lg:ml-72 min-h-screen">
        <header class="sticky top-0 z-30 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-gray-200 text-xl focus:outline-none transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-100">Detalle del Producto</h1>
                <a href="/admin/business/view/<?= $product['business_id'] ?>" 
                   class="inline-flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg transition-colors border border-gray-700">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center space-x-3">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($_GET['success']) ?></span>
                </div>
            <?php endif; ?>
            
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Galería de Fotos -->
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                        <?php if (!empty($photos)): ?>
                            <div class="mb-4 bg-gray-950/50 rounded-xl overflow-hidden border border-gray-800">
                                <img id="mainImage" 
                                     src="/uploads/products/<?= htmlspecialchars($photos[0]['photo']) ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>" 
                                     class="w-full h-96 object-cover">
                            </div>
                            
                            <?php if (count($photos) > 1): ?>
                            <div class="grid grid-cols-4 gap-3">
                                <?php foreach ($photos as $index => $photo): ?>
                                <button onclick="changeMainImage('<?= htmlspecialchars($photo['photo']) ?>', this)" 
                                        class="thumbnail-btn rounded-lg overflow-hidden border-2 transition-all hover:border-blue-500 <?= $index === 0 ? 'border-blue-500' : 'border-gray-800' ?>">
                                    <img src="/uploads/products/<?= htmlspecialchars($photo['photo']) ?>" 
                                         alt="Foto <?= $index + 1 ?>" 
                                         class="w-full h-20 object-cover">
                                </button>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="w-full h-96 bg-gray-950/50 border border-gray-800 rounded-xl flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-image text-5xl text-gray-700 mb-3"></i>
                                    <p class="text-gray-500">Sin imágenes</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                        
                    <!-- Información del Producto -->
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 space-y-6">
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-100 mb-3">
                                <?= htmlspecialchars($product['name']) ?>
                            </h2>
                            
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                                <?= $product['status'] === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' ?>">
                                <i class="fas fa-circle text-[6px] mr-2"></i>
                                <?= $product['status'] === 'active' ? 'Activo' : 'Inactivo' ?>
                            </span>
                        </div>
                        
                        <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Precio</p>
                            <p class="text-4xl font-bold text-green-400">
                                $<?= number_format($product['price'], 2) ?>
                            </p>
                        </div>
                            
                        <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Categoría</p>
                            <p class="text-gray-200 font-medium flex items-center space-x-2">
                                <i class="fas fa-tag text-purple-400"></i>
                                <span><?= htmlspecialchars($product['category_name']) ?></span>
                            </p>
                        </div>
                        
                        <?php if (!empty($product['description'])): ?>
                        <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <h3 class="text-sm font-semibold text-gray-300 mb-2 flex items-center space-x-2">
                                <i class="fas fa-file-lines text-gray-500"></i>
                                <span>Descripción</span>
                            </h3>
                            <p class="text-gray-400 whitespace-pre-line"><?= htmlspecialchars($product['description']) ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <h3 class="text-sm font-semibold text-gray-300 mb-3 flex items-center space-x-2">
                                <i class="fas fa-store text-gray-500"></i>
                                <span>Negocio</span>
                            </h3>
                            <p class="text-gray-200 font-medium"><?= htmlspecialchars($business['name']) ?></p>
                            <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($business['producer_name'] . ' ' . $business['producer_lastname']) ?></p>
                        </div>
                        
                        <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <h3 class="text-sm font-semibold text-gray-300 mb-3 flex items-center space-x-2">
                                <i class="fas fa-clock text-gray-500"></i>
                                <span>Fechas</span>
                            </h3>
                            <div class="space-y-1 text-sm text-gray-400">
                                <p><span class="text-gray-500">Creado:</span> <?= date('d/m/Y H:i', strtotime($product['created_at'])) ?></p>
                                <p><span class="text-gray-500">Actualizado:</span> <?= date('d/m/Y H:i', strtotime($product['updated_at'])) ?></p>
                            </div>
                        </div>
                            
                        <!-- Acciones -->
                        <div class="space-y-3 pt-4 border-t border-gray-800">
                            <?php if ($user['rol'] === 'admin' || $user['rol'] === 'master'): ?>
                            <form method="POST" action="/admin/business/products/toggle/<?= $product['id'] ?>">
                                <?php
                                require_once '../helpers/Session.php';
                                Session::start();
                                ?>
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center space-x-2 bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                                    <i class="fas fa-power-off"></i>
                                    <span><?= $product['status'] === 'active' ? 'Desactivar Producto' : 'Activar Producto' ?></span>
                                </button>
                            </form>
                            <?php endif; ?>
                            
                            <?php if ($user['rol'] === 'master'): ?>
                            <button onclick="confirmDelete(<?= $product['id'] ?>)" 
                                    class="w-full inline-flex items-center justify-center space-x-2 bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                                <i class="fas fa-trash"></i>
                                <span>Eliminar Producto</span>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
function changeMainImage(photoName, button) {
    document.getElementById('mainImage').src = '/uploads/products/' + photoName;
    
    // Actualizar el borde de los thumbnails
    document.querySelectorAll('.thumbnail-btn').forEach(btn => {
        btn.classList.remove('border-blue-500');
        btn.classList.add('border-gray-800');
    });
    
    button.classList.remove('border-gray-800');
    button.classList.add('border-blue-500');
}

function confirmDelete(productId) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/business/products/delete/${productId}`;
        
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
