<?php
include_once("Sql.class.php");
$sql = new Sql;

if ($_SESSION['fun_cargo'] == "medico") {
  if ($_SESSION['form'] == 1) {
      $tipo = "cadastro.php?acao=cadastro&passo=4";
  } elseif ($_SESSION['form'] == 2) {
      $tipo = "cadastro.php?acao=cadastro&passo=7";
  } else {
      $tipo = "cadastro.php?acao=cadastro&passo=3";
  }

  $maxMed = "SELECT MAX(med_id) AS med_id FROM medico";
  $idMed = $sql->selecionar($maxMed);
  $selMed = "SELECT * FROM medico WHERE med_id='" . $idMed . "';";
  $medico = $sql->fetch($selMed);
  ?>
  <form class="Form" action="<?=$tipo?>" method="post">
    <h1>Médico</h1>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">CRM:</label>
      <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        $dis = "disabled";
        $val = " value=\"" . $medico[1] . "\"";
      }
       ?>
      <input class="inp_class" type="text" name="med_crm" size="28" <?=$dis . $val; ?>><br>
      <label class="lbl_class">Especialização:</label>
      <?php
      if ($_SESSION['form'] == 1) {
        $sql->selectbox("especializacao");
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
        $tipo = "cadastro.php?acao=cadastro&passo=7";
    } else {
        $tipo = "cadastro.php?acao=cadastro&passo=3";
    }

    $maxFun = "SELECT MAX(fun_id) AS fun_id FROM funcionario";
    $idFun = $sql->selecionar($maxFun);

    $sel = "SELECT * FROM enfermeiro WHERE funcionario_fun_id='" . $idFun . "';";
    $reg = $sql->fetch($sel);
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
          $maxFun = "SELECT MAX(fun_id) AS fun_id FROM funcionario";
          $fun_id = $sql->selecionar($maxFun);
          $sel = "SELECT * FROM enfermeiro WHERE funcionario_fun_id='" . $fun_id . "';";
          $reg = $sql->fetch($sel);

          $dis = "disabled";
          $val = "value=\"" . $reg[2] . "\"";
        }
        ?>
        <input class="inp_class" type="text" name="enf_registro" size="28" <?=$dis . $val;?>><br>
      </div>
      <input class="inp_class submmit" type="submit" value="Confirmar">
    </form>
<?php
}
?>
