<!--//cadastro == 1
    // confirmacao final == 2
    //update == 3
-->
<link rel='stylesheet' href='../css/main.css'>
<link rel='stylesheet' href='../css/cadastro.css'>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js" ></script>
<script type="text/javascript" src="../js/script.js" ></script>
<?php
include_once("Sql.class.php");
$sql = new Sql;

if ($_SESSION['form'] == 1) {
  $tipo = "cadastro.php?acao=cadastro&passo=2";
} elseif ($_SESSION['form'] == 2) {
  $tipo = "cadastro.php?acao=cadastro&passo=5";
} else {
  $tipo = "cadastro.php?acao=cadastro&passo=1";
}

$maxPes = "SELECT MAX(pes_id) AS pes_id FROM pessoa";
$idPes = $sql->selecionar($maxPes);
$selPes = "SELECT * FROM pessoa WHERE pes_id='" . $idPes . "';";
$pessoa = $sql->fetch($selPes);

$maxEnd = "SELECT MAX(end_id) AS end_id FROM endereco";
$idEnd = $sql->selecionar($maxEnd);
$selEnd = "SELECT * FROM endereco WHERE end_id='" . $idEnd . "';";
$endereco = $sql->fetch($selEnd);
?>
<form class="Form form-cadastro" action="<?=$tipo?>" method="post">
  <?php
  if ($_SESSION['form'] == 1) {
    echo "<h1 class=\"titulo\">Cadastro de Pessoa</h1>";
  } elseif ($_SESSION['form'] == 2) {
    echo "<h1 class=\"titulo\">Confirmação Final</h1>";
  } else {
    echo "<h1 class=\"titulo\">Atualização de Dados</h1>";
  }
  ?>
  <br>
  <fieldset class="grupo-info visible-group">
    <legend class="legenda">Dados Pessoais</legend>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Nome:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[1] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_nome" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Nome do pai:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[2] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_pai" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Nome da mãe:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[3] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_mae" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">RG:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[4] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_rg" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">CPF:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "value=\"" . $_SESSION['cpf'] . "\"";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[5] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_cpf" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Data de Nascimento:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[6] . "\"";
          }
      ?>
      <input class="inp_class" type="date" name="pes_data" size="28"  <?=$dis . $val; ?>><br>
    </div>
      <div class="group-form group-form-cadastro">
      <label class="lbl_class">Email</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[8] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_email" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Estado civil:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $sql->selectbox("estado_civil");
        } else {
          $selE = "SELECT * FROM estado_civil WHERE etc_id='" . $pessoa[9] . "';";
          $etc = $sql->fetch($selE);
          echo "<input class=\"inp_class\" type=\"text\" name=\"pes_estado_civil\" size=\"28\" disabled value=" . $etc[1] . "><br>";
        }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Cidadania:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[10] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_cidadania" size="28" <?=$dis . $val?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Gênero</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $sql->selectbox("genero");
        } else {
          $selG = "SELECT * FROM genero WHERE gen_id='" . $pessoa[11] . "';";
          $gen = $sql->fetch($selG);
          echo "<input class=\"inp_class\" type=\"text\" name=\"pes_genero\" size=\"28\" disabled value=" . $gen[1] . "><br>";
        }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Sexo biológico:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $sql->selectbox("sexo");
        } else {
          $selS = "SELECT * FROM sexo WHERE sex_id='" . $pessoa[12] . "';";
          $sex = $sql->fetch($selG);
          echo "<input class=\"inp_class\" type=\"text\" name=\"pes_sexo_biologico\" size=\"28\" disabled value=" . $sex[1] . "><br>";
        }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Telefone:</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "";
          } else {
            $dis = " disabled";
            $val = " value=\"" . $pessoa[13] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_telefone" size="15" <?=$dis . $val?>><br>
    </div>
    <input class="submit" id="inp-env" type="button" name="inp-env" value="OK">
  </fieldset>

  <fieldset class="grupo-info hidden-group">
    <legend class="legenda">Dados de Contato</legend>

    <div class="extend group-form group-form-cadastro">
      <label class="lbl_class">Endereço:</label>
      <input id="autocomplete" class="inp_class" type="text" name="" size="28" value=""
      placeholder="Procurar endereço">
      <button class="submit" type="button" name="auto" id="btn-auto">Completar</button>
    </div>
    <!-- Seção Auto Endereço -->
    <div id="auto-endereco" class="auto-endereco">
      <div id="route" class="group-form group-form-cadastro">
      <label class="lbl_class">Rua:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[1] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_rua" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div id="street_number" class="group-form group-form-cadastro">
      <label class="lbl_class">Numero:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[2] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_numero" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div id="sublocality_level_1" class="group-form group-form-cadastro">
      <label class="lbl_class">Bairro:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[3] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_bairro" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div id="administrative_area_level_2" class="group-form group-form-cadastro">
      <label class="lbl_class">Cidade:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[4] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_cidade" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div id="administrative_area_level_1" class="group-form group-form-cadastro">
      <label class="lbl_class">Estado:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[5] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_estado" size="28" <?=$dis . $val; ?>><br>
    </div>

    <div id="postal_code" class="group-form group-form-cadastro">
      <label class="lbl_class">Cep:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[6] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_cep" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div id="country" class="group-form group-form-cadastro">
      <label class="lbl_class">País:</label>
      <?php
        if ($_SESSION['form'] == 1) {
          $dis = "";
          $val = "";
        } else {
          $dis = " disabled";
          $val = " value=\"" . $endereco[7] . "\"";
        }
      ?>
      <input class="inp_class" type="text" name="end_pais" size="28" <?=$dis . $val; ?>><br>
    </div>
    </div> <!-- Seção Auto Endereço FIM -->
    <?php
      if ($_SESSION['form'] == 2 || $_SESSION['form'] == 3) {
        echo "<input id=\"0\" type=\"button\" value=\"Alterar\">";
      }
      ?>
      <input class="inp_class submit" type="submit" value="Proximo"><br>
  </fieldset>
  </form>
