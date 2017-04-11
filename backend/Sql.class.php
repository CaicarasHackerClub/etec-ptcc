<?php

class Sql {
    // $host = "192.168.0.170";
    // $user = "helth";
    // $password = "helth";
    // $db = "helth_hospital";
      //
  function conecta() {
    include 'conectar.php';
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

  function selecionar($query) {
    $con = $this->conecta();
    $res = mysqli_query($con, $query) or die ("Erro selecionar  r()" . $query . mysqli_error($con));
    $qtd = mysqli_num_rows($res);

    if($qtd == 0) {
      return $qtd;
    }

    else {
      $posto = mysqli_fetch_array($res);
      return $posto[0];
    }

    mysqli_close($con);
  }
}

?>
