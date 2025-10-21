<?php
// Modelo para la gestión de tokens de acceso

require_once '../core/BaseModel.php';

class AccessTokenModel extends BaseModel {
    protected function getTableName() {
        return 'access_tokens';
    }

    // Buscar token válido (no usado, no expirado)
    public function getValidToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM access_tokens WHERE token = ? AND used = 0 AND expires_at > NOW()");
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    // Marcar token como usado
    public function markAsUsed($id) {
        $stmt = $this->db->prepare("UPDATE access_tokens SET used = 1, used_at = NOW() WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    // Limpiar tokens expirados
    public function cleanExpiredTokens() {
        $stmt = $this->db->prepare("DELETE FROM access_tokens WHERE expires_at < NOW() AND used = 0");
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Generar token único
    public function generateToken() {
        return bin2hex(random_bytes(32)); // 64 caracteres
    }

    // Crear token con expiración de 15 minutos
    public function createToken($role, $createdBy) {
        $token = $this->generateToken();
        $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $data = [
            'token' => $token,
            'rol' => $role,
            'created_by' => $createdBy,
            'expires_at' => $expiresAt
        ];

        $this->insert($data);
        return $token;
    }

    // Eliminar todos los tokens creados por un usuario
    public function deleteByCreator($userId) {
        $stmt = $this->db->prepare("DELETE FROM access_tokens WHERE created_by = ?");
        $stmt->execute([$userId]);
        return $stmt->rowCount();
    }
}
