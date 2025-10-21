<?php
// Controlador principal para administradores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../app/models/UserModel.php';
require_once '../app/models/CategoryModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/ProductModel.php';

class AdminController extends BaseController {
    public function index() {
        AuthMiddleware::checkAdminAccess();
        
        // Obtener estadísticas del dashboard
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        $businessModel = new BusinessModel();
        $productModel = new ProductModel();
        
        // Contadores
        $totalUsers = count($userModel->getAll());
        $totalCategories = count($categoryModel->getAll());
        $totalBusinesses = count($businessModel->getAll());
        $totalProducts = count($productModel->getAll());
        
        // Actividad reciente (últimos 10 usuarios registrados)
        $recentUsers = $this->getRecentUsers($userModel);
        
        // Renderizar la vista principal de administradores
        $this->render('admin/index', [
            'totalUsers' => $totalUsers,
            'totalCategories' => $totalCategories,
            'totalBusinesses' => $totalBusinesses,
            'totalProducts' => $totalProducts,
            'recentUsers' => $recentUsers
        ]);
    }
    
    private function getRecentUsers($userModel) {
        $db = $userModel->getDb();
        $stmt = $db->prepare("SELECT name, lastname, email, rol, created_at FROM users ORDER BY created_at DESC LIMIT 5");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}