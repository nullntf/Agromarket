<?php
// Controlador para la página de login

require_once '../core/BaseController.php';

class LoginController extends BaseController {
    public function index() {
        require_once '../helpers/Session.php';
        Session::start();

        // Verificar si la sesión expiró
        if (isset($_GET['expired']) && $_GET['expired'] == '1') {
            $expiredMessage = 'Tu sesión ha expirado por inactividad. Por favor inicia sesión nuevamente.';
        }
        
        // Verificar si se cerró sesión
        if (isset($_GET['logged_out']) && $_GET['logged_out'] == '1') {
            $logoutMessage = 'Has cerrado sesión exitosamente.';
        }
        
        // Verificar si el usuario está inactivo
        if (isset($_GET['inactive']) && $_GET['inactive'] == '1') {
            $expiredMessage = 'Tu cuenta ha sido desactivada. Contacta al administrador.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleLogin();
            return;
        }

        // Agregar token CSRF a la vista
        $csrfToken = Session::getCsrfToken();
        $this->render('login/index', ['csrf_token' => $csrfToken, 'expired_message' => $expiredMessage ?? null, 'logout_message' => $logoutMessage ?? null]);
    }

    private function handleLogin() {
        require_once '../helpers/Session.php';
        require_once '../helpers/RateLimiter.php';
        require_once '../app/models/UserModel.php';

        // Verificar CSRF primero
        if (!Session::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $error = 'Token CSRF inválido.';
            $csrfToken = Session::getCsrfToken();
            $this->render('login/index', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = 'Email y contraseña son requeridos.';
            $csrfToken = Session::getCsrfToken();
            $this->render('login/index', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        // Verificar si este email está bloqueado por rate limiting
        $lockStatus = RateLimiter::isLocked($email);
        if ($lockStatus['locked']) {
            $error = "Demasiados intentos de login para esta cuenta. Por favor espera {$lockStatus['remaining_minutes']} minuto(s) antes de intentar nuevamente.";
            $csrfToken = Session::getCsrfToken();
            $this->render('login/index', ['error' => $error, 'csrf_token' => $csrfToken, 'rate_limited' => true]);
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->getByEmail($email);

        if (!$user || !$userModel->verifyPassword($password, $user['password'])) {
            // Registrar intento fallido para este email
            $attemptResult = RateLimiter::recordFailedAttempt($email);
            
            if ($attemptResult['locked']) {
                $error = "Demasiados intentos fallidos. Esta cuenta ha sido bloqueada temporalmente por {$attemptResult['lockout_minutes']} minutos.";
            } else {
                $error = "Credenciales incorrectas. Te quedan {$attemptResult['attempts_remaining']} intento(s) para esta cuenta.";
            }
            
            $csrfToken = Session::getCsrfToken();
            $this->render('login/index', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        if ($user['status'] !== 'active') {
            // También registrar como intento fallido para este email
            $attemptResult = RateLimiter::recordFailedAttempt($email);
            
            if ($attemptResult['locked']) {
                $error = "Demasiados intentos fallidos. Esta cuenta ha sido bloqueada temporalmente por {$attemptResult['lockout_minutes']} minutos.";
            } else {
                $error = 'Cuenta inactiva. Contacta al administrador.';
            }
            
            $csrfToken = Session::getCsrfToken();
            $this->render('login/index', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        // Login exitoso - Resetear intentos para este email
        RateLimiter::reset($email);
        Session::login($user);
        $userModel->updateLastLogin($user['id']);

        // Redirigir según rol
        switch ($user['rol']) {
            case 'admin':
            case 'master':
                header('Location: /admin');
                break;
            case 'producer':
                header('Location: /producer');
                break;
            default:
                header('Location: /');
        }
        exit;
    }

    public function logout() {
        require_once '../helpers/Session.php';
        Session::logout();
        header('Location: /login?logged_out=1');
        exit;
    }
}