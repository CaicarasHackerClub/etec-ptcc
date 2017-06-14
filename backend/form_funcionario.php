<link rel='stylesheet' href='../css/main.css'>
<?php
include_once "Sql.class.php";
$sql = new Sql;

$_GET['voltar'] = isset($_GET['voltar'])? $_GET['voltar'] : "";
$_SESSION['form'] = isset($_SESSION['form'])? $_SESSION['form'] : "";
$_SESSION['id'] = isset($_SESSION['id'])? $_SESSION['id'] : "";

if ($_SESSION['form'] == 1 || $_GET['voltar'] == 1) {
  $_SESSION['form'] = 1;
  $tipo = "cadastro.php?acao=cadastro&passo=3";
} elseif ($_SESSION['form'] == 2) {
  if ($_SESSION['esc'] == 1) {
    $maxFun = "SELECT MAX(fun_id) AS fun_id FROM funcionario";
    $idFun = $sql->selecionar($maxFun);
    $selFun = "SELECT * FROM funcionario WHERE fun_id='" . $idFun . "';";
    $funcionario = $sql->fetch($selFun);
    $selUsu = "SELECT * FROM usuario WHERE funcionario_id='" . $idFun . "';";
    $usuario = $sql->fetch($selUsu);
  } else {
    $selFun="SELECT * FROM funcionario WHERE pessoa_pes_id='" . $_SESSION['id'] . "';";
    $funcionario = $sql->fetch($selFun);
    $selUsu = "SELECT * FROM usuario WHERE funcionario_id='" . $funcionario[0] . "';";
    $usuario = $sql->fetch($selUsu);
  }


  if ($_SESSION['fun_cargo'] == "medico" || $_SESSION['fun_cargo'] == "enfermeiro") {
    $tipo = "cadastro.php?acao=cadastro&passo=6";
  } else {
    $tipo = "cadastro.php?acao=cadastro&passo=5";
  }

} else {
  if ($_SESSION['form'] == 3 || $_GET['voltar'] == 1) {
    $selFun = "SELECT * FROM funcionario WHERE pessoa_pes_id='". $_SESSION['id'] ."';";
    $funcionario=$sql->fetch($selFun);
    $selUsu="SELECT * FROM usuario WHERE funcionario_id='" . $funcionario['0'] . "';";
    $usuario=$sql->fetch($selUsu);


    $_SESSION['fun_id'] = $funcionario[0];

    $tipo = "cadastro.php?acao=cadastro&passo=3";
  }
}

?>
<form class="form form-funcionario" action="<?=$tipo?>" method="post">
  <h1 class="titulo">Funcionário</h1><br>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Cargo</label>
    <?php
    if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
    echo "<select class=\"inp_class\" name=\"fun_cargo\">";
    echo  "<option class=\"option\" value=\"recepcao\">Recepcionista</option>";
    echo  "<option class=\"option\" value=\"medico\">Médico</option>";
    echo  "<option class=\"option\" value=\"enfermeiro\">Enfermeiro</option>";
    echo  "<option class=\"option\" value=\"funcionario\">Funcionário</option>";
    echo "</select>";

    } else {
      echo "<input class=\"inp_class\" type=\"text\" name=\"fun_cargo\" size=\"28\"
            disabled value = " . $funcionario[1] . "><br>";
    }
    ?>
    <br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Setor</label>
    <?php
    if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
      if ($_SESSION['form'] == 1) {
        $id = 0;
      } else {
        $sel="SELECT * FROM setor WHERE set_id='" . $funcionario[5] . "';";
        $id=$sql->selecionar($sel);
      }
      $sql->selectbox("setor",$id);
    } else {
      $sel = "SELECT * FROM setor WHERE set_id='" . $funcionario[5]  . "';";
      $set = $sql->fetch($sel);
      echo "<input class=\"inp_class\" type=\"text\" name=\"set_setor\" size=\"28\"
            disabled value = " . $set[1] . "><br>";
    }
    ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Inscrição</label>
    <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        if ($_SESSION['form'] == 2) {
          $dis = " disabled";
        } else {
          $dis = "";
        }
        $val = " value=\"" . $funcionario[2] . "\"";
      }
    ?>
    <input class="inp_class" type="text" name="fun_inscricao" size="28" <?=$dis . $val; ?>><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Turno</label>
    <?php
      if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
        if ($_SESSION['form'] == 1) {
          $id = 0;
        } else {
          $sel="SELECT * FROM turno WHERE tur_id='" . $funcionario[3] . "';";
          $id=$sql->selecionar($sel);
        }
        $sql->selectbox("turno",$id);
      } else {
        $sel1 = "SELECT * FROM turno WHERE tur_id='" . $funcionario[3]  . "';";
        $tur = $sql->fetch($sel1);
        echo "<input class=\"inp_class\" type=\"text\" name=\"fun_turno\" size=\"28\"
            disabled value = " . $tur[1] . "><br>";
      }
    ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">E-mail</label>
    <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        if ($_SESSION['form'] == 2) {
          $dis = " disabled";
        } else {
          $dis = "";
        }
        $val = " value=\"" . $usuario[2] . "\"";
      }
    ?>
    <input class="inp_class" type="text" name="usu_email" size="28" <?=$dis . $val; ?>><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Senha</label>
    <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        if ($_SESSION['form'] == 2) {
          $dis = " disabled";
        } else {
          $dis = "";
        }
        $val = " value=\"" . $usuario[1] . "\"";
      }
    ?>
    <input class="inp_class" type="password" name="usu_senha" size="28" <?=$dis . $val; ?>><br>
  </div>
  <?php
  if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
  ?>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Confirmação</label>
      <input class="inp_class" type="password" name="conf_senha" size="28"><br>
    </div>
  <?php
  }
  ?>

  <?php
    if ($_SESSION['form'] == 2 || $_SESSION['form'] == 3) {
      echo "<input id=\"0\" class=\"submit\" type=\"button\" value=\"Alterar\">";
    }
  ?>
  <input class="submit" type="submit" value="Proximo">
</form>
