<!DOCTYPE html>
<html lang="<?= $lang ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - <?= _e('product.title', 'Detalles del Producto') ?></title>
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

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="/" class="hover:text-blue-600 transition-colors"><?= _e('breadcrumb_home', 'Inicio') ?></a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="/tienda" class="hover:text-blue-600 transition-colors"><?= _e('store.title', 'Tienda') ?></a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-900 font-medium"><?= htmlspecialchars($product['name']) ?></span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Galería de Fotos -->
            <div class="space-y-4">
                <?php if (!empty($photos)): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <img id="mainImage" 
                             src="/uploads/products/<?= htmlspecialchars($photos[0]['photo']) ?>" 
                             alt="<?= htmlspecialchars($product['name']) ?>" 
                             class="w-full h-96 object-cover">
                    </div>
                    <?php if (count($photos) > 1): ?>
                    <div class="grid grid-cols-4 gap-3">
                        <?php foreach ($photos as $index => $photo): ?>
                        <button type="button" onclick="changeMainImage(this.querySelector('img').src, this)" 
                                class="thumbnail-btn bg-white rounded-lg shadow-sm border-2 overflow-hidden transition-all hover:border-blue-400 <?= $index === 0 ? 'border-blue-600' : 'border-gray-200' ?>">
                            <img src="/uploads/products/<?= htmlspecialchars($photo['photo']) ?>" 
                                 alt="Foto <?= $index + 1 ?>" 
                                 class="w-full h-20 object-cover">
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-8xl text-gray-300"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Información del Producto -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        <?= htmlspecialchars($product['name']) ?>
                    </h1>
                    
                    <div class="flex items-baseline space-x-3 mb-6">
                        <p class="text-4xl md:text-5xl font-bold text-blue-600">
                            <?= _e('product.price', 'Precio') ?>: $<?= number_format($product['price'], 2) ?>
                        </p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2"><?= _e('product.category', 'Categoría') ?></h3>
                        <p class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
                            <i class="fas fa-tag mr-2"></i>
                            <?= htmlspecialchars($product['category_name']) ?>
                        </p>
                    </div>
                    
                    <?php if (!empty($product['description'])): ?>
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-align-left text-blue-600 mr-2"></i>
                            <?= _e('product.description', 'Descripción') ?>
                        </h3>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line"><?= htmlspecialchars($product['description']) ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Botón de WhatsApp -->
                    <button onclick="contactWhatsApp()" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 px-6 rounded-lg transition-all hover:shadow-lg font-semibold text-lg inline-flex items-center justify-center space-x-2">
                        <i class="fab fa-whatsapp text-2xl"></i>
                        <span><?= _e('product.contact_whatsapp', 'Contactar por WhatsApp') ?></span>
                    </button>
                </div>
                
                <!-- Información del Negocio -->
                <div class="bg-gradient-to-br from-blue-50 to-sky-50 rounded-xl shadow-sm border border-blue-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-store text-blue-600 mr-2"></i>
                        <?= _e('product.business_info', 'Información del Negocio') ?>
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-building text-blue-600 w-5 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= _e('product.business', 'Negocio') ?></p>
                                <a href="/tienda/business/<?= $business['id'] ?>" class="text-gray-900 font-medium hover:text-blue-600 transition-colors">
                                    <?= htmlspecialchars($business['name']) ?>
                                </a>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-user text-blue-600 w-5 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= _e('product.producer', 'Productor') ?></p>
                                <p class="text-gray-900 font-medium"><?= htmlspecialchars($product['producer_name'] . ' ' . $product['producer_lastname']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone text-blue-600 w-5 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= _e('product.phone', 'Teléfono') ?></p>
                                <p class="text-gray-900 font-medium"><?= htmlspecialchars($business['phone']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
function changeMainImage(src, clickedBtn) {
    document.getElementById('mainImage').src = src;
    const thumbnails = document.querySelectorAll('.thumbnail-btn');
    thumbnails.forEach(btn => {
        btn.classList.remove('border-blue-600');
        btn.classList.add('border-gray-200');
    });
    if (clickedBtn) {
        clickedBtn.classList.remove('border-gray-200');
        clickedBtn.classList.add('border-blue-600');
    }
}

function contactWhatsApp() {
    const phone = '<?= htmlspecialchars($business['phone']) ?>';
    const cleanPhone = phone.replace(/\D/g, '');
    const producerName = '<?= htmlspecialchars($product['producer_name']) ?>';
    const businessName = '<?= htmlspecialchars($business['name']) ?>';
    const productName = '<?= htmlspecialchars($product['name']) ?>';
    const productUrl = window.location.href;
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
