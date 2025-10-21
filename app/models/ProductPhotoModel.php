<?php
// Modelo para la tabla product_photos

require_once '../core/BaseModel.php';

class ProductPhotoModel extends BaseModel {
    protected $table = 'product_photos';

    protected function getTableName() {
        return $this->table;
    }

    /**
     * Obtener todas las fotos de un producto
     * @param int $productId
     * @return array
     */
    public function getByProduct($productId) {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE product_id = ? 
            ORDER BY created_at ASC
        ");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener la primera foto de un producto (foto principal)
     * @param int $productId
     * @return array|false
     */
    public function getMainPhoto($productId) {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE product_id = ? 
            ORDER BY created_at ASC 
            LIMIT 1
        ");
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Contar fotos de un producto
     * @param int $productId
     * @return int
     */
    public function countByProduct($productId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchColumn();
    }

    /**
     * Eliminar todas las fotos de un producto
     * @param int $productId
     * @return int
     */
    public function deleteByProduct($productId) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->rowCount();
    }

    /**
     * Agregar foto a un producto
     * @param int $productId
     * @param mixed $photoData
     * @return int
     */
    public function addPhoto($productId, $photoData) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (product_id, photo) VALUES (?, ?)");
        $stmt->execute([$productId, $photoData]);
        return $this->db->lastInsertId();
    }

    /**
     * Agregar múltiples fotos a un producto
     * @param int $productId
     * @param array $photos
     * @return int
     */
    public function addMultiplePhotos($productId, $photos) {
        $count = 0;
        foreach ($photos as $photoData) {
            $this->addPhoto($productId, $photoData);
            $count++;
        }
        return $count;
    }
}
