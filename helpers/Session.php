<?php
// Helper para manejo de sesiones y CSRF

class Session {
    public static function start() {
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }

    // Verificar si usuario está autenticado
    public static function isAuthenticated() {
        self::start();
        return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
    }

    // Obtener usuario actual
    public static function getCurrentUser() {
        if (!self::isAuthenticated()) {
            return null;
        }
        return [
            'id' => self::get('user_id'),
            'name' => self::get('user_name'),
            'lastname' => self::get('user_lastname'),
            'rol' => self::get('user_role'),
            'email' => self::get('user_email'),
            'status' => self::get('user_status'),
            'profile_photo' => self::get('user_profile_photo')
        ];
    }

    // Verificar rol
    public static function hasRole($role) {
        return self::get('user_role') === $role;
    }

    // Generar token CSRF
    public static function generateCsrfToken() {
        $token = bin2hex(random_bytes(32));
        self::set('csrf_token', $token);
        return $token;
    }

    // Obtener token CSRF
    public static function getCsrfToken() {
        if (!self::has('csrf_token')) {
            return self::generateCsrfToken();
        }
        return self::get('csrf_token');
    }

    // Verificar token CSRF
    public static function verifyCsrfToken($token) {
        $sessionToken = self::get('csrf_token');
        if ($sessionToken === $token && !empty($token)) {
            self::generateCsrfToken(); // Regenerar después de uso exitoso
            return true;
        }
        return false;
    }

    // Login del usuario
    public static function login($user) {
        self::start();
        session_regenerate_id(true); // Regenerar ID de sesión por seguridad
        self::set('user_id', $user['id']);
        self::set('user_name', $user['name']);
        self::set('user_lastname', $user['lastname']);
        self::set('user_email', $user['email']);
        self::set('user_role', $user['rol']);
        self::set('user_status', $user['status']);
        self::set('user_profile_photo', $user['profile_photo'] ?? null);
        self::set('last_activity', time());
        self::set('session_token', bin2hex(random_bytes(32))); // Token único de sesión
    }

    // Actualizar datos del usuario actual en sesión
    public static function updateCurrentUser($data) {
        self::start();
        if (isset($data['name'])) {
            self::set('user_name', $data['name']);
        }
        if (isset($data['lastname'])) {
            self::set('user_lastname', $data['lastname']);
        }
        if (isset($data['email'])) {
            self::set('user_email', $data['email']);
        }
        if (isset($data['rol'])) {
            self::set('user_role', $data['rol']);
        }
        if (isset($data['status'])) {
            self::set('user_status', $data['status']);
        }
        if (isset($data['profile_photo'])) {
            self::set('user_profile_photo', $data['profile_photo']);
        }
    }

    // Logout completo y definitivo
    public static function logout() {
        self::start();
        
        // Guardar el nombre de la cookie antes de destruir
        $sessionName = session_name();
        $sessionParams = session_get_cookie_params();
        
        // Limpiar todas las variables de sesión
        $_SESSION = array();
        
        // Destruir la cookie de sesión en el navegador
        if (isset($_COOKIE[$sessionName])) {
            setcookie(
                $sessionName,
                '',
                time() - 42000,
                $sessionParams['path'],
                $sessionParams['domain'],
                $sessionParams['secure'],
                $sessionParams['httponly']
            );
        }
        
        // Destruir la sesión en el servidor
        session_destroy();
    }
}