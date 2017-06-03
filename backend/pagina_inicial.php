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
      <a href="../index.php?acao=logoff" class="nav_user" >Deslogar</a>
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

          include_once "Sql.class.php";
          $sql = new Sql;

          $con=$sql->conecta();
          $selCar="SELECT f.fun_cargo FROM funcionario f INNER JOIN usuario u ON f.fun_id=u.funcionario_id WHERE u.usu_id=" . $_SESSION['id_usu']. ";";

          $res=mysqli_query($con, $selCar) or die("Erro: id funcionario " . mysqli_error($con) . "<br> Query: " . $query);

          $cargo=mysqli_fetch_array($res);

          $_SESSION['tipo']=$cargo['fun_cargo'];

          if ($_SESSION['tipo'] == "enfermeiro" || $_SESSION['tipo'] == "medico") {
            $link1 = "../backend/sub_modulo.php";

          } else {
            $link1 = "";


          }
        ?>
        <a class="anchor" id="anchor-triagem" onclick="enviar(1)" href="<?=$link1?>">
          <img class="avatars" id="img-triagem" src="<?php
            echo ($_SESSION['tipo'] == "enfermeiro" ? "../img/avatars/triagem.png":"../img/avatars/triagempb.png");
          ?>">
          <p class="txt_avatar" id="name-tri">Triagem</p>
        </a>
        <!-- <input type="hidden" name=Valor value="../img/avatars/triagem.png">
        <input type="hidden" name=Nome_pag value="Triagem">
        </form> -->
        <?php
          if ($_SESSION['tipo'] == "recepcao") {
            $link2 = "../backend/sub_modulo.php";

          } else {
            $link2 = "";

          }
        ?>
        <!-- <form class="form" action="sub_modulo.php" method="post"> -->
        <a class="anchor" href="<?=$link2?>" onclick="enviar(2)">
          <img class="avatars" id="img-recepcao" src="<?php
            echo ($_SESSION['tipo'] == "recepcao" ? "../img/avatars/recepcao.png":"../img/avatars/recepcaopb.png");
          ?>">
          <p class="txt_avatar" id="name-recep">Recepção</p>
        </a>
        <!-- <input type="hidden" name=Valor value="../img/avatars/recepcao.png">
        <input type="hidden" name=Nome_pag value="Recepcao">
        </form> -->
        <?php
          if ($_SESSION['tipo'] == "administracao") {
            $link3 = "../backend/sub_modulo.php";

          } else {
            $link3 = "";

          }
        ?>
        <!-- <form class="form" action="sub_modulo.php" method="post"> -->
        <a class="anchor" href= "<?=$link3?>" onclick="enviar(3)">
          <img class="avatars" id="img-admin" src="<?php
            echo ($_SESSION['tipo'] == "administracao" ? "../img/avatars/adm.png":"../img/avatars/admpb.png");
          ?>">
          <p class="txt_avatar" id="name-admin">Administração</p>
        </a>
        <!-- <input type="hidden" name=Valor value="../img/avatars/adm.png">
        <input type="hidden" name=Nome_pag value="Administracao">
        </form> -->
        <?php
          if ($_SESSION['tipo'] == "enfermeiro-chefe") {
            $link4 = "../backend/sub_modulo.php";

          } else {
            $link4 = "";

          }
        ?>
        <a class="anchor" href="<?=$link4?>" onclick="enviar(4)">
          <img class="avatars" id="img-portaria" src="<?php
            echo ($_SESSION['tipo'] == "enfermeiro-chefe" ? "../img/avatars/portaria.png":"../img/avatars/portariapb.png");
          ?>">
          <p class="txt_avatar" id="name-portaria">Portaria</p>
        </a>

        <?php
          if ($_SESSION['tipo'] == "medico") {
            $link5 = "../backend/sub_modulo.php";

          } else {
            $link5 = "";

          }
        ?>
        <a class="anchor" href="<?=$link5?>" onclick="enviar(5)">
          <img class="avatars" id="img-medico" src="<?php
            echo ($_SESSION['tipo'] == "medico" ? "../img/avatars/consultorio.png":"../img/avatars/consultoriopb.png");
          ?>">
          <p class="txt_avatar" id="name-consultorio">Consultorio</p>
        </a>


      </div>

    </div>
  </div>
  </body>
</html>
