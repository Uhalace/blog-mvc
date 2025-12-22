<?php
require_once __DIR__ . "/../../core/Controller.php";
require_once __DIR__ . "/../../app/Models/UserModel.php";

/*
@uhalace:
Controller responsável por login, logout e criação de conta de usuários
*/
class UserController extends Controller {

    /*
    @uhalace:
    Exibe a tela de login
    */
    public function login() {
        $this->view("user/login");
    }

    /*
    @uhalace:
    Processa a autenticação do usuário com validação CSRF
    */
    public function autenticar() {

        /*
        @uhalace:
        Inicializa sessão se necessário
        */
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /*
        @uhalace:
        Validação mínima de dados obrigatórios
        */
        if (!isset($_POST['email'], $_POST['senha'], $_POST['csrf_token'])) {
            $_SESSION['erroLogin'] = "Dados inválidos";
            header("Location: " . BASE_URL . "/user/login");
            exit;
        }

        /*
        @uhalace:
        Validação do token CSRF
        */
        if (
            empty($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
        ) {
            $_SESSION['erroLogin'] = "Sessão inválida. Tente novamente.";
            header("Location: " . BASE_URL . "/user/login");
            exit;
        }

        /*
        @uhalace:
        Limpa token após uso (one-time token)
        */
        unset($_SESSION['csrf_token']);

        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        /*
        @uhalace:
        Tentativa de autenticação via Model
        */
        $model   = new UserModel();
        $usuario = $model->login($email, $senha);

        if ($usuario) {

            /*
            @uhalace:
            Inicializa sessão segura após login
            */
            session_regenerate_id(true);

            $_SESSION['usuario'] = $usuario;

            header("Location: " . BASE_URL . "/inicio");
            exit;
        }

        /*
        @uhalace:
        Mensagem genérica para evitar enumeração de usuários
        */
        $_SESSION['erroLogin'] = "Usuário ou senha incorretos!";
        header("Location: " . BASE_URL . "/user/login");
        exit;
    }

    /*
    @uhalace:
    Exibe o formulário de criação de conta
    */
    public function criarConta() {
        $this->view("user/criarConta");
    }

    /*
    @uhalace:
    Processa o cadastro de um novo usuário
    */
    public function salvar() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /*
        @uhalace:
        Validação mínima dos dados obrigatórios
        */
        if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
            $_SESSION['erro'] = "Dados inválidos";
            header("Location: " . BASE_URL . "/user/criarConta");
            exit;
        }

        $nome  = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $model = new UserModel();

        /*
        @uhalace:
        Evita cadastro duplicado por e-mail
        */
        if ($model->emailExiste($email)) {
            $_SESSION['erro'] = "E-mail já cadastrado!";
            header("Location: " . BASE_URL . "/user/criarConta");
            exit;
        }

        /*
        @uhalace:
        Criação do usuário com hash seguro de senha
        */
        $model->criar($nome, $email, $senha);

        header("Location: " . BASE_URL . "/user/login");
        exit;
    }

    /*
    @uhalace:
    Finaliza a sessão do usuário
    */
    public function logout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: " . BASE_URL . "/user/login");
        exit;
    }
}
