<?php
// Helper para configurar Security Headers HTTP

class SecurityHeaders {
    /**
     * Aplica todos los security headers recomendados
     */
    public static function apply() {
        // Prevenir que la página sea mostrada en un iframe (clickjacking protection)
        header("X-Frame-Options: DENY");
        
        // Habilitar protección XSS del navegador
        header("X-XSS-Protection: 1; mode=block");
        
        // Prevenir MIME type sniffing
        header("X-Content-Type-Options: nosniff");
        
        // Política de referrer (no enviar información sensible en el referrer)
        header("Referrer-Policy: strict-origin-when-cross-origin");
        
        // Content Security Policy (CSP) - Permite recursos del mismo origen y CDNs específicos
        $csp = "Content-Security-Policy: ";
        $csp .= "default-src 'self'; ";
        $csp .= "script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com; ";
        $csp .= "style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://fonts.googleapis.com; ";
        $csp .= "font-src 'self' https://cdnjs.cloudflare.com https://fonts.gstatic.com data:; ";
        $csp .= "img-src 'self' data: blob: https:; ";
        $csp .= "connect-src 'self'; ";
        $csp .= "frame-ancestors 'none'; ";
        $csp .= "base-uri 'self'; ";
        $csp .= "form-action 'self'; ";
        header($csp);
        
        // Strict Transport Security (HSTS) - Solo para HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
        }
        
        // Permissions Policy (antes Feature Policy)
        $permissions = "Permissions-Policy: ";
        $permissions .= "geolocation=(), ";
        $permissions .= "microphone=(), ";
        $permissions .= "camera=(), ";
        $permissions .= "payment=(), ";
        $permissions .= "usb=(), ";
        $permissions .= "magnetometer=(), ";
        $permissions .= "gyroscope=(), ";
        $permissions .= "accelerometer=()";
        header($permissions);
    }
    
    /**
     * Aplica headers específicos para APIs (si se necesitan en el futuro)
     */
    public static function applyForApi() {
        self::apply();
        
        // Headers adicionales para APIs
        header("Content-Type: application/json; charset=utf-8");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
    }
    
    /**
     * Aplica headers de cache para archivos estáticos
     */
    public static function applyForStaticFiles() {
        // Solo aplicar headers básicos, permitir cache
        header("X-Content-Type-Options: nosniff");
        header("Cache-Control: public, max-age=31536000, immutable");
    }
}
