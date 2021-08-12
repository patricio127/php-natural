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
     * @param int $id
     * @return Usuario|null
     */
    public function getById(int $id): ?Usuario {
        $query = "SELECT * FROM usuarios
                WHERE usuario_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
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

    public function update(int $id, string $nombre, string $apellido, string $telefono): bool {
        $query = "UPDATE usuarios 
                SET nombre  = :nombre, apellido  = :apellido, telefono  = :telefono
                WHERE usuario_id = :id";

        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'id'            => $id,
                'nombre'        => $nombre,
                'apellido'      => $apellido,
                'telefono'      => $telefono,
        ]);
        return $exito;
    }

    public function updateConDireccion(int $id, string $nombre, string $apellido, string $telefono, string $calle, string $numero, 
                            string $codigo_postal, string $dpto): bool {
        $query = "UPDATE usuarios 
                SET nombre  = :nombre, apellido  = :apellido, telefono  = :telefono, calle = :calle, 
                numero = :numero, codigo_postal = :codigo_postal, dpto = :dpto
                WHERE usuario_id = :id";

        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
                'id'            => $id,
                'nombre'        => $nombre,
                'apellido'      => $apellido,
                'telefono'      => $telefono,
                'calle'         => $calle,
                'numero'        => $numero,
                'codigo_postal' => $codigo_postal,
                'dpto'          => $dpto,
        ]);
        return $exito;
    }
}