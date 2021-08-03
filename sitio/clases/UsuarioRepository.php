<?php

class UsuarioRepository{
    private $db;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db){
        $this->db = $db;
    }

    /**
     * @param int $pk
     * @return Usuario|null
     */
    public function getByPk(int $pk): ?Usuario {
        $query = "SELECT * FROM usuarios
                WHERE usuario_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$pk]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        return $stmt->fetch();
    }

    public function crear(array $data){
        $query = "INSERT INTO usuarios (email, password, rol_id)
                VALUES (:email, :password, :rol_id)";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
            'email' => $data['email'],
            'password' => $data['password'],
            'rol_id' => $data['rol_id'],
        ]);
        return $exito;
    }
}