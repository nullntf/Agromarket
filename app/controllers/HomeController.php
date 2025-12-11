<?php
// Controlador para la página de inicio

require_once '../core/BaseController.php';

class HomeController extends BaseController {
    public function __construct() {
        parent::__construct();
        
        // Manejar cambio de idioma si se especifica en la URL
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'])) {
            $this->setLanguage($_GET['lang']);
            
            // Redirigir sin el parámetro de idioma para evitar problemas
            $url = strtok($_SERVER['REQUEST_URI'], '?');
            header('Location: ' . $url);
            exit();
        }
    }
    
    public function index() {
        // Renderizar la vista de inicio
        $this->render('home/index');
    }

    public function registerInfo() {
        // Renderizar la vista de información de registro
        $this->render('home/register_info');
    }
}