<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AgroCompra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Sora', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Geist', sans-serif; }
        .input-error { border-color: #ef4444 !important; }
        .input-success { border-color: #10b981 !important; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 min-h-screen flex items-center justify-center p-4">
    <!-- Language Switcher -->
    <div class="absolute top-4 right-4">
        <?php include __DIR__ . '/../partials/language_switcher.php'; ?>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <a href="<?= BASE_URL ?>/" class="inline-flex items-center space-x-2 mb-6">
                <i class="fas fa-seedling text-green-600 text-2xl"></i>
                <span class="text-2xl font-bold text-gray-900">AgroCompra</span>
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Bienvenido de Nuevo</h1>
            <p class="text-gray-600">Ingresa a tu cuenta para continuar</p>
        </div>

        <!-- Card de Login -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            
            <!-- Mensajes -->
            <?php if (isset($logout_message)): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start space-x-3 animate-fade-in">
                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                    <p class="text-sm text-green-800"><?= htmlspecialchars($logout_message) ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($expired_message)): ?>
                <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start space-x-3 animate-fade-in">
                    <i class="fas fa-exclamation-triangle text-amber-600 mt-0.5"></i>
                    <p class="text-sm text-amber-800"><?= htmlspecialchars($expired_message) ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start space-x-3 animate-fade-in">
                    <i class="fas fa-times-circle text-red-600 mt-0.5"></i>
                    <p class="text-sm text-red-800"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <!-- Formulario -->
            <form method="POST" action="<?= BASE_URL ?>/login" id="loginForm" class="space-y-6" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>Correo Electrónico
                    </label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               autocomplete="email"
                               class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="tu@email.com">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <i class="fas fa-check-circle absolute right-4 top-1/2 transform -translate-y-1/2 text-green-500 hidden" id="email-check"></i>
                    </div>
                    <p class="mt-1 text-xs text-red-600 hidden" id="email-error"></p>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-500 mr-2"></i>Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               autocomplete="current-password"
                               class="w-full px-4 py-3 pl-11 pr-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button type="button" onclick="togglePassword('password', 'password-toggle')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password-toggle"></i>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-red-600 hidden" id="password-error"></p>
                </div>
                
                <button type="submit"
                        id="submitBtn"
                        class="w-full bg-gradient-to-r from-blue-600 to-sky-600 hover:from-blue-700 hover:to-sky-700 text-white font-semibold py-3.5 px-4 rounded-xl transition-all hover:shadow-xl hover:scale-[1.02] flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span id="submitText">Iniciar Sesión</span>
                    <i class="fas fa-arrow-right" id="submitIcon"></i>
                    <i class="fas fa-spinner fa-spin hidden" id="submitSpinner"></i>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">¿Primera vez aquí?</span>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-gradient-to-br from-blue-50 to-sky-50 border border-blue-100 rounded-xl p-4">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                    <div class="text-sm text-blue-900">
                        <p class="font-semibold mb-1">¿Necesitas una cuenta?</p>
                        <p class="text-blue-700">Contacta con la Unidad de Agricultura y Ganadería para registrarte como productor.</p>
                        <a href="<?= BASE_URL ?>/registro/informacion" class="inline-flex items-center mt-2 text-blue-600 hover:text-blue-700 font-medium">
                            Ver más información
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enlaces adicionales -->
        <div class="mt-6 text-center">
            <a href="<?= BASE_URL ?>/" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Volver al Inicio
            </a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Email validation
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const emailCheck = document.getElementById('email-check');

        emailInput.addEventListener('blur', function() {
            const email = this.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!email) {
                this.classList.add('input-error');
                this.classList.remove('input-success');
                emailError.textContent = 'El correo electrónico es requerido';
                emailError.classList.remove('hidden');
                emailCheck.classList.add('hidden');
            } else if (!emailRegex.test(email)) {
                this.classList.add('input-error');
                this.classList.remove('input-success');
                emailError.textContent = 'Ingresa un correo electrónico válido';
                emailError.classList.remove('hidden');
                emailCheck.classList.add('hidden');
            } else {
                this.classList.remove('input-error');
                this.classList.add('input-success');
                emailError.classList.add('hidden');
                emailCheck.classList.remove('hidden');
            }
        });

        emailInput.addEventListener('input', function() {
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                emailError.classList.add('hidden');
            }
        });

        // Password validation
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('password-error');

        passwordInput.addEventListener('blur', function() {
            if (!this.value) {
                this.classList.add('input-error');
                passwordError.textContent = 'La contraseña es requerida';
                passwordError.classList.remove('hidden');
            } else {
                this.classList.remove('input-error');
                passwordError.classList.add('hidden');
            }
        });

        passwordInput.addEventListener('input', function() {
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                passwordError.classList.add('hidden');
            }
        });

        // Form submission
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');
        const submitSpinner = document.getElementById('submitSpinner');

        form.addEventListener('submit', function(e) {
            // Validate before submit
            let isValid = true;

            if (!emailInput.value.trim() || emailInput.classList.contains('input-error')) {
                isValid = false;
                emailInput.classList.add('input-error');
                emailError.textContent = 'Ingresa un correo electrónico válido';
                emailError.classList.remove('hidden');
            }

            if (!passwordInput.value) {
                isValid = false;
                passwordInput.classList.add('input-error');
                passwordError.textContent = 'La contraseña es requerida';
                passwordError.classList.remove('hidden');
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Iniciando sesión...';
            submitIcon.classList.add('hidden');
            submitSpinner.classList.remove('hidden');
        });
    </script>

</body>
</html>