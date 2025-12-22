<?php
/*
@ARQUIVO SERVER.PHP
Este arquivo é usado para rodar a aplicação no servidor embutido do PHP (php -S). Ele intercepta as requisições para arquivos estáticos (CSS, JS, imagens)
e serve esses arquivos diretamente, enquanto todas as outras requisições são encaminhadas para o index.php da aplicação.

*/

// Pega a URL solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//  Monta o caminho real onde o arquivo deveria estar (dentro da pasta public)
$caminhoArquivo = __DIR__ . '/public' . $uri;

// Se for um arquivo existente (CSS, JS, Imagem), nós mesmos o servimos
if ($uri !== '/' && file_exists($caminhoArquivo) && !is_dir($caminhoArquivo)) {
    
    // Descobre o tipo do arquivo (MIME Type) para o navegador entender
    $extensao = strtolower(pathinfo($caminhoArquivo, PATHINFO_EXTENSION));
    
    $mimes = [
        'css'  => 'text/css',
        'js'   => 'text/javascript', // ou application/javascript
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
    ];

    // Se conhecemos a extensão, enviamos o cabeçalho correto
    if (isset($mimes[$extensao])) {
        header("Content-Type: " . $mimes[$extensao]);
    }

    // Lê o arquivo e envia para o navegador
    readfile($caminhoArquivo);
    exit;
}

// Se não for arquivo estático, cria a variável URL e manda para o index.php
$_GET['url'] = ltrim($uri, '/'); 

// Carrega o index da aplicação
require_once __DIR__ . '/public/index.php';