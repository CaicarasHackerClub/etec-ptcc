<?php
include_once "Sql.class.php";
$sql = new Sql;

if ($_SESSION['form'] == 1) {
  $tipo = "cadastro.php?acao=cadastro&passo=3";
} elseif ($_SESSION['form'] == 2) {
  $tipo = "cadastro.php?acao=cadastro&passo=6";
} else {
  $tipo = "cadastro.php?acao=cadastro&passo=3";
}

$maxPac = "SELECT MAX(pac_id) AS pac_id FROM paciente";
$idPac = $sql->selecionar($maxPac);
$selPac = "SELECT * FROM paciente WHERE pac_id='" . $idPac . "';";
$paciente = $sql->fetch($selPac);
?>
<!--Formulário de dados da pessoa como paciente-->
<form class="form form-cadastro" action="<?=$tipo?>" method="post">
  <h1 class="titulo">Paciente</h1>
  <fieldset class="grupo-info visible-group">
    <legend class="legenda">Informações do Paciente</legend>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Escolaridade</label>
      <?php
      if ($_SESSION['form'] == 1) {
        if ($_SESSION['form'] == 1) {
            $id = 0;
          } else {
            $sel="SELECT * FROM escolaridade WHERE esc_id='" . $pessoa[4] . "';";
            $id=$sql->selecionar($sel);
          }
        $sql->selectbox("escolaridade", $id);
      } else {
        $sel = "SELECT * FROM escolaridade WHERE esc_id='" . $paciente[4] . "';";
        $esc = $sql->fetch($sel);
        echo "<input class=\"inp_class\" type=\"text\" name=\"pac_escolaridade\" size=\"28\" disabled value = " . $esc[2] . "><br>";
      }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Convênio</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $paciente[5] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="pds_convenio_nome" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Número </label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $paciente[6] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="pds_num_convenio" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">SUS</label>
      <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        $dis = " disabled";
        $val = " value=\"" . $paciente[7] . "\"";
      }
      ?>
      <input class="inp_class" type="text" name="pds_numero_sus" size="28" <?=$dis . $val; ?>><br>
    </div>
    <?php
      if ($_SESSION['form'] == 2 || $_SESSION['form'] == 3) {
        echo "<input id=\"0\" class=\"submit\" type=\"button\" value=\"Alterar\">";
      }
    ?>
    <input class="submit" type="submit" value="Confirmar">
  </fieldset>
</form>
