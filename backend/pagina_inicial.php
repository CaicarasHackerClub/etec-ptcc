<?php
session_start()
?>
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
    <a href="#" id="user" class="nav_user user">Usuário</a>
    <a href="#" class="nav_user">Deslogar</a>
    <div class="hora" id="hora"></div>
    </nav>

    <div class="main">

    <div class="cabecalho">
      <header>
      <img src="../img/icons/botao_menu.png" class="btn_slide" onclick="mostrarMenu()" >
      </header>
      <h1 class="titulo">Hug & Health</h1>
    </div>

    <div class="conteudoCentro">
      <!-- <form class="form" action="sub_modulo.php" method="post"> -->
      <?php
        include_once("Sql.class.php");
        $sql = new Sql;

        $con=$sql->conecta();
        $selCar="SELECT f.fun_cargo FROM funcionario f INNER JOIN usuario u ON f.fun_id=u.funcionario_id WHERE u.usu_id='" . $_SESSION['id_usu']. "';";

        $res=mysqli_query($con, $selCar) or die("Erro: id funcionario " . mysqli_error($con) . "<br> Query: " . $query);

        $cargo=mysqli_fetch_array($res);

        $_SESSION['tipo']=$cargo['fun_cargo'];

        if ($_SESSION['tipo'] == "triagem") {
          $dis1 = "";
        } else {
          $link1 = "";
          $dis1 = "disabled";

        }
      ?>
      <a class="anchor" id="anchor-triagem" onclick="enviar(1)" href="../backend/sub_modulo.php" <?=$dis1?>><img class="avatars" id="img-triagem" src="../img/avatars/triagem.png"><p class="txt_avatar" id="name-tri">
      Triagem</p></a>
      <!-- <input type="hidden" name=Valor value="../img/avatars/triagem.png">
      <input type="hidden" name=Nome_pag value="Triagem">
      </form> -->
      <?php
        if ($_SESSION['tipo'] == "recepcao") {
          $link2 = "../backend/sub_modulo.php";
          $dis2 = "";
        } else {
          $link2 = "";
          $dis2 = "disabled";
        }
      ?>
      <!-- <form class="form" action="sub_modulo.php" method="post"> -->
      <a class="anchor" href="../backend/sub_modulo.php" <?=$dis2?> onclick="enviar(2)"><img class="avatars" id="img-recepcao" src="../img/avatars/recepcao.png"><p class="txt_avatar" id="name-recep">Recepção</p></a>
      <!-- <input type="hidden" name=Valor value="../img/avatars/recepcao.png">
      <input type="hidden" name=Nome_pag value="Recepcao">
      </form> -->
      <?php
        if ($_SESSION['tipo'] == "administracao") {
          $link3 = "../backend/sub_modulo.php";
          $dis3 = "";
        } else {
          $link3 = "";
          $dis3 = "disabled";
        }
      ?>
      <!-- <form class="form" action="sub_modulo.php" method="post"> -->
      <a class="anchor" href= "../backend/sub_modulo.php" <?=$dis3?> onclick="enviar(3)"><img class="avatars" id="img-admin" src="../img/avatars/adm.png"><p class="txt_avatar" id="name-admin">Administração</p></a>
      <!-- <input type="hidden" name=Valor value="../img/avatars/adm.png">
      <input type="hidden" name=Nome_pag value="Administracao">
      </form> -->
      <?php
        if ($_SESSION['tipo'] == "portaria") {
          $link4 = "../backend/sub_modulo.php";
          $dis4 = "";
        } else {
          $link4 = "";
          $dis4 = "disabled";
        }
      ?>
      <a class="anchor" href="../backend/sub_modulo.php" <?=$dis4?> onclick="enviar(4)"><img class="avatars" id="img-portaria" src="../img/avatars/portaria.png"><p class="txt_avatar" id="name-portaria">Portaria</p></a>

    </div>

    </div>
  </div>
  </body>
</html>
