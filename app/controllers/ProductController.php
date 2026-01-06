<?php
require_once '../config/app.php';
// Controlador para gestión de productos

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../app/models/ProductModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/CategoryModel.php';
require_once '../app/models/ProductPhotoModel.php';

class ProductController extends BaseController {
    
    public function index($businessId = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$businessId) {
            redirect('/admin/businesses');
        }

        
        $productModel = new ProductModel();
        $businessModel = new BusinessModel();

        $business = $businessModel->getById($businessId);
        if (!$business) {
            redirect('/admin/businesses?success=' . urlencode('Negocio no encontrado.'));
        }

        $products = $productModel->getByBusiness($businessId);

        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;

        $this->render('admin/products/index', [
            'products' => $products,
            'business' => $business,
            'success' => $success
        ]);
    }

    public function create($businessId = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$businessId) {
            redirect('/admin/businesses');
        }

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate($businessId);
            return;
        }

        $businessModel = new BusinessModel();
        $categoryModel = new CategoryModel();

        $business = $businessModel->getById($businessId);
        if (!$business) {
            redirect('/admin/businesses?success=' . urlencode('Negocio no encontrado.'));
        }

        $categories = $categoryModel->getAll();

        $this->render('admin/products/create', [
            'business' => $business,
            'categories' => $categories
        ]);
    }

    private function handleCreate($businessId) {
        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('admin/products/create', ['error' => $error]);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $categoryId = $_POST['category_id'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($price) || empty($categoryId)) {
            $error = 'El nombre, precio y categoría son requeridos.';
            $this->render('admin/products/create', ['error' => $error]);
            return;
        }

        // Validar precio
        if (!is_numeric($price) || $price < 0) {
            $error = 'El precio debe ser un número válido mayor o igual a 0.';
            $this->render('admin/products/create', ['error' => $error]);
            return;
        }

        $productModel = new ProductModel();

        $data = [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $categoryId,
            'business_id' => $businessId,
            'status' => 'active'
        ];

        $productId = $productModel->insert($data);

        // Procesar fotos si se subieron
        if (isset($_FILES['photos']) && !empty($_FILES['photos']['name'][0])) {
            $photoModel = new ProductPhotoModel();
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                    $fileType = $_FILES['photos']['type'][$key];
                    
                    if (!in_array($fileType, $allowedTypes)) {
                        continue; // Saltar archivos no válidos
                    }
                    
                    // Validar tamaño (máximo 5MB)
                    if ($_FILES['photos']['size'][$key] > 5242880) {
                        continue; // Saltar archivos muy grandes
                    }
                    
                    $photoData = file_get_contents($tmpName);
                    $photoModel->addPhoto($productId, $photoData);
                }
            }
        }

        redirect('/admin/products/' . $businessId . '?success=' . urlencode('Producto creado exitosamente.'));
    }

    public function edit($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            redirect('/admin/businesses');
        }

        
        $productModel = new ProductModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id);
            return;
        }

        $product = $productModel->getById($id);
        if (!$product) {
            redirect('/admin/businesses?success=' . urlencode('Producto no encontrado.'));
        }

        $categoryModel = new CategoryModel();
        $photoModel = new ProductPhotoModel();
        
        $categories = $categoryModel->getAll();
        $photos = $photoModel->getByProduct($id);

        $this->render('admin/products/edit', [
            'product' => $product,
            'categories' => $categories,
            'photos' => $photos
        ]);
    }

    private function handleEdit($id) {
        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $productModel = new ProductModel();
            $product = $productModel->getById($id);
            $this->render('admin/products/edit', ['error' => $error, 'product' => $product]);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $categoryId = $_POST['category_id'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($price) || empty($categoryId)) {
            $error = 'El nombre, precio y categoría son requeridos.';
            $productModel = new ProductModel();
            $product = $productModel->getById($id);
            $this->render('admin/products/edit', ['error' => $error, 'product' => $product]);
            return;
        }

        // Validar precio
        if (!is_numeric($price) || $price < 0) {
            $error = 'El precio debe ser un número válido mayor o igual a 0.';
            $productModel = new ProductModel();
            $product = $productModel->getById($id);
            $this->render('admin/products/edit', ['error' => $error, 'product' => $product]);
            return;
        }

        $productModel = new ProductModel();
        $product = $productModel->getById($id);

        $data = [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $categoryId
        ];

        $productModel->update($id, $data);

        // Procesar nuevas fotos si se subieron
        if (isset($_FILES['photos']) && !empty($_FILES['photos']['name'][0])) {
            $photoModel = new ProductPhotoModel();
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                    $fileType = $_FILES['photos']['type'][$key];
                    
                    if (!in_array($fileType, $allowedTypes)) {
                        continue;
                    }
                    
                    if ($_FILES['photos']['size'][$key] > 5242880) {
                        continue;
                    }
                    
                    $photoData = file_get_contents($tmpName);
                    $photoModel->addPhoto($id, $photoData);
                }
            }
        }

        redirect('/admin/products/' . $product['business_id'] . '?success=' . urlencode('Producto actualizado exitosamente.'));
    }

    public function view($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            redirect('/admin/businesses');
        }

        
        $productModel = new ProductModel();
        $photoModel = new ProductPhotoModel();

        $product = $productModel->getById($id);
        if (!$product) {
            redirect('/admin/businesses?success=' . urlencode('Producto no encontrado.'));
        }

        $photos = $photoModel->getByProduct($id);

        $this->render('admin/products/view', [
            'product' => $product,
            'photos' => $photos
        ]);
    }

    public function toggleStatus($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            redirect('/admin/businesses');
        }

        $productModel = new ProductModel();

        $product = $productModel->getById($id);
        if (!$product) {
            redirect('/admin/businesses');
        }

        $productModel->toggleStatus($id);

        redirect('/admin/products/' . $product['business_id'] . '?success=' . urlencode('Estado del producto actualizado.'));
    }

    public function delete($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            redirect('/admin/businesses');
        }

        $productModel = new ProductModel();

        $product = $productModel->getById($id);
        if (!$product) {
            redirect('/admin/businesses');
        }

        $businessId = $product['business_id'];
        $productModel->delete($id);

        redirect('/admin/products/' . $businessId . '?success=' . urlencode('Producto eliminado exitosamente.'));
    }

    public function deletePhoto($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            redirect('/admin/businesses');
        }

        $photoModel = new ProductPhotoModel();

        $photo = $photoModel->getById($id);
        if (!$photo) {
            redirect('/admin/businesses');
        }

        $productId = $photo['product_id'];
        $photoModel->delete($id);

        redirect('/admin/products/edit/' . $productId . '?success=' . urlencode('Foto eliminada exitosamente.'));
    }
}
