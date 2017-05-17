<meta name="viewport" content="width=device-width, user-scalable=no">
<meta http-equiv="refresh" content="30">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/fila.css">
<script type="text/javascript" src="../js/jquery-3.1.1.min.js" ></script>
<script type="text/javascript" src="../js/script.js" ></script>
<?php
  include_once 'Fila.class.php';

  $fila = new Fila();

  $fila->setPacMax(5);

  $sel = $fila->getSel();
  $tempo = $fila->getTempo();

  $pos = 0;

  if (isset($_POST['reclassificar'])) {
    if (isset($_POST['senha']) && !empty($_POST['senha'])) {
      $num = $fila->num("SELECT usu_id FROM usuario WHERE usu_senha = '" . $_POST['senha'] . "';");

      if ($num != 0) {
        $fila->reclassificar($_POST['id'], $_POST['class']);
        $alert = "Paciente reclassificado com sucesso";
      } else {
        $alert = "Não há nenhum usuário cadastrado com essa senha";
      }
    } else {
      $alert = "Digite uma senha.";
    }

    echo
    "<script type='text/javascript'>
      alert('" . $alert . "');
    </script>";
  }

  if (isset($_POST['desistir'])) {
    $fila->desistir($_POST['id']);
  }

  if (isset($_POST['chamar'])) {
    $fila->inserir("UPDATE triagem SET tri_status = 3 WHERE tri_id = " . $_POST['id'] . ";");
  }

  // $fila->setPac(5, 0, 0);
  // $fila->chamar();

  for ($i = 0; $i < count($sel); $i++) {
    $res = $fila->inserir($sel[$i]);

    while ($pac = mysqli_fetch_array($res)) {
      $fila->atualizar();

      $data = $pac['tri_data'];
      $hora = $pac['tri_hora'];

      $fila->setPac($pac['tri_id'], $fila->calc($data, $hora), $pac['tri_classe_risco']);

      $pos++;

      if ($pos <= $fila->getPacMax() - $fila->getEmConsulta() && $fila->getEmConsulta() < $fila->getPacMax()
        || $fila->getEspera() >= $fila->getTempoMax()) {
        $fila->setProx(true);
      } else {
        $fila->setProx(false);
      }

      $fila->cat();
    }
  }

  $fila->imprimir();
