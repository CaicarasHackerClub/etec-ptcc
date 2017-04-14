<?php
  include_once 'Sql.class.php';
  include_once 'Fila.class.php';

  $sql = new Sql();
  $fila = new Fila();

  // $cor[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Vermelho' AND tri_status = 'Em espera'";
  $cor[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Laranja' AND tri_status = 'Em espera'";
  $cor[1] = "SELECT * FROM triagem WHERE tri_classe_risco = 'amarelo' AND tri_status = 'Em espera'";
  $cor[2] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Verde' AND tri_status = 'Em espera'";
  $cor[3] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Azul' AND tri_status = 'Em espera'";

  $tempo = array(10, 60, 120, 240);

  $pacMax = 5;

  // $fetch = $sql->fetch($laranja);

  $con = $sql->conecta();

  for($i = 0; $i < count($cor); $i++) {
    $res = mysqli_query($con, $cor[$i]);
    $fetch = mysqli_fetch_array($res);
    if(mysqli_num_rows($res) != 0) {
      while($pac = mysqli_fetch_array($res)) {
        $data = $pac['tri_data'];
        $hora = $pac['tri_hora'];
        $espera = $fila->espera($data, $hora);

        $pesId = $sql->selecionar("SELECT pessoa_pes_id FROM paciente WHERE pac_id = ".$pac['id_paciente'].";");
        $nome = $sql->selecionar("SELECT  pes_nome FROM pessoa WHERE pes_id = ".$pesId.";");

        $res2 = mysqli_query($con, "SELECT tri_id FROM triagem WHERE tri_status = 'Em consulta'");
        $emConsulta = mysqli_num_rows($res2);

        if($emConsulta < $pacMax || $espera >= $tempo[$i]) {
          $fila->chamar($pac['tri_id']);
          echo "Chama, nome: " . $nome . ", ID: " . $pac['tri_id'] . ", tempo de espera: " . $espera . "<br>";

        }
        else {
          echo "Na fila de espera, nome: " . $nome . ", ID: " . $pac['tri_id'] . ", tempo de espera: " . $espera . "<br>";

        }

        echo "Pessoas em consulta: " . $emConsulta . "<br>";
      }
    }
  }
?>
