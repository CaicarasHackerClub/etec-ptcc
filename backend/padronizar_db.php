<?php

include_once 'funcoes.php';
include_once 'Sql.class.php';

$sql = new Sql;
$con = $sql->conecta();

padronizar('estado', 'est', $con);
padronizar('cidade', 'cid', $con);

$con->close();

function padronizar($tabela, $prefixo, $con) {
  $nome = $prefixo . '_nome';
  $id = $prefixo . '_id';

  $sel = "SELECT $id, $nome FROM $tabela";
  $res = mysqli_query($con, $sel);

  while ($registro = mysqli_fetch_assoc($res)) {
    $sel = "UPDATE $tabela
    SET $nome = '" . tiraAcentos($registro[$nome]) . "'
    WHERE $id = " . $registro[$id];

    mysqli_query($con, $sel);
  }

  $sel = "SELECT $id, $nome FROM $tabela";
  $res = mysqli_query($con, $sel);

  while ($registro = mysqli_fetch_assoc($res)) {
    echo $registro[$id] . ', ' . $registro[$nome] . '<br />';
  }
}
