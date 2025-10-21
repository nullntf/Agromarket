<?php
// Modelo para la tabla departments

require_once '../core/BaseModel.php';

class DepartmentModel extends BaseModel {
    protected $table = 'departments';

    protected function getTableName() {
        return $this->table;
    }

    /**
     * Obtener todos los departamentos ordenados por nombre
     * @return array
     */
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener un departamento por ID
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar departamentos por nombre
     * @param string $search
     * @return array
     */
    public function search($search) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE name LIKE ? ORDER BY name ASC");
        $stmt->execute(["%{$search}%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Verificar si un departamento existe por nombre
     * @param string $name
     * @param int|null $excludeId ID a excluir de la búsqueda (para edición)
     * @return bool
     */
    public function existsByName($name, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE name = ? AND id != ?");
            $stmt->execute([$name, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE name = ?");
            $stmt->execute([$name]);
        }
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Contar municipios de un departamento
     * @param int $departmentId
     * @return int
     */
    public function countMunicipalities($departmentId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM municipalities WHERE department_id = ?");
        $stmt->execute([$departmentId]);
        return $stmt->fetchColumn();
    }
}
