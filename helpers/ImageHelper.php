<?php
// Helper para generar URLs de imágenes

class ImageHelper {
    /**
     * Obtener URL de foto de perfil
     * 
     * @param string|null $filename Nombre del archivo
     * @return string URL de la imagen o placeholder
     */
    public static function profilePhoto($filename) {
        if (empty($filename)) {
            return '/images/default-avatar.png';
        }
        return '/uploads/profiles/' . htmlspecialchars($filename);
    }
    
    /**
     * Obtener URL de foto de producto
     * 
     * @param string|null $filename Nombre del archivo
     * @return string URL de la imagen o placeholder
     */
    public static function productPhoto($filename) {
        if (empty($filename)) {
            return '/images/default-product.png';
        }
        return '/uploads/products/' . htmlspecialchars($filename);
    }
}
