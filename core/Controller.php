<?php

class Controller {

    // $view = "inicio/index"
    protected function view($view, $data = []) {
        extract($data);

        // Monta o caminho do arquivo da view
        $caminhoView = __DIR__ . "/../app/Views/{$view}.php";

        if (file_exists($caminhoView)) {
            require $caminhoView;
        } else {
            echo "View não encontrada: {$caminhoView}";
        }
    }
}
