<?php
// Controlador para registro de usuarios

require_once '../core/BaseController.php';
require_once '../helpers/Session.php';
require_once '../app/models/UserModel.php';
require_once '../app/models/AccessTokenModel.php';

class RegistroController extends BaseController {
    public function index() {

        // Session::start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleRegistration();
            return;
        }

        // Verificar token en URL
        $token = null;
        $role = null;
        foreach ($_GET as $key => $value) {
            if (strpos($key, '_token') !== false) {
                $token = $value;
                $role = str_replace('_token', '', $key);
                break;
            }
        }

        if (!$token || !$role) {
            $error = 'Token de invitación inválido. No se encontró token en la URL.';
            $csrfToken = Session::getCsrfToken();
            $this->render('login/register', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        $tokenModel = new AccessTokenModel();
        $accessToken = $tokenModel->getValidToken($token);

        if (!$accessToken) {
            $error = 'Token expirado o no encontrado en la base de datos.';
            $csrfToken = Session::getCsrfToken();
            $this->render('login/register', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        if ($accessToken['rol'] !== $role) {
            $error = "El rol del token ({$accessToken['rol']}) no coincide con el rol esperado ({$role}).";
            $csrfToken = Session::getCsrfToken();
            $this->render('login/register', ['error' => $error, 'csrf_token' => $csrfToken]);
            return;
        }

        // Token válido, mostrar formulario de registro
        $csrfToken = Session::getCsrfToken();
        $this->render('login/register', [
            'token' => $token,
            'role' => $role,
            'csrf_token' => $csrfToken
        ]);
    }

    private function handleRegistration() {

        // Verificar CSRF
        if (!Session::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $error = 'Token CSRF inválido.';
            $this->render('login/register', ['error' => $error]);
            return;
        }

        $token = $_POST['token'] ?? '';
        $role = $_POST['role'] ?? '';
        $name = trim($_POST['name'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['password_confirm'] ?? '';

        // Validaciones
        if (empty($name) || empty($lastname) || empty($email) || empty($password)) {
            $error = 'Todos los campos son requeridos.';
            $this->render('login/register', ['error' => $error, 'token' => $token, 'role' => $role, 'csrf_token' => Session::getCsrfToken()]);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email inválido.';
            $this->render('login/register', ['error' => $error, 'token' => $token, 'role' => $role, 'csrf_token' => Session::getCsrfToken()]);
            return;
        }

        if ($password !== $confirmPassword) {
            $error = 'Las contraseñas no coinciden.';
            $this->render('login/register', ['error' => $error, 'token' => $token, 'role' => $role, 'csrf_token' => Session::getCsrfToken()]);
            return;
        }

        $userModel = new UserModel();
        if (!$userModel->validatePassword($password)) {
            $error = 'La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.';
            $this->render('login/register', ['error' => $error, 'token' => $token, 'role' => $role, 'csrf_token' => Session::getCsrfToken()]);
            return;
        }

        // Verificar token nuevamente
        $tokenModel = new AccessTokenModel();
        $accessToken = $tokenModel->getValidToken($token);
        if (!$accessToken || $accessToken['rol'] !== $role) {
            $error = 'Token expirado o inválido.';
            $this->render('login/register', ['error' => $error, 'csrf_token' => Session::getCsrfToken()]);
            return;
        }

        // Verificar si email ya existe
        if ($userModel->getByEmail($email)) {
            $error = 'El email ya está registrado.';
            $this->render('login/register', ['error' => $error, 'token' => $token, 'role' => $role, 'csrf_token' => Session::getCsrfToken()]);
            return;
        }

        // Crear usuario
        $hashedPassword = $userModel->hashPassword($password);
        $userData = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $hashedPassword,
            'rol' => $role,
            'status' => 'active'
        ];

        $userId = $userModel->insert($userData);

        // Marcar token como usado
        $tokenModel->markAsUsed($accessToken['id']);

        // Login automático
        $user = $userModel->getById($userId);
        Session::login($user);
        $userModel->updateLastLogin($userId);

        // Redirigir según rol
        switch ($role) {
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
}
