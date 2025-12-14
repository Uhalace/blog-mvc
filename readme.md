# Como criar um blog simples no padrão MVC, básico para iniciantes
1. Este progeto usa o modelo MVC (Model, View e Controller, sem frimework)
2. Será um modelo de blog simples, e poderar ser aprimorado por qualquer um
3. O objetico desse projeto é para estudos e não para fins comerciais, porém caso creia usar para tal modo é de sua total responsabilidade.
4. O nível de segurança é baixo pois está usando o MD5 para criptogravia, essa hash está em desuso atualmente.
5. O projeto usará HTML, CSS, JS e PHPOO
* O projeto simula um frimework
# As configurações básicas do sistema esta na pasta core:
* Conteúdo da pasta core:

1. Controller padrao
2. Router (Aquivo de rotas)
3. Database onde esta a confguração do banco

# ATUALMENTE É RECOMENTADO USAR ARQUIVOS .env, o .env deve estar fora da raiz do projeto

* Nova atualização no banco
1. Adição do campo image no banco
ALTER TABLE `posts` ADD `image` VARCHAR(250) NOT NULL AFTER `titulo`;

# Agora temos os segintes campos
	1	id Primária	int(11)			Não	Nenhum		AUTO_INCREMENT	
	2	titulo	varchar(255)	utf8mb4_general_ci		Não	Nenhum			
	3	image	varchar(250)	utf8mb4_general_ci		Não	Nenhum			
	4	conteudo	text	utf8mb4_general_ci		Não	Nenhum		
	5	criado_em	datetime			Sim	current_timestamp()			
	6	atualizado_em	datetime		Sim	current_timestamp()		ON UPDATE CURRENT_TIMESTAMP()

# Usaremos a constante global para não precisarmos usar ../ para ir entre pontos no diretório
define('BASE_URL', '/blog-mvc/public');
define('APP_URL',  '/blog-mvc/app');

1. Para acessar basta chamar assim 
* <?= BASE_URL ?>/
<?= APP_URL ?>
