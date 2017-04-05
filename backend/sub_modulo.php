<!DOCTYPE html>
<html>
  <head>

    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../css/main.css">
    <script type="text/javascript" src="../js/script.js" ></script>
  </head>
  <body>

    <div class="container">
      <nav class="lateral" id="lateral">
        <img class="logo" src="../img/logos/index.png">
        <main class="main main-lateral">
          <a href="#" Class="anchor" id="modulo_1" onclick="mostrar()" >+ Módulo</a>
          <ul class="submodulo" id="submodulo_1">
            <li class="lista" ><a href="#" Class="anchor a-link">Sub Módulo</a></li>
            <li class="lista" ><a href="#" Class="anchor a-link">Sub Módulo</a></li>
            <li class="lista" ><a href="#" Class="anchor a-link">Sub Módulo</a></li>
            <li class="lista" ><a href="#" Class="anchor a-link">Sub Módulo</a></li>
          </ul>
          <a href="#" Class="anchor" id="modulo_2" >+ Módulo</a>
          <a href="#" Class="anchor" id="modulo_3" >+ Módulo</a>
        </main>
        <a href="#" id="user" class="nav_user">Usuário</a>
        <a href="#" class="nav_user">Deslogar</a>
        <div id="hora"></div>
      </nav>

      <div class="main">

        <div class="cabecalho">
          <header>
            <img src="../img/icons/botao_menu.png" id="btn_slide" onclick="mostrarMenu()" >
            <img src="../img/icons/opcoes.png" id="btn_slide-down" onclick="mostrarConfig()" class="button">
          </header>
          <div class="config cabecalho-group" id="config">
            <a href="#" class="anchor a-link"><img src="../img/icons/imprimir.png" class="image" alt="..."></a>
            <a href="#" class="anchor a-link"><img src="../img/icons/editar.png" class="image" alt="..."></a>
            <a href="#" class="anchor a-link"><img src="../img/icons/salvar.png" class="image" alt="..."></a>
          </div>
          <div class="group-image cabecalho-group" >
            <h1 class="tit-sub-modulo titulo">
              <img class="img-titulo" src="../img/avatars/triagem.png" alt="">
            </h1>
            <label class="tit-sub-modulo titulo" id="lbl_triagem">Triagem</label>
          </div>
        </div>

        <div class="centro-modulo conteudoCentro">
          <div class="main">
            <main class="main main-centro">

            </main>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>