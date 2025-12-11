<?php
declare(strict_types=1);
require_once __DIR__ . "/../../core/Database.php";

/*
@MODEL PARA CRIAR OS POST, SERA POST SIMPLES
*/

class PostModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function postNoticia(string $titulo, string $conteudo): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO posts (titulo, conteudo) VALUES (?, ?)");

        if (!$stmt) {
            throw new Exception("Erro na preparação: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $titulo, $conteudo);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar: " . $stmt->error);
        }

        $stmt->close();

        return true;
    }
}
