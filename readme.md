# Blog MVC em PHP (Projeto para Aprendizado)

Este projeto foi criado com o objetivo de **ensinar os fundamentos do padrão MVC (Model, View e Controller)** utilizando **PHP Orientado a Objetos**, sem o uso de frameworks.

Ele simula o funcionamento básico de um framework MVC, permitindo que iniciantes entendam como a arquitetura funciona internamente.

---

## Objetivo do projeto

- Aprender PHP Orientado a Objetos na prática  
- Entender o padrão MVC sem abstrações externas  
- Compreender o ciclo completo de uma requisição HTTP  
- Trabalhar com rotas, controllers, models e views  
- Servir como base para estudos e futuras melhorias  

⚠️ **Este projeto é apenas para fins educacionais.**  
Não é recomendado para uso comercial ou em produção.

---

## Tecnologias utilizadas

- PHP (Orientado a Objetos)
- HTML
- CSS
- JavaScript
- MySQL

---

## Aviso importante sobre segurança

> O nível de segurança deste projeto é **baixo**.

- O sistema utiliza **MD5** para hash de senhas
- MD5 está **obsoleto** e não deve ser usado em produção
- A escolha foi mantida **apenas para fins didáticos**

Caso este projeto seja utilizado fora do contexto de estudo, **toda a responsabilidade é do usuário**.

---

## Estrutura do projeto

O projeto segue uma estrutura simples baseada no padrão MVC.

blog-mvc/
├── app/
│ ├── controllers/
│ ├── models/
│ └── views/
│
├── core/
│ ├── Controller.php
│ ├── Router.php
│ └── Database.php
│
├── public/
│ └── index.php
│
├── config/
│ └── config.php
│
└── README.md


---

## Pasta `core`

A pasta `core` contém os arquivos principais do mini-framework:

- **Controller**  
  Classe base utilizada por todos os controllers do sistema.

- **Router**  
  Responsável por definir e gerenciar as rotas da aplicação.

- **Database**  
  Responsável pela configuração e conexão com o banco de dados.

---

## Configurações do sistema

As configurações básicas do sistema estão centralizadas.

> Atualmente, é **recomendado utilizar arquivos `.env`** para armazenar configurações sensíveis.

O arquivo `.env` **deve ficar fora da raiz do projeto**, por motivos de segurança.

---

## Banco de dados

O projeto utiliza MySQL.

### Atualização da tabela `posts`

Foi adicionada a coluna `image` para armazenamento do caminho da imagem do post.

```sql
ALTER TABLE `posts`
ADD `image` VARCHAR(250) NOT NULL AFTER `titulo`;

Estrutura atual da tabela posts
Campo	Tipo	Nulo	Extra
id	int(11)	Não	AUTO_INCREMENT (Primary Key)
titulo	varchar(255)	Não	
image	varchar(250)	Não	
conteudo	text	Não	
criado_em	datetime	Sim	DEFAULT current_timestamp()
atualizado_em	datetime	Sim	ON UPDATE current_timestamp()

* Constantes globais

Para evitar o uso excessivo de ../ na navegação entre diretórios, o projeto utiliza constantes globais.

define('BASE_URL', '/blog-mvc/public');
define('APP_URL',  '/blog-mvc/app');

* Utilização

1. Utilize BASE_URL para acessar arquivos públicos. 

2. Utilize APP_URL para acessar arquivos da aplicação

3. Como executar o projeto

4. Clone o repositório

5. Configure o banco de dados MySQL

# Ajuste as credenciais de conexão

1. Aponte o servidor para a pasta public

2. Acesse o projeto pelo navegador

3. Próximos passos sugeridos

# Este projeto pode ser evoluído como exercício:

1. Substituir MD5 por password_hash e password_verify

2. Implementar arquivos .env

3. Melhorar o sistema de rotas

4. Criar camadas de serviço

5. Adicionar validações e filtros de entrada

6. Implementar autenticação mais segura

# Licença

## Este projeto é livre para uso exclusivamente educacional.

## O autor não se responsabiliza por usos fora desse contexto.

* No futuro usaremos assim
'titulo'
'conteudo'
'image'
'autor' 
'data_criacao' 
'categoria' 

* Alteração
ALTER TABLE usuarios 
MODIFY senha VARCHAR(255) NOT NULL;
