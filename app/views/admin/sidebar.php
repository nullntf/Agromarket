<aside class="sidebar fixed left-0 top-0 w-72 h-full bg-gray-900 shadow-2xl text-gray-100 transition-transform duration-300 ease-in-out z-50 -translate-x-full lg:translate-x-0 border-r border-gray-800 flex flex-col">
    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-gray-800">
        <div class="flex items-center space-x-2">
            <i class="fas fa-shield-halved text-blue-500 text-2xl"></i>
            <h2 class="text-xl font-bold text-gray-100"><?php _e('admin.dashboard.title'); ?></h2>
        </div>
        <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-gray-200 text-2xl focus:outline-none transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <?php
    require_once '../helpers/Session.php';
    // Session::start();
    $currentUser = Session::getCurrentUser();
    $isMaster = $currentUser['rol'] === 'master';
    
    // Preparar foto de perfil (ruta de archivo)
    $profilePhoto = null;
    if (!empty($currentUser['profile_photo'])) {
        $profilePhoto = '/uploads/profiles/' . $currentUser['profile_photo'] . '?t=' . time();
    }
    
    // Color del rol
    $roleColors = [
        'master' => 'red',
        'admin' => 'blue',
        'producer' => 'green'
    ];
    $roleColor = $roleColors[$currentUser['rol']] ?? 'gray';
    ?>

    <!-- User Profile Card -->
    <div class="p-4 border-b border-gray-800">
        <div class="flex items-center space-x-3">
            <!-- Profile Photo -->
            <div class="w-12 h-12 rounded-full bg-gray-800 border-2 border-<?= $roleColor ?>-500 flex-shrink-0 overflow-hidden">
                <?php if ($profilePhoto): ?>
                    <img src="<?= $profilePhoto ?>" alt="<?= htmlspecialchars($currentUser['name']) ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                <?php endif; ?>
            </div>
            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-100 truncate">
                    <?= htmlspecialchars($currentUser['name'] . ' ' . $currentUser['lastname']) ?>
                </p>
                <div class="flex items-center space-x-1 mt-0.5">
                    <span class="text-xs px-2 py-0.5 bg-<?= $roleColor ?>-500/10 text-<?= $roleColor ?>-400 rounded border border-<?= $roleColor ?>-500/20">
                        <?= htmlspecialchars(ucfirst($currentUser['rol'])) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-1">
            <li>
                <a href="<?= BASE_URL ?>/admin" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-blue-400 transition-all duration-200 group">
                    <i class="fas fa-chart-line text-lg group-hover:scale-110 transition-transform"></i>
                    <span><?php _e('dashboard'); ?></span>
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>/admin/users" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-blue-400 transition-all duration-200 group">
                    <i class="fas fa-users text-lg group-hover:scale-110 transition-transform"></i>
                    <span><?php _e('admin.users.title'); ?></span>
                </a>
            </li>
            <?php if ($isMaster): ?>
            <li>
                <a href="<?= BASE_URL ?>/admin/categories" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-blue-400 transition-all duration-200 group">
                    <i class="fas fa-tags text-lg group-hover:scale-110 transition-transform"></i>
                    <span><?php _e('admin.categories.title'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <li>
                <a href="<?= BASE_URL ?>/admin/business" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-blue-400 transition-all duration-200 group">
                    <i class="fas fa-store text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Negocios</span>
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>/admin/settings" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-blue-400 transition-all duration-200 group">
                    <i class="fas fa-cog text-lg group-hover:scale-110 transition-transform"></i>
                    <span><?php _e('admin.settings.title'); ?></span>
                </a>
            </li>
        </ul>

        <!-- Divider -->
        <div class="my-6 border-t border-gray-800"></div>

        <!-- Quick Links -->
        <div class="mb-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 mb-2">Accesos Rápidos</p>
            <ul class="space-y-1">
                <li>
                    <a href="<?= BASE_URL ?>/tienda" target="_blank" class="flex items-center space-x-3 py-2 px-4 rounded-lg text-sm text-gray-400 hover:bg-gray-800 hover:text-gray-200 transition-all duration-200">
                        <i class="fas fa-external-link-alt text-sm"></i>
                        <span>Ver Tienda</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-800">
        <button onclick="cerrarSesion()" class="w-full flex items-center justify-center space-x-2 bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 font-semibold">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Sesión</span>
        </button>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

function cerrarSesion() {
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        window.location.href = '/logout';
    }
}
</script>