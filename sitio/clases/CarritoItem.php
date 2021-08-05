<?php
class CarritoItem {
    protected $id;
    protected $cantidad;
    protected $producto_id;
    protected $nombre;
    protected $descripcion;
    protected $precio;

    /**
     * Get the value of precio
     */ 
    public function getPrecio(){
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio){
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion(){
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre){
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of producto_id
     */ 
    public function getProducto_id(){
        return $this->producto_id;
    }

    /**
     * Set the value of producto_id
     *
     * @return  self
     */ 
    public function setProducto_id($producto_id){
        $this->producto_id = $producto_id;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad(){
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;

        return $this;
    }
}