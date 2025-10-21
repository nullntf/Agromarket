<?php
// Helper para Rate Limiting de login attempts por email

require_once __DIR__ . '/../core/DatabaseConnection.php';

class RateLimiter {
    private const MAX_ATTEMPTS = 5;
    private const LOCKOUT_DURATION = 1200; // 20 minutos en segundos

    /**
     * Verifica si el email está bloqueado por exceso de intentos
     * @param string $email Email del usuario
     * @return array ['locked' => bool, 'remaining_time' => int|null]
     */
    public static function isLocked($email) {
        if (empty($email)) {
            return ['locked' => false, 'remaining_time' => null];
        }

        $db = DatabaseConnection::getInstance()->getConnection();
        $email = strtolower(trim($email));
        
        $stmt = $db->prepare("
            SELECT attempts, locked_until 
            FROM login_attempts 
            WHERE email = :email
        ");
        $stmt->execute(['email' => $email]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$record) {
            return [
                'locked' => false,
                'remaining_time' => null
            ];
        }
        
        // Verificar si está bloqueado
        if ($record['locked_until'] !== null) {
            $lockedUntil = strtotime($record['locked_until']);
            $currentTime = time();
            
            if ($currentTime < $lockedUntil) {
                $remainingTime = $lockedUntil - $currentTime;
                return [
                    'locked' => true,
                    'remaining_time' => $remainingTime,
                    'remaining_minutes' => ceil($remainingTime / 60)
                ];
            }
            
            // Si el tiempo de bloqueo expiró, resetear
            self::reset($email);
        }
        
        return [
            'locked' => false,
            'remaining_time' => null
        ];
    }

    /**
     * Registra un intento de login fallido para un email
     * @param string $email Email del usuario
     * @return array ['locked' => bool, 'attempts_remaining' => int, 'locked_until' => string|null]
     */
    public static function recordFailedAttempt($email) {
        if (empty($email)) {
            return [
                'locked' => false,
                'attempts_remaining' => self::MAX_ATTEMPTS,
                'current_attempts' => 0
            ];
        }

        $db = DatabaseConnection::getInstance()->getConnection();
        $email = strtolower(trim($email));
        
        // Obtener registro actual
        $stmt = $db->prepare("
            SELECT id, attempts 
            FROM login_attempts 
            WHERE email = :email
        ");
        $stmt->execute(['email' => $email]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($record) {
            // Actualizar intentos existentes
            $newAttempts = $record['attempts'] + 1;
            
            if ($newAttempts >= self::MAX_ATTEMPTS) {
                // Bloquear usuario
                $lockedUntil = date('Y-m-d H:i:s', time() + self::LOCKOUT_DURATION);
                $stmt = $db->prepare("
                    UPDATE login_attempts 
                    SET attempts = :attempts, 
                        locked_until = :locked_until,
                        last_attempt = CURRENT_TIMESTAMP
                    WHERE email = :email
                ");
                $stmt->execute([
                    'attempts' => $newAttempts,
                    'locked_until' => $lockedUntil,
                    'email' => $email
                ]);
                
                return [
                    'locked' => true,
                    'attempts_remaining' => 0,
                    'locked_until' => $lockedUntil,
                    'lockout_minutes' => self::LOCKOUT_DURATION / 60
                ];
            } else {
                // Incrementar intentos
                $stmt = $db->prepare("
                    UPDATE login_attempts 
                    SET attempts = :attempts,
                        last_attempt = CURRENT_TIMESTAMP
                    WHERE email = :email
                ");
                $stmt->execute([
                    'attempts' => $newAttempts,
                    'email' => $email
                ]);
                
                return [
                    'locked' => false,
                    'attempts_remaining' => self::MAX_ATTEMPTS - $newAttempts,
                    'current_attempts' => $newAttempts
                ];
            }
        } else {
            // Crear nuevo registro
            $stmt = $db->prepare("
                INSERT INTO login_attempts (email, attempts, last_attempt) 
                VALUES (:email, 1, CURRENT_TIMESTAMP)
            ");
            $stmt->execute(['email' => $email]);
            
            return [
                'locked' => false,
                'attempts_remaining' => self::MAX_ATTEMPTS - 1,
                'current_attempts' => 1
            ];
        }
    }

    /**
     * Resetea el contador de intentos para un email (llamar en login exitoso)
     * @param string $email Email del usuario
     */
    public static function reset($email) {
        if (empty($email)) {
            return;
        }

        $db = DatabaseConnection::getInstance()->getConnection();
        $email = strtolower(trim($email));
        
        $stmt = $db->prepare("DELETE FROM login_attempts WHERE email = :email");
        $stmt->execute(['email' => $email]);
    }

    /**
     * Obtiene información del estado actual para un email
     * @param string $email Email del usuario
     * @return array
     */
    public static function getStatus($email) {
        if (empty($email)) {
            return [
                'locked' => false,
                'attempts' => 0,
                'attempts_remaining' => self::MAX_ATTEMPTS,
                'max_attempts' => self::MAX_ATTEMPTS,
                'lockout_duration_minutes' => self::LOCKOUT_DURATION / 60
            ];
        }

        $lockStatus = self::isLocked($email);
        $db = DatabaseConnection::getInstance()->getConnection();
        $email = strtolower(trim($email));
        
        $stmt = $db->prepare("SELECT attempts FROM login_attempts WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $attempts = $record ? $record['attempts'] : 0;
        
        return [
            'locked' => $lockStatus['locked'],
            'attempts' => $attempts,
            'attempts_remaining' => max(0, self::MAX_ATTEMPTS - $attempts),
            'max_attempts' => self::MAX_ATTEMPTS,
            'lockout_duration_minutes' => self::LOCKOUT_DURATION / 60,
            'remaining_time' => $lockStatus['remaining_time'] ?? null,
            'remaining_minutes' => $lockStatus['remaining_minutes'] ?? null
        ];
    }

    /**
     * Limpia registros antiguos (llamar periódicamente o en cron)
     * @param int $hoursOld Horas de antigüedad para limpiar (default: 24 horas)
     */
    public static function cleanOldRecords($hoursOld = 24) {
        $db = DatabaseConnection::getInstance()->getConnection();
        
        // Limpiar registros desbloqueados y antiguos
        $stmt = $db->prepare("
            DELETE FROM login_attempts 
            WHERE locked_until IS NULL 
            AND last_attempt < DATE_SUB(NOW(), INTERVAL :hours HOUR)
        ");
        $stmt->execute(['hours' => $hoursOld]);
        
        // Limpiar registros con bloqueo expirado
        $stmt = $db->prepare("
            DELETE FROM login_attempts 
            WHERE locked_until < DATE_SUB(NOW(), INTERVAL :hours HOUR)
        ");
        $stmt->execute(['hours' => $hoursOld]);
    }
}
