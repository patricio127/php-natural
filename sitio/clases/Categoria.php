<?php

class Categoria {
    protected $categoria_id;
    protected $nombre;

    public function getCategoriaId(): int {
        return $this->categoria_id;
    }
    public function setCategoriaId(int $categoria_id): void {
        $this->categoria_id = $categoria_id;
    }
    /**
     * @return string
     */
    public function getNombre(): string {
        return $this->nombre;
    }
    public function setNombre(int $nombre): void {
        $this->nombre = $nombre;
    }
}