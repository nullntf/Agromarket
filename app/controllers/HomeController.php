<?php
// Controlador de ejemplo para la página de inicio

require_once '../core/BaseController.php';

class HomeController extends BaseController {
    public function index() {
        // Renderizar la vista de inicio
        $this->render('home/index');
    }

    public function registerInfo() {
        // Renderizar la vista de información de registro
        $this->render('home/register_info');
    }
}