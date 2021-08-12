<?php 
class PedidoItemRepository {
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function create(array $pedido): bool {
        $query = "INSERT INTO items_pedido (`cantidad`, `precio`, `pedidos_pedido_id`, `productos_producto_id`)
                VALUES (:cantidad, :precio, :pedidos_pedido_id, :productos_producto_id)";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'cantidad'                 => $pedido['cantidad'],
                'precio'                   => $pedido['precio'],
                'pedidos_pedido_id'        => $pedido['pedido_id'], 
                'productos_producto_id'    => $pedido['producto_id'], 
        ]);
        return $exito;
    }

    public function getByPedidoId(int $pedido_id ): array {
        $query = "SELECT * FROM items_pedido
                INNER JOIN productos 
                ON productos.producto_id = items_pedido.productos_producto_id
                WHERE pedidos_pedido_id = :pedido_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute(['pedido_id'  => $pedido_id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, ItemPedido::class);
        $itemsPedido = $stmt->fetchAll();
        return $itemsPedido;
    }

}