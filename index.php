<?php
session_start();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/index.css" type="text/css">
  </head>
  <body>
    <?php
    include_once "backend/Sql.class.php";
    $sql=new Sql;

    if (!isset($_SESSION['id_usu'])) {
      if (!isset($_POST['usuario']) && !isset($_POST['senha'])) {
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
      $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
      if ($acao == "cadastro") {
        if ($_SESSION['tipo'] == "recepcao" || $_SESSION['tipo'] == "administracao") {
          if (!isset($_POST['doc'])) {
          ?>
            <form action="index.php?acao=cadastro" class="form-confir FormLogin" method="post">
              <label class="lbl_class">Numero do documento:</label>
              <input type="text" class="inp_class" name="doc" size="28"><br>
              <input type="submit" name=procurar class="submit" value="Procurar">
            </form>
          <?php
          } else {
            $tam=strlen($_POST['doc']);
            echo $tam;
            if (($tam < 11 ) || ($tam > 15)) {
              echo "Digite o CPF ou Cartão SUS novamente!";
            } elseif (($tam > 11) && ($tam < 15)) {
              echo "Digite corretamente o documento (CPF/SUS)";
            } elseif ($tam == 15) {
              $sel="SELECT * FROM plano_de_saude WHERE pds_numero_sus = '" . $_POST['doc'] . "';";
              $qtd=$sql->selecionar($sel);
                if ($qtd>=1) {
                  echo "Já possui um numero SUS com esse numero!!";
                } else {
                  $_SESSION['sus'] = $_POST['doc'];
                  header("Location:backend/cadastro.php?acao=cadastro");
                }
            } else {

              $sel="SELECT pes_cpf FROM pessoa WHERE pes_cpf = '" . $_POST['doc']  . "';";
              $qtd=$sql->selecionar($sel);
              if ($qtd>=1) {
                echo "Ja possui um cpf com esse numero!!";
                $_SESSION['esc'] = 3;
                header ("Location:backend/cadastro.php?acao=cadastro");
              } else {
                $_SESSION['cpf'] = $_POST['doc'];
                $_SESSION['esc'] = 1;
                header("Location:backend/cadastro.php?acao=cadastro");
              }
            }
          }
        } else {
          echo "Você não está autorizado a realizar cadastro neste sistema!";
        }
      } else {
        if ($acao == "logoff") {
          session_destroy();
          unset($_SESSION['tipo']);
          echo "<script>alert('Tchau!! Volte sempre!!')
        location.href='index.php';</script>;";
        }
      }
    }
    ?>
  </body>
</html>
