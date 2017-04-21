<!DOCTYPE html>
<html>
  <head>

  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="../css/main.css">
  <script type="text/javascript" src="../js/jquery-3.1.1.min.js" ></script>
  <script type="text/javascript" src="../js/script.js" ></script>
  </head>
  <body>

  <div class="container">
    <nav class="lateral" id="lateral">
    <img class="logo" src="../img/logos/index.png">
    <a href="#" id="user" class="nav_user">Usuário</a>
    <a href="#" class="nav_user">Deslogar</a>
    <div id="hora"></div>
    </nav>

    <div class="main">

    <div class="cabecalho">
      <header>
      <img src="../img/icons/botao_menu.png" id="btn_slide" onclick="mostrarMenu()" >
      </header>
      <h1 class="titulo">Hug & Health</h1>
    </div>

    <div class="conteudoCentro">
      <!-- <form class="form" action="sub_modulo.php" method="post"> -->
      <a class="anchor" id="anchor-triagem" onclick="enviar(1)" href="../backend/sub_modulo.php"><img class="avatars" id="img-triagem" src="../img/avatars/triagem.png"><p class="txt_avatar" id="name-tri">
      Triagem</p></a>
      <!-- <input type="hidden" name=Valor value="../img/avatars/triagem.png">
      <input type="hidden" name=Nome_pag value="Triagem">
      </form> -->

      <!-- <form class="form" action="sub_modulo.php" method="post"> -->
      <a class="anchor" href="../backend/sub_modulo.php" onclick="enviar(2)"><img class="avatars" id="img-recepcao" src="../img/avatars/recepcao.png"><p class="txt_avatar" id="name-recep">Recepção</p></a>
      <!-- <input type="hidden" name=Valor value="../img/avatars/recepcao.png">
      <input type="hidden" name=Nome_pag value="Recepcao">
      </form> -->

      <!-- <form class="form" action="sub_modulo.php" method="post"> -->
      <a class="anchor" href="../backend/sub_modulo.php" onclick="enviar(3)"><img class="avatars" id="img-admin" src="../img/avatars/adm.png"><p class="txt_avatar" id="name-admin">Administração</p></a>
      <!-- <input type="hidden" name=Valor value="../img/avatars/adm.png">
      <input type="hidden" name=Nome_pag value="Administracao">
      </form> -->
    </div>

    </div>
  </div>
  </body>
</html>
