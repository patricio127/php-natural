<?php

class Usuario {
    protected $usuario_id;
    protected $rol_id;
    protected $email;
    protected $password;
    protected $nombre;
    protected $apellido;
    protected $telefono;
    protected $calle;
    protected $numero;
    protected $codigo_postal;
    protected $dpto;

    public function getUsuarioId():int {
        return $this->usuario_id;
    }
    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }


    public function getRolId():int {
        return $this->rol_id;
    }
    public function setRolId($rol_id) {
        $this->rol_id = $rol_id;
    }


    public function getEmail():string {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }


    public function getPassword():string {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }


    public function getNombre():string {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }


    public function getApellido():string {
        return $this->apellido;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }


    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of calle
     */ 
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     *
     * @return  self
     */ 
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of codigo_posta
     */ 
    public function getCodigo_postal()
    {
        return $this->codigo_postal;
    }

    /**
     * Set the value of codigo_posta
     *
     * @return  self
     */ 
    public function setCodigo_postal($codigo_postal)
    {
        $this->codigo_postal = $codigo_postal;

        return $this;
    }

    /**
     * Get the value of dpto
     */ 
    public function getDpto()
    {
        return $this->dpto;
    }

    /**
     * Set the value of dpto
     *
     * @return  self
     */ 
    public function setDpto($dpto)
    {
        $this->dpto = $dpto;

        return $this;
    }
}