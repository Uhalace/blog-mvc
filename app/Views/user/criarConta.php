<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Captura e limpa a mensagem de erro se existir
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Blog MVC</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        /* Efeito de hover sutil no card */
        .auth-card:hover {
            transform: translateY(-5px);
        }

        .card-header-custom {
            background-color: #fff;
            padding: 40px 40px 20px;
            text-align: center;
            border-bottom: none;
        }

        .card-body-custom {
            padding: 20px 40px 40px;
        }

        .btn-primary {
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            background-color: #0d6efd;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .form-floating > .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .form-floating > .form-control:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border-color: #86b7fe;
        }

        .login-link {
            text-decoration: none;
            color: #0d6efd;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="card-header-custom">
            <div class="mb-3 text-primary">
                <i class="bi bi-person-plus-fill" style="font-size: 3rem;"></i>
            </div>
            <h2 class="fw-bold text-dark">Criar Conta</h2>
            <p class="text-muted">Preencha seus dados para começar.</p>
        </div>

        <div class="card-body-custom">
            
            <?php if ($erro): ?>
                <div class="alert alert-danger d-flex align-items-center fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?= htmlspecialchars($erro) ?></div>
                </div>
            <?php endif; ?>

            <form method="POST" action="/blog-mvc/public/user/salvar" class="needs-validation" novalidate oninput='senha_confirma.setCustomValidity(senha_confirma.value != senha.value ? "Senhas não conferem" : "")'>
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" required>
                    <label for="nome"><i class="bi bi-person me-1"></i> Nome Completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                    <label for="email"><i class="bi bi-envelope me-1"></i> E-mail</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required minlength="6">
                    <label for="senha"><i class="bi bi-lock me-1"></i> Senha</label>
                </div>
                
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="senha_confirma" name="senha_confirma" placeholder="Confirme a Senha" required>
                    <label for="senha_confirma"><i class="bi bi-check2-circle me-1"></i> Confirmar Senha</label>
                    <div class="invalid-feedback">
                        As senhas devem ser iguais.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Cadastrar <i class="bi bi-arrow-right-short"></i>
                </button>

                <div class="text-center">
                    <span class="text-muted small">Já tem uma conta?</span>
                    <a href="/blog-mvc/public/user/login" class="login-link ms-1">Fazer Login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>

</body>
</html>