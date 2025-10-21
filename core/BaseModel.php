<?php
// Clase base para todos los modelos
// Proporciona acceso a la conexión de base de datos

require_once 'DatabaseConnection.php';

abstract class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    // Método genérico para obtener todos los registros
    public function getAll() {
        $table = $this->getTableName();
        $stmt = $this->db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    // Método genérico para obtener por ID
    public function getById($id) {
        $table = $this->getTableName();
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Método genérico para insertar
    public function insert($data) {
        $table = $this->getTableName();
        $columns = implode(', ', array_keys($data));
        $placeholders = str_repeat('?, ', count($data) - 1) . '?';
        $stmt = $this->db->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($data));
        return $this->db->lastInsertId();
    }

    // Método genérico para actualizar
    public function update($id, $data) {
        $table = $this->getTableName();
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $stmt = $this->db->prepare("UPDATE $table SET $set WHERE id = ?");
        $stmt->execute(array_merge(array_values($data), [$id]));
        return $stmt->rowCount();
    }

    // Método genérico para eliminar
    public function delete($id) {
        $table = $this->getTableName();
        $stmt = $this->db->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    // Método abstracto para definir el nombre de la tabla
    abstract protected function getTableName();
    
    // Método público para obtener la conexión (útil para consultas personalizadas)
    public function getDb() {
        return $this->db;
    }
}