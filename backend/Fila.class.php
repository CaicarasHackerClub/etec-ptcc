<?php

include_once 'Sql.class.php';

class Fila extends Sql {

  function espera($dataPac, $horaPac) {
    $data = new DateTime($dataPac);
    $horario = new DateTime($horaPac);

    $dias = $data->diff(new DateTime(date('Y-m-d')));
    $horas = $horario->diff(new DateTime(date('H:i')));

    $tempo = $horas->format('%H:%I');
    $tempo = explode(':', $tempo);
    $h = $tempo[0];
    $m = $tempo[1];
    $h += $dias->d * 24;

    $tempoFinal = $h*60 + $m;

    return $tempoFinal;
  }

  function chamar($id) {
    $con = parent::conecta();

    $up = "UPDATE triagem SET tri_status = 'Em consulta' WHERE tri_id = " . $id . ";";
    $res = mysqli_query($con, $up) or die("Erro: " . mysqli_error($con) . "<br> Query: " . $up);

  }
}

?>
