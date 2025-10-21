<?php
// Controlador para la tienda pública

require_once '../core/BaseController.php';
require_once '../app/models/ProductModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/CategoryModel.php';
require_once '../app/models/DepartmentModel.php';
require_once '../app/models/MunicipalityModel.php';
require_once '../app/models/ProductPhotoModel.php';

class TiendaController extends BaseController {
    
    public function index() {
        
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $departmentModel = new DepartmentModel();
        $municipalityModel = new MunicipalityModel();
        $photoModel = new ProductPhotoModel();
        
        // Obtener filtros de búsqueda
        $search = $_GET['search'] ?? '';
        $categoryId = $_GET['category_id'] ?? '';
        $departmentId = $_GET['department_id'] ?? '';
        $municipalityId = $_GET['municipality_id'] ?? '';
        $minPrice = $_GET['min_price'] ?? '';
        $maxPrice = $_GET['max_price'] ?? '';
        
        // Construir filtros
        $filters = [];
        if (!empty($search)) {
            $filters['search'] = $search;
        }
        if (!empty($categoryId)) {
            $filters['category_id'] = $categoryId;
        }
        if (!empty($departmentId)) {
            $filters['department_id'] = $departmentId;
        }
        if (!empty($municipalityId)) {
            $filters['municipality_id'] = $municipalityId;
        }
        if (!empty($minPrice)) {
            $filters['min_price'] = $minPrice;
        }
        if (!empty($maxPrice)) {
            $filters['max_price'] = $maxPrice;
        }
        
        // Obtener productos filtrados (solo activos)
        $products = $productModel->getPublicProducts($filters);
        
        // Agregar foto principal a cada producto
        foreach ($products as &$product) {
            $mainPhoto = $photoModel->getMainPhoto($product['id']);
            $product['main_photo'] = $mainPhoto ? $mainPhoto['photo'] : null;
        }
        
        // Obtener datos para los filtros
        $categories = $categoryModel->getAll();
        $departments = $departmentModel->getAll();
        $municipalities = [];
        if (!empty($departmentId)) {
            $municipalities = $municipalityModel->getByDepartment($departmentId);
        }
        
        $this->render('tienda/index', [
            'products' => $products,
            'categories' => $categories,
            'departments' => $departments,
            'municipalities' => $municipalities,
            'filters' => $filters
        ]);
    }
    
    public function product($id = null) {
        if (!$id) {
            header('Location: /tienda');
            exit;
        }
        
        
        $productModel = new ProductModel();
        $product = $productModel->getById($id);
        
        // Verificar que el producto exista y esté activo
        if (!$product || $product['status'] !== 'active' || $product['business_status'] !== 'active') {
            header('Location: /tienda?error=' . urlencode('Producto no disponible.'));
            exit;
        }
        
        $photoModel = new ProductPhotoModel();
        $photos = $photoModel->getByProduct($id);
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getById($product['business_id']);
        
        $this->render('tienda/product', [
            'product' => $product,
            'photos' => $photos,
            'business' => $business
        ]);
    }
    
    public function business($id = null) {
        if (!$id) {
            header('Location: /tienda');
            exit;
        }
        
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getById($id);
        
        // Verificar que el negocio exista y esté activo
        if (!$business || $business['status'] !== 'active') {
            header('Location: /tienda?error=' . urlencode('Negocio no disponible.'));
            exit;
        }
        
        $productModel = new ProductModel();
        $products = $productModel->getByBusiness($id);
        
        // Filtrar solo productos activos
        $products = array_filter($products, function($product) {
            return $product['status'] === 'active';
        });
        
        // Agregar foto principal a cada producto
        $photoModel = new ProductPhotoModel();
        foreach ($products as &$product) {
            $mainPhoto = $photoModel->getMainPhoto($product['id']);
            $product['main_photo'] = $mainPhoto ? $mainPhoto['photo'] : null;
        }
        
        $this->render('tienda/business', [
            'business' => $business,
            'products' => $products
        ]);
    }
}