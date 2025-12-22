

# 📘 Blog MVC em PHP (Projeto Educacional)

Este projeto foi criado com o objetivo de **ensinar os fundamentos do padrão MVC (Model, View e Controller)** utilizando **PHP Orientado a Objetos**, sem o uso de frameworks pesados. Ele simula o funcionamento básico de um framework, permitindo que iniciantes entendam a arquitetura interna de uma aplicação web.

> ⚠️ **Aviso:** Este projeto é estritamente para **fins educacionais**. Embora possua melhorias de segurança, não é recomendado para uso comercial ou em produção sem auditoria adicional.

---

## 🎯 Objetivos de Aprendizado

* ✅ Aprender PHP Orientado a Objetos na prática.
* ✅ Entender o padrão MVC sem abstrações externas (Frameworkless).
* ✅ Compreender o ciclo completo de uma requisição HTTP.
* ✅ Trabalhar com Roteamento, Controllers, Models, Views e Middlewares.

---

## 🛠 Tecnologias Utilizadas

| Backend | Frontend | Infra/Dados |
| --- | --- | --- |
| PHP (OOP) | HTML5 & CSS3 | MySQL |
| Composer (Opcional) | JavaScript | Apache / PHP Server |
|  | Bootstrap 5 |  |

---

## 📁 Estrutura do Projeto

```graphql
blog-mvc/
├── app/
│   ├── Controllers/   # Lógica da aplicação
│   ├── Models/        # Regras de negócio e acesso ao DB
│   ├── Middlewares/   # Filtros de requisição (Auth, etc)
│   └── Views/         # Templates HTML
│
├── core/
│   ├── Controller.php # Classe base dos controllers
│   ├── Router.php     # Sistema de rotas (Apache)
│   └── Database.php   # Conexão PDO com MySQL
│
├── config/
│   └── config.php     # Credenciais e constantes
│
├── public/
│   └── index.php      # Entry-point (Apache/XAMPP)
│
└── server.php         # Roteador para PHP Built-in Server

```

---

## 🛡 Segurança e Implementações

O nível de segurança foi aprimorado para demonstrar boas práticas modernas.

### 🔑 Autenticação e Senhas

O sistema abandonou o MD5 e utiliza o padrão nativo e seguro do PHP:

* **Hash:** `password_hash($senha, PASSWORD_DEFAULT)` (Bcrypt/Argon2).
* **Verificação:** `password_verify($senhaDigitada, $hashArmazenado)`.
* **Vantagens:** Salt automático e proteção contra Rainbow Tables.

### 🛡 Proteções Ativas

* [x] **Prepared Statements:** Prevenção contra SQL Injection em todas as queries.
* [x] **Regeneração de Sessão:** Prevenção contra *Session Fixation* após login.
* [x] **Mensagens Genéricas:** Erros de login não revelam se o e-mail existe ou não.
* [x] **CSRF Token:** Proteção em formulários críticos.
* [x] **XSS Protection:** Escape de saída nas Views.

---

## ⚙️ Instalação e Configuração

### 1️⃣ Clonar o Repositório

```bash
git clone https://github.com/Uhalace/blog-mvc
cd blog-mvc

```

### 2️⃣ Banco de Dados

Crie um banco de dados MySQL e execute as atualizações necessárias nas tabelas:

```sql
-- Atualização na tabela 'posts'
ALTER TABLE `posts`
ADD `image` VARCHAR(250) NOT NULL AFTER `titulo`,
ADD `visualizacao` INT NOT NULL DEFAULT 0 AFTER `conteudo`;

-- Atualização na tabela 'usuarios'
ALTER TABLE `usuarios`
MODIFY `senha` VARCHAR(255) NOT NULL,
ADD `ativo` TINYINT(1) NOT NULL DEFAULT 1;

```

### 3️⃣ Configuração

Edite o arquivo `config/config.php` (ou crie um `.env` se já implementado) para ajustar as credenciais do banco e a URL base:

```php
define('BASE_URL', 'http://localhost:8080/'); // Ajuste conforme seu ambiente

```

---

## ▶️ Como Executar

Escolha o método de acordo com seu ambiente de desenvolvimento:

### 🅰️ Opção A — Servidor Embutido do PHP (Recomendado)

Utiliza o arquivo `server.php` para tratar o roteamento corretamente.

```bash
php -S localhost:8080 server.php

```

👉 Acesse: `http://localhost:8080`

### 🅱️ Opção B — Apache (XAMPP / WAMP)

Mova a pasta do projeto para dentro de `htdocs` ou `www`. O Apache usará o `public/index.php` e o `core/Router.php`.

👉 Acesse: `http://localhost/blog-mvc/`

---

## 🚀 Roadmap e Melhorias Futuras

* [ ] Implementar suporte a variáveis de ambiente (`.env`).
* [ ] Adicionar Rate Limiting no login (Anti-Brute Force).
* [ ] Middleware de permissões (ACL).
* [ ] Validação de dados centralizada.
* [ ] Logs de auditoria e segurança.

---

## 🕒 Histórico de Alterações (Changelog)

| Data | Alterações |
| --- | --- |
| **22/12/2025** | • Compatibilidade total com `php -S` e XAMPP.<br>
| **21/12/2025** | • Adição de contador de visualizações.<br>
<br>• Separação de roteamento (`server.php` vs `Router.php`). |


<br>• Middleware de Login.<br>

<br>• Integração com editor **TinyMCE**. |

---

## 📄 Licença

Este projeto é **Open Source** para fins de estudo. O autor não se responsabiliza pelo uso indevido do código em ambientes críticos.
