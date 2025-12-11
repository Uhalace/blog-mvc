<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita - Login</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; 
        }
        .login-card {
            width: 100%;
            max-width: 400px; 
        }
    </style>
</head>

<body>

    <div class="container login-card">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="mb-0">Área Restrita</h3>
            </div>
            
            <div class="card-body p-4">
                <form action="/blog-mvc/public/user/autenticar" method="POST">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="seu@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label fw-bold">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="********" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                    </div>

                </form>
            </div>
            
            <div class="card-footer text-center py-3">
                <small class="text-muted">Sistema de Blog MVC</small>
            </div>
        </div>
    </div>

    <script src="../../pubic/js/bootstrap.bundle.min.js"></script>
</body>
</html>