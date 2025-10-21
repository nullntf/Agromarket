<?php
// Controlador principal para productores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';

class ProducerController extends BaseController {
    public function index() {
        AuthMiddleware::checkProducerAccess();
        // Renderizar la vista principal de productores
        $this->render('producer/index');
    }
}