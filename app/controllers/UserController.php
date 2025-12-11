<?php
// Controlador para la gestión de usuarios

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';

class UserController extends BaseController {
    public function index() {
        AuthMiddleware::checkAdminAccess();

        require_once '../app/models/UserModel.php';
        $userModel = new UserModel();

        $users = $userModel->getAll();

        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;

        $this->render('admin/users/index', ['users' => $users, 'success' => $success]);
    }

    public function create() {
        AuthMiddleware::checkAdminAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate();
            return;
        }

        $this->render('admin/users/create');
    }

    private function handleCreate() {
        // Verificar CSRF token
        if (!Session::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/users/create', ['error' => $error]);
            return;
        }

        $role = $_POST['roleSelect'] ?? 'producer';
        $name = trim($_POST['nameInput'] ?? '');
        $phone = trim($_POST['phoneInput'] ?? '');

        if (empty($name) || empty($phone)) {
            $error = 'Nombre y teléfono son requeridos.';
            $this->render('admin/users/create', ['error' => $error]);
            return;
        }

        // Validar y formatear número de teléfono (El Salvador: +503)
        if (!preg_match('/^[0-9]{8}$/', $phone)) {
            $error = 'Formato de teléfono inválido. Use 8 dígitos sin código de país (ej: 70123456).';
            $this->render('admin/users/create', ['error' => $error]);
            return;
        }

        // Agregar código de país automáticamente
        $phone = '+503' . $phone;

        require_once '../app/models/AccessTokenModel.php';
        require_once '../helpers/Session.php';

        Session::start();
        $currentUser = Session::getCurrentUser();
        if (!$currentUser) {
            header('Location: /login');
            exit;
        }

        // Admin solo puede crear tokens para producer
        if ($currentUser['rol'] === 'admin' && $role !== 'producer') {
            $error = 'No tienes permisos para crear tokens de este rol.';
            $this->render('admin/users/create', ['error' => $error]);
            return;
        }

        $tokenModel = new AccessTokenModel();

        // Crear token y verificar que se generó correctamente
        $token = $tokenModel->createToken($role, $currentUser['id']);
        if (!$token) {
            $error = 'Error al generar el token de invitación. Por favor, inténtelo de nuevo.';
            $this->render('admin/users/create', ['error' => $error]);
            return;
        }

        // Generar URL de registro dinámicamente
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $url = "{$protocol}://{$host}/registro?{$role}_token={$token}";

        // Generar mensaje de WhatsApp
        $roleText = $role === 'producer' ? 'productor' : $role;
        $message = "¡Hola {$name}! \nUsa este enlace para registrarte como {$roleText} (válido por 15 minutos):\n{$url}";

        $whatsAppUrl = "https://wa.me/{$phone}?text=" . rawurlencode($message);

        // Usar JavaScript redirect en lugar de header redirect
        // para evitar problemas con output buffering
        echo "<script>window.location.href = '" . addslashes($whatsAppUrl) . "';</script>";
        exit;
    }

    public function edit($id = null) {
        AuthMiddleware::checkAdminAccess();

        require_once '../app/models/UserModel.php';
        require_once '../helpers/Session.php';

        Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede editar
        if ($currentUser['rol'] !== 'master') {
            header('Location: /admin/users?success=' . urlencode('No tienes permisos para editar usuarios.'));
            exit;
        }

        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id);
            return;
        }

        if (!$id) {
            header('Location: /admin/users');
            exit;
        }

        $user = $userModel->getById($id);
        if (!$user) {
            header('Location: /admin/users');
            exit;
        }

        $this->render('admin/users/edit', ['user' => $user]);
    }

    private function handleEdit($id) {
        require_once '../helpers/Session.php';
        Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede editar
        if ($currentUser['rol'] !== 'master') {
            header('Location: /admin/users?success=' . urlencode('No tienes permisos para editar usuarios.'));
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $role = $_POST['role'] ?? '';
        $status = $_POST['status'] ?? '';

        if (empty($name) || empty($lastname) || empty($email) || empty($role) || empty($status)) {
            $error = 'Todos los campos son requeridos.';
            $this->render('admin/users/edit', ['error' => $error, 'user' => ['id' => $id]]);
            return;
        }

        require_once '../app/models/UserModel.php';
        $userModel = new UserModel();

        $userModel->update($id, [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'rol' => $role,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        header('Location: /admin/users?success=' . urlencode('Usuario actualizado exitosamente.'));
        exit;
    }

    public function view($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/users');
            exit;
        }

        require_once '../app/models/UserModel.php';
        require_once '../helpers/Session.php';

        Session::start();
        $currentUser = Session::getCurrentUser();

        $userModel = new UserModel();
        $user = $userModel->getById($id);

        if (!$user) {
            header('Location: /admin/users');
            exit;
        }

        // Admin no puede ver masters ni otros admins
        if ($currentUser['rol'] === 'admin' && ($user['rol'] === 'master' || $user['rol'] === 'admin')) {
            header('Location: /admin/users?success=' . urlencode('No tienes permisos para ver este usuario.'));
            exit;
        }

        $this->render('admin/users/view', ['user' => $user]);
    }

    public function toggleStatus($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/users');
            exit;
        }

        require_once '../app/models/UserModel.php';
        require_once '../helpers/Session.php';

        Session::start();
        $currentUser = Session::getCurrentUser();

        $userModel = new UserModel();
        $user = $userModel->getById($id);

        if (!$user) {
            header('Location: /admin/users');
            exit;
        }

        // Admin solo puede cambiar estado de producers
        if ($currentUser['rol'] === 'admin' && $user['rol'] !== 'producer') {
            header('Location: /admin/users?success=' . urlencode('No tienes permisos para cambiar el estado de este usuario.'));
            exit;
        }

        $newStatus = $user['status'] === 'active' ? 'inactive' : 'active';
        $userModel->update($id, ['status' => $newStatus]);

        $message = $newStatus === 'active' ? 'Usuario activado exitosamente.' : 'Usuario inactivado exitosamente.';
        header('Location: /admin/users?success=' . urlencode($message));
        exit;
    }

    public function delete($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/users');
            exit;
        }

        require_once '../app/models/UserModel.php';
        require_once '../helpers/Session.php';

        Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede eliminar
        if ($currentUser['rol'] !== 'master') {
            header('Location: /admin/users?success=' . urlencode('No tienes permisos para eliminar usuarios.'));
            exit;
        }

        $userModel = new UserModel();
        $user = $userModel->getById($id);

        if (!$user) {
            header('Location: /admin/users');
            exit;
        }

        // No permitir eliminar al usuario actual
        if ($user['id'] == $currentUser['id']) {
            header('Location: /admin/users?success=' . urlencode('No puedes eliminarte a ti mismo.'));
            exit;
        }

        // Eliminar tokens creados por este usuario primero
        require_once '../app/models/AccessTokenModel.php';
        $tokenModel = new AccessTokenModel();
        $tokenModel->deleteByCreator($id);

        // Ahora eliminar el usuario
        $userModel->delete($id);

        header('Location: /admin/users?success=' . urlencode('Usuario eliminado exitosamente.'));
        exit;
    }
}
