<?php
if ($_SESSION['form'] == 1) {
  $tipo = "cadastro.php?acao=cadastro&passo=3";
} elseif ($_SESSION['form'] == 2) {
  $tipo = "cadastro.php?acao=cadastro&passo=6";
} else {
  $tipo = "cadastro.php?acao=cadastro&passo=3";
}

$maxFun = "SELECT MAX(fun_id) AS fun_id FROM funcionario";
$idFun = $sql->selecionar($maxFun);
$selFun = "SELECT * FROM funcionario WHERE fun_id='" . $idFun . "';";
$funcionario = $sql->fetch($selFun);

$selUsu = "SELECT * FROM usuario WHERE funcionario_id='" . $idFun . "';";
$usuario = $sql->fetch($selUsu);
?>
<form class="Form" action="<?=$tipo?>" method="post">
  <h1 class="titulo">Funcionário</h1>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Cargo:</label>
    <select class="select" name="fun_cargo">
      <option class="option" value="recepcao">Recepcionista</option>
      <option class="option" value="medico">Médico</option>
      <option class="option" value="enfermeiro">Enfermeiro</option>
      <option class="option" value="funcionario">Funcionário</option>
    </select>
    <br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Setor:</label>
    <?php
    $sql->selectbox("setor");
    ?>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Horario:</label>
    <input class="inp_class" type="time" name="fun_horario" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Inscrição:</label>
    <input class="inp_class" type="text" name="fun_inscricao" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Turno:</label>
    <select class="select" name="fun_turno">
     <option class="option" value="manha">Manhã</option>
     <option class="option" value="tarde">Tarde</option>
     <option class="option" value="noite">Noite</option>
    </select><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">E-mail:</label>
    <input class="inp_class" type="text" name="usu_email" size="28"><br>
  </div>
  <div class="group-form group-form-cadastro">
    <label class="lbl_class">Senha:</label>
    <input class="inp_class" type="password" name="usu_senha" size="28"><br>
  </div>
  <input class="inp_class" type="submit" value="Proximo">
</form>
