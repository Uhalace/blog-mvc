<?php
// URL base da aplicação
define('BASE_URL', '/blog-mvc/public');
define('APP_URL',  '/blog-mvc/app');
require "../core/Router.php";

$router = new Router();
$router->run();
