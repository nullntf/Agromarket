<?php
// Modelo para la tabla categories

require_once '../core/BaseModel.php';

class CategoryModel extends BaseModel {
    protected $table = 'categories';

    protected function getTableName() {
        return $this->table;
    }

    /**
     * Obtener todas las categorías ordenadas por nombre
     * @return array
     */
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener una categoría por ID
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar categorías por nombre
     * @param string $search
     * @return array
     */
    public function search($search) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE name LIKE ? ORDER BY name ASC");
        $stmt->execute(["%{$search}%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Verificar si una categoría existe por nombre
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
}
