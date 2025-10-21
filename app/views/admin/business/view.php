<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMarket - <?= htmlspecialchars($business['name']) ?></title>
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
                <h1 class="text-xl font-bold text-gray-100">Detalle del Negocio</h1>
                <a href="/admin/business" class="inline-flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg transition-colors border border-gray-700">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Volver</span>
                </a>
            </div>
        </header>

        <main class="overflow-auto">
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 mx-4 sm:mx-6 lg:mx-8 mt-4 flex items-center space-x-3">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($_GET['success']) ?></span>
                </div>
            <?php endif; ?>
            
            <!-- Información del Negocio -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden mb-6">
                    <!-- Hero Section con gradiente -->
                    <div class="bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-green-600/20 border-b border-gray-800 p-6 sm:p-8">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center">
                                <i class="fas fa-store text-3xl text-green-400"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-100 text-center">
                            <?= htmlspecialchars($business['name']) ?>
                        </h2>
                    </div>
                    
                    <div class="p-6 sm:p-8">
                            
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-phone text-blue-400 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Teléfono</p>
                                <p class="text-gray-200 font-medium"><?= htmlspecialchars($business['phone']) ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-map-marker-alt text-green-400 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Ubicación</p>
                                <p class="text-gray-200 font-medium"><?= htmlspecialchars($business['municipality_name'] . ', ' . $business['department_name']) ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-user text-purple-400 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Productor</p>
                                <p class="text-gray-200 font-medium"><?= htmlspecialchars($business['producer_name'] . ' ' . $business['producer_lastname']) ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-4 bg-gray-950/50 rounded-lg border border-gray-800">
                            <i class="fas fa-envelope text-yellow-400 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Email</p>
                                <p class="text-gray-200 font-medium break-all"><?= htmlspecialchars($business['producer_email']) ?></p>
                            </div>
                        </div>
                    </div>
                            
                    <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800 mb-4">
                        <h3 class="font-semibold text-gray-300 mb-2 flex items-center space-x-2">
                            <i class="fas fa-location-dot text-gray-500"></i>
                            <span>Dirección</span>
                        </h3>
                        <p class="text-gray-400"><?= htmlspecialchars($business['address']) ?></p>
                    </div>
                    
                    <?php if (!empty($business['description'])): ?>
                    <div class="p-4 bg-gray-950/50 rounded-lg border border-gray-800 mb-4">
                        <h3 class="font-semibold text-gray-300 mb-2 flex items-center space-x-2">
                            <i class="fas fa-file-lines text-gray-500"></i>
                            <span>Descripción</span>
                        </h3>
                        <p class="text-gray-400 whitespace-pre-line"><?= htmlspecialchars($business['description']) ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-500">Estado:</span>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                            <?= $business['status'] === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' ?>">
                            <i class="fas fa-circle text-[6px] mr-2"></i>
                            <?= $business['status'] === 'active' ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </div>
                    </div>
                </div>

                <!-- Productos del Negocio -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8 mb-6">
                    <h3 class="text-xl font-bold text-gray-100 mb-6 flex items-center space-x-2">
                        <i class="fas fa-box-open text-blue-400"></i>
                        <span>Productos</span>
                        <span class="px-2.5 py-1 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/20 text-sm font-semibold">
                            <?= count($products) ?>
                        </span>
                    </h3>
                    
                    <?php if (empty($products)): ?>
                        <div class="text-center py-12">
                            <i class="fas fa-box-open text-5xl text-gray-700 mb-4"></i>
                            <p class="text-gray-400 font-medium">Este negocio no tiene productos registrados</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($products as $product): ?>
                            <div class="bg-gray-950/50 border border-gray-800 rounded-xl overflow-hidden hover:border-gray-700 transition-all group">
                                <div class="h-48 bg-gray-900 relative overflow-hidden">
                                    <?php if ($product['main_photo']): ?>
                                        <img src="/uploads/products/<?= htmlspecialchars($product['main_photo']) ?>" 
                                             alt="<?= htmlspecialchars($product['name']) ?>" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-4xl text-gray-700"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <span class="absolute top-2 right-2 inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                        <?= $product['status'] === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/20 backdrop-blur-sm' : 'bg-red-500/10 text-red-400 border border-red-500/20 backdrop-blur-sm' ?>">
                                        <i class="fas fa-circle text-[6px] mr-1.5"></i>
                                        <?= $product['status'] === 'active' ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </div>
                                
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-gray-200 mb-2 line-clamp-1">
                                        <?= htmlspecialchars($product['name']) ?>
                                    </h4>
                                    <p class="text-2xl font-bold text-green-400 mb-3">
                                        $<?= number_format($product['price'], 2) ?>
                                    </p>
                                    <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                                        <?= htmlspecialchars($product['description'] ?? 'Sin descripción') ?>
                                    </p>
                                    
                                    <a href="/admin/business/products/view/<?= $product['id'] ?>" 
                                       class="flex items-center justify-center space-x-2 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors">
                                        <i class="fas fa-eye"></i>
                                        <span>Ver Detalles</span>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
