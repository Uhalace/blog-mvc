<?php

require_once __DIR__ . "/../../core/Controller.php";
require_once __DIR__ . "/../../app/Models/PostModel.php";

class PostController extends Controller
{
    public function criar()
    {
        session_start();
        $mensagem = $_SESSION['mensagem'] ?? null;
        unset($_SESSION['mensagem']);

        $this->view("post/criar", ["mensagem" => $mensagem]);
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        session_start();

        $titulo   = trim($_POST['titulo'] ?? '');
        $conteudo = trim($_POST['conteudo'] ?? '');
        $image    = '';

        // Validação de campos obrigatórios
        if (empty($titulo) || empty($conteudo) || empty($_FILES['imagem']['name'])) {
            $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        // Diretório de upload
        $DIR_UPLOAD = __DIR__ . "/../../public/imagens/posts/";
        if (!is_dir($DIR_UPLOAD)) {
            mkdir($DIR_UPLOAD, 0755, true);
        }

        // Validação do upload
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensagem'] = "Erro no envio da imagem.";
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        // Validação de tipo de imagem
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $mimeType = mime_content_type($_FILES['imagem']['tmp_name']);

        if (!in_array($mimeType, $tiposPermitidos)) {
            $_SESSION['mensagem'] = "Formato de imagem inválido. Use JPG, PNG ou WEBP.";
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        // Validação de tamanho (2MB)
        $tamanhoMaximo = 2 * 1024 * 1024;
        if ($_FILES['imagem']['size'] > $tamanhoMaximo) {
            $_SESSION['mensagem'] = "A imagem deve ter no máximo 2MB.";
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        // Geração de nome único
        $extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeUnico = uniqid('post_', true) . '.' . $extensao;
        $target    = $DIR_UPLOAD . $nomeUnico;

        // Upload do arquivo
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $target)) {
            $_SESSION['mensagem'] = "Erro ao salvar a imagem.";
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }

        try {
            $post = new PostModel();
            $post->postNoticia($titulo, $nomeUnico, $conteudo);

            $_SESSION['mensagem'] = "Notícia postada com sucesso!";
            header("Location: /blog-mvc/public/post/criar");
            exit;

        } catch (Exception $e) {

            // Remove a imagem caso o banco falhe
            if (file_exists($target)) {
                unlink($target);
            }

            $_SESSION['mensagem'] = "Erro ao salvar a notícia.";
            header("Location: /blog-mvc/public/post/criar");
            exit;
        }
    }
    function exibir(int $id)
    {
        try {
            $postModel = new PostModel();
            $post = $postModel->exibirNoticia($id);

            if (!$post) {
                http_response_code(404);
                echo "Notícia não encontrada.";
                exit;
            }

            $this->view("post/exibir", ["post" => $post]);

        } catch (Exception $e) {
            http_response_code(500);
            echo "Erro ao carregar a notícia.";
            exit;
        }
    }   
}
