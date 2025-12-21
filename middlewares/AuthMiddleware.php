<?php
// Middleware para autenticación y autorización

require_once '../helpers/Session.php';

class AuthMiddleware {
    /**
     * Verificar si el usuario está autenticado
     */
    public static function checkAuth() {
        // Session::start();
        
        // Verificar autenticación
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Verificar que el usuario esté activo
        $userStatus = Session::get('user_status');
        if ($userStatus === 'inactive') {
            self::forceLogout();
            header('Location: /login?inactive=1');
            exit;
        }
        
        // Verificar que la sesión no haya expirado (15 minutos)
        $lastActivity = Session::get('last_activity');
        if ($lastActivity && (time() - $lastActivity) > 900) { // 15 minutos
            self::forceLogout();
            header('Location: /login?expired=1');
            exit;
        }
        
        // Actualizar timestamp de actividad
        Session::set('last_activity', time());
    }

    /**
     * Verificar si el usuario tiene uno de los roles especificados
     */
    public static function checkRole($allowedRoles = []) {
        self::checkAuth();
        
        $userRole = Session::get('user_role');
        
        if (!in_array($userRole, $allowedRoles)) {
            // Usuario no autorizado
            http_response_code(403);
            echo "Acceso denegado. No tienes permisos para acceder a esta página.";
            exit;
        }
    }

    /**
     * Verificar si el usuario es admin o master (acceso a panel admin)
     */
    public static function checkAdminAccess() {
        self::checkRole(['admin', 'master']);
    }

    /**
     * Verificar si el usuario es producer (acceso a panel producer)
     */
    public static function checkProducerAccess() {
        self::checkRole(['producer']);
    }

    /**
     * Verificar si el usuario es master (control total)
     */
    public static function checkMasterAccess() {
        self::checkRole(['master']);
    }

    /**
     * Obtener información del usuario actual
     */
    public static function getCurrentUser() {
        self::checkAuth();
        return Session::getCurrentUser();
    }
    
    /**
     * Forzar logout sin redirección (para uso interno)
     */
    private static function forceLogout() {
        // Session::start();
        $sessionName = session_name();
        $sessionParams = session_get_cookie_params();
        $_SESSION = array();
        if (isset($_COOKIE[$sessionName])) {
            setcookie($sessionName, '', time() - 42000, $sessionParams['path'], $sessionParams['domain'], $sessionParams['secure'], $sessionParams['httponly']);
        }
        session_destroy();
    }
}