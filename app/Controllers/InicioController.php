<?php
// Chamando o controlador principal Controller do diretório core
require_once __DIR__ . "/../../core/Controller.php";
require_once __DIR__ . "/../../core/Database.php";

/*
 * InicioController
 * -----------------
 * Controla a página inicial do site.
 * Quando o usuário entra no projeto,
 * este controller é chamado primeiro.
 */

class InicioController extends Controller {
    

    public function index() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $result = $db->query($sql);

        if ($result === false) {
            die("Erro na consulta: " . $db->error);
}
        // Carrega a view: /app/Views/inicio/index.php
        $this->view("inicio/index", [
            "result" => $result
        ]);
    }
}
