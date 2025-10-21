<?php
// Controlador para gestión de negocios por administradores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../app/models/ProductModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/ProductPhotoModel.php';

class AdminBusinessController extends BaseController {
    
    public function index() {
        AuthMiddleware::checkAdminAccess();

        
        Session::start();
        $currentUser = Session::getCurrentUser();
        
        $businessModel = new BusinessModel();
        $businesses = $businessModel->getAll();
        
        $this->render('admin/business/index', [
            'businesses' => $businesses,
            'user' => $currentUser
        ]);
    }

    public function view($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/business');
            exit;
        }

        
        Session::start();
        $currentUser = Session::getCurrentUser();
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getById($id);
        
        if (!$business) {
            header('Location: /admin/business');
            exit;
        }
        
        $productModel = new ProductModel();
        $photoModel = new ProductPhotoModel();
        
        $products = $productModel->getByBusiness($id);
        
        // Agregar foto principal a cada producto
        foreach ($products as &$product) {
            $mainPhoto = $photoModel->getMainPhoto($product['id']);
            $product['main_photo'] = $mainPhoto ? $mainPhoto['photo'] : null;
        }
        
        $this->render('admin/business/view', [
            'business' => $business,
            'products' => $products,
            'user' => $currentUser
        ]);
    }

    public function toggleStatus($id = null) {
        AuthMiddleware::checkAdminAccess(); // Admin y Master pueden cambiar estado

        if (!$id) {
            header('Location: /admin/business');
            exit;
        }

        
        Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            header('Location: /admin/business?error=' . urlencode('Token CSRF inválido.'));
            exit;
        }
        
        $businessModel = new BusinessModel();
        $businessModel->toggleStatus($id);
        
        header('Location: /admin/business?success=' . urlencode('Estado del negocio actualizado.'));
        exit;
    }

    public function delete($id = null) {
        AuthMiddleware::checkMasterAccess(); // Solo master puede eliminar

        if (!$id) {
            header('Location: /admin/business');
            exit;
        }

        
        Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            header('Location: /admin/business?error=' . urlencode('Token CSRF inválido.'));
            exit;
        }
        
        $businessModel = new BusinessModel();
        $businessModel->delete($id);
        
        header('Location: /admin/business?success=' . urlencode('Negocio eliminado exitosamente.'));
        exit;
    }
}
