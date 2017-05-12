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
      $sql->selectbox("tipo_sanguineo");
      ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Remedio</label>
    <input class="inp_class" type="text" name="pac_remedio" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Doença</label>
    <input class="inp_class" type="text" name="pac_doenca" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Grau de escolaridade:</label>
    <?php
    $sql->selectbox("escolaridade");
    ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Convênio:</label>
    <input class="inp_class" type="text" name="pds_convenio_nome" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Número :</label>
    <input class="inp_class" type="text" name="pds_num_convenio" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">SUS:</label>
    <input class="inp_class" type="text" name="pds_numero_sus" size="28">
  </div>
  <input class="inp_class submmit" type="submit" value="Confirmar">
</form>
