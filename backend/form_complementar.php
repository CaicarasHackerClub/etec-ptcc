<?php
include_once "Sql.class.php";
$sql = new Sql;

if ($_SESSION['fun_cargo'] == "medico") {
  if ($_SESSION['form'] == 1) {
    $tipo = "cadastro.php?acao=cadastro&passo=4";
  } elseif ($_SESSION['form'] == 2) {
    if ($_SESSION['esc'] == 1) {
      $maxMed = "SELECT MAX(med_id) AS med_id FROM medico";
      $idMed = $sql->selecionar($maxMed);
      $selMed = "SELECT * FROM medico WHERE med_id='" . $idMed . "';";
      $medico = $sql->fetch($selMed);
    } else {
      $sel = "SELECT * FROM medico WHERE funcionario_fun_id='". $_SESSION['fun_id'] ."';";
      $medico=$sql->fetch($sel);
    }
    $tipo = "cadastro.php?acao=cadastro&passo=7";
  } else {
    $sel = "SELECT * FROM medico WHERE funcionario_fun_id='". $_SESSION['fun_id'] ."';";
    $medico=$sql->fetch($sel);
    $tipo = "cadastro.php?acao=cadastro&passo=4";
  }

  ?>
  <form class="form" action="<?=$tipo?>" method="post">
    <h1>Médico</h1>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">CRM:</label>
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
        $val = " value=\"" . $medico[1] . "\"";
      }
       ?>
      <input class="inp_class" type="text" name="med_crm" size="28" <?=$dis . $val; ?>><br>
      <label class="lbl_class">Especialização:</label>
      <?php
      if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
        if ($_SESSION['form'] == 1) {
          $id=0;
        } else {
          $sel="SELECT * FROM especializacao WHERE esp_id='". $medico[2] ."';";
          $id=$sql->selecionar($sel);
        }
        $sql->selectbox("especializacao",$id);
      } else {
        // Pegando o nome da especialização
        $sel = "SELECT * FROM medico_has_especializacao WHERE medico_med_id='" . $idMed . "';";
        $esp = $sql->fetch($sel);
        $selEsp = "SELECT e.esp_nome FROM especializacao e INNER JOIN medico_has_especializacao me ON         e.esp_id = me.especializacao_esp_id WHERE me.especializacao_esp_id ='" . $esp[1] . "';";
        $es = $sql->fetch($selEsp);

        echo "<input class=\"inp_class\" type=\"text\" name=\"esp_nome\" size=\"28\" disabled value=" . $es[0] .  "><br>";
      }
      ?>
    </div>
    <input class="inp_class submmit" type="submit" value="Confirmar">
  </form>
<?php
} elseif ($_SESSION['fun_cargo'] == "enfermeiro") {
  if ($_SESSION['form'] == 1) {
    $tipo = "cadastro.php?acao=cadastro&passo=4";
  } elseif ($_SESSION['form'] == 2) {
    if ($_SESSION['esc'] == 1) {
      $maxFun = "SELECT MAX(fun_id) AS fun_id FROM funcionario";
      $idFun = $sql->selecionar($maxFun);
      $sel = "SELECT * FROM enfermeiro WHERE funcionario_fun_id='" . $idFun . "';";
      $reg = $sql->fetch($sel);
    } else {
      $sel = "SELECT * FROM enfermeiro WHERE funcionario_fun_id='" . $_SESSION['fun_id'] . "';";
      $reg = $sql->fetch($sel);
    }
    $tipo = "cadastro.php?acao=cadastro&passo=7";
  } else {
    $tipo = "cadastro.php?acao=cadastro&passo=4";
  }

  ?>
  <form class="Form" action="<?=$tipo?>" method="post">
    <h1>Enfermeiro</h1>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Registro:</label>
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

        $sel = "SELECT * FROM enfermeiro WHERE funcionario_fun_id='" . $_SESSION['fun_id'] . "';";
        $reg = $sql->fetch($sel);

        $val = " value=\"" . $reg[1] . "\"";
      }
      ?>
      <input class="inp_class" type="text" name="enf_registro" size="20" <?=$dis . $val;?>><br>
    </div>
    <input class="inp_class submmit" type="submit" value="Confirmar">
  </form>
<?php
}
?>
