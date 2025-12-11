<!DOCTYPE html>
<html lang="<?= $lang ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($business['name']) ?> - <?= _e('business.title', 'Perfil del Negocio') ?></title>
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
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2">
                    <i class="fas fa-seedling text-green-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-900">AgroCompra</span>
                </a>
                <div class="flex items-center space-x-3">
                    <a href="/tienda" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        <i class="fas fa-store mr-2"></i><?= _e('store.title', 'Tienda') ?>
                    </a>
                    <a href="/" class="hidden md:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        <i class="fas fa-home mr-2"></i><?= _e('breadcrumb_home', 'Inicio') ?>
                    </a>
                    <!-- Language Switcher -->
                    <div class="hidden sm:block">
                        <?php include __DIR__ . '/../partials/language_switcher.php'; ?>
                    </div>
                    <a href="/login" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i><?= _e('login', 'Iniciar Sesión') ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Información del Negocio -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden mb-8">
            <!-- Hero Section con gradiente -->
            <div class="bg-gradient-to-r from-blue-600 to-sky-600 p-8 md:p-12">
                <div class="flex flex-col md:flex-row md:items-center gap-6">
                    <!-- Foto de Perfil del Productor -->
                    <div class="flex-shrink-0 mx-auto md:mx-0">
                        <?php if (!empty($business['producer_photo'])): ?>
                            <img src="/uploads/profiles/<?= htmlspecialchars($business['producer_photo']) ?>" 
                                 alt="<?= htmlspecialchars($business['producer_name']) ?>" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl">
                        <?php else: ?>
                            <div class="w-32 h-32 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center border-4 border-white shadow-xl">
                                <i class="fas fa-user text-4xl text-white"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Información del Negocio -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                            <?= htmlspecialchars($business['name']) ?>
                        </h1>
                        
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 text-white/90">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                <span><?= htmlspecialchars($business['producer_name'] . ' ' . $business['producer_lastname']) ?></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-2"></i>
                                <span><?= htmlspecialchars($business['phone']) ?></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span><?= htmlspecialchars($business['municipality_name'] . ', ' . $business['department_name']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-map-marked-alt text-blue-600 mr-2"></i>
                        <?= _e('business.address', 'Dirección') ?>
                    </h3>
                    <p class="text-gray-600"><?= htmlspecialchars($business['address']) ?></p>
                </div>
            
                <?php if (!empty($business['description'])): ?>
                <div class="border-t border-gray-200 pt-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        <?= _e('business.description', 'Descripción') ?>
                    </h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line"><?= htmlspecialchars($business['description']) ?></p>
                </div>
                <?php endif; ?>
                
                <!-- Botón de WhatsApp -->
                <div class="border-t border-gray-200 pt-6">
                    <button onclick="contactWhatsApp()" 
                            class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white py-3 px-8 rounded-lg transition-all hover:shadow-lg font-semibold inline-flex items-center justify-center space-x-2">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span><?= _e('business.contact_whatsapp', 'Contactar por WhatsApp') ?></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Productos del Negocio -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 md:p-8 mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                <?= _e('business.available_products', 'Productos Disponibles') ?>
                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-base font-semibold rounded-full ml-2">
                    <?= count($products) ?>
                </span>
            </h2>
            
            <?php if (empty($products)): ?>
                <div class="text-center py-16">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-700 mb-2"><?= _e('business.no_products', 'No hay productos disponibles') ?></h3>
                    <p class="text-gray-500"><?= _e('business.no_products_message', 'Este negocio no tiene productos publicados actualmente') ?></p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-200 transition-all group">
                        <div class="h-52 bg-gray-100 relative overflow-hidden">
                            <?php if ($product['main_photo']): ?>
                                <img src="/uploads/products/<?= htmlspecialchars($product['main_photo']) ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <i class="fas fa-image text-5xl text-gray-300"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                <?= htmlspecialchars($product['name']) ?>
                            </h3>
                            <p class="text-2xl font-bold text-blue-600 mb-4">
                                $<?= number_format($product['price'], 2) ?>
                            </p>
                            
                            <div class="space-y-2">
                                <a href="/tienda/product/<?= $product['id'] ?>" 
                                   class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white py-2.5 px-4 rounded-lg transition-all font-medium">
                                    <i class="fas fa-eye mr-2"></i><?= _e('business.view_details', 'Ver Detalles') ?>
                                </a>
                                <button onclick="contactProductWhatsApp('<?= htmlspecialchars($business['phone']) ?>', '<?= htmlspecialchars($business['producer_name']) ?>', '<?= htmlspecialchars($business['name']) ?>', '<?= htmlspecialchars($product['name']) ?>', '<?= $product['id'] ?>')" 
                                        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg transition-all font-medium">
                                    <i class="fab fa-whatsapp mr-2"></i><?= _e('business.contact_seller', 'Contactar Vendedor') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<script>
// Contactar al negocio en general
function contactWhatsApp() {
    const phone = '<?= htmlspecialchars($business['phone']) ?>';
    const cleanPhone = phone.replace(/\D/g, '');
    const producerName = '<?= htmlspecialchars($business['producer_name'] . ' ' . $business['producer_lastname']) ?>';
    const businessName = '<?= htmlspecialchars($business['name']) ?>';
    const businessUrl = window.location.href;
    const message = `<?= _e('whatsapp.business_message', 'Hola {producer}, me interesa conocer más sobre su negocio {business}. Puede ver su perfil aquí: {url}', [
        'producer' => $business['producer_name'] . ' ' . $business['producer_lastname'],
        'business' => $business['name'],
        'url' => '${businessUrl}'
    ]) ?>`;
    const encodedMessage = encodeURIComponent(message);
    window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
}

// Contactar sobre un producto específico
function contactProductWhatsApp(phone, producerName, businessName, productName, productId) {
    const cleanPhone = phone.replace(/\D/g, '');
    const productUrl = window.location.origin + '/tienda/product/' + productId;
    const message = `<?= _e('whatsapp.product_message', 'Hola {producer}, me interesa el producto "{product}" de su negocio {business}. Puede ver el producto aquí: {url}', [
        'producer' => '${producerName}',
        'product' => '${productName}',
        'business' => '${businessName}',
        'url' => '${productUrl}'
    ]) ?>`;
    const encodedMessage = encodeURIComponent(message);
    window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
}
</script>
</body>
</html>
