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

    public function postNoticia(string $titulo, string $image, string $conteudo): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO posts (titulo, image, conteudo) VALUES (?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Erro na preparação: " . $this->conn->error);
        }

        $stmt->bind_param("sss", $titulo, $image, $conteudo);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar: " . $stmt->error);
        }

        $stmt->close();

        return true;
    }
    public function exibirNoticia(int $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = ?");

        if (!$stmt) {
            throw new Exception("Erro na preparação: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao buscar: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        $stmt->close();

        return $post ?: null;
    }
}
