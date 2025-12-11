<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area restrita</title>
    <link rel="stylesheet" href="../../public/css/login.css">
</head>

<body>
    <div class="container">
        <div class="former">
            <div class="header">
                <h2>Login</h2>
            </div>
            <div class="section-body">
                <form action="/blog-mvc/public/user/autenticar" method="POST">
                    <div class="form-item">
                    <label>Email:</label><br>
                    <input type="email" name="email" required>
                    </div>

                    <div class="form-item">
                    <label>Senha:</label><br>
                    <input type="password" name="senha" required>
                    </div>

                    <div class="form-item">
                    <button type="submit" class="btn">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>