<?php




function calcularTempoLeitura($texto) {
    $palavras = str_word_count(strip_tags($texto));
    $minutos = floor($palavras / 200);
    return ($minutos < 1) ? "1 min de leitura" : $minutos . " min de leitura";
}

function formatarData($data) {
    return date('d/m/Y', strtotime($data));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= isset($post) ? htmlspecialchars($post['titulo']) : 'Blog MVC' ?></title>
    <meta name="description" content="<?= isset($post) ? substr(htmlspecialchars(strip_tags($post['conteudo'])), 0, 160) . '...' : 'Blog de tecnologia e notícias.' ?>">
    <meta name="author" content="<?= isset($post['autor']) ? htmlspecialchars($post['autor']) : 'Blog MVC' ?>">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= isset($post) ? htmlspecialchars($post['titulo']) : 'Blog MVC' ?>">
    <meta property="og:description" content="<?= isset($post) ? substr(htmlspecialchars(strip_tags($post['conteudo'])), 0, 160) : '' ?>">
    <meta property="og:image" content="<?= isset($post) ? BASE_URL . '/imagens/posts/' . htmlspecialchars($post['image']) : '' ?>">
    <meta property="og:site_name" content="Blog MVC">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --text-body: #2c3e50;
            --text-muted: #6c757d;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: var(--text-body);
            padding-top: 80px; 
        }

        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #000 !important;
        }

        /* Barra de Leitura */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: var(--primary-color);
            width: 0%;
            z-index: 2000;
            transition: width 0.1s;
        }

        /* Header do Post */
        .post-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .badge-category {
            background-color: rgba(13, 110, 253, 0.1);
            color: var(--primary-color);
            padding: 0.5em 1em;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .post-title {
            font-family: 'Merriweather', serif;
            font-weight: 900;
            font-size: 2.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            line-height: 1.3;
            color: #1a1a1a;
        }

        .post-meta {
            font-size: 0.9rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .post-meta img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Imagem Principal */
        .featured-image-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
            position: relative;
        }

        .featured-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .featured-image:hover {
            transform: scale(1.02);
        }

        /* Conteúdo do Artigo */
        .article-content {
            font-family: 'Merriweather', serif;
            font-size: 1.15rem;
            line-height: 1.9;
            color: #2c3e50;
            max-width: 740px; 
            margin: 0 auto;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        /* Rodapé Elegante */
        footer {
            background-color: #1a1a1a;
            color: #888;
            padding: 60px 0 30px;
            margin-top: 80px;
            font-size: 0.9rem;
        }
        
        footer h5 {
            color: #fff;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        footer a {
            color: #888;
            text-decoration: none;
            transition: color 0.2s;
        }

        footer a:hover {
            color: #fff;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .post-title { font-size: 2rem; }
            .article-content { font-size: 1.05rem; padding: 0 15px; }
        }
    </style>
</head>

<body>

<div id="progress-bar"></div>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="bi bi-journal-code me-2"></i>BLOG MVC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active fw-semibold" href="<?= BASE_URL ?>/inicio">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Tecnologia</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Carreira</a></li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-dark btn-sm rounded-pill px-4" href="#">Inscrever-se</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-5">
    <?php if (isset($post) && !empty($post)): ?>
        
        <header class="post-header">
            <?php if(isset($post['categoria'])): ?>
                <span class="badge-category"><?= htmlspecialchars($post['categoria']) ?></span>
            <?php endif; ?>
            
            <h1 class="post-title"><?= htmlspecialchars($post['titulo']) ?></h1>
            
            <div class="post-meta">
                <div class="d-flex align-items-center">
                    <img class="bi bi-person-circle fs-4 me-2" src="<?= $post['autor_imagem'] ?? 'https://placehold.co/40x40/eee/31343C?text=U' ?>" alt="Imagem do autor">
                    <div>
                        <br>
                        <span class="d-block fw-bold text-dark"><?= htmlspecialchars($post['autor'] ?? 'Redação MVC') ?></span>
                        <small>
                            <?php
                             $dataObj = new DateTime($post['criado_em']);
                             //IntlDateFormatter para formatar a data em pt_BR
                             $formatter = new IntlDateFormatter(
                                 'pt_BR',
                                 IntlDateFormatter::NONE,
                                 IntlDateFormatter::NONE,
                                 null,
                                 null,
                                 'dd MMMM, yyyy'
                             );
                             //Executa a formatação
                             $postado_em = $formatter->format($dataObj);
                             
                             // Primeira letra do mês em maiúscula
                             echo $postado_em = mb_convert_case($postado_em, MB_CASE_TITLE, 'UTF-8');
                            
                            ?>
                            &bull; <?= calcularTempoLeitura($post['conteudo']) ?>
                        </small>
                    </div>
                </div>
            </div>
        </header>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="featured-image-container">
                    <?php 
                        $imagePath = isset($post['image']) && !empty($post['image']) 
                            ? BASE_URL .'/imagens/posts/' . htmlspecialchars($post['image']) 
                            : 'https://placehold.co/800x400/eee/31343C?text=Blog+MVC'; //caso não tenha imagem
                    ?>
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($post['titulo']) ?>" class="featured-image">
                </div>
            </div>
        </div>

        <article class="row justify-content-center">
            <div class="col-lg-8">
                <div class="article-content">
                    <div class="d-flex gap-2 mb-4 text-muted small">
                        <span>COMPARTILHAR:</span>
                        <a href="#" class="text-primary"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-info"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-success"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    
                    <hr class="mb-4 opacity-25">

                    <div class="article-content" style="text-align: justify;">
                         <?= html_entity_decode($post['conteudo'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?>
                    </div>

                    <hr class="my-4 opacity-25">
                    <div class="mt-5 p-4 bg-light rounded-3 d-flex align-items-start border">
                        <div class="flex-shrink-0">
                            <img class="bi bi-person-bounding-box fs-1 text-secondary" src="<?= $post['autor_imagem'] ?? 'https://placehold.co/80x80/eee/31343C?text=U' ?>" alt="Imagem do autor" width="80" height="80">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0 text-dark">Sobre o Autor</h5>
                            <p class="mb-0 text-muted small">Aqui sobre o autor e o que ele faz</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>

    <?php else: ?>
        
        <div class="text-center py-5">
            <div class="display-1 text-muted mb-3"><i class="bi bi-file-earmark-x"></i></div>
            <h2 class="fw-bold">Ops! Post não encontrado.</h2>
            <p class="text-white mb-4">O artigo que você está procurando pode ter sido removido ou o link está incorreto.</p>
            <a href="index.php" class="btn btn-primary rounded-pill px-5 py-2">Voltar para a Home</a>
        </div>

    <?php endif; ?>
</main>

<footer>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white">Blog MVC</h5>
                <p class="small text-white">Uma plataforma dedicada a compartilhar conhecimento sobre desenvolvimento, tecnologia e inovação.</p>
                <div class="d-flex gap-3">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-github"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5>Links</h5>
                <ul class="list-unstyled text-small ">
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Sobre</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Legal</h5>
                <ul class="list-unstyled text-small">
                    <li><a href="#">Termos de Uso</a></li>
                    <li><a href="#">Privacidade</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Newsletter</h5>
                <form class="mt-2">
                    <div class="input-group input-group-sm">
                        <input type="email" class="form-control bg-dark text-white border-secondary" placeholder="Seu e-mail">
                        <button class="btn btn-primary" type="button">OK</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="border-top border-secondary mt-5 pt-4 text-center text-white">
            <small class="text-white">
                &copy; <span id="year"></span> Blog MVC. Desenvolvido por <strong>Uhalace</strong>.
            </small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Atualiza o ano automaticamente
    document.getElementById('year').textContent = new Date().getFullYear();

    // Barra de Leitura 
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("progress-bar").style.width = scrolled + "%";
    };
</script>
</body>
</html>