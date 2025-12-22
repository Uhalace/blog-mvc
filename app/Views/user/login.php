<?php
/*
@uhalace:
View responsável pela autenticação do usuário
Implementa exibição de erros e proteção CSRF
*/

/*
@uhalace:
Inicia sessão apenas se necessário
*/
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
@uhalace:
Captura mensagem de erro e limpa da sessão
*/
$erro = $_SESSION["erroLogin"] ?? null;
unset($_SESSION['erroLogin']);

/*
@uhalace:
Geração de token CSRF
*/
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Área Restrita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .login-header {
            padding: 40px 30px 10px;
            text-align: center;
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }

        .card-body {
            padding: 30px;
        }

        .password-wrapper .form-control {
            border-right: none;
            border-radius: 8px 0 0 8px;
        }

        .password-wrapper .input-group-text {
            border: 1px solid #dee2e6;
            border-left: none;
            background-color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="login-header">
        <div class="icon-circle">
            <i class="bi bi-shield-lock"></i>
        </div>
        <h3 class="fw-bold text-dark">Área Restrita</h3>
        <p class="text-muted small">Entre com suas credenciais para acessar.</p>
    </div>

    <div class="card-body">

        <?php if ($erro): ?>
            <div class="alert alert-danger d-flex align-items-center small py-2" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <div><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/user/autenticar" method="POST">

            <!--
            @uhalace:
            Token CSRF
            -->
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

            <div class="form-floating mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="seu@email.com" required>
                <label for="email">E-mail</label>
            </div>

            <div class="input-group mb-3 password-wrapper">
                <div class="form-floating flex-grow-1">
                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>
                <span class="input-group-text text-muted" onclick="togglePassword()">
                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                </span>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    Entrar <i class="bi bi-box-arrow-in-right ms-2"></i>
                </button>
            </div>

        </form>
    </div>

    <div class="card-footer bg-white border-0 text-center pb-4">
        <small class="text-muted">Não tem uma conta?</small>
        <a href="<?= BASE_URL ?>/user/criarConta" class="text-primary fw-bold text-decoration-none ms-1">
            Cadastre-se
        </a>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('senha');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }
</script>

</body>
</html>
