<?php 
class CarritoRepository {
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function getByUserId(int $id): array {
        $query = "SELECT * FROM items_carrito
                INNER JOIN productos
                    ON items_carrito.productos_producto_id = productos.producto_id
                WHERE items_carrito.usuarios_usuario_id = ?";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, CarritoItem::class);
        $itemsCarrito = $stmt->fetchAll();
        return $itemsCarrito;
    }

    public function create(array $itemCarrito): bool {
        $query = "INSERT INTO items_carrito (cantidad, productos_producto_id, 
                usuarios_usuario_id)
                VALUES (:cantidad, :productos_producto_id, :usuarios_usuario_id)";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'cantidad'                      => $itemCarrito['cantidad'],
                'productos_producto_id'         => $itemCarrito['producto_id'],
                'usuarios_usuario_id'           => $itemCarrito['usuario_id'], 
        ]);
        return $exito;
    }
    public function delete(int $id){
        $query = "DELETE FROM items_carrito
                WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$id]);
        return $exito;
    }
}