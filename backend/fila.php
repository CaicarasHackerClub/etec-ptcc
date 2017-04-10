<?php
  include_once 'Sql.class.php';

  $sql = new Sql();

  $vermelho = "SELECT * FROM triagem WHERE tri_classe_risco = 'Vermelho' AND status = 'Em espera'";
  $laranja = "SELECT * FROM triagem WHERE tri_classe_risco = 'Laranja' AND status = 'Em espera'";
  $amarelo = "SELECT * FROM triagem WHERE tri_classe_risco = 'amarelo' AND status = 'Em espera'";
  $verde = "SELECT * FROM triagem WHERE tri_classe_risco = 'Verde' AND status = 'Em espera'";
  $azul = "SELECT * FROM triagem WHERE tri_classe_risco = 'Azul' AND status = 'Em espera'";

  $data = new DateTime('2017-04-10');
  $hora = new DateTime('14:02');

  $dias = $data->diff(new DateTime(date('Y-m-d')));
  $horas = $hora->diff(new DateTime(date('H:i')));

  echo $dias->d . ' dia(s) <br>';
  echo $horas->format('%H:%I') . '<br>';

  $tempo = $horas->format('%H:%I');
  $tempo = explode(':', $tempo);
  $h = $tempo[0];
  $m = $tempo[1];

  $h += $dias->d * 24;
  echo $h . ' horas e ' . $m . ' minutos <br>';

  $tempoFinal = $h*60 + $m;
  echo 'Tempo total: ' . $tempoFinal . ' minutos';

?>
