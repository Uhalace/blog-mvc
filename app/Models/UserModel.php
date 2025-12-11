<?php
require_once __DIR__ . "/../../core/Database.php";

/*
 @UserModel
 Faz consulta no banco de dados para login.
 */

class UserModel {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function login($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = MD5(?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
}
