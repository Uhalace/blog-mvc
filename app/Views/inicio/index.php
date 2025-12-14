<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog MVC</title>

    <meta name="description" content="Blog MVC com notícias, artigos e atualizações recentes.">
    <meta name="author" content="Blog MVC">

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css">

    <style>
        body {
            padding-top: 72px;
            background-color: #f8f9fa;
        }

        /* Header */
        .navbar-brand {
            font-weight: 600;
            letter-spacing: .5px;
        }

        /* Hero */
        .hero {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }

        .hero h1 {
            font-weight: 300;
        }

        /* Cards */
        .post-card {
            border: none;
            border-radius: 10px;
            transition: all .25s ease;
        }

        .post-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,.08);
        }

        .post-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 210px;
            object-fit: cover;
        }

        .post-card .card-title {
            font-size: 1.05rem;
            font-weight: 600;
        }

        .post-card .card-text {
            font-size: .95rem;
            color: #6c757d;
        }

        /* Footer */
        footer {
            background-color: #212529;
            color: #adb5bd;
        }

        footer a {
            color: #adb5bd;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">BLOG MVC</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notícias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero py-5">
    <div class="container text-center">
        <h1 class="display-6">Últimas Publicações</h1>
        <p class="text-muted mt-2">
            Conteúdo atualizado com informações relevantes e confiáveis.
        </p>
    </div>
</section>

<!-- POSTS -->
<main class="container py-5">
    <div class="row g-4">

        <?php
        while ($row = $result->fetch_assoc()) {
            $postado_em = date('d/m/Y H:i', strtotime($row['criado_em']));
        ?>
        <div class="col-sm-6 col-md-4">
            <div class="card post-card h-100">
                <img src="<?= BASE_URL ?>/imagens/posts/<?= $row['image'] ?>" alt="Imagem do post">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $row['titulo'] ?></h5>

                    <p class="card-text">
                        <?= substr($row['conteudo'], 0, 120) ?>...
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            Ler artigo
                        </a>
                        <small class="text-muted"><?= $postado_em ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</main>

<!-- FOOTER -->
<footer class="py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <small>© <?= date('Y') ?> Blog MVC</small>
        <small>Desenvolvido por Uhalace</small>
    </div>
</footer>

<script src="<?= BASE_URL ?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>
