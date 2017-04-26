<?php
  include_once 'Sql.class.php';
  include_once 'Fila.class.php';

  $sql = new Sql();
  $fila = new Fila();

  $fila->setPacMax(5);

  $sel = $fila->getSel();
  $tempo = $fila->getTempo();

  $pos = 0;

  if (isset($_POST['reclassificar'])) {
    $fila->reclassificar($_POST['id'], $_POST['class']);
  }

  if (isset($_POST['remover'])) {
    $fila->remover($_POST['id']);
  }

  if (isset($_POST['desistir'])) {
    $fila->desistir($_POST['id']);
  }

  if (isset($_POST['chamar'])) {
    $fila->inserir("UPDATE triagem SET tri_status = 2 WHERE tri_id = " . $_POST['id'] . ";");
  }

  $con = $sql->conecta();

  // $fila->setPac(5, 0, 0);
  // $fila->chamar();

  for ($i = 0; $i < count($sel); $i++) {
    $res = mysqli_query($con, $sel[$i]);

    while ($pac = mysqli_fetch_array($res)) {
      $fila->atualizar();

      $data = $pac['tri_data'];
      $hora = $pac['tri_hora'];

      $fila->setPac($pac['tri_id'], $fila->calc($data, $hora), $tempo[$i]);

      $pos++;

      if ($pos <= $fila->getPacMax() - $fila->getEmConsulta()  && $fila->getEmConsulta() < $fila->getPacMax() || $fila->getEspera() >= $fila->getTempoMax()) {
        $fila->cat(true, $pos);
      } else {
        $fila->cat(false, $pos);
      }
    }
  }

  mysqli_close($con);

  $fila->atualizar();

  echo "
  <div>
    Pessoas em consulta: " . $fila->getEmConsulta() . " <br>
    Pessoas em espera: " . $fila->getNaFila() . "
  </div>";

  $fila->imprimir();
