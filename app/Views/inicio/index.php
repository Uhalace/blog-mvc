<?php
require_once __DIR__ . "/../../../core/Database.php";

$db = Database::getInstance()->getConnection();

$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $db->query($sql);

if ($result === false) {
    die("Erro na consulta: " . $db->error);
}

while ($row = $result->fetch_assoc()) {
    echo "<h2>{$row['titulo']}</h2>";
    echo "<p>{$row['conteudo']}</p>";
    echo "<hr>";
}
