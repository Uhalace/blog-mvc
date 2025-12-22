# Blog MVC em PHP (Projeto para Aprendizado)

Este projeto foi criado com o objetivo de **ensinar os fundamentos do padrão MVC (Model, View e Controller)** utilizando **PHP Orientado a Objetos**, sem o uso de frameworks.

Ele simula o funcionamento básico de um framework MVC, permitindo que iniciantes entendam como a arquitetura funciona internamente.

---

## 🎯 Objetivo do Projeto

- Aprender PHP Orientado a Objetos na prática  
- Entender o padrão MVC sem abstrações externas  
- Compreender o ciclo completo de uma requisição HTTP  
- Trabalhar com rotas, controllers, models, views e middlewares  
- Servir como base para estudos e futuras melhorias  

⚠️ **Este projeto é apenas para fins educacionais.**  
Não é recomendado para uso comercial ou em produção.

---

## 🛠 Tecnologias Utilizadas

- PHP (Orientado a Objetos)
- HTML
- CSS
- JavaScript
- MySQL
- Bootstrap (UI)

---

## 🔐 Aviso Importante sobre Segurança

> O nível de segurança deste projeto foi **significativamente melhorado**, porém **ainda não é adequado para produção**.

### 🔑 Hash de Senhas

O sistema **não utiliza MD5**.

```php
$hash = password_hash($senha, PASSWORD_DEFAULT);
Utiliza algoritmo seguro nativo do PHP

Salt embutido automaticamente

Compatível com futuras versões do PHP

🔍 Verificação de Senha
php
Copiar código
password_verify($senhaDigitada, $hashArmazenado);
🛡 Proteções Implementadas
Hash seguro de senhas

Prepared Statements (SQL Injection)

Sessão regenerada após login

Mensagens genéricas de erro (anti-enumeração)

CSRF Token no formulário de login

Escape de saída contra XSS nas views

⚠️ Limitações Atuais
Não possui rate limit

Não força HTTPS

Sessão ainda simples (sem SameSite/HttpOnly configurado manualmente)

Sem logs de auditoria

Sem testes automatizados

📁 Estrutura do Projeto
graphql
Copiar código
blog-mvc/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Middlewares/
│   └── Views/
│
├── core/
│   ├── Controller.php   # Classe base dos controllers
│   ├── Router.php       # Sistema de rotas (Apache)
│   └── Database.php     # Conexão com MySQL
│
├── public/
│   └── index.php        # Entry-point para Apache/XAMPP
│
├── server.php           # Roteador para PHP Built-in Server
│
├── config/
│   └── config.php
│
└── README.md
🔧 Configurações
Recomenda-se o uso de .env (opcional neste projeto)

Nunca armazene .env dentro da pasta pública

Indicado apenas para ambiente de desenvolvimento```

🌐 Constantes Globais
php
Copiar código
define('BASE_URL', '/');
define('APP_URL',  '/app');
🗄 Banco de Dados
Tabela posts
sql
Copiar código
ALTER TABLE `posts`
ADD `image` VARCHAR(250) NOT NULL AFTER `titulo`;

ALTER TABLE `posts`
ADD `visualizacao` INT NOT NULL DEFAULT 0 AFTER `conteudo`;
Tabela usuarios
sql
Copiar código
ALTER TABLE usuarios 
MODIFY senha VARCHAR(255) NOT NULL;

ALTER TABLE usuarios
ADD ativo TINYINT(1) NOT NULL DEFAULT 1;
▶️ Como Executar o Projeto
1️⃣ Clonar o Repositório
bash
Copiar código
git clone https://github.com/Uhalace/blog-mvc
cd blog-mvc
2️⃣ Configurar o Banco de Dados
Crie o banco MySQL

Ajuste as credenciais em config/config.php

Execute os comandos SQL necessários

3️⃣ Escolha o Método de Execução
🅰️ Opção A — Servidor Embutido do PHP
Utiliza o arquivo server.php para roteamento:

bash
Copiar código
php -S localhost:8080 server.php
Acesse:

arduino
Copiar código
http://localhost:8080
🅱️ Opção B — Apache (XAMPP / WAMP)
Mova o projeto para htdocs

O Apache direciona para public/index.php

O roteamento é tratado por core/Router.php

Acesse:

arduino
Copiar código
http://localhost/blog-mvc/
🚀 Próximos Passos Sugeridos
Implementar .env

Rate limit no login

Middleware de permissões

CSRF global

Validação centralizada

Logs de segurança

Testes automatizados

🕒 Histórico de Alterações
📅 21/12/2025
Adição da coluna visualizacao

Middleware de login

Integração do TinyMCE

📅 22/12/2025
Compatibilidade total com php -S e XAMPP

Separação de roteamento:

server.php → PHP Built-in

core/Router.php → Apache

📄 Licença
Projeto exclusivamente educacional.

O autor não se responsabiliza por usos fora desse contexto.
