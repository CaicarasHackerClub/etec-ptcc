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

$maxPac = "SELECT MAX(pac_id) AS pac_id FROM paciente";
$idPac = $sql->selecionar($maxPac);
$selPac = "SELECT * FROM paciente WHERE pac_id='" . $idPac . "';";
$paciente = $sql->fetch($selPac);
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
        echo "<input class=\"inp_class\" type=\"text\" name=\"med_crm\" size=\"28\" value=" . $esp[1] .  "><br>";
       }
     ?>
    </div>
</form>