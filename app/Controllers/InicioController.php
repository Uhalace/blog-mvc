<?php
// Chamando o controlador principal Controller do diretório core
require_once __DIR__ . "/../../core/Controller.php";

/*
 * InicioController
 * -----------------
 * Controla a página inicial do site.
 * Quando o usuário entra no projeto,
 * este controller é chamado primeiro.
 */

class InicioController extends Controller {

    public function index() {
        // Carrega a view: /app/Views/inicio/index.php
        $this->view("inicio/index");
    }
}
