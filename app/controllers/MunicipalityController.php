<?php
// Controlador para gestión de municipios

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../app/models/DepartmentModel.php';
require_once '../app/models/MunicipalityModel.php';

class MunicipalityController extends BaseController {
    
    public function index() {
        AuthMiddleware::checkAdminAccess();

        $municipalityModel = new MunicipalityModel();

        $municipalities = $municipalityModel->getAll();

        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;

        $this->render('admin/municipalities/index', [
            'municipalities' => $municipalities,
            'success' => $success
        ]);
    }

    public function create() {
        AuthMiddleware::checkAdminAccess();

        $departmentModel = new DepartmentModel();
        $departments = $departmentModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate();
            return;
        }

        $this->render('admin/municipalities/create', ['departments' => $departments]);
    }

    private function handleCreate() {
        // Session::start();

        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/municipalities/create', ['error' => $error]);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $departmentId = $_POST['department_id'] ?? '';

        if (empty($name) || empty($departmentId)) {
            $error = 'El nombre y el departamento son requeridos.';
            $departmentModel = new DepartmentModel();
            $departments = $departmentModel->getAll();
            $this->render('admin/municipalities/create', ['error' => $error, 'departments' => $departments]);
            return;
        }

        $municipalityModel = new MunicipalityModel();

        // Verificar si ya existe en ese departamento
        if ($municipalityModel->existsByNameInDepartment($name, $departmentId)) {
            $error = 'Ya existe un municipio con ese nombre en este departamento.';
            $departmentModel = new DepartmentModel();
            $departments = $departmentModel->getAll();
            $this->render('admin/municipalities/create', ['error' => $error, 'departments' => $departments]);
            return;
        }

        $municipalityModel->insert([
            'name' => $name,
            'department_id' => $departmentId
        ]);

        header('Location: /admin/municipalities?success=' . urlencode('Municipio creado exitosamente.'));
        exit;
    }

    public function edit($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/municipalities');
            exit;
        }

        
        $municipalityModel = new MunicipalityModel();
        $departmentModel = new DepartmentModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id);
            return;
        }

        $municipality = $municipalityModel->getById($id);
        if (!$municipality) {
            header('Location: /admin/municipalities');
            exit;
        }

        $departments = $departmentModel->getAll();

        $this->render('admin/municipalities/edit', [
            'municipality' => $municipality,
            'departments' => $departments
        ]);
    }

    private function handleEdit($id) {
        // Session::start();

        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/municipalities/edit', ['error' => $error, 'municipality' => ['id' => $id]]);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $departmentId = $_POST['department_id'] ?? '';

        if (empty($name) || empty($departmentId)) {
            $error = 'El nombre y el departamento son requeridos.';
            $departmentModel = new DepartmentModel();
            $departments = $departmentModel->getAll();
            $this->render('admin/municipalities/edit', [
                'error' => $error,
                'municipality' => ['id' => $id, 'name' => $name, 'department_id' => $departmentId],
                'departments' => $departments
            ]);
            return;
        }

        $municipalityModel = new MunicipalityModel();

        // Verificar si ya existe otro municipio con ese nombre en ese departamento
        if ($municipalityModel->existsByNameInDepartment($name, $departmentId, $id)) {
            $error = 'Ya existe otro municipio con ese nombre en este departamento.';
            $departmentModel = new DepartmentModel();
            $departments = $departmentModel->getAll();
            $this->render('admin/municipalities/edit', [
                'error' => $error,
                'municipality' => ['id' => $id, 'name' => $name, 'department_id' => $departmentId],
                'departments' => $departments
            ]);
            return;
        }

        $municipalityModel->update($id, [
            'name' => $name,
            'department_id' => $departmentId
        ]);

        header('Location: /admin/municipalities?success=' . urlencode('Municipio actualizado exitosamente.'));
        exit;
    }

    public function delete($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/municipalities');
            exit;
        }

        $municipalityModel = new MunicipalityModel();

        $municipality = $municipalityModel->getById($id);
        if (!$municipality) {
            header('Location: /admin/municipalities');
            exit;
        }

        $municipalityModel->delete($id);

        header('Location: /admin/municipalities?success=' . urlencode('Municipio eliminado exitosamente.'));
        exit;
    }
}
