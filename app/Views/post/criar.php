<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/bootstrap.min.css">
    <script src="<?= BASE_URL ?>/public/js/tinynce/tinymce.min.js"></script>

    <title>Publicar Notícia</title>
    <style>
      .tox-statusbar__path{
  visibility:hidden !important;
}
.tox-statusbar{
  visibility:hidden !important;
}
.tox-notifications-container {
visibility:hidden !important;
Z-index:-9999 !important;
}

    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Criar Nova Notícia</h4>
                    </div>
                    
                    <div class="card-body p-4">

                        <?php if (!empty($mensagem)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $mensagem ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                            <!-- PARA FAZER UPLOAD DE IMAGENS, ADICIONAR O ATRIBUTO enctype="multipart/form-data" NO FORM -->
                        <form action="/blog-mvc/public/post/salvar" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 justify-content-center text-center">
                                <label for="imagem" class="form-label fw-bold">Pré-visualização da Imagem</label><br>
                                <img  id="preview-img" src="../../public/images/placeholder.png" alt="Pré-visualização da Imagem" class="img-fluid mb-2" style="max-height: 300px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-bold">Título</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Digite o título da notícia" required>
                            </div>
                            <div class="mb-3">
                                <label for="imagem" class="form-label fw-bold">Imagem</label><br>
                                <label for="imagem" class="form-label" id="label-img">Selecione uma imagem para a notícia (opcional):</label>
                                <input style="display: none;" type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="conteudo" class="form-label fw-bold">Conteúdo</label>
                                <textarea class="form-control" name="conteudo" id="full-featured-non-premium"  placeholder="Escreva o conteúdo aqui..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Salvar Publicação
                                </button>
                                <a href="/blog-mvc/" class="btn btn-outline-secondary">Inicio</a>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="text-center mt-3 text-muted">
                    <small>Sistema de Blog MVC</small>
                </div>

            </div>
        </div>
    </div>
    <script>
  tinymce.init({
  selector: 'textarea#full-featured-non-premium',
   language_url : 'js/plugin/linguagem.js', // caminho do arquivo de tradução
    language: 'pt_BR', // define o idioma
  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: '//www.tiny.cloud/css/codepen.min.css',
  link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 520,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
 });

//tinyMCE em portugues
tinymce.addI18n("pt_PT",{"#":"#","Accessibility":"Acessibilidade","Accordion":"Acorde\xe3o","Accordion body...":"Corpo do acorde\xe3o...","Accordion summary...":"Resumo do acorde\xe3o...","Action":"A\xe7\xe3o","Activity":"Atividades","Address":"Endere\xe7o","Advanced":"Avan\xe7ado","Align":"Alinhar","Align center":"Alinhar ao centro","Align left":"Alinhar \xe0 esquerda","Align right":"Alinhar \xe0 direita","Alignment":"Alinhamento","Alignment {0}":"Alinhamento {0}","All":"Tudo","Alternative description":"Descri\xe7\xe3o alternativa","Alternative source":"Origem alternativa","Alternative source URL":"URL da origem alternativa","Anchor":"\xc2ncora","Anchor...":"\xc2ncora...","Anchors":"\xc2ncoras","Animals and Nature":"Animais e natureza","Arrows":"Setas","B":"B","Background color":"Cor de fundo","Background color {0}":"Cor do fundo {0}","Black":"Preto","Block":"Bloco","Block {0}":"Bloco {0}","Blockquote":"Cita\xe7\xe3o em bloco","Blocks":"Blocos","Blue":"Azul","Blue component":"Componente azul(Blue)","Body":"Corpo","Bold":"Negrito","Border":"Contorno","Border color":"Cor do contorno","Border style":"Estilo do contorno","Border width":"Largura do contorno","Bottom":"Inferior","Browse files":"Navegar em ficheiros","Browse for an image":"Navegar por uma imagem","Browse links":"Navegar hiperliga\xe7\xf5es","Bullet list":"Lista com marcas","Cancel":"Cancelar","Caption":"Legenda","Cell":"C\xe9lula","Cell padding":"Preenchimento da c\xe9lula","Cell properties":"Propriedades da c\xe9lula","Cell spacing":"Espa\xe7amento entre c\xe9lulas","Cell styles":"Estilo de c\xe9lulas","Cell type":"Tipo de c\xe9lula","Center":"Centro","Characters":"Caracteres","Characters (no spaces)":"Caracteres (sem espa\xe7os)","Circle":"C\xedrculo","Class":"Classe","Clear formatting":"Limpar formata\xe7\xe3o","Close":"Fechar","Code":"C\xf3digo","Code sample...":"Amostra de c\xf3digo...","Code view":"Vista do c\xf3digo-fonte","Color Picker":"Seletor de cores","Color swatch":"Cole\xe7\xe3o de cores","Cols":"Colunas","Column":"Coluna","Column clipboard actions":"A\xe7\xf5es da coluna da \xe1rea de transfer\xeancia","Column group":"Grupo de colunas","Column header":"Cabe\xe7alho de coluna","Constrain proportions":"Manter propor\xe7\xf5es","Copy":"Copiar","Copy column":"Copiar coluna","Copy row":"Copiar linha","Could not find the specified string.":"N\xe3o foi poss\xedvel localizar a cadeia de caracteres especificada.","Could not load emojis":"N\xe3o conseguiu carregar os emojis","Count":"Contagem","Currency":"Moeda","Current window":"Janela atual","Custom color":"Cor personalizada","Custom...":"Personalizado...","Cut":"Cortar","Cut column":"Cortar coluna","Cut row":"Cortar linha","Dark Blue":"Azul escuro","Dark Gray":"Cinzento escuro","Dark Green":"Verde escuro","Dark Orange":"Laranja escuro","Dark Purple":"P\xfarpura escuro","Dark Red":"Vermelho escuro","Dark Turquoise":"Turquesa escuro","Dark Yellow":"Amarelo escuro","Dashed":"Tracejada","Date/time":"Data/hora","Decrease indent":"Diminuir avan\xe7o","Default":"Predefini\xe7\xe3o","Delete accordion":"Eliminar acorde\xe3o","Delete column":"Eliminar coluna","Delete row":"Eliminar linha","Delete table":"Eliminar tabela","Dimensions":"Dimens\xf5es","Disc":"Disco","Div":"Div","Document":"Documento","Dotted":"Ponteada","Double":"Duplo","Drop an image here":"Largar aqui uma imagem","Dropped file type is not supported":"O tipo de ficheiro largado n\xe3o \xe9 suportado","Edit":"Editar","Embed":"Incorporar","Emojis":"Emojis","Emojis...":"Emojis...","Error":"Erro","Error: Form submit field collision.":"Erro: conflito no campo de submiss\xe3o de formul\xe1rio.","Error: No form element found.":"Erro: nenhum elemento de formul\xe1rio encontrado.","Extended Latin":"Latino estendido","Failed to initialize plugin: {0}":"Falha ao inicializar o plugin: {0}","Failed to load plugin url: {0}":"Falha ao carregar o URL do plugin: {0}","Failed to load plugin: {0} from url {1}":"Falha ao carregar o plugin: {0} do URL {1}","Failed to upload image: {0}":"Falha ao carregar a imagem: {0}","File":"Ficheiro","Find":"Localizar","Find (if searchreplace plugin activated)":"Pesquisar (se o plugin localizar e substituir estiver ativado)","Find and Replace":"Pesquisar e substituir","Find and replace...":"Localizar e substituir...","Find in selection":"Pesquisar na sele\xe7\xe3o","Find whole words only":"Localizar apenas palavras inteiras","Flags":"Bandeiras","Focus to contextual toolbar":"Foco na barra de ferramentas contextual","Focus to element path":"Foco no caminho do elemento","Focus to menubar":"Foco na barra de menu","Focus to toolbar":"Foco na barra de ferramentas","Font":"Tipo de letra","Font size {0}":"Tamanho da letra {0}","Font sizes":"Tamanhos de letra","Font {0}":"Tipo de letra {0}","Fonts":"Tipos de letra","Food and Drink":"Comida e bebida","Footer":"Rodap\xe9","Format":"Formatar","Format {0}":"Formato {0}","Formats":"Formatos","Fullscreen":"Ecr\xe3 inteiro","G":"G","General":"Geral","Gray":"Cinzento","Green":"Verde","Green component":"Componente verde(Green)","Groove":"Entalhado","Handy Shortcuts":"Atalhos \xfateis","Header":"Cabe\xe7alho","Header cell":"C\xe9lula de cabe\xe7alho","Heading 1":"T\xedtulo 1","Heading 2":"T\xedtulo 2","Heading 3":"T\xedtulo 3","Heading 4":"T\xedtulo 4","Heading 5":"T\xedtulo 5","Heading 6":"T\xedtulo 6","Headings":"T\xedtulos","Height":"Altura","Help":"Ajuda","Hex color code":"C\xf3digo de cor hexad\xe9cimal","Hidden":"Escondido","Horizontal align":"Alinhamento horizontal","Horizontal line":"Linha horizontal","Horizontal space":"Espa\xe7o horizontal","ID":"ID","ID should start with a letter, followed only by letters, numbers, dashes, dots, colons or underscores.":"O ID deve come\xe7ar com uma letra, seguido apenas por letras, n\xfameros, tra\xe7os, pontos, dois pontos ou sobtra\xe7os.","Image is decorative":"Imagem \xe9 decorativa","Image list":"Lista de imagens","Image title":"T\xedtulo da imagem","Image...":"Imagem...","ImageProxy HTTP error: Could not find Image Proxy":"Erro de ImageProxy HTTP: Proxy de Imagem n\xe3o encontrado","ImageProxy HTTP error: Incorrect Image Proxy URL":"Erro de ImageProxy HTTP: URL do Proxy de Imagem incorreto","ImageProxy HTTP error: Rejected request":"Erro de ImageProxy HTTP: Pedido regeitado","ImageProxy HTTP error: Unknown ImageProxy error":"Erro de ImageProxy HTTP: Erro de Proxy de Imagem desconhecido","Increase indent":"Aumentar avan\xe7o","Inline":"Na linha","Insert":"Inserir","Insert Template":"Inserir modelo","Insert accordion":"Inserir acorde\xe3o","Insert column after":"Inserir coluna depois","Insert column before":"Inserir coluna antes","Insert date/time":"Inserir data/hora","Insert image":"Inserir imagem","Insert link (if link plugin activated)":"Inserir hiperliga\xe7\xe3o (se o plugin de liga\xe7\xf5es estiver ativado)","Insert row after":"Inserir linha depois","Insert row before":"Inserir linha antes","Insert table":"Inserir tabela","Insert template...":"Inserir modelo...","Insert video":"Inserir v\xeddeo","Insert/Edit code sample":"Inserir/editar amostra de c\xf3digo","Insert/edit image":"Inserir/editar imagem","Insert/edit link":"Inserir/editar liga\xe7\xe3o","Insert/edit media":"Inserir/editar media","Insert/edit video":"Inserir/editar v\xeddeo","Inset":"Inserido","Invalid hex color code: {0}":"C\xf3digo de cor hexad\xe9cimal inv\xe1lido: {0}","Invalid input":"Entrada inv\xe1lida","Italic":"It\xe1lico","Justify":"Justificar","Keyboard Navigation":"Navega\xe7\xe3o com teclado","Language":"Idioma","Learn more...":"Saiba mais...","Left":"Esquerda","Left to right":"Da esquerda para a direita","Light Blue":"Azul claro","Light Gray":"Cinzento claro","Light Green":"Verde claro","Light Purple":"P\xfarpura claro","Light Red":"Vermelho claro","Light Yellow":"Amarelo claro","Line height":"Altura da linha","Link list":"Lista de liga\xe7\xf5es","Link...":"Liga\xe7\xe3o...","List Properties":"Propriedades da lista","List properties...":"Propriedades da lista\u2026","Loading emojis...":"A carregar emojis...","Loading...":"A carregar...","Lower Alpha":"Latino em min\xfasculas","Lower Greek":"Grego em min\xfasculas","Lower Roman":"Romano em min\xfasculas","Match case":"Diferenciar mai\xfasculas/min\xfasculas","Mathematical":"Matem\xe1tico","Media poster (Image URL)":"Publicador de media (URL da imagem)","Media...":"Media...","Medium Blue":"Azul interm\xe9dio","Medium Gray":"Cinzento m\xe9dio","Medium Purple":"P\xfarpura interm\xe9dio","Merge cells":"Fundir c\xe9lulas","Middle":"Meio","Midnight Blue":"Azul muito escuro","More...":"Mais...","Name":"Nome","Navy Blue":"Azul-atl\xe2ntico","New document":"Novo documento","New window":"Nova janela","Next":"Seguinte","No":"N\xe3o","No alignment":"Sem alinhamento","No color":"Sem cor","Nonbreaking space":"Espa\xe7o n\xe3o separ\xe1vel","None":"Nenhum","Numbered list":"Lista numerada","OR":"OU","Objects":"Objetos","Ok":"Ok","Open help dialog":"Abrir caixa de di\xe1logo Ajuda","Open link":"Abrir liga\xe7\xe3o","Open link in...":"Abrir liga\xe7\xe3o em...","Open popup menu for split buttons":"Abrir o menu popup para bot\xf5es divididos","Orange":"Laranja","Outset":"Extra\xeddo","Page break":"Quebra de p\xe1gina","Paragraph":"Par\xe1grafo","Paste":"Colar","Paste as text":"Colar como texto","Paste column after":"Colar coluna depois","Paste column before":"Colar coluna antes","Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off.":"O comando colar est\xe1 em modo de texto simples. O conte\xfado ser\xe1 colado como texto simples at\xe9 desativar esta op\xe7\xe3o.","Paste or type a link":"Copiar ou escrever uma hiperliga\xe7\xe3o","Paste row after":"Colar linha depois","Paste row before":"Colar linha antes","Paste your embed code below:":"Insira, abaixo, o seu c\xf3digo de incorpora\xe7\xe3o:","People":"Pessoas","Plugins":"Plugins","Plugins installed ({0}):":"Plugins instalados ({0}):","Powered by {0}":"Com tecnologia {0}","Pre":"Pre","Preferences":"Prefer\xeancias","Preformatted":"Pr\xe9-formatado","Premium plugins:":"Plugins comerciais:","Press the Up and Down arrow keys to resize the editor.":"Prima as teclas de seta (Para cima e Para baixo) para redimensionar o editor.","Press the arrow keys to resize the editor.":"Prima as teclas de seta para redimensionar o editor.","Press {0} for help":"Prima {0} para obter ajuda","Preview":"Pr\xe9-visualizar","Previous":"Anterior","Print":"Imprimir","Print...":"Imprimir...","Purple":"P\xfarpura","Quotations":"Aspas","R":"R","Range 0 to 255":"Intervalo de 0 a 255","Red":"Vermelho","Red component":"Componente vermelho(Red)","Redo":"Refazer","Remove":"Remover","Remove color":"Remover cor","Remove link":"Remover liga\xe7\xe3o","Replace":"Substituir","Replace all":"Substituir tudo","Replace with":"Substituir por","Resize":"Redimensionar","Restore last draft":"Restaurar o \xfaltimo rascunho","Reveal or hide additional toolbar items":"Mostrar ou esconder itens adicionais da barra de ferramentas","Rich Text Area":"\xc1rea de Rich Text","Rich Text Area. Press ALT-0 for help.":"\xc1rea de texto formatado. Prima ALT-0 para exibir a ajuda.","Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help":"\xc1rea de texto formatado. Prima ALT-F9 para exibir o menu. Prima ALT-F10 para exibir a barra de ferramentas. Prima ALT-0 para exibir a ajuda","Ridge":"Crista","Right":"Direita","Right to left":"Da direita para a esquerda","Row":"Linha","Row clipboard actions":"A\xe7\xf5es da linha da \xe1rea de transfer\xeancia","Row group":"Grupo de linhas","Row header":"Cabe\xe7alho de linha","Row properties":"Propriedades da linha","Row type":"Tipo de linha","Rows":"Linhas","Save":"Guardar","Save (if save plugin activated)":"Guardar (se o plugin de guardar estiver ativado)","Scope":"\xc2mbito","Search":"Pesquisar","Select all":"Selecionar tudo","Select...":"Selecionar...","Selection":"Sele\xe7\xe3o","Shortcut":"Atalho","Show blocks":"Mostrar blocos","Show caption":"Mostrar legenda","Show invisible characters":"Mostrar carateres invis\xedveis","Size":"Tamanho","Solid":"S\xf3lida","Source":"Origem","Source code":"C\xf3digo fonte","Special Character":"Car\xe1cter especial","Special character...":"Car\xe1cter especial...","Split cell":"Dividir c\xe9lula","Square":"Quadrado","Start list at number":"Come\xe7ar a lista pelo n\xfamero","Strikethrough":"Rasurado","Style":"Estilo","Subscript":"Inferior \xe0 linha","Superscript":"Superior \xe0 linha","Switch to or from fullscreen mode":"Entrar ou sair do modo de ecr\xe3 inteiro","Symbols":"S\xedmbolos","System Font":"Tipo de letra do sistema","Table":"Tabela","Table caption":"Legenda da tabela","Table properties":"Propriedades da tabela","Table styles":"Estilos de tabelas ","Template":"Modelo","Templates":"Modelos","Text":"Texto","Text color":"Cor do texto","Text color {0}":"Cor do texto {0}","Text to display":"Texto a mostrar","The URL you entered seems to be an email address. Do you want to add the required mailto: prefix?":"O URL que indicou parece ser um endere\xe7o de email. Quer adicionar o prefixo mailto: tal como necess\xe1rio?","The URL you entered seems to be an external link. Do you want to add the required http:// prefix?":"O URL que indicou parece ser uma liga\xe7\xe3o externa. Deseja adicionar o prefixo http:// necess\xe1rio?","The URL you entered seems to be an external link. Do you want to add the required https:// prefix?":"O URL que introduziu parece ser uma liga\xe7\xe3o externa. Deseja adicionar-lhe o prefixo https:// ?","Title":"T\xedtulo","To open the popup, press Shift+Enter":"Para abrir o pop-up, prima Shift+Enter","Toggle accordion":"Ativar/desativar acorde\xe3o","Tools":"Ferramentas","Top":"Superior","Travel and Places":"Viagens e lugares","Turquoise":"Turquesa","Underline":"Sublinhado","Undo":"Desfazer","Upload":"Carregar","Uploading image":"A carregar imagem","Upper Alpha":"Latino em mai\xfasculas","Upper Roman":"Romano em mai\xfasculas","Url":"URL","User Defined":"Definido pelo utilizador","Valid":"V\xe1lido","Version":"Vers\xe3o","Vertical align":"Alinhamento vertical","Vertical space":"Espa\xe7o vertical","View":"Ver","Visual aids":"Ajuda visual","Warn":"Aviso","White":"Branco","Width":"Largura","Word count":"Contagem de palavras","Words":"Palavras","Words: {0}":"Palavras: {0}","Yellow":"Amarelo","Yes":"Sim","You are using {0}":"Est\xe1 a usar {0}","You have unsaved changes are you sure you want to navigate away?":"Existem altera\xe7\xf5es que ainda n\xe3o foram guardadas. Tem a certeza que pretende sair?","Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X/C/V keyboard shortcuts instead.":"O seu navegador n\xe3o suporta acesso direto \xe0 \xe1rea de transfer\xeancia. Por favor, use os atalhos Ctrl+X/C/V do seu teclado.","alignment":"alinhamento","austral sign":"Austral - s\xedmbolo de moeda","cedi sign":"Cedi - s\xedmbolo de moeda","colon sign":"sinal de dois pontos","cruzeiro sign":"Cruzeiro - s\xedmbolo de moeda","currency sign":"s\xedmbolo de moeda","dollar sign":"D\xf3lar - s\xedmbolo de moeda","dong sign":"Dong - s\xedmbolo de moeda","drachma sign":"Dracma - s\xedmbolo de moeda","euro-currency sign":"Euro - s\xedmbolo de moeda","example":"exemplo","formatting":"formata\xe7\xe3o","french franc sign":"Franco franc\xeas - s\xedmbolo de moeda","german penny symbol":"Penny alem\xe3o - s\xedmbolo de moeda","guarani sign":"Guarani - s\xedmbolo de moeda","history":"hist\xf3rico","hryvnia sign":"Gr\xedvnia - s\xedmbolo de moeda","indentation":"indenta\xe7\xe3o","indian rupee sign":"Rupia indiana - s\xedmbolo de moeda","kip sign":"Kip - s\xedmbolo de moeda","lira sign":"Lira - s\xedmbolo de moeda","livre tournois sign":"Libra de Tours - s\xedmbolo de moeda","manat sign":"Manat - s\xedmbolo de moeda","mill sign":"sinal de por mil","naira sign":"Naira - s\xedmbolo de moeda","new sheqel sign":"Shekel - s\xedmbolo de moeda","nordic mark sign":"Markka n\xf3rdica - s\xedmbolo de moeda","peseta sign":"Peseta - s\xedmbolo de moeda","peso sign":"Peso - s\xedmbolo de moeda","ruble sign":"Rublo - s\xedmbolo de moeda","rupee sign":"R\xfapia - s\xedmbolo de moeda","spesmilo sign":"Spesmilo - s\xedmbolo de moeda","styles":"estilos","tenge sign":"Tengue - s\xedmbolo de moeda","tugrik sign":"Tugrik - s\xedmbolo de moeda","turkish lira sign":"Lira turca - s\xedmbolo de moeda","won sign":"Won - s\xedmbolo de moeda","yen character":"Iene - s\xedmbolo de moeda","yen/yuan character variant one":"Iene/Iuane - variante do s\xedmbolo de moeda","yuan character":"Iuane - s\xedmbolo de moeda","yuan character, in hong kong and taiwan":"Iuane, em Hong Kong e Rep\xfablica da China - s\xedmbolo de moeda","{0} characters":"{0} caracteres","{0} columns, {1} rows":"{0} colunas, {1} linhas","{0} words":"{0} palavras"}); 
   
      
</script>

    
    <script src="<?= BASE_URL ?>/public/js/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="<?= BASE_URL ?>/public/js/popper/popper.min.js"></script>
    <script src="<?= BASE_URL ?>/public/js/bootstrap/bootstrap.min.js"></script>
    <script src="../../public/js/validate.image.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>