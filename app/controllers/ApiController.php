<?php
require_once '../config/app.php';
// Controlador para API REST

require_once '../core/BaseController.php';
require_once '../app/models/MunicipalityModel.php';

class ApiController extends BaseController {
    
    public function municipalities() {
        header('Content-Type: application/json');
        
        $departmentId = $_GET['department_id'] ?? null;
        
        if (!$departmentId) {
            echo json_encode([]);
            exit;
        }
        
        $municipalityModel = new MunicipalityModel();
        
        $municipalities = $municipalityModel->getByDepartment($departmentId);
        
        echo json_encode($municipalities);
        exit;
    }
}
