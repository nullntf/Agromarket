<?php
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
            header('Location: /admin/businesses');
            exit;
        }

        
        $productModel = new ProductModel();
        $businessModel = new BusinessModel();

        $business = $businessModel->getById($businessId);
        if (!$business) {
            header('Location: /admin/businesses?success=' . urlencode('Negocio no encontrado.'));
            exit;
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
            header('Location: /admin/businesses');
            exit;
        }

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate($businessId);
            return;
        }

        $businessModel = new BusinessModel();
        $categoryModel = new CategoryModel();

        $business = $businessModel->getById($businessId);
        if (!$business) {
            header('Location: /admin/businesses?success=' . urlencode('Negocio no encontrado.'));
            exit;
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

        header('Location: /admin/products/' . $businessId . '?success=' . urlencode('Producto creado exitosamente.'));
        exit;
    }

    public function edit($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/businesses');
            exit;
        }

        
        $productModel = new ProductModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id);
            return;
        }

        $product = $productModel->getById($id);
        if (!$product) {
            header('Location: /admin/businesses?success=' . urlencode('Producto no encontrado.'));
            exit;
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

        header('Location: /admin/products/' . $product['business_id'] . '?success=' . urlencode('Producto actualizado exitosamente.'));
        exit;
    }

    public function view($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/businesses');
            exit;
        }

        
        $productModel = new ProductModel();
        $photoModel = new ProductPhotoModel();

        $product = $productModel->getById($id);
        if (!$product) {
            header('Location: /admin/businesses?success=' . urlencode('Producto no encontrado.'));
            exit;
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
            header('Location: /admin/businesses');
            exit;
        }

        $productModel = new ProductModel();

        $product = $productModel->getById($id);
        if (!$product) {
            header('Location: /admin/businesses');
            exit;
        }

        $productModel->toggleStatus($id);

        header('Location: /admin/products/' . $product['business_id'] . '?success=' . urlencode('Estado del producto actualizado.'));
        exit;
    }

    public function delete($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/businesses');
            exit;
        }

        $productModel = new ProductModel();

        $product = $productModel->getById($id);
        if (!$product) {
            header('Location: /admin/businesses');
            exit;
        }

        $businessId = $product['business_id'];
        $productModel->delete($id);

        header('Location: /admin/products/' . $businessId . '?success=' . urlencode('Producto eliminado exitosamente.'));
        exit;
    }

    public function deletePhoto($id = null) {
        AuthMiddleware::checkAdminAccess();

        if (!$id) {
            header('Location: /admin/businesses');
            exit;
        }

        $photoModel = new ProductPhotoModel();

        $photo = $photoModel->getById($id);
        if (!$photo) {
            header('Location: /admin/businesses');
            exit;
        }

        $productId = $photo['product_id'];
        $photoModel->delete($id);

        header('Location: /admin/products/edit/' . $productId . '?success=' . urlencode('Foto eliminada exitosamente.'));
        exit;
    }
}
