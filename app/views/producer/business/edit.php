<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Negocio - AgroCompra</title>
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
    <?php include __DIR__ . '/../sidebar.php'; ?>
    
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
                        <h1 class="text-xl font-bold text-gray-900">Editar Negocio</h1>
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
            <!-- Error Message -->
            <?php if (isset($error)): ?>
                <div class="max-w-3xl mx-auto mb-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start space-x-3">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                        <p class="text-red-800 flex-1"><?= htmlspecialchars($error) ?></p>
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
                    
                    <!-- Business Information -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                            <i class="fas fa-store text-green-600"></i>
                            <span>Información del Negocio</span>
                        </h2>
                        
                        <!-- Business Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-tag text-gray-500"></i>
                                <span>Nombre del Negocio <span class="text-red-600">*</span></span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   maxlength="200"
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   value="<?= htmlspecialchars($business['name']) ?>">
                        </div>
                        
                        <!-- Phone -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-phone text-gray-500"></i>
                                <span>Teléfono <span class="text-red-600">*</span></span>
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   required
                                   maxlength="20"
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   value="<?= htmlspecialchars($business['phone']) ?>">
                        </div>
                        
                        <!-- Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-map text-gray-500"></i>
                                    <span>Departamento <span class="text-red-600">*</span></span>
                                </label>
                                <select id="department_id" 
                                        name="department_id" 
                                        required
                                        onchange="loadMunicipalities(this.value)"
                                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Seleccionar departamento</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id'] ?>" <?= $dept['id'] == $business['department_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($dept['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label for="municipality_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-gray-500"></i>
                                    <span>Municipio <span class="text-red-600">*</span></span>
                                </label>
                                <select id="municipality_id" 
                                        name="municipality_id" 
                                        required
                                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Seleccionar municipio</option>
                                    <?php foreach ($municipalities as $muni): ?>
                                        <option value="<?= $muni['id'] ?>" <?= $muni['id'] == $business['municipality_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($muni['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Address -->
                        <div class="mb-6">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                                <i class="fas fa-home text-gray-500"></i>
                                <span>Dirección <span class="text-red-600">*</span></span>
                            </label>
                            <input type="text" 
                                   id="address" 
                                   name="address" 
                                   required
                                   maxlength="255"
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   value="<?= htmlspecialchars($business['address']) ?>">
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
                                      class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"><?= htmlspecialchars($business['description'] ?? '') ?></textarea>
                            <p class="text-xs text-gray-500 mt-2 flex items-center space-x-1">
                                <i class="fas fa-info-circle"></i>
                                <span>Describe tu negocio, productos o servicios</span>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Guardar Cambios</span>
                        </button>
                        <a href="<?= BASE_URL ?>/producer/business" class="flex-1 inline-flex items-center justify-center space-x-2 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg transition-colors font-semibold">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </a>
                    </div>
                </div>
            </form>
        </main>
    </div>

<script>
function loadMunicipalities(departmentId) {
    const municipalitySelect = document.getElementById('municipality_id');
    
    if (!departmentId) {
        municipalitySelect.innerHTML = '<option value="">Seleccionar municipio</option>';
        return;
    }
    
    fetch(`/api/municipalities?department_id=${departmentId}`)
        .then(response => response.json())
        .then(data => {
            const currentMunicipality = municipalitySelect.value;
            municipalitySelect.innerHTML = '<option value="">Seleccionar municipio</option>';
            data.forEach(municipality => {
                const option = document.createElement('option');
                option.value = municipality.id;
                option.textContent = municipality.name;
                if (municipality.id == currentMunicipality) {
                    option.selected = true;
                }
                municipalitySelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar municipios:', error);
        });
}
</script>
</body>
</html>
