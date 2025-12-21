<?php
// Controlador para gestión de productos por administradores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../app/models/ProductModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/ProductPhotoModel.php';

class AdminProductController extends BaseController {
    
    public function view($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/business');
            exit;
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            header('Location: /admin/business');
            exit;
        }
        
        $photoModel = new ProductPhotoModel();
        $photos = $photoModel->getByProduct($id);
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getById($product['business_id']);
        
        $this->render('admin/business/products/view', [
            'product' => $product,
            'photos' => $photos,
            'business' => $business,
            'user' => $currentUser
        ]);
    }

    public function toggleStatus($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/business');
            exit;
        }

        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            header('Location: /admin/business?error=' . urlencode('Token CSRF inválido.'));
            exit;
        }
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            header('Location: /admin/business');
            exit;
        }
        
        // Cambiar estado y marcar como desactivado por admin si se está desactivando
        $newStatus = $product['status'] === 'active' ? 'inactive' : 'active';
        $disabledByAdmin = $newStatus === 'inactive' ? 1 : 0;
        
        $productModel->update($id, [
            'status' => $newStatus,
            'disabled_by_admin' => $disabledByAdmin
        ]);
        
        header('Location: /admin/business/products/view/' . $id . '?success=' . urlencode('Estado del producto actualizado.'));
        exit;
    }

    public function delete($id = null) {
        AuthMiddleware::checkMasterAccess(); // Solo master puede eliminar

        if (!$id) {
            header('Location: /admin/business');
            exit;
        }

        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            header('Location: /admin/business?error=' . urlencode('Token CSRF inválido.'));
            exit;
        }
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            header('Location: /admin/business');
            exit;
        }
        
        $businessId = $product['business_id'];
        $productModel->delete($id);
        
        header('Location: /admin/business/view/' . $businessId . '?success=' . urlencode('Producto eliminado exitosamente.'));
        exit;
    }
}
