<?php
// Clase base para todos los controladores
// Puede contener lógica común para controladores

abstract class BaseController {
    // Método para renderizar vistas
    protected function render($view, $data = []) {
        // Extraer datos para usar en la vista
        extract($data);
        // Incluir el archivo de vista
        include '../app/views/' . $view . '.php';
    }
}