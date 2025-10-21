<?php
// Modelo para la tabla businesses

require_once '../core/BaseModel.php';

class BusinessModel extends BaseModel {
    protected $table = 'businesses';

    protected function getTableName() {
        return $this->table;
    }

    /**
     * Obtener todos los negocios con información relacionada
     * @return array
     */
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT 
                b.*,
                u.name as producer_name,
                u.lastname as producer_lastname,
                u.email as producer_email,
                d.name as department_name,
                m.name as municipality_name
            FROM {$this->table} b
            INNER JOIN users u ON b.producer_id = u.id
            INNER JOIN departments d ON b.department_id = d.id
            INNER JOIN municipalities m ON b.municipality_id = m.id
            ORDER BY b.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener un negocio por ID con información relacionada
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT 
                b.*,
                u.name as producer_name,
                u.lastname as producer_lastname,
                u.email as producer_email,
                u.profile_photo as producer_photo,
                d.name as department_name,
                m.name as municipality_name
            FROM {$this->table} b
            INNER JOIN users u ON b.producer_id = u.id
            INNER JOIN departments d ON b.department_id = d.id
            INNER JOIN municipalities m ON b.municipality_id = m.id
            WHERE b.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener negocio por producer_id
     * @param int $producerId
     * @return array|false
     */
    public function getByProducerId($producerId) {
        $stmt = $this->db->prepare("
            SELECT 
                b.*,
                d.name as department_name,
                m.name as municipality_name
            FROM {$this->table} b
            INNER JOIN departments d ON b.department_id = d.id
            INNER JOIN municipalities m ON b.municipality_id = m.id
            WHERE b.producer_id = ?
        ");
        $stmt->execute([$producerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Verificar si un producer ya tiene un negocio
     * @param int $producerId
     * @return bool
     */
    public function producerHasBusiness($producerId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE producer_id = ?");
        $stmt->execute([$producerId]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Cambiar estado del negocio
     * @param int $id
     * @return int
     */
    public function toggleStatus($id) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET status = CASE WHEN status = 'active' THEN 'inactive' ELSE 'active' END 
            WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    /**
     * Obtener negocios por departamento
     * @param int $departmentId
     * @return array
     */
    public function getByDepartment($departmentId) {
        $stmt = $this->db->prepare("
            SELECT b.*, m.name as municipality_name
            FROM {$this->table} b
            INNER JOIN municipalities m ON b.municipality_id = m.id
            WHERE b.department_id = ? AND b.status = 'active'
            ORDER BY b.name ASC
        ");
        $stmt->execute([$departmentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener negocios por municipio
     * @param int $municipalityId
     * @return array
     */
    public function getByMunicipality($municipalityId) {
        $stmt = $this->db->prepare("
            SELECT b.*
            FROM {$this->table} b
            WHERE b.municipality_id = ? AND b.status = 'active'
            ORDER BY b.name ASC
        ");
        $stmt->execute([$municipalityId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Contar productos de un negocio
     * @param int $businessId
     * @return int
     */
    public function countProducts($businessId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM products WHERE business_id = ?");
        $stmt->execute([$businessId]);
        return $stmt->fetchColumn();
    }

    /**
     * Actualizar negocio (sobrescribe el método base para manejar BLOB)
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update($id, $data) {
        $set = [];
        $params = [];
        
        foreach ($data as $key => $value) {
            $set[] = "`$key` = ?";
            $params[] = $value;
        }
        
        $params[] = $id;
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $set) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        // Ejecutar directamente - PDO maneja BLOB automáticamente
        $stmt->execute($params);
        
        return $stmt->rowCount();
    }

    /**
     * Insertar negocio (sobrescribe el método base para manejar BLOB)
     * @param array $data
     * @return int
     */
    public function insert($data) {
        $columns = array_keys($data);
        $placeholders = array_fill(0, count($data), '?');
        
        $sql = "INSERT INTO {$this->table} (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $placeholders) . ")";
        $stmt = $this->db->prepare($sql);
        
        // Ejecutar directamente - PDO maneja BLOB automáticamente
        $stmt->execute(array_values($data));
        
        return $this->db->lastInsertId();
    }
}
