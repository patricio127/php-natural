<?php
require_once __DIR__ . '/Producto.php';
class ProductoRepository {
    private $db;

    private $paginacionHabilitada = false;

    private $cantResultado = 12;

    private $paginacionPagina = 1;

    private $paginacionInicial;
    
    private $paginacionTotalPaginas;

    private $paginacionTotalRegistros;
    /**
     * @param PDO $db;
     */
    public function __construct(PDO $db){
        $this->db = $db;
    }

    /** 
    * @return Producto[]
    */
    
    public function all(?array $busqueda =[]):array {
        $queryWhere= "";
        $execParameters = [];
        if($busqueda !== null && count($busqueda) > 0){
            $queryWhere = " WHERE productos.nombre LIKE ?";
            $execParameters[] = '%' . $busqueda['buscar'] . '%';

        }

        $queryLimit = $this->paginacionQuery($queryWhere, $execParameters);
        

        $query = "SELECT * FROM productos
                    " . $queryWhere ."" . $queryLimit;
        $stmt = $this->db->prepare($query);
        $stmt->execute($execParameters);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        return $stmt->fetchAll();
    }


    
    // retorna los datos del productos asociado al id
    public function getByPk(int $id, bool $loadRelations = false): Producto {
        $query = "SELECT * FROM productos
                WHERE producto_id = ?";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $producto = $stmt->fetch();
        if($loadRelations){
            $query = "SELECT categorias. *
                    FROM productos_has_categorias
                    INNER JOIN categorias
                        ON productos_has_categorias.categorias_categoria_id = categorias.categoria_id
                    WHERE productos_has_categorias.productos_producto_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Categoria::class);
            $producto->setCategorias($stmt->fetchAll());
        }
        return $producto;
    }
    
    /**
     * @param PDO $db
     * @param array $nuevoProducto
     * @return bool
     */
    
    public function create(array $nuevoProducto): bool {
        $query = "INSERT INTO productos (usuario_id, nombre, 
                descripcion, precio, imagen, imagen_descripcion)
                VALUES (:usuario_id, :nombre, :descripcion, :precio, :imagen, :imagen_descripcion)";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'usuario_id'        => $nuevoProducto['usuario_id'], 
                'nombre'            => $nuevoProducto['nombre'],
                'descripcion'       => $nuevoProducto['descripcion'],
                'precio'            => $nuevoProducto['precio'], 
                'imagen'            => $nuevoProducto['imagen'], 
                'imagen_descripcion'=> $nuevoProducto['imagen_descripcion'],
        ]);

        $producto_id = $this->db->lastInsertId();

        if(!empty($nuevoProducto['categorias'])) {
            $exitoCategorias = $this->insertCategorias($nuevoProducto['categorias'], $producto_id);
            $exito = $exito && $exitoCategorias;
        }
        return $exito;
    }
    /**
     * @param int $id
     * @param array $dataProducto
     * @return bool
     */
    
    public function update(int $id, array $dataProducto): bool {
        $query = "UPDATE productos 
                SET usuario_id          = :usuario_id,
                    nombre              = :nombre,
                    descripcion         = :descripcion,
                    precio              = :precio,
                    imagen              = :imagen, 
                    imagen_descripcion  = :imagen_descripcion
                WHERE producto_id = :producto_id";

        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'usuario_id'        => $dataProducto['usuario_id'],
                'nombre'            => $dataProducto['nombre'],
                'descripcion'       => $dataProducto['descripcion'],
                'precio'            => $dataProducto['precio'], 
                'imagen'            => $dataProducto['imagen'], 
                'imagen_descripcion'=> $dataProducto['imagen_descripcion'],
                'producto_id'       => $id,
        ]);

        $exitoDelete = $this->deleteCategorias($id);
        $exito = $exito && $exitoDelete;

        if(!empty($dataProducto['categorias'])) {
            $exitoCategorias = $this->insertCategorias($dataProducto['categorias'], $id);
            $exito = $exito && $exitoCategorias;
        }
        return $exito;
    }
    /**
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id){
        $exitoDelete = $this->deleteCategorias($id);
        

        $query = "DELETE FROM productos
                WHERE producto_id = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$id]);
        $exito = $exito && $exitoDelete;
        return $exito;
    }
    protected function deleteCategorias(int $id): bool {
        $queryDelete = "DELETE FROM productos_has_categorias
                        WHERE productos_producto_id = ?";
        $stmt = $this->db->prepare($queryDelete);
        return $stmt = $stmt->execute([$id]);
    }
    protected function insertCategorias(array $categorias, int $id): bool {
        $setsValores = [];
        $categoriasValores = [];
        foreach($categorias as $categoria) {
            $setsValores[] = "(?, ?)";
            $categoriasValores[] = $id;
            $categoriasValores[] = $categoria;
        }
        $queryCategorias = "INSERT INTO productos_has_categorias (productos_producto_id, categorias_categoria_id)
                            VALUES" . implode(', ', $setsValores);
        $stmtCategorias = $this->db->prepare($queryCategorias);
        return $stmtCategorias->execute($categoriasValores);
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

            $queryCount = " SELECT COUNT(*) AS 'total' FROM productos" . $queryWhere;
            $stmt = $this->db->prepare($queryCount);
            $stmt->execute($execParameters);
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->paginacionTotalRegistros = $fila['total'];

            $this->paginacionTotalPaginas = ceil($this->paginacionTotalRegistros / $this->cantResultado);
        }
        return $queryLimit;
    }
}