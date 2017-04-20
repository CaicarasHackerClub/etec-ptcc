<?php
  include_once 'Sql.class.php';
  include_once 'Fila.class.php';

  $sql = new Sql();
  $fila = new Fila();

  $pacMax = 5;

  $cor = $fila->getCor();
  $tempo = $fila->getTempo();

  $con = $sql->conecta();

  $fila->chamar(52);

  for($i = 0; $i < count($cor); $i++) {
    $res = mysqli_query($con, $cor[$i]);

    while($pac = mysqli_fetch_array($res)) {
      $data = $pac['tri_data'];
      $hora = $pac['tri_hora'];
      $fila->setEspera($fila->calc($data, $hora));

      $fila->atualizar($pac['id_paciente'], $pac['tri_id'], $i);

      if($fila->getEmConsulta() < $pacMax || $fila->getEspera() >= $tempo[$i]) {
        $fila->chamar();
      }

      else {
        $fila->cat();
      }
    }
  }

  mysqli_close($con);

  echo "Pessoas em consulta: " . $fila->getEmConsulta() . "<br>";
  echo "Pessoas em espera: " . $fila->getEmEspera() . "<br>";

  $fila->imprimir();
?>
