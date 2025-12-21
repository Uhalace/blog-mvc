<?php
session_start();


if (!defined('BASE_URL')) define('BASE_URL', '/blog-mvc/public');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog MVC - Tecnologia e Inovação</title>
    <meta name="description" content="Artigos de ponta sobre desenvolvimento web, PHP, e tecnologia.">
    <meta name="author" content="Uhalace Souza">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --hover-transform: translateY(-8px);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.08);
            --card-hover-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
            color: #4a5568;
            padding-top: 76px; 
            
        }

        /* Navbar Glassmorphism */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar-brand { font-weight: 800; color: #1a202c !important; letter-spacing: -0.5px; }
        .nav-link { font-weight: 500; color: #4a5568 !important; }
        .nav-link:hover { color: var(--primary-color) !important; }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
            padding: 80px 0 60px;
            border-bottom: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        
        
        .hero::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 300px; height: 300px;
            background: rgba(13, 110, 253, 0.05);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-content { position: relative; z-index: 1; }
        .hero h1 { font-family: 'Merriweather', serif; font-weight: 900; color: #1a202c; letter-spacing: -1px; }

        
        .search-wrapper {
            max-width: 500px;
            margin: 30px auto 0;
            position: relative;
        }
        .search-input {
            border-radius: 50px;
            padding: 15px 25px;
            border: 1px solid #cbd5e0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }
        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            border-color: var(--primary-color);
        }
        .search-btn {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            border-radius: 50px;
            padding: 0 20px;
        }

        /* Cards */
        .post-card {
            border: none;
            border-radius: 16px;
            background: #fff;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .post-card:hover {
            transform: var(--hover-transform);
            box-shadow: var(--card-hover-shadow);
        }

        .img-wrapper {
            overflow: hidden;
            height: 220px;
            position: relative;
        }

        .post-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .post-card:hover img {
            transform: scale(1.05); 
        }

        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255,255,255,0.9);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            color: #2d3748;
        }

        .card-text {
            color: #718096;
            font-size: 0.95rem;
            line-height: 1.6;
            /* Truncar texto após 3 linhas com CSS */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-footer-custom {
            margin-top: auto;
            border-top: 1px solid #edf2f7;
            padding-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #a0aec0;
        }

        .read-more-btn {
            font-weight: 600;
            text-decoration: none;
            color: var(--primary-color);
            display: inline-flex;
            align-items: center;
        }
        .read-more-btn:hover { text-decoration: underline; }

        /* Footer */
        footer {
            background-color: #1a202c;
            color: #cbd5e0;
            margin-top: 80px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="bi bi-code-square me-2 text-primary"></i>BLOG MVC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Notícias</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>/user/logout">Logout</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>/post/criar">Publicar</a></li>
                <?php endif; ?>
                <li class="nav-item ms-lg-2">
                    <a href="<?php echo BASE_URL; ?>/user/login" class="btn btn-primary btn-sm rounded-pill px-4">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero text-center">
    <div class="container hero-content">
        <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill">Blog & News</span>
        <h1 class="display-5 mb-3">Conhecimento que <span class="text-primary">Impulsiona</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 600px;">
            Artigos técnicos, tutoriais e as últimas novidades do mundo do desenvolvimento.
        </p>

        <div class="search-wrapper">
            <form action="#" method="GET">
                <input type="text" class="form-control search-input" placeholder="O que você quer ler hoje?" name="q">
                <button type="submit" class="btn btn-primary search-btn"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
</section>

<main class="container py-5">
    
    <?php if ($result->num_rows === 0): ?>
        <div class="text-center py-5">
            <div class="mb-3 text-muted"><i class="bi bi-inbox fs-1"></i></div>
            <h3>Nenhuma publicação encontrada</h3>
            <p class="text-muted">Parece que ainda não escrevemos nada sobre isso.</p>
        </div>
    <?php else: ?>

    <div class="row g-4">
        <?php
        while ($row = $result->fetch_assoc()) {
            // Formatação de data mais elegante
            $dataObj = new DateTime($row['criado_em']);
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
            $postado_em = mb_convert_case($postado_em, MB_CASE_TITLE, 'UTF-8');
            
            
            
            
            
            $titulo = htmlspecialchars($row['titulo']);
            $conteudo = htmlspecialchars(strip_tags($row['conteudo'])); 
            
            
            $imagem = !empty($row['image']) 
                ? BASE_URL . "/imagens/posts/" . htmlspecialchars($row['image']) 
                : "https://placehold.co/600x400/eee/31343C?text=Blog+MVC";
                
            $categoria = htmlspecialchars($row['categoria'] ?? 'Geral');
            $link = "/blog-mvc/post/exibir/" . $row['id'];
            $visualizacoes = (int)$row['visualizacao'];
        ?>
        
        <div class="col-md-6 col-lg-4">
            <article class="card post-card">
                <a href="<?= $link ?>" class="img-wrapper">
                    <span class="category-badge"><?= $categoria ?></span>
                    <img src="<?= $imagem ?>" alt="<?= $titulo ?>">
                </a>

                <div class="card-body">
                    <h2 class="h5 card-title">
                        <a href="<?= $link ?>" class="text-decoration-none text-dark stretched-link">
                            <?= $titulo ?>
                        </a>
                    </h2>

                    <p class="card-text">
                        <?= $conteudo ?>
                    </p>

                    <div class="card-footer-custom">
                        <div class="d-flex align-items-center gap-2 text-dark">
                            <i class="bi bi-calendar3"></i>
                            <small><?= $postado_em ?></small>
                            <small class="ms-3 text-dark"><i class="bi bi-eye"></i> <?= $visualizacoes ?> </small>
                        </div>
                        <span class="read-more-btn">
                            Ler mais <i class="bi bi-arrow-right ms-1"></i>
                        </span>
                    </div>
                </div>
            </article>
        </div>
        
        <?php } ?>
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Navegação">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
            </ul>
        </nav>
    </div>

    <?php endif; ?>
</main>

<footer class="py-5 text-center text-md-start">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="text-white mb-3">Blog MVC</h5>
                <p class="small text-secondary">
                    Desenvolvido com paixão para compartilhar conhecimento. 
                    <br>Codificado por <strong>Uhalace</strong>.
                </p>
            </div>
            <div class="col-md-4 mb-4 mb-md-0 text-center">
                <h6 class="text-uppercase mb-3 font-weight-bold text-white">Redes</h6>
                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle m-1"><i class="bi bi-github"></i></a>
                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle m-1"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle m-1"><i class="bi bi-twitter"></i></a>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <small class="d-block text-secondary mb-2">&copy; <?= date('Y') ?> Todos os direitos reservados.</small>
                <a href="#" class="text-secondary small text-decoration-none me-2">Privacidade</a>
                <a href="#" class="text-secondary small text-decoration-none">Termos</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>