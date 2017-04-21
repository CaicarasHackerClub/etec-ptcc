<?php
session_start();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="css/index.css" type="text/css">
  </head>
  <body>
    <?php
    if (!isset ($_SESSION ['id_usu'])) {
      if (!isset ($_POST['usuario']) && !isset($_POST['senha'])) {
        ?>
      <img src="img/logos/index.png" class="Img">
          <form class="FormLogin" action="backend/verifica_usuario.php" method="post">
            <input type="text" name="usu_email" size="28" class="inp_class" placeholder="Usuario"><br>
            <input type="password" name="usu_senha" size="28" class="inp_class" placeholder="Senha"><br>
            <input type="submit" name="subm" value="Login" class="submit">
          </form>
      <?php

      }
    } else {
      $acao = isset($_GET['acao'])? $_GET['acao'] : ""; ?>
      <a href="?acao=cadastro">Cadastro</a>
      <a href="?acao=logoff">Sair</a>
      <?php
      if ($acao == "cadastro") {
        header ("Location:backend/cadastro.php");
      } else {
        if ($acao == "logoff") {
          session_destroy();
          unset ($_SESSION['tipo']);
          echo "<script>alert('Tchau!! Volte sempre!!')
        location.href='index.php';</script>;";
        }
      }
    }
    ?>
  </body>
</html>
