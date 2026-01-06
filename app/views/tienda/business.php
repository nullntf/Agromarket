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

    <!-- Información del Negocio -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-lg border border-[#dfe8cf] overflow-hidden mb-8">
            <!-- Hero Section con gradiente -->
            <div class="bg-gradient-to-r from-[#6b7a2a] via-[#6b7a2a] to-[#4f5c1e] p-8 md:p-12">
                <div class="flex flex-col md:flex-row md:items-center gap-6">
                    <!-- Foto de Perfil del Productor -->
                    <div class="flex-shrink-0 mx-auto md:mx-0">
                        <?php if (!empty($business['producer_photo'])): ?>
                            <img src="<?= BASE_URL ?>/uploads/profiles/<?= htmlspecialchars($business['producer_photo']) ?>" 
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
                    <h3 class="text-lg font-semibold text-[#22310e] mb-3 flex items-center">
                        <i class="fas fa-map-marked-alt text-[#6b7a2a] mr-2"></i>
                        <?= _e('business.address', 'Dirección') ?>
                    </h3>
                    <p class="text-gray-600"><?= htmlspecialchars($business['address']) ?></p>
                </div>
            
                <?php if (!empty($business['description'])): ?>
                <div class="border-t border-gray-200 pt-6 mb-6">
                    <h3 class="text-lg font-semibold text-[#22310e] mb-3 flex items-center">
                        <i class="fas fa-info-circle text-[#6b7a2a] mr-2"></i>
                        <?= _e('business.description', 'Descripción') ?>
                    </h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line"><?= htmlspecialchars($business['description']) ?></p>
                </div>
                <?php endif; ?>
                
                <!-- Botón de WhatsApp -->
                <div class="border-t border-gray-200 pt-6">
                    <button onclick="contactWhatsApp()" 
                            class="w-full md:w-auto bg-[#6b7a2a] hover:brightness-95 text-white py-3 px-8 rounded-xl transition-all hover:shadow-lg font-extrabold inline-flex items-center justify-center space-x-2">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span><?= _e('business.contact_whatsapp', 'Contactar por WhatsApp') ?></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Productos del Negocio -->
        <div class="bg-white rounded-2xl shadow-lg border border-[#dfe8cf] p-6 md:p-8 mb-8">
            <h2 class="text-2xl md:text-3xl font-extrabold text-[#22310e] mb-6">
                <?= _e('business.available_products', 'Productos Disponibles') ?>
                <span class="inline-flex items-center px-3 py-1 bg-[#e6efd8] text-[#334015] text-base font-extrabold rounded-full ml-2">
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
                <!-- Pagination Info -->
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Mostrando <span id="showing-start">1</span> - <span id="showing-end">8</span> de <span id="total-products"><?= count($products) ?></span> productos
                    </p>
                    <div class="flex items-center gap-2">
                        <label for="products-per-page" class="text-sm text-gray-600">Productos por página:</label>
                        <select id="products-per-page" class="px-3 py-1 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#6b7a2a]/40 focus:border-[#6b7a2a] outline-none">
                            <option value="8" selected>8</option>
                            <option value="12">12</option>
                            <option value="16">16</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                </div>
                
                <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] overflow-hidden hover:shadow-lg hover:border-[#9fb34d]/60 transition-all group">
                        <div class="h-52 bg-gray-100 relative overflow-hidden">
                            <?php if ($product['main_photo']): ?>
                                <img src="<?= BASE_URL ?>/uploads/products/<?= htmlspecialchars($product['main_photo']) ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#f5f7ef] to-[#e6efd8]">
                                    <i class="fas fa-image text-5xl text-gray-300"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-lg font-extrabold text-[#22310e] mb-3 line-clamp-2 group-hover:text-[#6b7a2a] transition-colors">
                                <?= htmlspecialchars($product['name']) ?>
                            </h3>
                            <p class="text-2xl font-extrabold text-[#6b7a2a] mb-4">
                                $<?= number_format($product['price'], 2) ?>
                            </p>
                            
                            <div class="space-y-2">
                                <a href="<?= BASE_URL ?>/tienda/product/<?= $product['id'] ?>" 
                                   class="block w-full text-center bg-[#1a1f12] hover:bg-[#14180f] text-white py-2.5 px-4 rounded-xl transition font-semibold">
                                    <i class="fas fa-eye mr-2"></i><?= _e('business.view_details', 'Ver Detalles') ?>
                                </a>
                                <button onclick="contactProductWhatsApp('<?= htmlspecialchars($business['phone']) ?>', '<?= htmlspecialchars($business['producer_name']) ?>', '<?= htmlspecialchars($business['name']) ?>', '<?= htmlspecialchars($product['name']) ?>', '<?= $product['id'] ?>')" 
                                        class="block w-full text-center bg-[#6b7a2a] hover:brightness-95 text-white py-2.5 px-4 rounded-xl transition font-extrabold">
                                    <i class="fab fa-whatsapp mr-2"></i><?= _e('business.contact_seller', 'Contactar Vendedor') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination Controls -->
                <div id="pagination-controls" class="mt-8 flex items-center justify-center gap-2">
                    <button id="prev-page" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition" disabled>
                        <i class="fas fa-chevron-left mr-2"></i>Anterior
                    </button>
                    
                    <div id="page-numbers" class="flex gap-1">
                        <!-- Page numbers will be inserted here by JavaScript -->
                    </div>
                    
                    <button id="next-page" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                        Siguiente<i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== Pagination Logic =====
    const allProducts = Array.from(document.querySelectorAll('#products-grid > div'));
    const totalProducts = allProducts.length;
    let currentPage = 1;
    let productsPerPage = 8;
    
    const productsGrid = document.getElementById('products-grid');
    const prevPageBtn = document.getElementById('prev-page');
    const nextPageBtn = document.getElementById('next-page');
    const pageNumbersContainer = document.getElementById('page-numbers');
    const productsPerPageSelect = document.getElementById('products-per-page');
    const showingStart = document.getElementById('showing-start');
    const showingEnd = document.getElementById('showing-end');
    const totalProductsSpan = document.getElementById('total-products');
    
    function getTotalPages() {
        return Math.ceil(totalProducts / productsPerPage);
    }
    
    function renderProducts() {
        const startIndex = (currentPage - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;
        
        allProducts.forEach((product, index) => {
            if (index >= startIndex && index < endIndex) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
        
        // Update showing info
        showingStart.textContent = totalProducts > 0 ? startIndex + 1 : 0;
        showingEnd.textContent = Math.min(endIndex, totalProducts);
        
        // Update buttons
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === getTotalPages();
        
        renderPageNumbers();
        
        // Scroll to top of products
        productsGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    function renderPageNumbers() {
        const totalPages = getTotalPages();
        pageNumbersContainer.innerHTML = '';
        
        // Show max 5 page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.textContent = i;
            pageBtn.className = `px-3 py-2 rounded-lg transition ${
                i === currentPage 
                    ? 'bg-[#6b7a2a] text-white font-bold' 
                    : 'border border-gray-300 hover:bg-gray-50'
            }`;
            pageBtn.addEventListener('click', () => {
                currentPage = i;
                renderProducts();
            });
            pageNumbersContainer.appendChild(pageBtn);
        }
    }
    
    prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderProducts();
        }
    });
    
    nextPageBtn.addEventListener('click', () => {
        if (currentPage < getTotalPages()) {
            currentPage++;
            renderProducts();
        }
    });
    
    productsPerPageSelect.addEventListener('change', (e) => {
        productsPerPage = parseInt(e.target.value);
        currentPage = 1;
        renderProducts();
    });
    
    // Initial render
    if (totalProducts > 0) {
        renderProducts();
    }
    
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
