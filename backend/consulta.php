<?php
  include_once 'Sql.class.php';
  include_once 'Consulta.class.php';

  $sql = new Sql();
  $cons = new Consulta();

  if (isset($_POST['consulta'])) {
    // DAdos da triagem
    ?>
      <form action="consulta.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
        <input type="hidden" name="chegada" value="<?php echo date('H:m:i') ?>">
        <input type="hidden" name="data" value="<?php echo date('Y-m-d') ?>">
        <label> Encaminhamento </label>
        <input type="text" name="encaminhamento"> <br>
        <label> Comentário </label>
        <input type="text" name="comentario">
        <input type="submit" name="encerrar" value="Encerrar consulta">
      </form>
    <?php
  } else if (isset($_POST['encerrar'])) {
    $chegada = $_POST['chegada'];
    $data = $_POST['data'];
    $saida = date('H:m:i');
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : "";
    $triId = $_POST['id'];
    $encaminhamento = $_POST['encaminhamento'];

    $cons->setChegada($chegada);
    $cons->setData($data);
    $cons->setSaida($saida);
    $cons->setComentario($comentario);
    $cons->setTriId($triId);
    $cons->setMedId(1);
    $cons->setEncId($encaminhamento);

    echo "Query: " . $query . "<br>";

    $query = "INSERT INTO consulta(con_hora_chegada, con_hora_saida, con_data, con_comentario, con_tri_id, con_med_id, con_enc_id)
      VALUES('" . $cons->getChegada() . "', '" . $cons->getSaida() . "', '" . $cons->getData() . "', '" . $cons->getcomentario() .
      "', " . $cons->getTriId() . ", " . $cons->getMedId() . ", " . $cons->getEncId() . ");";

    $cons->inserir($query);

    echo "Inserido com sucesso!";
  } else {
    $query = "SELECT * FROM triagem WHERE tri_status = 3";
    $res = $sql->inserir($query);

    ?>

    <table border="1">
      <thead>
        <th> # </th>
        <th> Nome </th>
        <th> Classificação </th>
        <th> Tempo de espera </th>
      </thead>

    <?php

    if ($cons->num($query) == 0) {
      echo
      "<tr>
        <td colspan='4'> Não há ninguém aguardando atendimento </td>
      </tr>";
    } else {
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
    }

    ?>

    </table>

    <?php
  }
