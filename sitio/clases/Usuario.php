<?php

class Usuario {
    protected $usuario_id;
    protected $rol_id;
    protected $email;
    protected $password;
    protected $nombre;
    protected $apellido;

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

}