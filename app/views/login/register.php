<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - AgroCompra</title>
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
        .password-strength-weak { background: #ef4444; }
        .password-strength-medium { background: #f59e0b; }
        .password-strength-strong { background: #10b981; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 min-h-screen flex items-center justify-center p-4 py-12">
    <!-- Language Switcher -->
    <div class="absolute top-4 right-4">
        <?php include __DIR__ . '/../partials/language_switcher.php'; ?>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2 mb-6">
                <i class="fas fa-seedling text-green-600 text-2xl"></i>
                <span class="text-2xl font-bold text-gray-900">AgroCompra</span>
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Crear Cuenta</h1>
            <p class="text-gray-600">Completa el formulario para unirte a la plataforma</p>
        </div>

        <!-- Card de Registro -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <!-- Mensajes -->
            <?php if (isset($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start space-x-3 animate-fade-in">
                    <i class="fas fa-times-circle text-red-600 mt-0.5"></i>
                    <p class="text-sm text-red-800"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start space-x-3 animate-fade-in">
                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                    <p class="text-sm text-green-800"><?= htmlspecialchars($success) ?></p>
                </div>
            <?php endif; ?>

            <!-- Formulario -->
            <form method="POST" id="registerForm" class="space-y-5" novalidate>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
            <input type="hidden" name="role" value="<?= htmlspecialchars($role ?? '') ?>">

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-500 mr-2"></i>Nombre
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required
                               minlength="2"
                               autocomplete="given-name"
                               class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="Tu nombre">
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <p class="mt-1 text-xs text-red-600 hidden" id="name-error"></p>
                </div>

                <!-- Apellido -->
                <div>
                    <label for="lastname" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-500 mr-2"></i>Apellido
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="lastname" 
                               name="lastname" 
                               required
                               minlength="2"
                               autocomplete="family-name"
                               class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="Tu apellido">
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <p class="mt-1 text-xs text-red-600 hidden" id="lastname-error"></p>
                </div>

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
                               minlength="8"
                               autocomplete="new-password"
                               class="w-full px-4 py-3 pl-11 pr-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button type="button" onclick="togglePassword('password', 'password-toggle')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password-toggle"></i>
                        </button>
                    </div>
                    <!-- Password strength indicator -->
                    <div class="mt-2">
                        <div class="flex gap-1 h-1">
                            <div class="flex-1 bg-gray-200 rounded-full overflow-hidden">
                                <div id="strength-bar" class="h-full transition-all duration-300"></div>
                            </div>
                        </div>
                        <p class="mt-1 text-xs" id="strength-text"></p>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 flex items-start space-x-1">
                        <i class="fas fa-info-circle mt-0.5"></i>
                        <span>Mínimo 8 caracteres, incluir mayúsculas, minúsculas y números</span>
                    </p>
                    <p class="mt-1 text-xs text-red-600 hidden" id="password-error"></p>
                </div>

                <!-- Password Confirm -->
                <div>
                    <label for="password_confirm" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-500 mr-2"></i>Confirmar Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirm" 
                               name="password_confirm" 
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-3 pl-11 pr-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button type="button" onclick="togglePassword('password_confirm', 'password-confirm-toggle')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password-confirm-toggle"></i>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-red-600 hidden" id="password-confirm-error"></p>
                </div>

                <button type="submit"
                        id="submitBtn"
                        class="w-full bg-gradient-to-r from-blue-600 to-sky-600 hover:from-blue-700 hover:to-sky-700 text-white font-semibold py-3.5 px-4 rounded-xl transition-all hover:shadow-xl hover:scale-[1.02] flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span id="submitText">Crear Cuenta</span>
                    <i class="fas fa-user-plus" id="submitIcon"></i>
                    <i class="fas fa-spinner fa-spin hidden" id="submitSpinner"></i>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">¿Ya tienes cuenta?</span>
                </div>
            </div>

            <!-- Login link -->
            <div class="text-center">
                <a href="/login" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                    Iniciar Sesión
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Enlace volver -->
        <div class="mt-6 text-center">
            <a href="/" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors group">
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

        // Form inputs
        const nameInput = document.getElementById('name');
        const lastnameInput = document.getElementById('lastname');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirm');

        // Error messages
        const nameError = document.getElementById('name-error');
        const lastnameError = document.getElementById('lastname-error');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const passwordConfirmError = document.getElementById('password-confirm-error');

        // Name validation
        nameInput.addEventListener('blur', function() {
            const value = this.value.trim();
            if (!value) {
                this.classList.add('input-error');
                nameError.textContent = 'El nombre es requerido';
                nameError.classList.remove('hidden');
            } else if (value.length < 2) {
                this.classList.add('input-error');
                nameError.textContent = 'El nombre debe tener al menos 2 caracteres';
                nameError.classList.remove('hidden');
            } else {
                this.classList.remove('input-error');
                this.classList.add('input-success');
                nameError.classList.add('hidden');
            }
        });

        nameInput.addEventListener('input', function() {
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                nameError.classList.add('hidden');
            }
        });

        // Lastname validation
        lastnameInput.addEventListener('blur', function() {
            const value = this.value.trim();
            if (!value) {
                this.classList.add('input-error');
                lastnameError.textContent = 'El apellido es requerido';
                lastnameError.classList.remove('hidden');
            } else if (value.length < 2) {
                this.classList.add('input-error');
                lastnameError.textContent = 'El apellido debe tener al menos 2 caracteres';
                lastnameError.classList.remove('hidden');
            } else {
                this.classList.remove('input-error');
                this.classList.add('input-success');
                lastnameError.classList.add('hidden');
            }
        });

        lastnameInput.addEventListener('input', function() {
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                lastnameError.classList.add('hidden');
            }
        });

        // Email validation
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

        // Password strength checker
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');

        function checkPasswordStrength(password) {
            let strength = 0;
            let text = '';
            let color = '';

            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            if (strength <= 2) {
                text = 'Débil';
                color = 'password-strength-weak';
                strengthBar.style.width = '33%';
            } else if (strength <= 4) {
                text = 'Media';
                color = 'password-strength-medium';
                strengthBar.style.width = '66%';
            } else {
                text = 'Fuerte';
                color = 'password-strength-strong';
                strengthBar.style.width = '100%';
            }

            strengthBar.className = `h-full transition-all duration-300 ${color}`;
            strengthText.textContent = password.length > 0 ? `Fortaleza: ${text}` : '';
            strengthText.className = `mt-1 text-xs ${password.length > 0 ? 'text-gray-600' : ''}`;
        }

        passwordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                passwordError.classList.add('hidden');
            }
        });

        // Password validation
        passwordInput.addEventListener('blur', function() {
            const password = this.value;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);

            if (!password) {
                this.classList.add('input-error');
                passwordError.textContent = 'La contraseña es requerida';
                passwordError.classList.remove('hidden');
            } else if (password.length < 8) {
                this.classList.add('input-error');
                passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres';
                passwordError.classList.remove('hidden');
            } else if (!hasUpperCase || !hasLowerCase || !hasNumber) {
                this.classList.add('input-error');
                passwordError.textContent = 'Debe incluir mayúsculas, minúsculas y números';
                passwordError.classList.remove('hidden');
            } else {
                this.classList.remove('input-error');
                this.classList.add('input-success');
                passwordError.classList.add('hidden');
            }
        });

        // Password confirm validation
        passwordConfirmInput.addEventListener('blur', function() {
            const password = passwordInput.value;
            const confirm = this.value;

            if (!confirm) {
                this.classList.add('input-error');
                passwordConfirmError.textContent = 'Debes confirmar tu contraseña';
                passwordConfirmError.classList.remove('hidden');
            } else if (password !== confirm) {
                this.classList.add('input-error');
                passwordConfirmError.textContent = 'Las contraseñas no coinciden';
                passwordConfirmError.classList.remove('hidden');
            } else {
                this.classList.remove('input-error');
                this.classList.add('input-success');
                passwordConfirmError.classList.add('hidden');
            }
        });

        passwordConfirmInput.addEventListener('input', function() {
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                passwordConfirmError.classList.add('hidden');
            }
        });

        // Form submission
        const form = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');
        const submitSpinner = document.getElementById('submitSpinner');

        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate all fields
            if (!nameInput.value.trim() || nameInput.value.trim().length < 2) {
                isValid = false;
                nameInput.classList.add('input-error');
                nameError.textContent = 'Ingresa un nombre válido';
                nameError.classList.remove('hidden');
            }

            if (!lastnameInput.value.trim() || lastnameInput.value.trim().length < 2) {
                isValid = false;
                lastnameInput.classList.add('input-error');
                lastnameError.textContent = 'Ingresa un apellido válido';
                lastnameError.classList.remove('hidden');
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
                isValid = false;
                emailInput.classList.add('input-error');
                emailError.textContent = 'Ingresa un correo electrónico válido';
                emailError.classList.remove('hidden');
            }

            const password = passwordInput.value;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);

            if (!password || password.length < 8 || !hasUpperCase || !hasLowerCase || !hasNumber) {
                isValid = false;
                passwordInput.classList.add('input-error');
                passwordError.textContent = 'La contraseña no cumple con los requisitos';
                passwordError.classList.remove('hidden');
            }

            if (password !== passwordConfirmInput.value) {
                isValid = false;
                passwordConfirmInput.classList.add('input-error');
                passwordConfirmError.textContent = 'Las contraseñas no coinciden';
                passwordConfirmError.classList.remove('hidden');
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Creando cuenta...';
            submitIcon.classList.add('hidden');
            submitSpinner.classList.remove('hidden');
        });
    </script>

</body>
</html>
