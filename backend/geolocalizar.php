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

    return mysqli_fetch_assoc($res);
  }

  function getDemografia() {

    $mysqli = new Sql;
    $con = $mysqli->conecta();

    $query = "SELECT p.pes_nome, e.end_rua, e.end_numero, e.end_cidade "
    . "FROM endereco e "
    . "INNER JOIN pessoa p "
    . "ON e.pessoa_pes_id = p.pes_id;";

    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . ", Query: $query");

    mysqli_close($con);

    $demo = array();
    while ($row = mysqli_fetch_assoc($res)) {
      $demo[] = json_encode($row);
    }

    return $demo;
  }

  if (!is_null($tipo)) {

    switch ($tipo) {
      case 'endereço':
        $pessoa = isset($_GET['pessoa']) ? $_GET['pessoa'] : null;
        if (!is_null($pessoa)) {
          $endereco = getEndereco($pessoa);
          echo json_encode($endereco);
        }
        break;

      case 'demografia':
        $demo = getDemografia();
        echo json_encode($demo);
        break;

      default:
        # code...
        break;
    }
  }

  exit();
