<?php
require_once __DIR__ . "/../../core/Database.php";

class UserModel {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function login($email, $senha) {

        $sql = "SELECT id, nome, email, senha 
                FROM usuarios 
                WHERE email = ? 
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            unset($usuario['senha']); // nunca devolver hash
            return $usuario;
        }

        return false;
    }

    public function criar($nome, $email, $senha) {

        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $hash);
        return $stmt->execute();
    }

    public function emailExiste($email) {

        $sql = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }
}
