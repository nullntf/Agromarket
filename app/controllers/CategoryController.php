<?php
require_once '../config/app.php';
// Controlador para la gestión de categorías

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';

class CategoryController extends BaseController {
    
    public function index() {
        AuthMiddleware::checkAdminAccess();

        require_once '../helpers/Session.php';
        // Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede ver categorías
        if ($currentUser['rol'] !== 'master') {
            redirect('/admin?success=' . urlencode('No tienes permisos para acceder a categorías.'));
        }

        require_once '../app/models/CategoryModel.php';
        $categoryModel = new CategoryModel();

        $categories = $categoryModel->getAll();

        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;

        $this->render('admin/categories/index', [
            'categories' => $categories,
            'success' => $success
        ]);
    }

    public function create() {
        AuthMiddleware::checkAdminAccess();

        require_once '../helpers/Session.php';
        // Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede crear categorías
        if ($currentUser['rol'] !== 'master') {
            redirect('/admin/categories?success=' . urlencode('No tienes permisos para crear categorías.'));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate();
            return;
        }

        $this->render('admin/categories/create');
    }

    private function handleCreate() {
        require_once '../helpers/Session.php';
        // Session::start();

        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/categories/create', ['error' => $error]);
            return;
        }

        $name = trim($_POST['name'] ?? '');

        if (empty($name)) {
            $error = 'El nombre de la categoría es requerido.';
            $this->render('admin/categories/create', ['error' => $error]);
            return;
        }

        require_once '../app/models/CategoryModel.php';
        $categoryModel = new CategoryModel();

        // Verificar si ya existe
        if ($categoryModel->existsByName($name)) {
            $error = 'Ya existe una categoría con ese nombre.';
            $this->render('admin/categories/create', ['error' => $error]);
            return;
        }

        $categoryModel->insert(['name' => $name]);

        redirect('/admin/categories?success=' . urlencode('Categoría creada exitosamente.'));
    }

    public function edit($id = null) {
        AuthMiddleware::checkAdminAccess();

        require_once '../helpers/Session.php';
        // Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede editar categorías
        if ($currentUser['rol'] !== 'master') {
            redirect('/admin/categories?success=' . urlencode('No tienes permisos para editar categorías.'));
        }

        if (!$id) {
            redirect('/admin/categories');
        }

        require_once '../app/models/CategoryModel.php';
        $categoryModel = new CategoryModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id);
            return;
        }

        $category = $categoryModel->getById($id);
        if (!$category) {
            redirect('/admin/categories');
        }

        $this->render('admin/categories/edit', ['category' => $category]);
    }

    private function handleEdit($id) {
        require_once '../helpers/Session.php';
        // Session::start();

        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/categories/edit', ['error' => $error, 'category' => ['id' => $id]]);
            return;
        }

        $name = trim($_POST['name'] ?? '');

        if (empty($name)) {
            $error = 'El nombre de la categoría es requerido.';
            $this->render('admin/categories/edit', ['error' => $error, 'category' => ['id' => $id]]);
            return;
        }

        require_once '../app/models/CategoryModel.php';
        $categoryModel = new CategoryModel();

        // Verificar si ya existe otra categoría con ese nombre
        if ($categoryModel->existsByName($name, $id)) {
            $error = 'Ya existe otra categoría con ese nombre.';
            $this->render('admin/categories/edit', ['error' => $error, 'category' => ['id' => $id, 'name' => $name]]);
            return;
        }

        $categoryModel->update($id, ['name' => $name]);

        redirect('/admin/categories?success=' . urlencode('Categoría actualizada exitosamente.'));
    }

    public function delete($id = null) {
        AuthMiddleware::checkAdminAccess();

        require_once '../helpers/Session.php';
        // Session::start();
        $currentUser = Session::getCurrentUser();

        // Solo master puede eliminar categorías
        if ($currentUser['rol'] !== 'master') {
            redirect('/admin/categories?success=' . urlencode('No tienes permisos para eliminar categorías.'));
        }

        if (!$id) {
            redirect('/admin/categories');
        }

        require_once '../app/models/CategoryModel.php';
        $categoryModel = new CategoryModel();

        $category = $categoryModel->getById($id);
        if (!$category) {
            redirect('/admin/categories');
        }

        $categoryModel->delete($id);

        redirect('/admin/categories?success=' . urlencode('Categoría eliminada exitosamente.'));
    }
}