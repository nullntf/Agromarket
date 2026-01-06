<?php
require_once '../config/app.php';
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
            redirect('/admin/business');
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            redirect('/admin/business');
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
            redirect('/admin/business');
        }

        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            redirect('/admin/business?error=' . urlencode('Token CSRF inválido.'));
        }
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            redirect('/admin/business');
        }
        
        // Cambiar estado y marcar como desactivado por admin si se está desactivando
        $newStatus = $product['status'] === 'active' ? 'inactive' : 'active';
        $disabledByAdmin = $newStatus === 'inactive' ? 1 : 0;
        
        $productModel->update($id, [
            'status' => $newStatus,
            'disabled_by_admin' => $disabledByAdmin
        ]);
        
        redirect('/admin/business/products/view/' . $id . '?success=' . urlencode('Estado del producto actualizado.'));
    }

    public function delete($id = null) {
        AuthMiddleware::checkMasterAccess(); // Solo master puede eliminar

        if (!$id) {
            redirect('/admin/business');
        }

        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            redirect('/admin/business?error=' . urlencode('Token CSRF inválido.'));
        }
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            redirect('/admin/business');
        }
        
        $businessId = $product['business_id'];
        $productModel->delete($id);
        
        redirect('/admin/business/view/' . $businessId . '?success=' . urlencode('Producto eliminado exitosamente.'));
    }
}
