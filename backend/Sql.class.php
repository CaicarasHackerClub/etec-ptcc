<?php

class Sql {
  function conecta() {
    // $host = "192.168.0.170";
    // $user = "helth";
    // $password = "helth";
    // $db = "helth_hospital";

    $host = "localhost";
    $user = "root";
    $password = "root";
    $db = "hospital1";
    $con  = mysqli_connect($host, $user, $password, $db) or die ("Erro ao conectar: " . mysqli_connect_error());

    return $con;
  }

  function inserir($query) {
    $con = $this->conecta();

    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . "<br> Query: " . $query);

    mysqli_close($con);

    if($res) {
      return TRUE;
    }

    else {
      return FALSE;
    }
  }

  function fetch($query) {
    $con = $this->conecta();

    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . "<br> Query: " . $query);
    $fetch = mysqli_fetch_array($res);

    mysqli_close($con);

    return $fetch;
  }
}

?>
