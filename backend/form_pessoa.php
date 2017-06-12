<!--//cadastro == 1
    // confirmacao final == 2
    //update == 3
    // verificação de dados == 4
-->
<link rel='stylesheet' href='../css/main.css'>
<link rel='stylesheet' href='../css/cadastro.css'>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js" ></script>
<script type="text/javascript" src="../js/script.js" ></script>
<?php
include_once "Sql.class.php";
$sql = new Sql;

if ($_SESSION['form'] == 1) {
  //cadastro
  $tipo="cadastro.php?acao=cadastro&passo=2";
} elseif ($_SESSION['form'] == 2) {
  $maxPes = "SELECT MAX(pes_id) AS pes_id FROM pessoa";
  $idPes = $sql->selecionar($maxPes);
  $selPes = "SELECT * FROM pessoa WHERE pes_id='" . $idPes . "';";
  $pessoa = $sql->fetch($selPes);

  $maxEnd = "SELECT MAX(end_id) AS end_id FROM endereco";
  $idEnd = $sql->selecionar($maxEnd);
  $selEnd = "SELECT * FROM endereco WHERE end_id='" . $idEnd . "';";
  $endereco = $sql->fetch($selEnd);

    if ($_SESSION['fun_cargo'] == "medico" || $_SESSION['fun_cargo'] == "enfermeiro") {
      $tipo = "cadastro.php?acao=cadastro&passo=5";
    } else {
      $tipo = "cadastro.php?acao=cadastro&passo=4";
    }

} elseif ($_SESSION['form'] == 3) {
  $selPes = "SELECT * FROM pessoa WHERE pes_id='" . $_SESSION['id'] . "';";
  $pessoa = $sql->fetch($selPes);
  $selEnd = "SELECT * FROM endereco WHERE pessoa_pes_id='" . $_SESSION['id'] . "';";
  $endereco = $sql->fetch($selEnd);
  $tipo="cadastro.php?acao=cadastro&passo=2";
}

?>
<form class="form form-cadastro" action="<?=$tipo?>" method="post">
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
      <div class="group-form group-form-cadastro extend">
      <label class="lbl_class">Nome</label>
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
            $val = " value=\"" . $pessoa[1] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_nome" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Nome do pai</label>
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
            $val = " value=\"" . $pessoa[2] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_pai" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Nome da mãe</label>
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
            $val = " value=\"" . $pessoa[3] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_mae" size="28" <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">RG</label>
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
            $val = " value=\"" . $pessoa[4] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_rg" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">CPF</label>
      <?php
          if ($_SESSION['form'] == 1) {
            $dis = "";
            $val = "value=\"" . $_SESSION['cpf'] . "\"";
          } else {
            if ($_SESSION['form'] == 2) {
              $dis = " disabled";
            } else {
              $dis = "";
            }
            $val = " value=\"" . $pessoa[5] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_cpf" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Nascimento</label>
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
            if ($_SESSION['form'] == 2) {
              $dis = " disabled";
            } else {
              $dis = "";
            }
            $val = " value=\"" . $pessoa[8] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_email" size="28"  <?=$dis . $val; ?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Estado civil</label>
      <?php
        if ($_SESSION['form'] == 1  || $_SESSION['form'] == 3) {
          $sql->selectbox("estado_civil");
        } else {
          $selE = "SELECT * FROM estado_civil WHERE etc_id='" . $pessoa[9] . "';";
          $etc = $sql->fetch($selE);

          if ($_SESSION['form'] == 2) {
            $dis = " disabled";
          } else {
            $dis = "";
          }

          $val = "value=\"" . $etc[1] . "\"";
        echo "<input class=\"inp_class\" type=\"text\" name=\"pes_estado_civil\" size=\"28\""
             . $dis . $val . "><br>\"";
        }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Cidadania</label>
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
            $val = " value=\"" . $pessoa[10] . "\"";
          }
      ?>
      <input class="inp_class" type="text" name="pes_cidadania" size="28" <?=$dis . $val;?>><br>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Gênero</label>
      <?php
        if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
          $sql->selectbox("genero");
        } else {
          $selG = "SELECT gen_genero FROM genero WHERE gen_id='" . $pessoa[11] . "';";
          $gen = $sql->fetch($selG);
          if ($_SESSION['form'] == 2) {
            $dis = " disabled";
          } else {
            $dis = "";
          }
          $val = " value=\"" . $gen[1] . "\"";
        echo "<input class=\"inp_class\" type=\"text\" name=\"pes_genero\" size=\"28\"" . $dis . $val . "><br>\"";
        }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Sexo biológico</label>
      <?php
        if ($_SESSION['form'] == 1 || $_SESSION['form'] == 3) {
          $sql->selectbox("sexo");
        } else {
          $selS = "SELECT * FROM sexo WHERE sex_id='" . $pessoa[12] . "';";
          $sex = $sql->fetch($selG);
          if ($_SESSION['form'] == 2) {
            $dis = " disabled";
          } else {
            $dis = "";
          }
        $val = " value=\"" . $sex[1] . "\"";
        echo "<input class=\"inp_class\" type=\"text\" name=\"pes_sexo_biologico\" size=\"28\"" . $dis . $val .
        "><br>";
        }
      ?>
    </div>
    <div class="group-form group-form-cadastro">
      <label class="lbl_class">Telefone</label>
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
          $val = " value=\"" . $pessoa[13] . "\"";
      }
      ?>
      <input class="inp_class" type="text" name="pes_telefone" size="15" <?=$dis . $val;?>><br>
    </div>
    <input class="submit" id="inp-env" type="button" name="inp-env" value="Proximo">
  </fieldset>

  <fieldset class="grupo-info hidden-group">
      <legend class="legenda">Dados de Contato</legend>
    <?php
      if ($_SESSION['form'] == 1) {
      ?>
        <div class="error" id="error-onload"></div>
          <div class="extend group-form group-form-cadastro" id="autocompletar">
            <label class="lbl_class">Endereço</label>
            <input id="autocompletar-in" class="inp_class" type="text" name="" size="28" value=""
            placeholder="Procurar endereço ou enter para completado manual" autofocus>
          <!-- <button class="submit" type="button" name="auto" id="btn-auto">Manual</button> -->
          </div>
        <?php
        //$_SESSION['form'] = 2;
        echo "</div>";
        echo "<div id=\"auto-endereco\" class=\"auto-endereco\">";
        include 'form_endereco.php';
        echo "</div>";
      } elseif ($_SESSION['form'] == 2 || $_SESSION['form'] == 3)  {
        include 'form_endereco.php';
      }
    ?>
    <!-- Seção Auto Endereço -->

      <?php
      if ($_SESSION['form'] == 2 || $_SESSION['form'] == 3) {
        echo "<input id=\"0\" type=\"button\" value=\"Alterar\">";
      }
      ?>
      <input class="submit" id="inp-voltar" type="button" value="Anterior">
      <input class="inp_class submit cadastro-submit" type="submit" value="Proximo"><br>
  </fieldset>
  </form>
