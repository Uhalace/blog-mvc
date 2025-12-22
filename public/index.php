<?php
require_once __DIR__ . '/../config/config.php';
require __DIR__ . '/../core/Router.php';

$router = new Router();
$router->run();


