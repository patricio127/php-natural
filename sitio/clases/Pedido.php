<?php
class Pedido {
    protected $usuarios_usuario_id;
    protected $pedido_id;
    protected $monto_total;
    protected $monto_productos;
    protected $monto_envio;
    protected $fecha;
    protected $delivery;
    protected $completado;
    protected $items;




    /**
     * Get the value of delivery
     */ 
    public function getDelivery() {
        return $this->delivery;
    }

    /**
     * Set the value of delivery
     *
     * @return  self
     */ 
    public function setDelivery($delivery) {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of monto_envio
     */ 
    public function getMonto_envio() {
        return $this->monto_envio;
    }

    /**
     * Set the value of monto_envio
     *
     * @return  self
     */ 
    public function setMonto_envio($monto_envio) {
        $this->monto_envio = $monto_envio;

        return $this;
    }

    /**
     * Get the value of monto_productos
     */ 
    public function getMonto_productos() {
        return $this->monto_productos;
    }

    /**
     * Set the value of monto_productos
     *
     * @return  self
     */ 
    public function setMonto_productos($monto_productos) {
        $this->monto_productos = $monto_productos;

        return $this;
    }

    /**
     * Get the value of monto_total
     */ 
    public function getMonto_total() {
        return $this->monto_total;
    }

    /**
     * Set the value of monto_total
     *
     * @return  self
     */ 
    public function setMonto_total($monto_total) {
        $this->monto_total = $monto_total;

        return $this;
    }

    /**
     * Get the value of pedido_id
     */ 
    public function getPedido_id() {
        return $this->pedido_id;
    }

    /**
     * Set the value of pedido_id
     *
     * @return  self
     */ 
    public function setPedido_id($pedido_id) {
        $this->pedido_id = $pedido_id;

        return $this;
    }

    /**
     * Get the value of usuarios_usuario_id
     */ 
    public function getUsuarios_usuario_id() {
        return $this->usuarios_usuario_id;
    }

    /**
     * Set the value of usuarios_usuario_id
     *
     * @return  self
     */ 
    public function setUsuarios_usuario_id($usuarios_usuario_id) {
        $this->usuarios_usuario_id = $usuarios_usuario_id;

        return $this;
    }

    /**
     * Get the value of completado
     */ 
    public function getCompletado() {
        return $this->completado;
    }

    /**
     * Set the value of completado
     *
     * @return  self
     */ 
    public function setCompletado($completado) {
        $this->completado = $completado;

        return $this;
    }

    /**
     * Get the value of items
     */ 
    public function getItems(): array {
        return $this->items;
    }
 
    /**
     * Set the value of items
     *
     * @return  self
     */ 
     public function setItems($items) {
        $this->items = $items;

        return $this;
    } 
}