<?php
// Controlador para la gestión de departamentos

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';

class DepartmentController extends BaseController {
    
    public function index() {
        AuthMiddleware::checkAdminAccess();

        require_once '../app/models/DepartmentModel.php';
        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->getAll();

        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;

        $this->render('admin/departments/index', [
            'departments' => $departments,
            'success' => $success
        ]);
    }

    public function create() {
        AuthMiddleware::checkAdminAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate();
            return;
        }

        $this->render('admin/departments/create');
    }

    private function handleCreate() {
        require_once '../helpers/Session.php';
        Session::start();

        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/departments/create', ['error' => $error]);
            return;
        }

        $name = trim($_POST['name'] ?? '');

        if (empty($name)) {
            $error = 'El nombre del departamento es requerido.';
            $this->render('admin/departments/create', ['error' => $error]);
            return;
        }

        require_once '../app/models/DepartmentModel.php';
        $departmentModel = new DepartmentModel();

        // Verificar si ya existe
        if ($departmentModel->existsByName($name)) {
            $error = 'Ya existe un departamento con ese nombre.';
            $this->render('admin/departments/create', ['error' => $error]);
            return;
        }

        $departmentModel->insert(['name' => $name]);

        header('Location: /admin/departments?success=' . urlencode('Departamento creado exitosamente.'));
        exit;
    }

    public function edit($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/departments');
            exit;
        }

        require_once '../app/models/DepartmentModel.php';
        $departmentModel = new DepartmentModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id);
            return;
        }

        $department = $departmentModel->getById($id);
        if (!$department) {
            header('Location: /admin/departments');
            exit;
        }

        $this->render('admin/departments/edit', ['department' => $department]);
    }

    private function handleEdit($id) {
        require_once '../helpers/Session.php';
        Session::start();

        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/departments/edit', ['error' => $error, 'department' => ['id' => $id]]);
            return;
        }

        $name = trim($_POST['name'] ?? '');

        if (empty($name)) {
            $error = 'El nombre del departamento es requerido.';
            $this->render('admin/departments/edit', ['error' => $error, 'department' => ['id' => $id]]);
            return;
        }

        require_once '../app/models/DepartmentModel.php';
        $departmentModel = new DepartmentModel();

        // Verificar si ya existe otro departamento con ese nombre
        if ($departmentModel->existsByName($name, $id)) {
            $error = 'Ya existe otro departamento con ese nombre.';
            $this->render('admin/departments/edit', ['error' => $error, 'department' => ['id' => $id, 'name' => $name]]);
            return;
        }

        $departmentModel->update($id, ['name' => $name]);

        header('Location: /admin/departments?success=' . urlencode('Departamento actualizado exitosamente.'));
        exit;
    }

    public function delete($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/departments');
            exit;
        }

        require_once '../app/models/DepartmentModel.php';
        $departmentModel = new DepartmentModel();

        $department = $departmentModel->getById($id);
        if (!$department) {
            header('Location: /admin/departments');
            exit;
        }

        // Verificar si tiene municipios asociados
        $municipalitiesCount = $departmentModel->countMunicipalities($id);
        if ($municipalitiesCount > 0) {
            header('Location: /admin/departments?success=' . urlencode("No se puede eliminar el departamento porque tiene {$municipalitiesCount} municipios asociados."));
            exit;
        }

        $departmentModel->delete($id);

        header('Location: /admin/departments?success=' . urlencode('Departamento eliminado exitosamente.'));
        exit;
    }
}
