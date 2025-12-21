<?php
// Controlador para gestión de negocios de productores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../helpers/FileUpload.php';
require_once '../app/models/UserModel.php';
require_once '../app/models/ProductModel.php';
require_once '../app/models/BusinessModel.php';
require_once '../app/models/DepartmentModel.php';
require_once '../app/models/MunicipalityModel.php';
require_once '../app/models/ProductPhotoModel.php';

class ProducerBusinessController extends BaseController {
    
    public function index() {
        AuthMiddleware::checkProducerAccess();

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        // Obtener datos completos del usuario incluyendo profile_photo
        $userModel = new UserModel();
        $userComplete = $userModel->getById($currentUser['id']);
        
        $businessModel = new BusinessModel();
        
        // Obtener el negocio del producer
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        // Si no tiene negocio, redirigir a crear
        if (!$business) {
            header('Location: /producer/business/create');
            exit;
        }
        
        $productModel = new ProductModel();
        $photoModel = new ProductPhotoModel();
        
        $products = [];
        // Obtener productos del negocio
        $products = $productModel->getByBusiness($business['id']);
        
        // Agregar foto principal a cada producto
        foreach ($products as &$product) {
            $mainPhoto = $photoModel->getMainPhoto($product['id']);
            $product['main_photo'] = $mainPhoto ? $mainPhoto['photo'] : null;
        }
        
        // Verificar si hay mensaje de éxito
        $success = $_GET['success'] ?? null;
        
        $this->render('producer/business/index', [
            'business' => $business,
            'products' => $products,
            'user' => $userComplete,
            'success' => $success
        ]);
    }

    public function create() {
        AuthMiddleware::checkProducerAccess();

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $businessModel = new BusinessModel();
        
        // Si ya tiene negocio, redirigir al index
        if ($businessModel->producerHasBusiness($currentUser['id'])) {
            header('Location: /producer/business');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate($currentUser['id']);
            return;
        }
        
        $departmentModel = new DepartmentModel();
        $departments = $departmentModel->getAll();
        
        $this->render('producer/business/create', [
            'departments' => $departments
        ]);
    }

    private function handleCreate($producerId) {
        
        // Session::start();
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $this->render('producer/business/create', ['error' => $error]);
            return;
        }

        $businessModel = new BusinessModel();
        
        // Verificar que no tenga ya un negocio
        if ($businessModel->producerHasBusiness($producerId)) {
            header('Location: /producer/business');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $departmentId = $_POST['department_id'] ?? '';
        $municipalityId = $_POST['municipality_id'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($phone) || empty($address) || empty($departmentId) || empty($municipalityId)) {
            $error = 'Todos los campos son requeridos excepto la descripción.';
            $this->render('producer/business/create', ['error' => $error]);
            return;
        }

        $data = [
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'description' => $description,
            'producer_id' => $producerId,
            'department_id' => $departmentId,
            'municipality_id' => $municipalityId,
            'status' => 'active'
        ];

        $businessModel->insert($data);

        header('Location: /producer/business?success=' . urlencode('¡Negocio creado exitosamente! Ahora puedes agregar tus productos.'));
        exit;
    }

    public function edit() {
        AuthMiddleware::checkProducerAccess();

        
        // Session::start();
        $currentUser = Session::getCurrentUser();
        
        $businessModel = new BusinessModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEdit($currentUser['id']);
            return;
        }
        
        $business = $businessModel->getByProducerId($currentUser['id']);
        
        if (!$business) {
            header('Location: /producer/business?success=' . urlencode('No tienes un negocio registrado.'));
            exit;
        }
        
        $departmentModel = new DepartmentModel();
        $municipalityModel = new MunicipalityModel();
        
        $departments = $departmentModel->getAll();
        $municipalities = $municipalityModel->getByDepartment($business['department_id']);
        
        $this->render('producer/business/edit', [
            'business' => $business,
            'departments' => $departments,
            'municipalities' => $municipalities
        ]);
    }

    private function handleEdit($producerId) {
        
        // Session::start();
        
        $businessModel = new BusinessModel();
        $business = $businessModel->getByProducerId($producerId);
        
        // Verificar CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::verifyCsrfToken($csrfToken)) {
            $error = 'Token CSRF inválido.';
            $departmentModel = new DepartmentModel();
            $municipalityModel = new MunicipalityModel();
            $this->render('producer/business/edit', [
                'error' => $error,
                'business' => $business,
                'departments' => $departmentModel->getAll(),
                'municipalities' => $municipalityModel->getByDepartment($business['department_id'])
            ]);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $departmentId = $_POST['department_id'] ?? '';
        $municipalityId = $_POST['municipality_id'] ?? '';

        // Validar campos requeridos
        if (empty($name) || empty($phone) || empty($address) || empty($departmentId) || empty($municipalityId)) {
            $error = 'Todos los campos son requeridos excepto la descripción.';
            $departmentModel = new DepartmentModel();
            $municipalityModel = new MunicipalityModel();
            $this->render('producer/business/edit', [
                'error' => $error,
                'business' => $business,
                'departments' => $departmentModel->getAll(),
                'municipalities' => $municipalityModel->getByDepartment($departmentId)
            ]);
            return;
        }

        $data = [
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'description' => $description,
            'department_id' => $departmentId,
            'municipality_id' => $municipalityId
        ];

        $businessModel->update($business['id'], $data);

        header('Location: /producer/business?success=' . urlencode('Negocio actualizado exitosamente.'));
        exit;
    }
}
