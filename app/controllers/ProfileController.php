<?php
require_once '../config/app.php';
// Controlador para la gestión de perfil de productores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';

class ProfileController extends BaseController {
    
    public function index() {
        AuthMiddleware::checkProducerAccess();

        require_once '../helpers/Session.php';
        require_once '../app/models/UserModel.php';
        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        $userModel = new UserModel();
        
        // Obtener datos completos del usuario
        $user = $userModel->getById($currentUser['id']);
        
        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;
        
        $this->render('producer/profile/index', [
            'user' => $user,
            'success' => $success
        ]);
    }

    public function edit() {
        AuthMiddleware::checkProducerAccess();

        require_once '../helpers/Session.php';
        require_once '../app/models/UserModel.php';
        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        $userModel = new UserModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit();
            return;
        }
        
        // Obtener datos completos del usuario
        $user = $userModel->getById($currentUser['id']);
        
        $this->render('producer/profile/edit', ['user' => $user]);
    }

    private function handleEdit() {
        require_once '../helpers/Session.php';
        require_once '../helpers/FileUpload.php';
        require_once '../app/models/UserModel.php';
        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $userModel = new UserModel();
            $user = $userModel->getById($currentUser['id']);
            $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($lastname) || empty($email)) {
            $error = 'El nombre, apellido y email son requeridos.';
            $userModel = new UserModel();
            $user = $userModel->getById($currentUser['id']);
            $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
            return;
        }

        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'El email no es válido.';
            $userModel = new UserModel();
            $user = $userModel->getById($currentUser['id']);
            $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->getById($currentUser['id']);

        // Verificar si el email ya existe (excepto el propio)
        if ($email !== $user['email'] && $userModel->existsByEmail($email)) {
            $error = 'El email ya está en uso por otro usuario.';
            $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
            return;
        }

        $updateData = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email
        ];

        // Procesar eliminación de foto si se solicitó
        if (isset($_POST['delete_photo'])) {
            if (!empty($user['profile_photo'])) {
                FileUpload::deleteImage($user['profile_photo'], 'profiles');
            }
            $updateData['profile_photo'] = null;
        }

        // Procesar foto de perfil si se subió
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            // Eliminar foto anterior si existe
            if (!empty($user['profile_photo'])) {
                FileUpload::deleteImage($user['profile_photo'], 'profiles');
            }
            
            // Subir nueva foto
            $customName = 'profile_' . $currentUser['id'];
            $uploadResult = FileUpload::uploadImage($_FILES['profile_photo'], 'profiles', $customName);
            
            if (!$uploadResult['success']) {
                $error = $uploadResult['error'];
                $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
                return;
            }
            
            $updateData['profile_photo'] = $uploadResult['filename'];
        }

        // Si se quiere cambiar la contraseña
        if (!empty($newPassword)) {
            // Verificar contraseña actual
            if (empty($currentPassword)) {
                $error = 'Debes ingresar tu contraseña actual para cambiarla.';
                $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
                return;
            }

            if (!password_verify($currentPassword, $user['password'])) {
                $error = 'La contraseña actual es incorrecta.';
                $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
                return;
            }

            // Validar que las contraseñas coincidan
            if ($newPassword !== $confirmPassword) {
                $error = 'Las contraseñas nuevas no coinciden.';
                $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
                return;
            }

            // Validar longitud mínima
            if (strlen($newPassword) < 6) {
                $error = 'La contraseña debe tener al menos 6 caracteres.';
                $this->render('producer/profile/edit', ['error' => $error, 'user' => $user]);
                return;
            }

            $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        // Actualizar usuario
        $userModel->update($currentUser['id'], $updateData);

        // Preparar datos para actualizar sesión
        $sessionUpdate = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email
        ];

        // Incluir profile_photo si fue modificado
        if (isset($updateData['profile_photo'])) {
            $sessionUpdate['profile_photo'] = $updateData['profile_photo'];
        }

        // Actualizar sesión con los nuevos datos
        Session::updateCurrentUser($sessionUpdate);

        redirect('/producer/profile?success=' . urlencode('Perfil actualizado exitosamente.'));
    }
}
