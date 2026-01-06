<?php
/**
 * Configuración de la aplicación
 * 
 * Este archivo contiene las configuraciones globales de la aplicación,
 * incluyendo la URL base que es crucial para deployments en subdirectorios.
 */

/**
 * BASE_URL - La ruta base de la aplicación
 * 
 * Como tanto localhost como producción apuntan a la raíz del proyecto
 * (no directamente a public/), y el .htaccess redirige internamente,
 * la BASE_URL debe estar vacía en ambos casos.
 */
define('BASE_URL', '');

/**
 * Función helper para generar URLs absolutas
 * 
 * @param string $path La ruta relativa (ej: '/login', '/admin/users')
 * @return string La URL completa con BASE_URL prefijado
 */
function url($path = '')
{
    // Asegurar que el path comienza con /
    if (!empty($path) && $path[0] !== '/') {
        $path = '/' . $path;
    }
    return BASE_URL . $path;
}

/**
 * Función helper para generar URLs de assets (imágenes, CSS, JS)
 * 
 * @param string $path La ruta del asset (ej: '/uploads/products/foto.jpg')
 * @return string La URL completa del asset
 */
function asset($path = '')
{
    return url($path);
}

/**
 * Función helper para redirecciones
 * 
 * @param string $path La ruta a redirigir (puede incluir query string, ej: '/admin?success=ok')
 * @param array $params Query parameters adicionales (se añaden a los existentes)
 */
function redirect($path, $params = [])
{
    // Separar path y query string si existe
    $parts = explode('?', $path, 2);
    $basePath = $parts[0];
    $existingQuery = isset($parts[1]) ? $parts[1] : '';

    // Construir URL con BASE_URL
    $url = url($basePath);

    // Combinar query strings
    if (!empty($existingQuery) || !empty($params)) {
        $queryParts = [];
        if (!empty($existingQuery)) {
            $queryParts[] = $existingQuery;
        }
        if (!empty($params)) {
            $queryParts[] = http_build_query($params);
        }
        $url .= '?' . implode('&', $queryParts);
    }

    header('Location: ' . $url);
    exit;
}
