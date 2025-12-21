<!DOCTYPE html>
<html lang="<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'es'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php _e('store.title', 'Tienda - AgroCompra'); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Sora', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Geist', sans-serif; }

        /* Tailwind CDN no siempre trae line-clamp plugin */
        .line-clamp-2{
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-[#f5f7ef] text-gray-900">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 bg-[#6b7a2a] text-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/" class="flex items-center gap-2">
                <i class="fas fa-seedling text-[#e6efd8] text-2xl"></i>
                <span class="text-xl font-extrabold tracking-wide">AgroCompra</span>
            </a>

            <div class="flex items-center gap-3">
                <a href="/" class="hidden sm:inline-flex items-center px-3 py-2 text-sm font-semibold hover:opacity-90 transition">
                    <i class="fas fa-home mr-2"></i><?php _e('home.nav.home', 'Inicio'); ?>
                </a>

                <!-- Language Switcher -->
                <div class="hidden sm:block">
                    <?php include __DIR__ . '/../partials/language_switcher.php'; ?>
                </div>

                <a href="/login"
                   class="inline-flex items-center px-5 py-2.5 bg-[#e6efd8] text-[#334015] font-extrabold rounded-full hover:brightness-95 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i><?php _e('home.nav.login', 'Iniciar Sesión'); ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<header class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#6b7a2a] via-[#6b7a2a] to-[#4f5c1e]"></div>
    <div class="absolute inset-0 opacity-15"
         style="background-image: radial-gradient(circle at 20% 20%, #ffffff 0, transparent 35%),
                              radial-gradient(circle at 80% 30%, #ffffff 0, transparent 35%),
                              radial-gradient(circle at 40% 80%, #ffffff 0, transparent 35%);">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <p class="text-white/80 text-sm font-semibold flex items-center gap-2">
                    <i class="fas fa-store"></i>
                    <?php _e('store.title', 'Tienda - AgroCompra'); ?>
                </p>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mt-2">
                    <?php _e('store.catalog', 'Catálogo de Productos'); ?>
                </h1>
                <p class="text-white/90 mt-2 max-w-2xl">
                    <?php _e('store.discover', 'Descubre productos agrícolas frescos de toda El Salvador'); ?>
                </p>
            </div>

            <div class="hidden md:flex items-center gap-3 bg-white/10 border border-white/15 rounded-2xl px-4 py-3 backdrop-blur">
                <div class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                    <i class="fas fa-leaf text-white"></i>
                </div>
                <div class="text-white">
                    <p class="text-sm font-bold"><?php _e('store.tip.title', 'Tip'); ?></p>
                    <p class="text-xs text-white/80"><?php _e('store.tip.text', 'Usa filtros para encontrar más rápido.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <?php if (isset($_GET['error'])): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
            <i class="fas fa-times-circle text-red-600 mt-0.5"></i>
            <p class="text-sm text-red-800"><?= htmlspecialchars($_GET['error']) ?></p>
        </div>
    <?php endif; ?>

    <!-- FILTROS -->
    <section class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-extrabold text-[#22310e] flex items-center">
                <i class="fas fa-filter text-[#6b7a2a] mr-2"></i>
                <?php _e('store.filters.title', 'Filtros de Búsqueda'); ?>
            </h2>

            <button type="button" onclick="resetFilters()"
                    class="text-sm text-[#6b7a2a] hover:opacity-80 font-semibold">
                <i class="fas fa-times mr-1"></i> <?php _e('store.filters.clear', 'Limpiar Filtros'); ?>
            </button>
        </div>

        <form id="filterForm" method="GET" action="/tienda" class="space-y-5">
            <div>
                <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-search text-gray-400 mr-2"></i><?php _e('store.filters.search', 'Búsqueda General'); ?>
                </label>
                <input type="text" id="search" name="search"
                       value="<?= isset($filters['search']) ? htmlspecialchars($filters['search']) : '' ?>"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#6b7a2a]/40 focus:border-[#6b7a2a] outline-none bg-white"
                       placeholder="<?php _e('store.filters.search', 'Buscar productos...'); ?>">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tag text-gray-400 mr-2"></i><?php _e('store.filters.category', 'Categoría'); ?>
                    </label>
                    <select id="category_id" name="category_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#6b7a2a]/40 focus:border-[#6b7a2a] outline-none bg-white">
                        <option value=""><?php _e('store.filters.category', 'Todas las categorías'); ?></option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= (isset($filters['category_id']) && $filters['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i><?php _e('store.filters.department', 'Departamento'); ?>
                    </label>
                    <select id="department_id" name="department_id"
                            onchange="loadMunicipalities(this.value)"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#6b7a2a]/40 focus:border-[#6b7a2a] outline-none bg-white">
                        <option value=""><?php _e('store.filters.department', 'Todos los departamentos'); ?></option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department['id'] ?>" <?= (isset($filters['department_id']) && $filters['department_id'] == $department['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($department['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="municipality_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-location-dot text-gray-400 mr-2"></i><?php _e('store.filters.municipality', 'Municipio'); ?>
                    </label>
                    <select id="municipality_id" name="municipality_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#6b7a2a]/40 focus:border-[#6b7a2a] outline-none bg-white">
                        <option value=""><?php _e('store.filters.municipality', 'Todos los municipios'); ?></option>
                        <?php foreach ($municipalities as $municipality): ?>
                            <option value="<?= $municipality['id'] ?>" <?= (isset($filters['municipality_id']) && $filters['municipality_id'] == $municipality['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($municipality['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit"
                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-[#6b7a2a] hover:brightness-95 text-white font-extrabold rounded-xl transition shadow-sm">
                    <i class="fas fa-search mr-2"></i>
                    <?php _e('store.filters.search_button', 'Buscar'); ?>
                </button>

                <button type="reset"
                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 font-semibold rounded-xl transition">
                    <i class="fas fa-undo mr-2"></i>
                    <?php _e('store.filters.reset_button', 'Reiniciar'); ?>
                </button>
            </div>
        </form>
    </section>

    <!-- RESULTADOS -->
    <section class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-extrabold text-[#22310e] flex items-center gap-2">
            <i class="fas fa-basket-shopping text-[#6b7a2a]"></i>
            <?php _e('store.results.products', 'Productos') ?>
            <?php if (count($products) > 0): ?>
                <span class="inline-flex items-center px-3 py-1 bg-[#e6efd8] text-[#334015] text-sm font-extrabold rounded-full">
                    <?= count($products) ?>
                </span>
            <?php endif; ?>
        </h2>

        <!-- Podés meter aquí un "ordenar por" luego si querés -->
    </section>

    <?php if (empty($products)): ?>
        <div class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] p-14 text-center">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-extrabold text-gray-800 mb-2">No se encontraron productos</h3>
            <p class="text-gray-500 mb-6">Intenta ajustar los filtros de búsqueda</p>
            <a href="/tienda"
               class="inline-flex items-center px-6 py-3 bg-[#6b7a2a] hover:brightness-95 text-white font-extrabold rounded-xl transition">
                <i class="fas fa-redo mr-2"></i>
                Ver Todos los Productos
            </a>
        </div>
    <?php else: ?>

        <!-- GRID DE PRODUCTOS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($products as $product): ?>
                <article class="bg-white rounded-2xl shadow-sm border border-[#dfe8cf] overflow-hidden hover:shadow-lg hover:border-[#9fb34d]/60 transition-all group">
                    <!-- Imagen -->
                    <div class="h-52 bg-gray-100 relative overflow-hidden">
                        <?php if ($product['main_photo']): ?>
                            <img src="/uploads/products/<?= htmlspecialchars($product['main_photo']) ?>"
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#f5f7ef] to-[#e6efd8]">
                                <i class="fas fa-image text-5xl text-gray-300"></i>
                            </div>
                        <?php endif; ?>

                        <!-- Precio badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/90 text-[#22310e] font-extrabold text-sm shadow-sm">
                                $<?= number_format($product['price'], 2) ?>
                            </span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-5">
                        <h3 class="text-lg font-extrabold text-[#22310e] mb-3 line-clamp-2 group-hover:text-[#6b7a2a] transition-colors">
                            <?= htmlspecialchars($product['name']) ?>
                        </h3>

                        <div class="space-y-2 mb-4 text-sm text-gray-600">
                            <p class="flex items-center">
                                <i class="fas fa-store text-[#6b7a2a] w-4 mr-2"></i>
                                <span class="truncate"><?= htmlspecialchars($product['business_name']) ?></span>
                            </p>

                            <p class="flex items-center">
                                <i class="fas fa-user text-[#6b7a2a] w-4 mr-2"></i>
                                <span class="truncate"><?= htmlspecialchars($product['producer_name'] . ' ' . $product['producer_lastname']) ?></span>
                            </p>

                            <p class="flex items-center">
                                <i class="fas fa-location-dot text-[#6b7a2a] w-4 mr-2"></i>
                                <span class="truncate"><?= htmlspecialchars($product['municipality_name'] . ', ' . $product['department_name']) ?></span>
                            </p>
                        </div>

                        <!-- Botones -->
                        <div class="space-y-2">
                            <a href="/tienda/product/<?= $product['id'] ?>"
                               class="block w-full text-center bg-[#1a1f12] hover:bg-[#14180f] text-white py-2.5 px-4 rounded-xl transition font-semibold">
                                <i class="fas fa-eye mr-2"></i>Ver Detalles
                            </a>

                            <button
                                onclick="contactWhatsApp('<?= htmlspecialchars($product['business_phone']) ?>', '<?= htmlspecialchars($product['producer_name']) ?>', '<?= htmlspecialchars($product['business_name']) ?>', '<?= htmlspecialchars($product['name']) ?>', '<?= $product['id'] ?>')"
                                class="block w-full text-center bg-[#6b7a2a] hover:brightness-95 text-white py-2.5 px-4 rounded-xl transition font-extrabold">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                            </button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</main>

<script>
    // (Opcional) Resetear filtros sin romper tu flujo
    function resetFilters(){
        window.location.href = '/tienda';
    }

    // Cargar municipios dinámicamente
    async function loadMunicipalities(departmentId) {
        const municipalitySelect = document.getElementById('municipality_id');
        municipalitySelect.innerHTML = '<option value=""><?php _e('store.filters.loading', 'Cargando...') ?>';

        if (!departmentId) {
            municipalitySelect.innerHTML = '<option value=""><?php _e('store.filters.municipality', 'Todos los municipios'); ?></option>';
            return;
        }

        try {
            const response = await fetch(`/api/municipalities?department_id=${departmentId}`);
            const municipalities = await response.json();

            municipalitySelect.innerHTML = '<option value=""><?php _e('store.filters.municipality', 'Todos los municipios'); ?></option>';
            municipalities.forEach(municipality => {
                const option = document.createElement('option');
                option.value = municipality.id;
                option.textContent = municipality.name;
                municipalitySelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error al cargar municipios:', error);
            municipalitySelect.innerHTML = '<option value=""><?php _e('store.filters.error_loading', 'Error al cargar'); ?></option>';
        }
    }

    // Función para contactar por WhatsApp
    function contactWhatsApp(phone, producerName, businessName, productName, productId) {
        const cleanPhone = (phone || '').replace(/\D/g, '');
        const productUrl = window.location.origin + '/tienda/product/' + productId;
        const message = `Hola ${producerName}, me interesa el producto "${productName}" de su negocio ${businessName}. Puede ver el producto aquí: ${productUrl}`;
        const encodedMessage = encodeURIComponent(message);
        window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
    }
</script>

</body>
</html>
