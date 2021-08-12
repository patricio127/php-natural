<?php 
class PedidoRepository {
    private $db;

    private $paginacionHabilitada = false;

    private $cantResultado = 6;

    private $paginacionPagina = 1;

    private $paginacionInicial;
    
    private $paginacionTotalPaginas;

    private $paginacionTotalRegistros;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function getById(int $id): Pedido|bool {
        $query = "SELECT * FROM pedidos
                WHERE pedido_id = ?";


        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pedido::class);
        $pedido = $stmt->fetch();

        $pedido_item_repo = new PedidoItemRepository($this->db);
        $pedido->setItems($pedido_item_repo->getByPedidoId($id));
        return $pedido;

    }

    public function create(array $pedido): int|bool {
        $query = "INSERT INTO pedidos (`monto_total`, `monto_envio`,
         `monto_productos`, `fecha`, `delivery`, `usuarios_usuario_id`)
                VALUES (:monto_total, :monto_envio, :monto_productos, :fecha, :delivery, :usuarios_usuario_id)";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'monto_total'            => $pedido['monto_total'],
                'monto_envio'            => $pedido['monto_envio'],
                'monto_productos'        => $pedido['monto_productos'], 
                'fecha'                  => $pedido['fecha'], 
                'delivery'               => $pedido['delivery'], 
                'usuarios_usuario_id'    => $pedido['usuario_id'], 
        ]);
        if($exito) {
            return $this->db->lastInsertId();
        }
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
    public function updateEstadoPedido(int $id, int $completado): bool {
        $query = "UPDATE pedidos 
                SET completado  = :completado
                WHERE pedido_id = :id";

        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'id'        => $id,
                'completado'  => $completado,
        ]);
        return $exito;
    }
    public function getAll(): array {
        $queryWhere= "";
        $execParameters = [];

        $queryLimit = $this->paginacionQuery($queryWhere, $execParameters);

        $query = "SELECT * FROM pedidos ". $queryWhere ." " . $queryLimit;
    
        $stmt = $this->db->prepare($query);
        $stmt->execute($execParameters);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pedido::class);
        $pedidos = $stmt->fetchAll();
        return $pedidos;
    }

    public function getByUserId(int $usuario_id): array {
        $queryWhere= "WHERE usuarios_usuario_id = :usuario_id";
        $execParameters = [
            'usuario_id'  => $usuario_id,
        ];

        $queryLimit = $this->paginacionQuery($queryWhere, $execParameters);
        $query = "SELECT * FROM pedidos ". $queryWhere ."" . $queryLimit;
    
        $stmt = $this->db->prepare($query);
        $stmt->execute($execParameters);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pedido::class);
        $pedidos = $stmt->fetchAll();
        return $pedidos;
    }


    public function paginacionHabilitar() {
        $this->paginacionHabilitada = true;
    }
    public function isPaginacionHabilitada(): bool {
        return $this->paginacionHabilitada;
    }
    public function setPaginacionHabilitada(bool $paginacionHabilitada):void {
        $this->paginacionHabilitada = $paginacionHabilitada;
    }
    
    public function getCantResultado(): int {
        return $this->cantResultado;
    }
    public function setCantResultado(int $cantResultado):void {
        $this->cantResultado = $cantResultado;
    }

    public function getPaginacionPagina(): int {
        return $this->paginacionPagina;
    }
    public function setPaginacionPagina(int $paginacionPagina):void {
        $this->paginacionPagina = $paginacionPagina;
    }

    public function getPaginacionTotalPaginas(): int {
        return $this->paginacionTotalPaginas;
    }

    public function getPaginacionTotalRegistros(): int {
        return $this->paginacionTotalRegistros;
    }

    private function paginacionQuery(string $queryWhere, array $execParameters) {
        $queryLimit = "";
        if($this->paginacionHabilitada) {
            $this->paginacionInicial = ($this->cantResultado * $this->paginacionPagina) - $this->cantResultado;

            $queryLimit = " LIMIT " . $this->paginacionInicial . ", " . $this->cantResultado;

            $queryCount = " SELECT COUNT(*) AS 'total' FROM pedidos " . $queryWhere;

            $stmt = $this->db->prepare($queryCount);
            $stmt->execute($execParameters);
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->paginacionTotalRegistros = $fila['total'];

            $this->paginacionTotalPaginas = ceil($this->paginacionTotalRegistros / $this->cantResultado);
        }
        return $queryLimit;
    }

}