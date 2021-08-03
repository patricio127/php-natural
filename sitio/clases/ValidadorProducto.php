<?php
class ValidadorProducto {

    protected $data = [];
    protected $errores = [];
    /**
     * @param $data
     */
    public function __construct($data){
        $this->data = $data;
        $this->validar();
    }
    /**
     * @return bool
     */
    public function tieneErrores():bool{
        return count($this->errores) > 0;
    }
    /**
     * @return array
     */
    public function getErrores():array{
        return $this->errores;
    }
    
    protected function validar(){
        $this->validarNombre();
        $this->validarDescripcion();
        $this->validarPrecio();
    }
    
    protected function validarNombre(){
        if(empty($this->data['nombre'])){
            $this->errores['nombre'] = "<p class='input-error'>Debes poner un nombre del producto.</p>";
        } else if(strlen($this->data['nombre']) < 3){
            $this->errores['nombre'] = "<p class='input-error'>Debes poner al menos 3 caracteres.</p>";
        } else if(strlen($this->data['nombre']) > 100){
            $this->errores['nombre'] = "<p class='input-error'>EL titulo no debe ser mas de 100 caracteres.</p>";
        }
    }
    protected function validarDescripcion(){
        if(empty($this->data['descripcion'])){
            $this->errores['descripcion'] = "<p class='input-error'>Debes poner una descripcion para el producto.</p>";
        } else if(strlen($this->data['descripcion']) < 3){
            $this->errores['descripcion'] = "<p class='input-error'>Debes poner al menos 3 caracteres.</p>";
        }
    }
    protected function validarPrecio(){
        if(empty($this->data['precio'])){
            $this->errores['precio'] = "<p class='input-error'>Debes poner un precio para el producto.</p>";
        }
    }
}