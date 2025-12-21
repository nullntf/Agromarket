<?php
// Controlador principal para productores

require_once '../core/BaseController.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../helpers/Session.php';
require_once '../app/models/ProductModel.php';

class ProducerController extends BaseController {
    public function index() {
        AuthMiddleware::checkProducerAccess();

        Session::start();
        $currentUser = Session::getCurrentUser();

        $productModel = new ProductModel();
        $activeProductsCount = $productModel->countActiveByProducer($currentUser['id']);

        // Renderizar la vista principal de productores
        $this->render('producer/index', [
            'activeProductsCount' => $activeProductsCount
        ]);
    }
}