<?php
include_once("Sql.class.php");
$sql = new Sql;

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
    <input class="inp_class" type="text" name="med_crm" size="28" <?=$val . $dis ?>><br>
    <label class="lbl_class">Especialização:</label>
    <?php
    if ($_SESSION['form'] == 1) {
      $sql->selectbox("especializacao");
    } else {
      // Pegando o nome da especialização
      $sel = "SELECT * FROM medico_has_especializacao WHERE medico_med_id='" . $idMed . "';";
      $esp = $sql->fetch($sel);
      $selEsp = "SELECT * FROM especializacao WHERE esp_id='" . $esp[2] . "';";
      $es = $sql->fetch($selEsp);

      echo "<input class=\"inp_class\" type=\"text\" name=\"esp_nome\" size=\"28\" value=" . $es[2] .  "><br>";
    }
    ?>
  </div>
  <input class="inp_class submmit" type="submit" value="Confirmar">
</form>
