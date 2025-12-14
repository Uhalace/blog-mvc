//ARQUIVO DE VALIDAÇÃO DO UPLOAD DE IMAGENS
/*
@AUTOR: UHALACE DE S SANTOS
@DATA: 24/06/2024
@DESCRIÇÃO: ESTE ARQUIVO CONTÉM O CÓDIGO RESPONSÁVEL PELA VALIDAÇÃO DO UPLOAD DE IMAGENS NO FORMULÁRIO DE CRIAÇÃO DE NOTÍCIAS.
@VERSÃO: 1.0
@ARQIVOS QUE ELE É STATICAMENTE INCLUÍDO: criar.php
@CAMPOS RELACIONASDOS AO UPLOAD DE IMAGENS: imagem e label-img
*/

// Seleciona o input de arquivo pelo id "imagem"
const imagemInput = document.getElementById('imagem');

// Seleciona o elemento label onde será exibida a mensagem ao usuário
const labelImagem = document.getElementById('label-img');

// Seleciona o elemento img que será usado para pré-visualizar a imagem
const previewImg = document.getElementById('preview-img');

// Função para pré-visualizar a imagem selecionada
imagemInput.addEventListener('change', () => {
    // Evento disparado sempre que o usuário seleciona ou remove um arquivo

    if (imagemInput.files.length > 0) {
        // Verifica se existe pelo menos um arquivo selecionado

        labelImagem.style.color = 'green';
        // Altera a cor do texto do label para verde

        labelImagem.textContent = 'Imagem selecionada com sucesso!';
        // Atualiza o texto do label informando sucesso na seleção

        const reader = new FileReader();
        // Cria um objeto FileReader para ler o conteúdo do arquivo

        reader.onload = e => {
            // Função executada quando a leitura do arquivo for concluída

            previewImg.src = e.target.result;
            // Define a imagem de pré-visualização usando o conteúdo lido (base64)
        };

        reader.readAsDataURL(imagemInput.files[0]);
        // Lê o arquivo selecionado e converte para uma URL base64
    } else {
        // Caso nenhum arquivo esteja selecionado

        labelImagem.style.color = 'red';
        // Altera a cor do texto do label para vermelho

        labelImagem.textContent = 'Nenhuma imagem selecionada. Por favor, selecione uma imagem.';
        // Exibe uma mensagem de erro para o usuário
    }
});
