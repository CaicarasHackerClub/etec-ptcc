<?php
  header("content-type:application/json");

  include_once 'Sql.class.php';
  $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;

  function getEndereco($pessoa) {

    $mysqli = new Sql;
    $con = $mysqli->conecta();

    $query = "SELECT e.end_rua, e.end_numero, e.end_bairro, e.end_cidade, e.end_cep "
    . "FROM endereco e "
    . "INNER JOIN pessoa p "
    . "ON e.pessoa_pes_id = p.pes_id "
    . "WHERE p.pes_nome = '$pessoa';";

    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . ", Query: $query");

    mysqli_close($con);

    $row = mysqli_fetch_assoc($res);
    $row['end_cidade'] = getCidade($row['end_cidade']);

    return json_encode($row);
  }

  function getDemografia() {

    $mysqli = new Sql;
    $con = $mysqli->conecta();

    $query = "SELECT p.pes_nome, e.end_rua, e.end_numero, e.end_bairro, e.end_cidade, e.end_cep "
    . "FROM endereco e "
    . "INNER JOIN pessoa p "
    . "ON e.pessoa_pes_id = p.pes_id;";

    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . ", Query: $query");

    mysqli_close($con);

    $demo = array();
    while ($row = mysqli_fetch_assoc($res)) {
      $row['end_cidade'] = getCidade($row['end_cidade']);
      $demo[] = json_encode($row);
    }

    return $demo;
  }

  function getCidade($cid_id) {

    $mysqli = new Sql;
    $con = $mysqli->conecta();

    $query = "SELECT `cid_nome` FROM `cidade` WHERE `cid_id` = '$cid_id';";
    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . ", Query: $query");

    mysqli_close($con);

    return mysqli_fetch_row($res)[0];
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
