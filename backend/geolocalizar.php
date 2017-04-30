<?php
  header("content-type:application/json");

  include_once 'Sql.class.php';

  $pessoa = isset($_GET['pessoa']) ? $_GET['pessoa'] : null;

  $mysqli = new Sql;
  $con = $mysqli->conecta();

  $query = "SELECT e.end_rua, e.end_numero, e.end_cidade "
         . "FROM endereco e "
         . "INNER JOIN pessoa p "
         . "ON e.pessoa_pes_id = p.pes_id "
         . "WHERE p.pes_nome = '$pessoa';";

  $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . ", Query: $query");
  $arrEndereco = mysqli_fetch_assoc($res);

  mysqli_close($con);

  echo json_encode($arrEndereco);

  exit();
