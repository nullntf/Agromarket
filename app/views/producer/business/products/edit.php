<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - AgroCompra</title>
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
                        <i class="fas fa-edit text-green-600 text-xl"></i>
                        <h1 class="text-xl font-bold text-gray-900">Editar Producto</h1>
                    </div>
                    <a href="/producer/business" class="text-sm text-gray-600 hover:text-green-600 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span class="hidden sm:inline">Volver</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Error Message -->
            <?php if (isset($error)): ?>
                <div class="max-w-3xl mx-auto mb-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start space-x-3">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                        <p class="text-red-800 flex-1"><?= htmlspecialchars($error) ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Success Message -->
            <?php if (isset($success)): ?>
                <div class="max-w-3xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                        <p class="text-green-800 flex-1"><?= htmlspecialchars($success) ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Form -->
            <form method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <?php
                    require_once '../helpers/Session.php';
                    // Session::start();
                    ?>
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                    
                    <!-- Current Photos -->
                    <?php if (!empty($photos)): ?>
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center justify-between">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-images text-green-600"></i>
                                <span>Fotos Actuales</span>
                            </span>
                            <span class="text-sm font-normal text-gray-600"><?= count($photos) ?>/5 fotos</span>
                        </h2>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                            <?php foreach ($photos as $photo): ?>
                            <div class="relative group existing-photo">
                                <img src="/uploads/products/<?= htmlspecialchars($photo['photo']) ?>" 
                                     alt="Foto del producto" 
                                     class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                                <button type="button"
                                        onclick="confirmDeletePhoto(<?= $photo['id'] ?>)"
                                        class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-lg">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-8"></div>
                    <?php endif; ?>
                    
                    <!-- Product Information -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                            <i class="fas fa-box text-green-600"></i>
                            <span>Información del Producto</span>
                        </h2>
                        
                        <!-- Product Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-tag text-gray-500"></i>
                                <span>Nombre del Producto <span class="text-red-600">*</span></span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   maxlength="200"
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   value="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                        
                        <!-- Price and Category -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-dollar-sign text-gray-500"></i>
                                    <span>Precio <span class="text-red-600">*</span></span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-500 font-semibold">$</span>
                                    <input type="number" 
                                           id="price" 
                                           name="price" 
                                           required
                                           min="0"
                                           step="0.01"
                                           class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                           value="<?= htmlspecialchars($product['price']) ?>">
                                </div>
                            </div>
                            
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-list text-gray-500"></i>
                                    <span>Categoría <span class="text-red-600">*</span></span>
                                </label>
                                <select id="category_id" 
                                        name="category_id" 
                                        required
                                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Seleccionar categoría</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-align-left text-gray-500"></i>
                                <span>Descripción</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-8"></div>
                    
                    <!-- Add More Photos -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                            <i class="fas fa-camera text-green-600"></i>
                            <span>Agregar Más Fotos</span>
                        </h2>
                        
                        <div class="mb-4">
                            <label for="photos" class="block text-sm font-semibold text-gray-700 mb-2">Seleccionar Fotos</label>
                            <input type="file" 
                                   id="photos" 
                                   name="photos[]" 
                                   accept="image/*"
                                   multiple
                                   onchange="previewImages(event)"
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-600 file:text-white file:font-medium hover:file:bg-green-700 transition-colors">
                            <p class="text-xs text-gray-500 mt-2 flex items-center space-x-1">
                                <i class="fas fa-info-circle"></i>
                                <span>Máximo 10MB por imagen. Formatos: JPG, PNG, GIF, WEBP. Límite total: 5 fotos por producto</span>
                            </p>
                        </div>
                        
                        <!-- New Images Preview -->
                        <div id="preview-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 hidden"></div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Guardar Cambios</span>
                        </button>
                        <a href="/producer/business" class="flex-1 inline-flex items-center justify-center space-x-2 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </a>
                    </div>
                </div>
            </form>
        </main>
    </div>

<script>
function previewImages(event) {
    const previewContainer = document.getElementById('preview-container');
    const input = event.target;
    const files = input.files;
    const maxFiles = 5;
    
    // Count existing photos
    const existingPhotos = document.querySelectorAll('.existing-photo').length;
    const availableSlots = maxFiles - existingPhotos;
    
    // Validate total limit
    if (files.length > availableSlots) {
        alert(`Solo puedes agregar ${availableSlots} imagen(es) más. El producto ya tiene ${existingPhotos} foto(s) y el límite es ${maxFiles}.`);
        input.value = '';
        previewContainer.classList.add('hidden');
        previewContainer.innerHTML = '';
        return;
    }
    
    if (files.length === 0) {
        previewContainer.classList.add('hidden');
        previewContainer.innerHTML = '';
        return;
    }
    
    previewContainer.classList.remove('hidden');
    previewContainer.innerHTML = '';
    
    Array.from(files).slice(0, availableSlots).forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Preview ${index + 1}" 
                         class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                    <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full font-semibold">
                        Nueva
                    </div>
                `;
                previewContainer.appendChild(div);
            };
            
            reader.readAsDataURL(file);
        }
    });
}

function confirmDeletePhoto(photoId) {
    if (confirm('¿Estás seguro de que deseas eliminar esta foto?')) {
        window.location.href = `/producer/business/products/photo/delete/${photoId}`;
    }
}
</script>
</body>
</html>
