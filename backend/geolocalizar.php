<?php
  header("content-type:application/json");

  include_once 'Sql.class.php';
  $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;

  function getEndereco($pessoa) {

    $mysqli = new Sql;
    $con = $mysqli->conecta();

    $query = "SELECT e.end_rua, e.end_numero, e.end_cidade "
    . "FROM endereco e "
    . "INNER JOIN pessoa p "
    . "ON e.pessoa_pes_id = p.pes_id "
    . "WHERE p.pes_nome = '$pessoa';";

    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . ", Query: $query");

    mysqli_close($con);

    return mysqli_fetch_array($res);
  }

  if (!is_null($tipo)) {

    $json = null;

    switch ($tipo) {
      case 'endereço':
        $pessoa = isset($_GET['pessoa']) ? $_GET['pessoa'] : null;
        if (!is_null($pessoa)) {
          $json = getEndereco($pessoa);
        }
        break;

      default:
        # code...
        break;
    }

    echo json_encode($json);
  }

  exit();
