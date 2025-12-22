<?php
require_once __DIR__ . "/../../core/Database.php";

class UserModel {

    private $conn;

    /*
    @uhalace:
    Inicializa a conexão com o banco de dados
    */
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    /*
    @uhalace:
    Realiza login seguro com proteção contra enumeração de usuários,
    verificação de conta ativa e rehash automático de senha
    */
    public function login(string $email, string $senha): array|false {

        $sql = "
            SELECT 
                id, 
                nome, 
                email, 
                senha, 
                ativo 
            FROM usuarios 
            WHERE email = ?
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result  = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        /*
        @uhalace:
        Proteção contra enumeração de usuários.
        Executa password_verify mesmo quando o usuário não existe
        */
        if (!$usuario) {
            password_verify($senha, password_hash('fake_password', PASSWORD_DEFAULT));
            return false;
        }

        /*
        @uhalace:
        Verifica se a conta está ativa
        */
        if ((int)$usuario['ativo'] !== 1) {
            return false;
        }

        /*
        @uhalace:
        Verificação da senha
        */
        if (!password_verify($senha, $usuario['senha'])) {
            return false;
        }

        /*
        @uhalace:
        Rehash automático caso o algoritmo padrão do PHP seja atualizado
        */
        if (password_needs_rehash($usuario['senha'], PASSWORD_DEFAULT)) {
            $this->atualizarSenha($usuario['id'], $senha);
        }

        unset($usuario['senha']);
        return $usuario;
    }

    /*
    @uhalace:
    Criação de usuário com hash seguro de senha
    */
    public function criar(string $nome, string $email, string $senha): bool {

        if ($this->emailExiste($email)) {
            return false;
        }

        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "
            INSERT INTO usuarios (nome, email, senha, ativo)
            VALUES (?, ?, ?, 1)
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $hash);

        return $stmt->execute();
    }

    /*
    @uhalace:
    Atualiza o hash da senha quando necessário
    */
    private function atualizarSenha(int $id, string $senha): void {

        $novoHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $novoHash, $id);
        $stmt->execute();
    }

    /*
    @uhalace:
    Verifica se o email já está cadastrado
    */
    public function emailExiste(string $email): bool {

        $sql = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }
}
