<?php

class Autenticacion {
    private $db;
    /**
     * @param PDO $db;
     */
    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function login(string $email, string $password): bool {
        $query = 'SELECT * FROM usuarios
                WHERE email = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$usuario){
            return false;
        }

        if(!password_verify($password, $usuario['password'])) {
            return false;
        }

        $_SESSION['id'] = (int) $usuario['usuario_id'];
        $_SESSION['rol_id'] = (int) $usuario['rol_id'];
        return true;
    }
    
    public function autenticado (): bool {
        return isset($_SESSION['id']);
    }

    public function logout(){
        unset($_SESSION['id'], $_SESSION['rol_id']);
    }

    public function rolAdmin(): bool {
        return $this->autenticado() && $_SESSION['rol_id'] === 1;
    }
    /**
     * @return Usuario | null
     */
    public function getUsuario(): ?Usuario {
        if(!$this->autenticado()) return null;
        $repo = new UsuarioRepository($this->db);
        return $repo->getByPk($_SESSION['id']);
    }
}