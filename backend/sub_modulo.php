<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../css/main.css">
  </head>

  <body onload="recebe()">
    <div class="container">
      <nav class="lateral" id="lateral">

        <img class="logo sub-logo" src="../img/logos/index.png">

        <main class="main main-lateral">
          <!-- <a href="#" Class="anchor" id="modulo_1" onclick="mostrar()" >+ Módulo</a>
          <ul class="submodulo" id="submodulo_1">
          <li class="lista" ><a href="#" Class="anchor ">Sub Módulo</a></li>
          <li class="lista" ><a href="#" Class="anchor ">Sub Módulo</a></li>
          <li class="lista" ><a href="#" Class="anchor ">Sub Módulo</a></li>
          <li class="lista" ><a href="#" Class="anchor ">Sub Módulo</a></li>
          </ul> -->

          <a Class="anchor" id="triagem" onclick="mostrarAbas('Triagem', '../backend/triagem.php', 1)" >
            <img src="../img/icons/triagem.png" class="icon-modulo"  alt="">
            <p>Triagem</p>
          </a>

          <a Class="anchor" id="cadastro" onclick="mostrarAbas('Cadastro', '../index.php?acao=cadastro', 2)" >
            <img src="../img/icons/cadastro.png" class="icon-modulo" alt="">
            <p>Cadastro</p>
          </a>

          <a Class="anchor" id="fila" onclick="mostrarAbas('Fila', '../backend/fila.php', 4)" >
            <img src="../img/icons/portaria.png" class="icon-modulo" alt="">
            <p>Portaria</p>
          </a>

          <a Class="anchor" id="consulta" onclick="mostrarAbas('Consultório', '../backend/consulta.php', 5)" >
            <img src="../img/icons/consultorio.png" class="icon-modulo" alt="">
            <p>Consultório</p>
          </a>

          <a Class="anchor" id="geoloc" onclick="mostrarAbas('GeoLoc', '../backend/geolocalizar.html', 6)" >
            <img src="../img/icons/geoloc.png" class="icon-modulo" alt="">
            <p>GeoLoc</p>
          </a>

        <!-- end main -->
        </main>

        <a href="#" id="user" class="nav_user user">Usuário</a>
        <a href="../index.php?acao=logoff" class="nav_user">Deslogar</a>
        <div id="hora" class="hora"></div>

      <!-- end nav -->
      </nav>

      <div class="main">

        <div class="cabecalho sub-cabecalho">
          <header>
            <img src="../img/icons/botao_menu.png" class="btn_slide" id="btn_slide" onclick="mostrarMenu()" >
            <img src="../img/icons/opcoes.png" id="btn_slide-down" onclick="mostrarConfig()" class="button">
          </header>

          <div class="config cabecalho-group" id="config">
            <a href="javascript:window.history.go(-1)" class="anchor"><img src="../img/icons/voltar.png" class="image" alt="..."></a>
            <a href="#" class="anchor "><img src="../img/icons/imprimir.png" class="image" alt="..."></a>
            <a href="#" class="anchor "><img src="../img/icons/editar.png" class="image" alt="..."></a>
            <a href="#" class="anchor "><img src="../img/icons/salvar.png" class="image" alt="..."></a>
          </div>

          <div class="group-image cabecalho-group" >
            <div class="tit-sub-modulo tit-image"></div>
            <label class="tit-sub-modulo tit-text lbl_triagem" id="lbl_triagem"></label>
          </div>
        </div>

        <div class="centro-modulo conteudoCentro">
          <div class="main">
            <main class="main main-centro" id="main-centro">
              <div class="TabControl">
                <div class="header">
                  <ul id="abas" class="abas" id="abas"></ul>
                </div>
                <div id="content" class="content"></div>
              </div>
            </main>
          </div>
        </div>

      </div> <!-- end main -->
    </div> <!-- end container -->

    <script type="text/javascript" src="../js/jquery-3.1.1.min.js" ></script>
    <script type="text/javascript" src="../js/script.js" ></script>
  </body>
</html>
