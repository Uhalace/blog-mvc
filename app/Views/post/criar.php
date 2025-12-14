<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css">

    <title>Publicar Notícia</title>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Criar Nova Notícia</h4>
                    </div>
                    
                    <div class="card-body p-4">

                        <?php if (!empty($mensagem)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $mensagem ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                            <!-- PARA FAZER UPLOAD DE IMAGENS, ADICIONAR O ATRIBUTO enctype="multipart/form-data" NO FORM -->
                        <form action="/blog-mvc/public/post/salvar" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 justify-content-center text-center">
                                <label for="imagem" class="form-label fw-bold">Pré-visualização da Imagem</label><br>
                                <img  id="preview-img" src="../../public/images/placeholder.png" alt="Pré-visualização da Imagem" class="img-fluid mb-2" style="max-height: 300px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-bold">Título</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Digite o título da notícia" required>
                            </div>
                            <div class="mb-3">
                                <label for="imagem" class="form-label fw-bold">Imagem</label><br>
                                <label for="imagem" class="form-label" id="label-img">Selecione uma imagem para a notícia (opcional):</label>
                                <input style="display: none;" type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="conteudo" class="form-label fw-bold">Conteúdo</label>
                                <textarea class="form-control" name="conteudo" id="conteudo" rows="6" placeholder="Escreva o conteúdo aqui..." required></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Salvar Publicação
                                </button>
                                <a href="javascript:history.back()" class="btn btn-outline-secondary">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="text-center mt-3 text-muted">
                    <small>Sistema de Blog MVC</small>
                </div>

            </div>
        </div>
    </div>
    <script src="../../public/js/validate.image.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>