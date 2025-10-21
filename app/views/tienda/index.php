<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - AgroMarket</title>
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
                    <span class="text-xl font-bold text-gray-900">AgroMarket</span>
                </a>
                <div class="flex items-center space-x-3">
                    <a href="/" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        <i class="fas fa-home mr-2"></i>Inicio
                    </a>
                    <a href="/login" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-sky-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Catálogo de Productos</h1>
            <p class="text-blue-50">Descubre productos agrícolas frescos de toda El Salvador</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start space-x-3">
                <i class="fas fa-times-circle text-red-600 mt-0.5"></i>
                <p class="text-sm text-red-800"><?= htmlspecialchars($_GET['error']) ?></p>
            </div>
        <?php endif; ?>
        
        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>
                    Filtros de Búsqueda
                </h2>
                <button type="button" onclick="document.getElementById('filterForm').classList.toggle('hidden')" class="md:hidden text-gray-600 hover:text-blue-600">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <form id="filterForm" method="GET" action="/tienda" class="space-y-5">
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-search text-gray-400 mr-2"></i>Búsqueda General
                    </label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="<?= htmlspecialchars($filters['search'] ?? '') ?>"
                           placeholder="Buscar por nombre, negocio o productor..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag text-gray-400 mr-2"></i>Categoría
                        </label>
                        <select id="category_id" 
                                name="category_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Todas las categorías</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($filters['category_id']) && $filters['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marked-alt text-gray-400 mr-2"></i>Departamento
                        </label>
                        <select id="department_id" 
                                name="department_id"
                                onchange="loadMunicipalities(this.value)"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Todos los departamentos</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= $department['id'] ?>" <?= (isset($filters['department_id']) && $filters['department_id'] == $department['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($department['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="municipality_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>Municipio
                        </label>
                        <select id="municipality_id" 
                                name="municipality_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Todos los municipios</option>
                            <?php foreach ($municipalities as $municipality): ?>
                                <option value="<?= $municipality['id'] ?>" <?= (isset($filters['municipality_id']) && $filters['municipality_id'] == $municipality['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($municipality['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-dollar-sign text-gray-400 mr-2"></i>Rango de Precio
                        </label>
                        <div class="flex space-x-2">
                            <input type="number" 
                                   name="min_price" 
                                   value="<?= htmlspecialchars($filters['min_price'] ?? '') ?>"
                                   placeholder="Mín"
                                   step="0.01"
                                   class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <input type="number" 
                                   name="max_price" 
                                   value="<?= htmlspecialchars($filters['max_price'] ?? '') ?>"
                                   placeholder="Máx"
                                   step="0.01"
                                   class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all hover:shadow-lg">
                        <i class="fas fa-search mr-2"></i>
                        Buscar
                    </button>
                    <a href="/tienda" 
                       class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-all">
                        <i class="fas fa-times mr-2"></i>
                        Limpiar
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Resultados -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">
                Productos Disponibles
                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full ml-2">
                    <?= count($products) ?>
                </span>
            </h2>
        </div>
        
        <?php if (empty($products)): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-16 text-center">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-700 mb-2">No se encontraron productos</h3>
                <p class="text-gray-500 mb-6">Intenta ajustar los filtros de búsqueda</p>
                <a href="/tienda" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-redo mr-2"></i>
                    Ver Todos los Productos
                </a>
            </div>
        <?php else: ?>
            <!-- Grid de Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-200 transition-all group">
                    <!-- Imagen del Producto -->
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
                    
                    <!-- Información del Producto -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                            <?= htmlspecialchars($product['name']) ?>
                        </h3>
                        
                        <div class="space-y-2 mb-4">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-store text-gray-400 w-4 mr-2"></i>
                                <span class="truncate"><?= htmlspecialchars($product['business_name']) ?></span>
                            </p>
                            
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-user text-gray-400 w-4 mr-2"></i>
                                <span class="truncate"><?= htmlspecialchars($product['producer_name'] . ' ' . $product['producer_lastname']) ?></span>
                            </p>
                            
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400 w-4 mr-2"></i>
                                <span class="truncate"><?= htmlspecialchars($product['municipality_name'] . ', ' . $product['department_name']) ?></span>
                            </p>
                        </div>
                        
                        <div class="flex items-baseline justify-between mb-4">
                            <p class="text-2xl font-bold text-blue-600">
                                $<?= number_format($product['price'], 2) ?>
                            </p>
                        </div>
                        
                        <!-- Botones de Acción -->
                        <div class="space-y-2">
                            <a href="/tienda/product/<?= $product['id'] ?>" 
                               class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white py-2.5 px-4 rounded-lg transition-all font-medium">
                                <i class="fas fa-eye mr-2"></i>Ver Detalles
                            </a>
                            <button onclick="contactWhatsApp('<?= htmlspecialchars($product['business_phone']) ?>', '<?= htmlspecialchars($product['producer_name']) ?>', '<?= htmlspecialchars($product['business_name']) ?>', '<?= htmlspecialchars($product['name']) ?>', '<?= $product['id'] ?>')" 
                                    class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg transition-all font-medium">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

<script>
// Cargar municipios dinámicamente
async function loadMunicipalities(departmentId) {
    const municipalitySelect = document.getElementById('municipality_id');
    municipalitySelect.innerHTML = '<option value="">Cargando...</option>';
    
    if (!departmentId) {
        municipalitySelect.innerHTML = '<option value="">Todos los municipios</option>';
        return;
    }
    
    try {
        const response = await fetch(`/api/municipalities?department_id=${departmentId}`);
        const municipalities = await response.json();
        
        municipalitySelect.innerHTML = '<option value="">Todos los municipios</option>';
        municipalities.forEach(municipality => {
            const option = document.createElement('option');
            option.value = municipality.id;
            option.textContent = municipality.name;
            municipalitySelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar municipios:', error);
        municipalitySelect.innerHTML = '<option value="">Error al cargar</option>';
    }
}

// Función para contactar por WhatsApp
function contactWhatsApp(phone, producerName, businessName, productName, productId) {
    // Limpiar el número de teléfono (quitar espacios, guiones, etc.)
    const cleanPhone = phone.replace(/\D/g, '');
    
    // Crear el mensaje personalizado
    const productUrl = window.location.origin + '/tienda/product/' + productId;
    const message = `Hola ${producerName}, me interesa el producto "${productName}" de su negocio ${businessName}. Puede ver el producto aquí: ${productUrl}`;
    
    // Codificar el mensaje para URL
    const encodedMessage = encodeURIComponent(message);
    
    // Abrir WhatsApp
    window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
}
</script>
</body>
</html>