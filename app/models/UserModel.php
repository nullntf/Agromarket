<?php
// Modelo para la gestión de usuarios

require_once '../core/BaseModel.php';

class UserModel extends BaseModel {
    protected function getTableName() {
        return 'users';
    }

    // Buscar usuario por email
    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Verificar si existe un email (opcionalmente excluyendo un ID)
    public function existsByEmail($email, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$email, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
        }
        return $stmt->fetchColumn() > 0;
    }

    // Actualizar last_login
    public function updateLastLogin($id) {
        $stmt = $this->db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    // Cambiar estado (active/inactive)
    public function toggleStatus($id) {
        $stmt = $this->db->prepare("UPDATE users SET status = CASE WHEN status = 'active' THEN 'inactive' ELSE 'active' END WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    // Validar contraseña
    public function validatePassword($password) {
        // Mínimo 8 caracteres, al menos una mayúscula, una minúscula y un número
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
    }

    // Hash de contraseña
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Verificar contraseña
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
