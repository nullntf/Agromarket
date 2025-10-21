<?php
// Modelo para la tabla municipalities

require_once '../core/BaseModel.php';

class MunicipalityModel extends BaseModel {
    protected $table = 'municipalities';

    protected function getTableName() {
        return $this->table;
    }

    /**
     * Obtener todos los municipios con información del departamento
     * @return array
     */
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT m.*, d.name as department_name 
            FROM {$this->table} m
            INNER JOIN departments d ON m.department_id = d.id
            ORDER BY d.name ASC, m.name ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener un municipio por ID con información del departamento
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT m.*, d.name as department_name 
            FROM {$this->table} m
            INNER JOIN departments d ON m.department_id = d.id
            WHERE m.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener municipios por departamento
     * @param int $departmentId
     * @return array
     */
    public function getByDepartment($departmentId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE department_id = ? ORDER BY name ASC");
        $stmt->execute([$departmentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar municipios por nombre
     * @param string $search
     * @return array
     */
    public function search($search) {
        $stmt = $this->db->prepare("
            SELECT m.*, d.name as department_name 
            FROM {$this->table} m
            INNER JOIN departments d ON m.department_id = d.id
            WHERE m.name LIKE ? OR d.name LIKE ?
            ORDER BY d.name ASC, m.name ASC
        ");
        $searchTerm = "%{$search}%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Verificar si un municipio existe por nombre en un departamento
     * @param string $name
     * @param int $departmentId
     * @param int|null $excludeId ID a excluir de la búsqueda (para edición)
     * @return bool
     */
    public function existsByNameInDepartment($name, $departmentId, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE name = ? AND department_id = ? AND id != ?");
            $stmt->execute([$name, $departmentId, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE name = ? AND department_id = ?");
            $stmt->execute([$name, $departmentId]);
        }
        return $stmt->fetchColumn() > 0;
    }
}
