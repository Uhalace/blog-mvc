<?php

namespace App\Middlewares;

class Autenticacao
{
    public static function verificar()
    {
        // Inicia a sessão se ainda não estiver iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
            // Redireciona para a página de login
            session_start();
            $_SESSION['erroLogin'] = "Acesso negado. Por favor, faça login para continuar.";
            header('Location: /blog-mvc/public/user/login');
            exit;
        }

        // Usuário está autenticado, continua a execução
        return true;
    }
}
