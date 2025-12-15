<?php
require_once __DIR__ . "/../../core/Controller.php";
require_once __DIR__ . "/../../app/Models/UserModel.php";

/*
@CONTROLLER PARA USUARIOS, LOGIN, LOGOUT E CRIAR CONTA

*/
class UserController extends Controller {

    public function login() {
        $this->view("user/login");
    }

    public function autenticar() {

        if (!isset($_POST['email'], $_POST['senha'])) {
            echo "Dados inválidos";
            return;
        }

        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $model = new UserModel();
        $usuario = $model->login($email, $senha);

        if ($usuario) {
            session_start();
            session_regenerate_id(true);
            $_SESSION['usuario'] = $usuario;

            header("Location: /blog-mvc/public/");
            exit;
        }

        session_start();
        $_SESSION['erroLogin'] = "Usuário ou senha incorretos!";
        header("Location: /blog-mvc/public/user/login");
            exit;
    }

    //CRIAR CONTA
      

    // Exibe o formulário
    public function criarConta() {
        $this->view("user/criarConta");
    }

    // Processa o cadastro
    public function salvar() {

        if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
            session_start();
            $_SESSION['erro'] = "Dados inválidos";
            header("Location: /blog-mvc/public/user/criarConta");
             exit;
        }

        $nome  = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $model = new UserModel();

        if ($model->emailExiste($email)) {
            session_start();
            $_SESSION['erro'] = "E-mail já cadastrado!";
            header("Location: /blog-mvc/public/user/criarConta");
             exit;
        }

        $model->criar($nome, $email, $senha);

        header("Location: /blog-mvc/public/user/login");
        exit;
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /blog-mvc/public/user/login");
        exit;
    }
}
