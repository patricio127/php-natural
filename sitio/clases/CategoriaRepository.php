<?php

class CategoriaRepository {
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }
    public function all(): array {
        $query = "SELECT * FROM categorias";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Categoria::class);

        return $stmt->fetchAll();
    }
}