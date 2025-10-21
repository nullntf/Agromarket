<?php
// Helper para manejo de subida de archivos

class FileUpload {
    // Tipos MIME permitidos para imágenes
    private static $allowedMimeTypes = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/webp'
    ];
    
    // Extensiones permitidas
    private static $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    // Tamaño máximo por defecto: 10MB
    private static $maxFileSize = 10485760; // 10 * 1024 * 1024
    
    /**
     * Subir un archivo de imagen
     * 
     * @param array $file Array $_FILES['campo']
     * @param string $directory Directorio destino relativo a /public/uploads/ (ej: 'profiles', 'banners', 'products')
     * @param string|null $customName Nombre personalizado (sin extensión). Si es null, genera uno único
     * @return array ['success' => bool, 'filename' => string|null, 'error' => string|null]
     */
    public static function uploadImage($file, $directory, $customName = null) {
        // Validar que el archivo existe
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return ['success' => false, 'filename' => null, 'error' => 'No se recibió ningún archivo'];
        }
        
        // Validar errores de upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'filename' => null, 'error' => self::getUploadErrorMessage($file['error'])];
        }
        
        // Validar tamaño
        if ($file['size'] > self::$maxFileSize) {
            $maxMB = self::$maxFileSize / 1048576;
            return ['success' => false, 'filename' => null, 'error' => "El archivo excede el tamaño máximo de {$maxMB}MB"];
        }
        
        // Validar tipo MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, self::$allowedMimeTypes)) {
            return ['success' => false, 'filename' => null, 'error' => 'Tipo de archivo no permitido. Solo se aceptan imágenes JPG, PNG, GIF y WebP'];
        }
        
        // Obtener extensión del archivo
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, self::$allowedExtensions)) {
            $extension = 'jpg'; // Extensión por defecto
        }
        
        // Generar nombre de archivo
        if ($customName) {
            $filename = self::sanitizeFilename($customName) . '.' . $extension;
        } else {
            $filename = uniqid('img_', true) . '.' . $extension;
        }
        
        // Crear directorio si no existe
        $uploadPath = __DIR__ . '/../public/uploads/' . $directory;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }
        
        // Ruta completa del archivo
        $fullPath = $uploadPath . '/' . $filename;
        
        // Si el archivo ya existe, agregar timestamp
        if (file_exists($fullPath)) {
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . time() . '.' . $extension;
            $fullPath = $uploadPath . '/' . $filename;
        }
        
        // Mover archivo
        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            // Establecer permisos
            chmod($fullPath, 0644);
            return ['success' => true, 'filename' => $filename, 'error' => null];
        } else {
            return ['success' => false, 'filename' => null, 'error' => 'Error al guardar el archivo en el servidor'];
        }
    }
    
    /**
     * Eliminar un archivo de imagen
     * 
     * @param string $filename Nombre del archivo
     * @param string $directory Directorio (ej: 'profiles', 'banners', 'products')
     * @return bool
     */
    public static function deleteImage($filename, $directory) {
        if (empty($filename)) {
            return false;
        }
        
        $filePath = __DIR__ . '/../public/uploads/' . $directory . '/' . $filename;
        
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        
        return false;
    }
    
    /**
     * Obtener URL pública de una imagen
     * 
     * @param string|null $filename Nombre del archivo
     * @param string $directory Directorio (ej: 'profiles', 'banners', 'products')
     * @param string|null $default URL por defecto si no hay imagen
     * @return string
     */
    public static function getImageUrl($filename, $directory, $default = null) {
        if (empty($filename)) {
            return $default ?: '/images/placeholder.png';
        }
        
        return '/uploads/' . $directory . '/' . $filename;
    }
    
    /**
     * Verificar si un archivo existe
     * 
     * @param string $filename Nombre del archivo
     * @param string $directory Directorio
     * @return bool
     */
    public static function fileExists($filename, $directory) {
        if (empty($filename)) {
            return false;
        }
        
        $filePath = __DIR__ . '/../public/uploads/' . $directory . '/' . $filename;
        return file_exists($filePath);
    }
    
    /**
     * Sanitizar nombre de archivo
     * 
     * @param string $filename
     * @return string
     */
    private static function sanitizeFilename($filename) {
        // Remover caracteres especiales
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
        // Limitar longitud
        return substr($filename, 0, 100);
    }
    
    /**
     * Obtener mensaje de error de upload
     * 
     * @param int $errorCode
     * @return string
     */
    private static function getUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return 'El archivo es demasiado grande';
            case UPLOAD_ERR_PARTIAL:
                return 'El archivo se subió parcialmente';
            case UPLOAD_ERR_NO_FILE:
                return 'No se subió ningún archivo';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Falta el directorio temporal';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Error al escribir el archivo en disco';
            case UPLOAD_ERR_EXTENSION:
                return 'Una extensión de PHP detuvo la subida';
            default:
                return 'Error desconocido al subir el archivo';
        }
    }
    
    /**
     * Configurar tamaño máximo de archivo
     * 
     * @param int $bytes Tamaño en bytes
     */
    public static function setMaxFileSize($bytes) {
        self::$maxFileSize = $bytes;
    }
    
    /**
     * Obtener tamaño máximo de archivo
     * 
     * @return int Tamaño en bytes
     */
    public static function getMaxFileSize() {
        return self::$maxFileSize;
    }
}
