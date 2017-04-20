<?php
  include_once 'Sql.class.php';
  include_once 'Fila.class.php';

  $sql = new Sql();
  $fila = new Fila();

  // $cor[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Vermelho' AND tri_status = 'Em espera'";
  $cor[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Laranja' AND tri_status = 'Em espera';";
  $cor[1] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Amarelo' AND tri_status = 'Em espera';";
  $cor[2] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Verde' AND tri_status = 'Em espera'";;
  $cor[3] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Azul' AND tri_status = 'Em espera';";

  $tempo = array(10, 60, 120, 240);

  $pacMax = 5;

  $emConsulta = $sql->num("SELECT tri_id FROM triagem WHERE tri_status = 'Em consulta';");
  $emEspera = $sql->num("SELECT tri_id FROM triagem WHERE tri_status = 'Em espera'");

  $con = $sql->conecta();

  for($i = 0; $i < count($cor); $i++) {
    $res = mysqli_query($con, $cor[$i]);

    while($pac = mysqli_fetch_array($res)) {
      $data = $pac['tri_data'];
      $hora = $pac['tri_hora'];
      $espera = $fila->espera($data, $hora);

      $pesId = $sql->selecionar("SELECT pessoa_pes_id FROM paciente WHERE pac_id = " . $pac['id_paciente'] . ";");
      $nome = $sql->selecionar("SELECT pes_nome FROM pessoa WHERE pes_id = " . $pesId . ";");

      $emConsulta = $sql->num("SELECT tri_id FROM triagem WHERE tri_status = 'Em consulta';");
      $emEspera = $sql->num("SELECT tri_id FROM triagem WHERE tri_status = 'Em espera'");

      if($emConsulta < $pacMax || $espera >= $tempo[$i]) {
        $fila->chamar($pac['tri_id']);
        echo "Chamada: $nome, ID: " . $pac['tri_id'] . ", tempo de espera: $espera . <br>";
      }
      else {
        echo "Na fila de espera:  $nome, ID: " . $pac['tri_id'] . ", tempo de espera:  $espera/$tempo[$i] <br>";

      }
    }
  }

  echo "Pessoas em consulta: $emConsulta <br>";
  echo "Pessoas em espera: $emEspera <br>";
?>
