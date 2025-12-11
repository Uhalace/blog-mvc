<?php
require_once __DIR__ . "/../../core/Controller.php";
require_once __DIR__ . "/../../app/Models/UserModel.php";

/*
 * UserController
 * ----------------
 * Responsável por:
 * - Mostrar tela de login
 * - Validar usuário
 */

class UserController extends Controller {

    public function login() {
        $this->view("user/login");
    }

    public function autenticar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $model = new UserModel();
        $usuario = $model->login($email, $senha);

        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario;

            header("Location: /blog-mvc/public/");
            exit;
        } else {
            echo "Usuário ou senha incorretos!";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /blog-mvc/public/user/login");
    }
}
