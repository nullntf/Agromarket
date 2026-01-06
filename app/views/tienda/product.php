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
        
        /* Hamburger Icon */
        .hamburger-icon {
            width: 24px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .hamburger-line {
            width: 100%;
            height: 2px;
            background-color: white;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .hamburger-icon.active .hamburger-line:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }
        
        .hamburger-icon.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-icon.active .hamburger-line:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }
        
        /* Mobile Menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .mobile-menu.active {
            max-height: 400px;
        }
        
        .mobile-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            transition: background-color 0.2s;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .mobile-menu-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .mobile-menu-link i {
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-[#f5f7ef] text-gray-900">
    <!-- Navbar -->
    <nav class="bg-[#6b7a2a] text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?= BASE_URL ?>/" class="flex items-center space-x-2">
                    <i class="fas fa-seedling text-[#e6efd8] text-2xl"></i>
                    <span class="text-xl font-bold text-white">AgroCompra</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="<?= BASE_URL ?>/tienda" class="inline-flex items-center px-4 py-2 text-sm font-semibold hover:opacity-90 transition">
                        <i class="fas fa-store mr-2"></i><?= _e('store.title', 'Tienda') ?>
                    </a>
                    <a href="<?= BASE_URL ?>/" class="inline-flex items-center px-4 py-2 text-sm font-semibold hover:opacity-90 transition">
                        <i class="fas fa-home mr-2"></i><?= _e('breadcrumb_home', 'Inicio') ?>
                    </a>
                    <!-- Language Switcher -->
                    <?php include __DIR__ . '/../partials/language_switcher.php'; ?>
                    
                    <a href="<?= BASE_URL ?>/login" class="inline-flex items-center px-5 py-2.5 bg-[#e6efd8] text-[#334015] font-extrabold rounded-full hover:brightness-95 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i><?= _e('login', 'Iniciar Sesión') ?>
                    </a>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <button id="hamburger-btn" class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-white/10 transition focus:outline-none" aria-label="Toggle menu">
                    <div class="hamburger-icon">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </div>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden">
            <div class="px-4 pt-2 pb-6 space-y-3">
                <a href="<?= BASE_URL ?>/tienda" class="mobile-menu-link">
                    <i class="fas fa-store"></i>
                    <span><?= _e('store.title', 'Tienda') ?></span>
                </a>
                <a href="<?= BASE_URL ?>/" class="mobile-menu-link">
                    <i class="fas fa-home"></i>
                    <span><?= _e('breadcrumb_home', 'Inicio') ?></span>
                </a>
                
                <div class="h-px bg-white/20 my-3"></div>
                
                <a href="<?= BASE_URL ?>/login" class="block w-full px-5 py-3 bg-[#e6efd8] text-[#334015] font-bold rounded-full hover:brightness-95 transition text-center">
                    <?= _e('login', 'Iniciar Sesión') ?>
                </a>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-[#dfe8cf]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="<?= BASE_URL ?>/" class="hover:text-[#6b7a2a] transition-colors"><?= _e('breadcrumb_home', 'Inicio') ?></a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="<?= BASE_URL ?>/tienda" class="hover:text-[#6b7a2a] transition-colors"><?= _e('store.title', 'Tienda') ?></a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-[#22310e] font-medium"><?= htmlspecialchars($product['name']) ?></span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Galería de Fotos -->
            <div class="space-y-4">
                <?php if (!empty($photos)): ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] overflow-hidden">
                        <img id="mainImage" 
                             src="<?= BASE_URL ?>/uploads/products/<?= htmlspecialchars($photos[0]['photo']) ?>" 
                             alt="<?= htmlspecialchars($product['name']) ?>" 
                             class="w-full h-96 object-cover">
                    </div>
                    <?php if (count($photos) > 1): ?>
                    <div class="grid grid-cols-4 gap-3">
                        <?php foreach ($photos as $index => $photo): ?>
                        <button type="button" onclick="changeMainImage(this.querySelector('img').src, this)" 
                                class="thumbnail-btn bg-white rounded-lg shadow-sm border-2 overflow-hidden transition-all hover:border-[#6b7a2a] <?= $index === 0 ? 'border-[#6b7a2a]' : 'border-gray-200' ?>">
                            <img src="<?= BASE_URL ?>/uploads/products/<?= htmlspecialchars($photo['photo']) ?>" 
                                 alt="Foto <?= $index + 1 ?>" 
                                 class="w-full h-20 object-cover">
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] overflow-hidden">
                        <div class="w-full h-96 bg-gradient-to-br from-[#f5f7ef] to-[#e6efd8] flex items-center justify-center">
                            <i class="fas fa-image text-8xl text-gray-300"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Información del Producto -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] p-6 md:p-8">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#22310e] mb-4">
                        <?= htmlspecialchars($product['name']) ?>
                    </h1>
                    
                    <div class="flex items-baseline space-x-3 mb-6">
                        <p class="text-4xl md:text-5xl font-extrabold text-[#6b7a2a]">
                            <?= _e('product.price', 'Precio') ?>: $<?= number_format($product['price'], 2) ?>
                        </p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2"><?= _e('product.category', 'Categoría') ?></h3>
                        <p class="inline-flex items-center px-3 py-1 bg-[#e6efd8] text-[#334015] text-sm font-bold rounded-full">
                            <i class="fas fa-tag mr-2"></i>
                            <?= htmlspecialchars($product['category_name']) ?>
                        </p>
                    </div>
                    
                    <?php if (!empty($product['description'])): ?>
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-semibold text-[#22310e] mb-3 flex items-center">
                            <i class="fas fa-align-left text-[#6b7a2a] mr-2"></i>
                            <?= _e('product.description', 'Descripción') ?>
                        </h3>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line"><?= htmlspecialchars($product['description']) ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Botón de WhatsApp -->
                    <button onclick="contactWhatsApp()" 
                            class="w-full bg-[#6b7a2a] hover:brightness-95 text-white py-4 px-6 rounded-xl transition-all hover:shadow-lg font-extrabold text-lg inline-flex items-center justify-center space-x-2">
                        <i class="fab fa-whatsapp text-2xl"></i>
                        <span><?= _e('product.contact_whatsapp', 'Contactar por WhatsApp') ?></span>
                    </button>
                </div>
                
                <!-- Información del Negocio -->
                <div class="bg-gradient-to-br from-[#e6efd8] to-[#dfe8cf] rounded-2xl shadow-sm border border-[#9fb34d]/40 p-6">
                    <h3 class="text-lg font-semibold text-[#22310e] mb-4 flex items-center">
                        <i class="fas fa-store text-[#6b7a2a] mr-2"></i>
                        <?= _e('product.business_info', 'Información del Negocio') ?>
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-building text-[#6b7a2a] w-5 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= _e('product.business', 'Negocio') ?></p>
                                <a href="<?= BASE_URL ?>/tienda/business/<?= $business['id'] ?>" class="text-[#22310e] font-medium hover:text-[#6b7a2a] transition-colors">
                                    <?= htmlspecialchars($business['name']) ?>
                                </a>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-user text-[#6b7a2a] w-5 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= _e('product.producer', 'Productor') ?></p>
                                <p class="text-[#22310e] font-medium"><?= htmlspecialchars($product['producer_name'] . ' ' . $product['producer_lastname']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone text-[#6b7a2a] w-5 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= _e('product.phone', 'Teléfono') ?></p>
                                <p class="text-[#22310e] font-medium"><?= htmlspecialchars($business['phone']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== Hamburger Menu Toggle =====
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.querySelector('.hamburger-icon');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            hamburgerIcon.classList.toggle('active');
        });

        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                hamburgerIcon.classList.remove('active');
            });
        });

        document.addEventListener('click', function(e) {
            if (!hamburgerBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('active');
                hamburgerIcon.classList.remove('active');
            }
        });
    }
});

function changeMainImage(src, clickedBtn) {
    document.getElementById('mainImage').src = src;
    const thumbnails = document.querySelectorAll('.thumbnail-btn');
    thumbnails.forEach(btn => {
        btn.classList.remove('border-[#6b7a2a]');
        btn.classList.add('border-gray-200');
    });
    if (clickedBtn) {
        clickedBtn.classList.remove('border-gray-200');
        clickedBtn.classList.add('border-[#6b7a2a]');
    }
}

function contactWhatsApp() {
    const phone = '<?= htmlspecialchars($business['phone']) ?>';
    const cleanPhone = phone.replace(/\D/g, '');
    const producerName = '<?= htmlspecialchars($product['producer_name']) ?>';
    const businessName = '<?= htmlspecialchars($business['name']) ?>';
    const productName = '<?= htmlspecialchars($product['name']) ?>';
    const productUrl = 'https://agrocompra.santaanacentro.gob.sv' + window.location.pathname + (window.location.search || '');
    const message = `Hola ${producerName}, estoy interesado en el producto "${productName}" de ${businessName}. ¿Podría proporcionarme más información sobre precio, disponibilidad y opciones de entrega? Gracias. Producto: ${productUrl}`;
    const encodedMessage = encodeURIComponent(message);
    window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
}
</script>
</body>
</html>
