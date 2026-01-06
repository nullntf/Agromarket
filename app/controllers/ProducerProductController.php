<?php
require_once '../config/app.php';
// Controlador para gestión de productos de productores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../helpers/FileUpload.php';
require_once '../app/models/ProductModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/CategoryModel.php';
require_once '../app/models/ProductPhotoModel.php';

class ProducerProductController extends BaseController {
    
    public function create() {
        AuthMiddleware::checkProducerAccess();

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate($currentUser['id']);
            return;
        }
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business) {
            redirect('/producer/business?success=' . urlencode('No tienes un negocio registrado.'));
        }
        
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();
        
        $this->render('producer/business/products/create', [
            'business' => $business,
            'categories' => $categories
        ]);
    }

    private function handleCreate($producerId) {
        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('producer/business/products/create', ['error' => $error]);
            return;
        }

        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($producerId);
        
        if (!$business) {
            redirect('/producer/business');
        }

        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $categoryId = $_POST['category_id'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($price) || empty($categoryId)) {
            $error = 'El nombre, precio y categoría son requeridos.';
            $this->render('producer/business/products/create', ['error' => $error]);
            return;
        }

        // Validar precio
        if (!is_numeric($price) || $price < 0) {
            $error = 'El precio debe ser un número válido mayor o igual a 0.';
            $this->render('producer/business/products/create', ['error' => $error]);
            return;
        }

        $productModel = new ProductModel();

        $data = [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $categoryId,
            'business_id' => $business['id'],
            'status' => 'active'
        ];

        $productId = $productModel->insert($data);

        // Procesar fotos si se subieron (máximo 5)
        if (isset($_FILES['photos']) && !empty($_FILES['photos']['name'][0])) {
            $photoModel = new ProductPhotoModel();
            $uploadedCount = 0;
            $maxPhotos = 5;
            
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                if ($uploadedCount >= $maxPhotos) {
                    break; // Detener después de 5 fotos
                }
                
                if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                    // Crear array de archivo individual para FileUpload
                    $file = [
                        'name' => $_FILES['photos']['name'][$key],
                        'type' => $_FILES['photos']['type'][$key],
                        'tmp_name' => $tmpName,
                        'error' => $_FILES['photos']['error'][$key],
                        'size' => $_FILES['photos']['size'][$key]
                    ];
                    
                    $customName = 'product_' . $productId . '_' . ($uploadedCount + 1);
                    $uploadResult = FileUpload::uploadImage($file, 'products', $customName);
                    
                    if ($uploadResult['success']) {
                        $photoModel->addPhoto($productId, $uploadResult['filename']);
                        $uploadedCount++;
                    }
                }
            }
        }

        redirect('/producer/business?success=' . urlencode('Producto creado exitosamente.'));
    }

    public function edit($id = null) {
        AuthMiddleware::checkProducerAccess();

        if (!$id) {
            redirect('/producer/business');
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $productModel = new ProductModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($id, $currentUser['id']);
            return;
        }

        $product = $productModel->getById($id);
        if (!$product) {
            redirect('/producer/business?success=' . urlencode('Producto no encontrado.'));
        }
        
        // Verificar que el producto pertenece al producer
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business || $product['business_id'] != $business['id']) {
            redirect('/producer/business?success=' . urlencode('No tienes permiso para editar este producto.'));
        }

        $categoryModel = new CategoryModel();
        $photoModel = new ProductPhotoModel();
        
        $categories = $categoryModel->getAll();
        $photos = $photoModel->getByProduct($id);

        $this->render('producer/business/products/edit', [
            'product' => $product,
            'categories' => $categories,
            'photos' => $photos
        ]);
    }

    private function handleEdit($id, $producerId) {
        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $productModel = new ProductModel();
            $product = $productModel->getById($id);
            $this->render('producer/business/products/edit', ['error' => $error, 'product' => $product]);
            return;
        }

        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        // Verificar que el producto pertenece al producer
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($producerId);
        
        if (!$business || $product['business_id'] != $business['id']) {
            redirect('/producer/business');
        }

        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $categoryId = $_POST['category_id'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($price) || empty($categoryId)) {
            $error = 'El nombre, precio y categoría son requeridos.';
            $this->render('producer/business/products/edit', ['error' => $error, 'product' => $product]);
            return;
        }

        // Validar precio
        if (!is_numeric($price) || $price < 0) {
            $error = 'El precio debe ser un número válido mayor o igual a 0.';
            $this->render('producer/business/products/edit', ['error' => $error, 'product' => $product]);
            return;
        }

        $data = [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $categoryId
        ];

        $productModel->update($id, $data);

        // Procesar nuevas fotos si se subieron (máximo 5 fotos totales)
        if (isset($_FILES['photos']) && !empty($_FILES['photos']['name'][0])) {
            $photoModel = new ProductPhotoModel();
            
            // Contar fotos existentes
            $existingPhotos = $photoModel->getByProduct($id);
            $currentCount = count($existingPhotos);
            $maxPhotos = 5;
            $uploadedCount = 0;
            
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                // Verificar que no exceda el límite total
                if (($currentCount + $uploadedCount) >= $maxPhotos) {
                    break; // Ya tiene 5 fotos
                }
                
                if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                    // Crear array de archivo individual para FileUpload
                    $file = [
                        'name' => $_FILES['photos']['name'][$key],
                        'type' => $_FILES['photos']['type'][$key],
                        'tmp_name' => $tmpName,
                        'error' => $_FILES['photos']['error'][$key],
                        'size' => $_FILES['photos']['size'][$key]
                    ];
                    
                    $customName = 'product_' . $id . '_' . ($currentCount + $uploadedCount + 1);
                    $uploadResult = FileUpload::uploadImage($file, 'products', $customName);
                    
                    if ($uploadResult['success']) {
                        $photoModel->addPhoto($id, $uploadResult['filename']);
                        $uploadedCount++;
                    }
                }
            }
        }

        redirect('/producer/business?success=' . urlencode('Producto actualizado exitosamente.'));
    }

    public function view($id = null) {
        AuthMiddleware::checkProducerAccess();

        if (!$id) {
            redirect('/producer/business');
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            redirect('/producer/business?success=' . urlencode('Producto no encontrado.'));
        }
        
        // Verificar que el producto pertenece al producer
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business || $product['business_id'] != $business['id']) {
            redirect('/producer/business?success=' . urlencode('No tienes permiso para ver este producto.'));
        }
        
        $photoModel = new ProductPhotoModel();
        $photos = $photoModel->getByProduct($id);

        $this->render('producer/business/products/view', [
            'product' => $product,
            'photos' => $photos
        ]);
    }

    public function toggleStatus($id = null) {
        AuthMiddleware::checkProducerAccess();

        if (!$id) {
            redirect('/producer/business');
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            redirect('/producer/business');
        }
        
        // Verificar que el producto pertenece al producer
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business || $product['business_id'] != $business['id']) {
            redirect('/producer/business');
        }

        // Verificar si fue desactivado por un administrador
        if ($product['disabled_by_admin'] == 1 && $product['status'] === 'inactive') {
            redirect('/producer/business?error=' . urlencode('Este producto fue desactivado por un administrador. No puedes activarlo.'));
        }

        // Si el productor está activando el producto, limpiar la marca de admin
        if ($product['status'] === 'inactive') {
            $productModel->update($id, [
                'status' => 'active',
                'disabled_by_admin' => 0
            ]);
        } else {
            $productModel->toggleStatus($id);
        }

        redirect('/producer/business?success=' . urlencode('Estado del producto actualizado.'));
    }

    public function delete($id = null) {
        AuthMiddleware::checkProducerAccess();

        if (!$id) {
            redirect('/producer/business');
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        if (!$product) {
            redirect('/producer/business');
        }
        
        // Verificar que el producto pertenece al producer
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business || $product['business_id'] != $business['id']) {
            redirect('/producer/business');
        }

        $productModel->delete($id);

        redirect('/producer/business?success=' . urlencode('Producto eliminado exitosamente.'));
    }

    public function deletePhoto($id = null) {
        AuthMiddleware::checkProducerAccess();

        if (!$id) {
            redirect('/producer/business');
        }

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $photoModel = new ProductPhotoModel();
        $photo = $photoModel->getById($id);
        
        if (!$photo) {
            redirect('/producer/business');
        }
        
        // Verificar que la foto pertenece a un producto del producer
        $productModel = new ProductModel();
        $product = $productModel->getById($photo['product_id']);
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business || !$product || $product['business_id'] != $business['id']) {
            redirect('/producer/business');
        }

        // Eliminar archivo físico
        if (!empty($photo['photo'])) {
            FileUpload::deleteImage($photo['photo'], 'products');
        }
        
        // Eliminar registro de base de datos
        $photoModel->delete($id);

        redirect('/producer/business/products/edit/' . $photo['product_id'] . '?success=' . urlencode('Foto eliminada exitosamente.'));
    }
}
