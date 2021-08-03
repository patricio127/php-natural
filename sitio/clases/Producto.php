<?php
class Producto {
    protected $producto_id;
    protected $usuario_id;
    protected $nombre;
    protected $descripcion;
    protected $precio;
    protected $categorias = [];
    protected $imagen;
    protected $imagen_descripcion;

    /**
     * @return int
     */
    public function getProductoId() {
        return $this->producto_id;
    }
    /**
     * @param int $producto_id
     */
    public function setProductoId($producto_id) {
        $this->producto_id = $producto_id;
    }

        /**
     * @return int
     */
    public function getUsuarioId() {
        return $this->usuario_id;
    }
    /**
     * @param int $usuario_id
     */
    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }
    /**
     * @param string $nombre
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

        /**
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }
    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        /**
     * @return string 
     */
    public function getPrecio() {
        return $this->precio;
    }
    /**
     * @param string $precio
     */
    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    /**
     * @return array
     */
    public function getCategorias() {
        return $this->categorias;
    }
    /**
     * @param string $categoria
     */
    public function setCategorias($categorias) {
        $this->categorias = $categorias;
    }

    /**
     * @return string 
     */
    public function getImagen() {
        return $this->imagen;
    }
    /**
     * @param string $imagen
     */
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    /**
     * @return string 
     */
    public function getImagenDescripcion() {
        return $this->imagen_descripcion;
    }
    /**
     * @param string $imagen_descripcion
     */
    public function setImagenDescripcion($imagen_descripcion) {
        $this->imagen_descripcion = $imagen_descripcion;
    }
}