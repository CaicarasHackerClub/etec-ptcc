<!DOCTYPE html>
<head>
  <link rel='stylesheet' href='../css/main.css'>
  <link rel='stylesheet' href='../css/triagem.css'>
  <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<?php
// $id = isset($_POST['id']) ? $_POST['id'] : "";

if (!isset($_POST['recepcao']) && !isset($_POST['classificar'])) {
  ?>
  <form class="form form-triagem" action="triagem.php" method="post">
    <div class="content-form">
      <div class="group-form">
        <label class="lbl_class">ID: </label>
        <input class="inp_class" type="text" size="4" name="id"> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class">Peso: </label>
        <input class="inp_class" type="text" size="3" name="peso"> <p>kg</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class">Altura: </label>
        <input class="inp_class" type="text" size="3" name="altura"> <p>m</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class min-class">Batimento cardíaco: </label>
        <input class="inp_class" type="text" size="3" name="batimento" <!--required--> <p>bpm</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class ">Respiração: </label>
        <input class="inp_class" type="text" size="3" name="resp" <!--required--> <p>rpm</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class">Temperatura: </label>
        <input class="inp_class" type="text" size="2" name="temp" <!--required--> <p>ºC </p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class">PAS: </label>
        <input class="inp_class" type="text" size="3" name="pas" <!--required--> <p>mmHg</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class">PAD: </label>
        <input class="inp_class" type="text" size="3" name="pad" <!--required--> <p>mmHg</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class min-class">Nível de oxigenação: </label>
        <input class="inp_class" type="text" size="3" name="oxi"> <p>%</p> <br>
      </div>

      <div class="group-form">
        <label class="lbl_class">Dor: </label>
        <select class="inp_class" name="dor">
          <?php
          for ($i = 0; $i <= 10; $i++) {
            echo "<option value='$i'> $i </option>";
          } ?>
        </select> <br>
      </div>
      <div class="group-form">
        <label class="extend-class" for="indi">Comprometimento de orgãos vitais </label>
        <input id="indi" class="inp_class" type="checkbox" name="org">
      </div>
      <input class="anchor submit" type="submit" name="recepcao" value="Enviar">
    </div>
  </form>
  <?php
} else {
  include_once 'Sql.class.php';
  include_once 'Triagem.class.php';

  $sql = new Sql();
  $tri = new Triagem();

  date_default_timezone_set('America/Sao_Paulo');

  $id = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : 0;
  $temp = isset($_POST['temp']) ? trim($_POST['temp']) : "";
  $pas = isset($_POST['pas']) ? trim($_POST['pas']) : "";
  $pad = isset($_POST['pad']) ? trim($_POST['pad']) : "";
  $peso = isset($_POST['peso']) && !empty($_POST['peso']) ? trim($_POST['peso']) : 0;
  $altura = isset($_POST['altura']) && !empty($_POST['altura']) ? trim($_POST['altura']) : 0;
  $batimento = isset($_POST['batimento']) ? trim($_POST['batimento']) : "";
  $oxi = isset($_POST['oxi']) && !empty($_POST['oxi']) ? trim($_POST['oxi']) : 0;
  $resp = isset($_POST['resp']) ? trim($_POST['resp']) : "";
  $dor = isset($_POST['dor']) && !empty($_POST['dor']) ? trim($_POST['dor']) : 0;
  $orgaos = isset($_POST['org']) ? 1 : 0;
  $data = date('Y-m-d');
  $hora = date('H:i');

  $blank = [
    'Temperatura' => $temp,
    'PAS' => $pas,
    'PAD' => $pad,
    'Batimento cardíaco' => $batimento,
    'Respiração' => $resp,
  ];

  $sql->blank($blank);

  $class = isset($_POST['class']) ? $_POST['class'] : "0";

  $tri->setPacId($id);
  $tri->setTemp($temp);
  $tri->setPas($pas);
  $tri->setPad($pad);
  $tri->setPeso($peso);
  $tri->setAltura($altura);
  $tri->setBatimento($batimento);
  $tri->setOxi($oxi);
  $tri->setClass($class);
  $tri->setResp($resp);
  $tri->setDor($dor);
  $tri->setOrg($orgaos);
  $tri->setData($data);
  $tri->setHora($hora);

  // Se o usuário já tiver clicado no botão "Classificar" ou "Aceitar cor"
  if (isset($_POST['classificar'])) {
    $status = $tri->getClass() == 5 ? 3 : 1;
    $tri->setStatus($status);

    $query = "INSERT INTO `triagem`(tri_temperatura, tri_pressao, tri_peso, tri_altura,
        tri_batimento, tri_oxigenacao, tri_classe_risco, tri_respiracao, tri_dor,
        tri_orgaos_vitais, tri_data, tri_hora, tri_status, id_paciente) VALUES("
        . $tri->getTemp() . ", '"  . $tri->getPas()     . "x"   . $tri->getPad()       . "', "
        . $tri->getPeso() . ", "   . $tri->getAltura()  . ", "  . $tri->getBatimento() . ", "
        . $tri->getOxi()  . ", "   . $tri->getClass()   . ", "  . $tri->getResp()      . ", "
        . $tri->getDor()  . ", "   . $tri->getOrg()     . ", '" . $tri->getData()      . "', '"
        . $tri->getHora() . "', '" . $tri->getStatus()  . "', " . $tri->getPacId()     . ");";

    $rows = "SELECT tri_id FROM triagem WHERE id_paciente = " . $tri->getPacId() . " AND tri_status <> 5 AND tri_status <> 6 ;";

    if ($sql->num($rows) == 0) {
      if ($sql->inserir($query)) {
        echo "Inserido com sucesso";
      } else {
        echo "Erro ao inserir";
      }
    } else {
      echo "O paciente já passou pela triagem";
    }
  } else {
    $query = "SELECT pessoa.pes_data FROM pessoa INNER JOIN paciente ON pessoa.pes_id = " . $tri->getPacId() . ";";
    $data = $sql->selecionar($query);

    $dataNasc = explode("-", $data);
    $idade = date('Y') - $dataNasc[0];

    // echo
    // "ID: " . $tri->getPacId() . "<br>
    // Peso: " . $tri->getPeso() . "<br>
    // Altura: " . $tri->getAltura()  ."<br>
    // Batimento cadíaco: " . $tri->getBatimento() . "<br>
    // Respiração: " . $tri->getResp() . "<br>
    // Temperatura: " . $tri->getTemp() . "<br>
    // PAS: " . $tri->getPas() . "<br>
    // PAD: " . $tri->getPad() . "<br>
    // Oxigenação: " . $tri->getOxi() . "<br>
    // Orgãos vitais comprometidos: " . $tri->getOrg() . "<br>
    // Idade: " . $idade . "<br>";


    // Classificando
    if (($tri->getResp() < 10 || $tri->getResp() > 30) && $tri->getResp() != 0) {
      $tri->setClass(5);
    } else {
      if (($tri->getPas() < 80 && $tri->getPad() < 50) && ($tri->getResp() != 0 && $tri->getPas() != 0 && $tri->getPad() != 0)) {
        $tri->setClass(4);
      } else {
        if ($tri->getPas() >= 220 && $tri->getPad() >= 120 && $tri->getOrg() == 1) {
          $tri->setClass(4);
        } else {
          if ($tri->getTemp() >= 39 && $tri->getTemp() != 0) {
            $tri->setClass(3);
          } else {
            if ($tri->getPas() >= 220 && $tri->getPad() >= 120 && $tri->getOrg() == 0) {
              $tri->setClass(3);
            } else {
              if ($idade >= 60 || $tri->getPas() >= 180 && $tri->getPas() < 220 && $tri->getPad() >= 120
                && $tri->getPad() < 130 && $tri->getOrg == 0) {
                $tri->setClass(2);
                echo "Idade do paciente: " . $idade;
              } else {
                $tri->setClass(1);
              }
            }
          }
        }
      }
    }

    ?>

    <form class="form form-classi" action="triagem.php" method="post">
    <h1 class="titulo"> Classificação: </h1>
    <input type="radio" id="vermelho" class="inp_class" name="class" value="5" required
    <?php
    if ($tri->getClass() == 5) {
      echo "checked";
    } ?> >

    <label for="vermelho" class="lbl-radio-class lbl_class"><p>Vermelho</p></label><br>

    <input type="radio" id="laranja" class="inp_class" name="class" value="4" required
    <?php
    if ($tri->getClass() == 4) {
      echo "checked";
    } ?> >

    <label for="laranja" class="lbl-radio-class lbl_class"><p>Laranja</p></label><br>

    <input type="radio" id="amarelo" class="inp_class" name="class" value="3" required
    <?php
    if ($tri->getClass() == 3) {
      echo "checked";
    } ?> >

    <label for="amarelo" class="lbl-radio-class lbl_class"><p>Amarelo</p></label><br>

    <input type="radio" id="verde" class="inp_class" name="class" value="2" required
    <?php
    if ($tri->getClass() == 2) {
      echo "checked";
    } ?> >

    <label for="verde" class="lbl-radio-class lbl_class"><p>Verde</p></label><br>

    <input type="radio" id="azul" class="inp_class" name="class" value="1" required
    <?php
    if ($tri->getClass() == 1) {
      echo "checked";
    } ?> >

    <label for="azul" class="lbl-radio-class lbl_class"><p>Azul</p></label>

    <input type="hidden" class="inp_class" name="peso" value=" <?php echo $tri->getPeso() ?>">
    <input type="hidden" class="inp_class" name="altura" value=" <?php echo $tri->getAltura() ?>">
    <input type="hidden" class="inp_class" name="batimento" value=" <?php echo $tri->getBatimento() ?>">
    <input type="hidden" class="inp_class" name="resp" value=" <?php echo $tri->getResp() ?>">
    <input type="hidden" class="inp_class" name="temp" value=" <?php echo $tri->getTemp() ?>">
    <input type="hidden" class="inp_class" name="pas" value=" <?php echo $tri->getPas() ?>">
    <input type="hidden" class="inp_class" name="pad" value=" <?php echo $tri->getPad() ?>">
    <input type="hidden" class="inp_class" name="oxi" value=" <?php echo $tri->getOxi() ?>">
    <input type="hidden" class="inp_class" name="dor" value="<?php echo $tri->getDor() ?>">
    <input type="hidden" class="inp_class" name="org" value="<?php echo $tri->getOrg() ?>">
    <input type="hidden" class="inp_class" name="id" value=" <?php echo $tri->getPacId()  ?> ">
    <input type="submit" class="submit" name="classificar" value="Classificar">
    </form>
  <?php
  }
}
