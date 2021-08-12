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

    public function vaciar(int $usuario_id){
        $query = "DELETE FROM items_carrito
                WHERE usuarios_usuario_id = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$usuario_id]);
        return $exito;
    }

    public function update(int $id, int $cantidad): bool {
        $query = "UPDATE items_carrito 
                SET cantidad  = :cantidad
                WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'id'        => $id,
                'cantidad'  => $cantidad,
        ]);
        return $exito;
    }

    public function getByUserIdAndProductId(int $usuario_id, int $producto_id, ): CarritoItem|bool {
        $query = "SELECT * FROM items_carrito
                WHERE usuarios_usuario_id = :usuario_id AND productos_producto_id = :producto_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'usuario_id'  => $usuario_id,
            'producto_id' => $producto_id,
        ]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, CarritoItem::class);
        $itemsCarrito = $stmt->fetch();
        return $itemsCarrito;
    }

}