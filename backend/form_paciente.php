<?php
if ($_SESSION['form'] == 1) {
  $tipo = "cadastro.php?acao=cadastro&passo=3";
} elseif ($_SESSION['form'] == 2) {
  $tipo = "cadastro.php?acao=cadastro&passo=6";
} else {
  $tipo = "cadastro.php?acao=cadastro&passo=3";
}

$maxPac = "SELECT MAX(pac_id) AS pac_id FROM paciente";
$idPac = $sql->selecionar($maxPac);
$selPes = "SELECT * FROM paciente WHERE pac_id='" . $idPac . "';";
$paciente = $sql->fetch($selPac);
?>
<!--Formulário de dados da pessoa como paciente-->
<form class="Form" action="<?=$tipo?>" method="post">
  <h1 class="titulo">Paciente</h1>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Tipo Sanguineo</label>
      <?php
      if ($_SESSION['form'] == 1){
        $sql->selectbox("tipo_sanguineo");
      } else {
        echo "<input class=\"inp_class\" type=\"text\" name=\"pac_tipo_sanguineo\" size=\"28\" disabled value = " . $paciente[1] . "><br>";
      }
      ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Remedio</label>
      <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        $dis = " disabled";
        $val = " value=\"" . $paciente[2] . "\"";
      }
      ?>
    <input class="inp_class" type="text" name="pac_remedio" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Doença</label>
    <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        $dis = " disabled";
        $val = " value=\"" . $paciente[2] . "\"";
      }
    ?>
    <input class="inp_class" type="text" name="pac_doenca" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Grau de escolaridade:</label>
    <?php
    if ($_SESSION['form'] == 1){
      $sql->selectbox("escolaridade");
    } else {
      echo "<input class=\"inp_class\" type=\"text\" name=\"pac_escolaridade\" size=\"28\" disabled value = " . $paciente[3] . "><br>";
    }
    ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Convênio:</label>
    <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        $dis = " disabled";
        $val = " value=\"" . $paciente[4] . "\"";
      }
    ?>
    <input class="inp_class" type="text" name="pds_convenio_nome" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Número :</label>
    <?php
      if ($_SESSION['form'] == 1) {
        $dis = "";
        $val = "";
      } else {
        $dis = " disabled";
        $val = " value=\"" . $paciente[5] . "\"";
      }
    ?>
    <input class="inp_class" type="text" name="pds_num_convenio" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">SUS:</label>
    <?php
    if ($_SESSION['form'] == 1) {
      $dis = "";
      $val = "";
    } else {
      $dis = " disabled";
      $val = " value=\"" . $paciente[2] . "\"";
    }
    ?>
    <input class="inp_class" type="text" name="pds_numero_sus" size="28">
  </div>
  <input class="inp_class submmit" type="submit" value="Confirmar">
</form>
