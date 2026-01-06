<?php
// Punto de entrada principal de la aplicación
// Implementa un enrutador básico basado en la URL

// Cargar configuración de la aplicación (BASE_URL, helpers)
require_once '../config/app.php';

// Aplicar security headers HTTP
require_once '../helpers/SecurityHeaders.php';
SecurityHeaders::apply();

require_once '../config/database.php';
require_once '../config/routes.php';

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Eliminar el BASE_URL del path para el enrutamiento
$basePath = trim(BASE_URL, '/');
if (!empty($basePath) && strpos($path, '/' . $basePath) === 0) {
    $path = substr($path, strlen('/' . $basePath));
}

$path = trim($path, '/');

// Buscar ruta exacta
if (array_key_exists($path, $routes)) {
    $route = $routes[$path];
    $controllerName = $route['controller'];
    $action = $route['action'];
    require_once "../app/controllers/{$controllerName}.php";
    $controller = new $controllerName();
    $controller->$action();
} else {
    // Buscar rutas con parámetros (ej: admin/users/toggle/1)
    $found = false;
    foreach ($routes as $routePath => $route) {
        // Convertir ruta con parámetros a patrón regex
        $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $routePath);
        if (preg_match("#^$pattern$#", $path, $matches)) {
            array_shift($matches); // Remover match completo
            $controllerName = $route['controller'];
            $action = $route['action'];
            require_once "../app/controllers/{$controllerName}.php";
            $controller = new $controllerName();

            // Si hay parámetros, pasarlos al método
            if (!empty($matches)) {
                call_user_func_array([$controller, $action], $matches);
            } else {
                $controller->$action();
            }
            $found = true;
            break;
        }
    }

    if (!$found) {
        // Página no encontrada, redirigir a inicio
        require_once '../app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
    }
}