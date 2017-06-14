<?php

class Sql {
  // $host = "192.168.0.170";
  // $user = "helth";
  // $password = "helth";
  // $db = "helth_hospital";

  public function conecta() {
    include 'conectar.php';
    return $con;
  }

  public function selecionar($query) {
    $con = $this->conecta();
    $res = mysqli_query($con, $query) or die("Erro selecionar  r()" . $query . mysqli_error($con));
    $qtd = mysqli_num_rows($res);

    mysqli_close($con);

    if ($qtd == 0) {
      return $qtd;
    } else {
      $posto = mysqli_fetch_array($res);
      return $posto[0];
    }
  }

  public function inserir($query) {
    $con = $this->conecta();
    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . "<br> Query: " . $query);

    mysqli_close($con);

    return $res;
  }

  public function fetch($query) {
    $con = $this->conecta();
    $res = mysqli_query($con, $query) or die("Erro: " . mysqli_error($con) . "<br> Query: " . $query);
    $fetch = mysqli_fetch_array($res);

    mysqli_close($con);

    return $fetch;
  }

  public function num($query) {
    $con = $this->conecta();
    $res = mysqli_query($con, $query);

    mysqli_close($con);

    return mysqli_num_rows($res);
  }

  public function insertId() {
    $con = $this->conecta();
    $id = mysqli_insert_id($con);

    mysqli_close($con);

    return $id;
  }

  public function selectbox($tabela,$id) {
    $con = $this->conecta();

    $sel = "SELECT * FROM " . $tabela;
    $res = mysqli_query($con, $sel) or die("Erro : ");

    echo "<select class='inp_class select' name='" . $tabela . "'>\n";

    while ($selecao = mysqli_fetch_array($res)) {
      if ($id == $selecao[0]) {
        $chk = " selected=\"selected\"";
      } else {
        $chk = "";
      }
      echo "<option value=" . $selecao[0] . $chk . ">" . $selecao[1] . "</option>\n";
    }

    echo "</select><br>\n";

    mysqli_close($con);
  }

  public function blank($campos) {
    $b = 0;
    $s = "";

    foreach ($campos as $key => $c) {
      if ($c == "") {
        $b++;
        $s .= $b . '. O campo "' . $key . '" não pode ser deixado em branco.\n';
      }
    }

    if ($s != "") {
      $s = $b . ' erro(s):\n\n' . $s;
      echo "
        <script type='text/javascript'>
          alert('$s');
          history.back();
        </script>
      ";
    }
  }
}
