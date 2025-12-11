<?php
require_once __DIR__ . "/../../core/Controller.php";
require_once __DIR__ . "/../../app/Models/PostModel.php";

class PostController extends Controller
{
    public function criar()
    {
        session_start();
        $mensagem = $_SESSION['mensagem'] ?? null;
        unset($_SESSION['mensagem']); // limpa após mostrar

        $this->view("post/criar", ["mensagem" => $mensagem]);
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        $titulo = trim($_POST['titulo']);
        $conteudo = trim($_POST['conteudo']);

        try {
            $post = new PostModel();
            $post->postNoticia($titulo, $conteudo);

            session_start();
            $_SESSION['mensagem'] = "Notícia postada com sucesso!";

            // voltar para a mesma página
            header("Location: /blog-mvc/public/post/criar");
            exit;

        } catch (Exception $e) {
            session_start();
            $_SESSION['mensagem'] = "Erro: " . $e->getMessage();

            header("Location: /blog-mvc/public/post/criar");
            exit;
        }
    }
}
