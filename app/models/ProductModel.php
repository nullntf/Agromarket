<?php
// Modelo para la tabla products

require_once '../core/BaseModel.php';

class ProductModel extends BaseModel {
    protected $table = 'products';

    protected function getTableName() {
        return $this->table;
    }

    /**
     * Obtener todos los productos con información relacionada
     * @return array
     */
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                c.name as category_name,
                b.name as business_name,
                b.producer_id
            FROM {$this->table} p
            INNER JOIN categories c ON p.category_id = c.id
            INNER JOIN businesses b ON p.business_id = b.id
            ORDER BY p.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener un producto por ID con información relacionada
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                c.name as category_name,
                b.name as business_name,
                b.phone as business_phone,
                b.status as business_status,
                b.producer_id,
                u.name as producer_name,
                u.lastname as producer_lastname
            FROM {$this->table} p
            INNER JOIN categories c ON p.category_id = c.id
            INNER JOIN businesses b ON p.business_id = b.id
            INNER JOIN users u ON b.producer_id = u.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener productos por negocio
     * @param int $businessId
     * @return array
     */
    public function getByBusiness($businessId) {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                c.name as category_name
            FROM {$this->table} p
            INNER JOIN categories c ON p.category_id = c.id
            WHERE p.business_id = ?
            ORDER BY p.created_at DESC
        ");
        $stmt->execute([$businessId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener productos por categoría
     * @param int $categoryId
     * @return array
     */
    public function getByCategory($categoryId) {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                b.name as business_name
            FROM {$this->table} p
            INNER JOIN businesses b ON p.business_id = b.id
            WHERE p.category_id = ? AND p.status = 'active'
            ORDER BY p.name ASC
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cambiar estado del producto
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
     * Buscar productos por nombre
     * @param string $search
     * @return array
     */
    public function search($search) {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                c.name as category_name,
                b.name as business_name
            FROM {$this->table} p
            INNER JOIN categories c ON p.category_id = c.id
            INNER JOIN businesses b ON p.business_id = b.id
            WHERE p.name LIKE ? AND p.status = 'active'
            ORDER BY p.name ASC
        ");
        $stmt->execute(['%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener productos por rango de precio
     * @param float $minPrice
     * @param float $maxPrice
     * @return array
     */
    public function getByPriceRange($minPrice, $maxPrice) {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                c.name as category_name,
                b.name as business_name
            FROM {$this->table} p
            INNER JOIN categories c ON p.category_id = c.id
            INNER JOIN businesses b ON p.business_id = b.id
            WHERE p.price BETWEEN ? AND ? AND p.status = 'active'
            ORDER BY p.price ASC
        ");
        $stmt->execute([$minPrice, $maxPrice]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Contar fotos de un producto
     * @param int $productId
     * @return int
     */
    public function countPhotos($productId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM product_photos WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchColumn();
    }

    /**
     * Obtener productos públicos con filtros (solo activos)
     * @param array $filters
     * @return array
     */
    public function getPublicProducts($filters = []) {
        $sql = "
            SELECT 
                p.*,
                c.name as category_name,
                b.name as business_name,
                b.phone as business_phone,
                b.status as business_status,
                b.id as business_id,
                u.name as producer_name,
                u.lastname as producer_lastname,
                m.name as municipality_name,
                d.name as department_name
            FROM {$this->table} p
            INNER JOIN categories c ON p.category_id = c.id
            INNER JOIN businesses b ON p.business_id = b.id
            INNER JOIN users u ON b.producer_id = u.id
            INNER JOIN municipalities m ON b.municipality_id = m.id
            INNER JOIN departments d ON b.department_id = d.id
            WHERE p.status = 'active' AND b.status = 'active'
        ";
        
        $params = [];
        
        // Filtro de búsqueda (nombre de producto, negocio o productor)
        if (!empty($filters['search'])) {
            $sql .= " AND (
                p.name LIKE ? OR 
                b.name LIKE ? OR 
                CONCAT(u.name, ' ', u.lastname) LIKE ?
            )";
            $searchTerm = '%' . $filters['search'] . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        // Filtro por categoría
        if (!empty($filters['category_id'])) {
            $sql .= " AND p.category_id = ?";
            $params[] = $filters['category_id'];
        }
        
        // Filtro por departamento
        if (!empty($filters['department_id'])) {
            $sql .= " AND b.department_id = ?";
            $params[] = $filters['department_id'];
        }
        
        // Filtro por municipio
        if (!empty($filters['municipality_id'])) {
            $sql .= " AND b.municipality_id = ?";
            $params[] = $filters['municipality_id'];
        }
        
        // Filtro por rango de precio
        if (!empty($filters['min_price'])) {
            $sql .= " AND p.price >= ?";
            $params[] = $filters['min_price'];
        }
        
        if (!empty($filters['max_price'])) {
            $sql .= " AND p.price <= ?";
            $params[] = $filters['max_price'];
        }
        
        $sql .= " ORDER BY p.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
