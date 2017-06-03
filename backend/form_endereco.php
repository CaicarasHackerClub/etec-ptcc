<?php
include_once "Sql.class.php";
$sql = new Sql;
?>

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
    <?php
      if ($_SESSION['form'] == 2) {
        echo "<input class=\"submit\" type=\"submit\" value=\"Próximo\"><br>";
      }
    ?>

     <!-- Seção Auto Endereço FIM -->
