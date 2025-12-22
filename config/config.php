<?php
define("DB_HOST", "localhost");
define("DB_NAME", "blog");
define("DB_USER", "root");
define("DB_PASS", "");
// Lógica para definir a BASE_URL automaticamente
if (!defined('BASE_URL')) {
    // Verifica se está rodando no servidor embutido (php -S)
    if (php_sapi_name() === 'cli-server') {
        // No servidor embutido, a raiz é direta, pois usamos o router
        define('BASE_URL', ''); 
    } else {
        // No XAMPP (Apache padrão), precisamos indicar a subpasta
        define('BASE_URL', '/blog-mvc');
    }
}
// URL base da aplicação
// define('BASE_URL', '/blog-mvc');
define("BASE_URL_APP", 'localhost');

define('APP_URL',  '/blog-mvc/app');
