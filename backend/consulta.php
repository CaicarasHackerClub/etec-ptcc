<?php
  include_once 'Sql.class.php';
  include_once 'Consulta.class.php';

  $sql = new Sql();
  $cons = new Consulta();

  $res = $sql->inserir("SELECT * FROM triagem WHERE tri_status = 3");

  if (isset($_POST['consulta'])) {
    ?>

    <!-- Formulário -->

    <?php
  } else {

    ?>

    <table border="1">
      <thead>
        <th> # </th>
        <th> Nome </th>
        <th> Classificação </th>
        <th> Tempo de espera </th>
      </thead>

    <?php

    while ($pac = mysqli_fetch_array($res)) {
      $espera = $cons->calc($_pac['data'], $_pac['hora']);
      $cons->setPac($pac['tri_id'], $espera, $pac['tri_classe_risco']);

      $pac = $cons->getPac();

      echo
      "<form action='consulta.php' method='post'>
        <tr>
          <td>" . $pac[0] . "</td>
          <td>" . $pac[1] . "</td>
          <td>" . $pac[2] . "</td>
          <td>" . $pac[3] . "/" . $pac[4]. "</td>
          <input type='hidden' value='" . $pac[0] . "' name='id'>
          <td> <input type='submit' name='consulta'> </td>
        </tr>
      </form>";

    }

    ?>

    </table>

    <?php
  }
