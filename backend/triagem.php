<?php
  // $id = isset($_POST['id']) ? $_POST['id'] : "";
  if(!isset($_POST['Recepcao']) && !isset($_POST['classificar'])) {
  ?>
  <h1>Triagem</h1>
  <form action="triagem.php" method="post">
    <label>ID: </label><input type="text" name="id"><br>
    <label>Peso: </label><input type="text" name="peso"><br>
    <label>Altura: </label><input type="text" name="altura"><br>
    <label>Batimento cardíaco: </label><input type="text" name="batimento" required><br>
    <label>Respiração: </label><input type="text" name="resp" required><br>
    <label>Temperatura corporal: </label><input type="text" name="temp" required><br>
    <label>PAS: </label><input type="text" name="pas" required><br>
    <label>PAD: </label><input type="text" name="pad" required><br>
    <label>Nível de oxigenação do sangue: </label><input type="text" name="oxi"><br>
    <label>Dor: </label><input type="text" name="dor"><br>
    <label>Indicação de comprometimento dos orgãos vitais </label> <input type="checkbox" name="org"> <br>
    <input type="submit" name="Recepcao">
  </form>
  <?php
    }

  else {
    include_once 'Sql.class.php';
    include_once 'Triagem.class.php';

    $sql = new Sql();
    $tri = new Triagem();

    $id = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : "0";
    $temp = isset($_POST['temp']) && !empty($_POST['temp']) ? trim($_POST['temp']) : "0";
    $pas = isset($_POST['pas']) && !empty($_POST['pas']) ? trim($_POST['pas']) : "0";
    $pad = isset($_POST['pad']) && !empty($_POST['pad']) ? trim($_POST['pad']) : "0";
    $peso = isset($_POST['peso']) && !empty($_POST['peso']) ? trim($_POST['peso']) : "0";
    $altura = isset($_POST['altura']) && !empty($_POST['altura']) ? trim($_POST['altura']) : "0";
    $batimento = isset($_POST['batimento']) && !empty($_POST['batimento']) ? trim($_POST['batimento']) : "0";
    $oxi = isset($_POST['oxi']) && !empty($_POST['oxi']) ? trim($_POST['oxi']) : "0";
    $resp = isset($_POST['resp']) && !empty($_POST['resp']) ? trim($_POST['resp']) : "0";
    $dor = isset($_POST['dor']) && !empty($_POST['resp']) ? trim($_POST['resp']) : "0";
    $orgaos = isset($_POST['org']) ? 1 : 0;
    $data = date('Y-m-d');
    $hora = date('H:i:s');

    $class = isset($_POST['class']) ? $_POST['class'] : "Indefinido";

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
    if(isset($_POST['classificar'])) {
      $status = $tri->getClass() == "Vermelho" ? "Em consulta" : "Em espera";
      $tri->setStatus($status);

      $query = "INSERT INTO `triagem`(tri_temperatura, tri_pressao, tri_peso, tri_altura,
                tri_batimento, tri_oxigenacao, tri_classe_risco, tri_respiracao, tri_dor,
                tri_orgaos_vitais, tri_data, tri_hora, tri_status, id_paciente) VALUES("
                . $tri->getTemp() . ", '"  . $tri->getPas()    . "x"   . $tri->getPad()       . "', "
                . $tri->getPeso() . ", "   . $tri->getAltura() . ", "  . $tri->getBatimento() . ", "
                . $tri->getOxi()  . ", '"  . $tri->getClass()  . "', " . $tri->getResp()      . ", "
                . $tri->getDor()  . ", "   . $tri->getOrg()    . ", '" . $tri->getData()      . "', '"
                . $tri->getHora() . "', '" . $tri->getStatus() . "', " . $tri->getPacId()     . ");";

      if($sql->inserir($query)) {
        echo "Inserido com sucesso";
      }

      else {
        echo "Erro ao inserir";
      }
    }

    // Se ainda não tiver realizado a triagem, pede os dados
    else {
      // Pegando a idade do paciente
      $fetchId = $sql->fetch("SELECT pessoa_pes_id FROM paciente WHERE pac_id = " . $tri->getPacId() . ";");
      $fetchData = $sql->fetch("SELECT pes_data FROM pessoa WHERE pes_id = " . $fetchId['pessoa_pes_id'] . ";");

      $dataNasc = explode("-", $fetchData['pes_data']);
      $idade = date(Y) - $dataNasc[0];

      // echo "ID PESSOA: " . $fetchId['pessoa_pes_id'] . "<br>";

      // echo
      // "<br> Peso: " . $tri->getPeso() . "<br>" .
      // "Altura: " . $tri->getAltura()  ."<br>" .
      // "Batimento cadíaco: " . $tri->getBatimento() . "<br>" .
      // "Respiração: " . $tri->getResp() . "<br>" .
      // "Temperatura: " . $tri->getTemp() . "<br>" .
      // "PAS: " . $tri->getPas() . "<br>" .
      // "PAD: " . $tri->getPad() . "<br>" .
      // "Oxigenação: " . $tri->getOxi() . "<br>" .
      // "Idade: " . $idade . "<br>" .
      // "Orgãos vitais comprometidos: " . $tri->getOrg() . "<br>" .
      // "ID: " . $tri->getPacId() . "<br><br>";

      // Classificando
      if(($tri->getResp() < 10 || $tri->getResp() > 30) && $tri->getResp() != 0) {
        $tri->setClass("Vermelho");
      }

      else if(($tri->getPas() < 80 && $tri->getPad() < 50) && ($tri->getResp() != 0 && $tri->getPas() != 0 && $tri->getPad() != 0)) {
        $tri->setClass("Laranja");
      }

      else if($tri->getPas() >= 220 && $tri->getPad() >= 120 && $tri->getOrg() == 1) {
        $tri->setClass("Laranja");
      }

      else if($tri->getTemp() >= 39 && $tri->getTemp() != 0) {
        $tri->setClass("Amarelo");
      }

      else if($tri->getPas() >= 220 && $tri->getPad() >= 120 && $tri->getOrg() == 0) {
        $tri->setClass("Amarelo");
      }

      else if($idade >= 60 || $tri->getPas() >= 180 && $tri->getPas() < 220 && $tri->getPad() >= 120 && $tri->getPad() < 130 && $tri->getOrg == 0) {
        $tri->setClass("Verde");
        echo "Idade do paciente: " . $idade;
      }

      else {
        $tri->setClass("Azul");
      }

      echo "<br> O paciente foi classificado como: " . strtolower($tri->getClass());
      ?>
      <br>
      <form action="triagem.php" method="post">
        <input type="hidden" name="peso" value=" <?php echo $tri->getPeso() ?>">
        <input type="hidden" name="altura" value=" <?php echo $tri->getAltura() ?>">
        <input type="hidden" name="batimento" value=" <?php echo $tri->getBatimento() ?>">
        <input type="hidden" name="resp" value=" <?php echo $tri->getResp() ?>">
        <input type="hidden" name="temp" value=" <?php echo $tri->getTemp() ?>">
        <input type="hidden" name="pas" value=" <?php echo $tri->getPas() ?>">
        <input type="hidden" name="pad" value=" <?php echo $tri->getPad() ?>">
        <input type="hidden" name="oxi" value=" <?php echo $tri->getOxi() ?>">
        <input type="hidden" name="class" value="<?php echo $tri->getClass() ?>">
        <input type="hidden" name="dor" value="<?php echo $tri->getDor() ?>">
        <input type="hidden" name="org" value="<?php echo $tri->getOrg() ?>">
        <input type="hidden" name="id" value=" <?php echo $tri->getPacId()  ?> ">
        <input type="submit" name="classificar" value="Aceitar cor">
      </form>

      <h1> Classificação manual: </h1>
      <form action="triagem.php" method="post">
        <input type="radio" name="class" value="Vermelho" required> Vermelho <br>
        <input type="radio" name="class" value="Laranja" required> Laranja  <br>
        <input type="radio" name="class" value="Amarelo" required> Amarelo <br>
        <input type="radio" name="class" value="Verde" required> Verde  <br>
        <input type="radio" name="class" value="Azul" required> Azul  <br>
        <input type="hidden" name="peso" value=" <?php echo $tri->getPeso() ?>">
        <input type="hidden" name="altura" value=" <?php echo $tri->getAltura() ?>">
        <input type="hidden" name="batimento" value=" <?php echo $tri->getBatimento() ?>">
        <input type="hidden" name="resp" value=" <?php echo $tri->getResp() ?>">
        <input type="hidden" name="temp" value=" <?php echo $tri->getTemp() ?>">
        <input type="hidden" name="pas" value=" <?php echo $tri->getPas() ?>">
        <input type="hidden" name="pad" value=" <?php echo $tri->getPad() ?>">
        <input type="hidden" name="oxi" value=" <?php echo $tri->getOxi() ?>">
        <input type="hidden" name="dor" value="<?php echo $tri->getDor() ?>">
        <input type="hidden" name="org" value="<?php echo $tri->getOrg() ?>">
        <input type="hidden" name="id" value=" <?php echo $tri->getPacId()  ?> ">
        <input type="submit" name="classificar" value="Classificar">
      </form>
    <?php
    }
  }
?>
