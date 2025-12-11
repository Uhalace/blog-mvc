<?php

class Router {

    public function run() {

        // URL, chama inicio/index
        $url = $_GET['url'] ?? "inicio/index";

        // separa em partes
        $url = explode("/", $url);

        // Controller
        $controllerName = ucfirst($url[0]) . "Controller";

        // Método (ação)
        $method = $url[1] ?? "index";

        // Parâmetros extras
        $params = array_slice($url, 2);

        // Carregar controller
        $controllerPath = "../app/Controllers/$controllerName.php";

        if (!file_exists($controllerPath)) {
            die("Controller não encontrado: $controllerName");
        }

        require $controllerPath;

        // Instanciar controller
        $controller = new $controllerName();

        // Verificar método
        if (!method_exists($controller, $method)) {
            die("Método não encontrado: $method");
        }

        // Chamar método com parâmetros
        call_user_func_array([$controller, $method], $params);
    }
}
