<?php
  include_once 'Sql.class.php';
  include_once 'Consulta.class.php';

  $cons = new Consulta();
  $fila = new Fila();
  $sql = new Sql();

  date_default_timezone_set('America/Sao_Paulo');

  if (isset($_POST['consulta'])) {
    $query = "SELECT * FROM  triagem WHERE tri_id = " . $_POST['triId'] . ";";

    $pac = $sql->fetch($query);

    $st = "UPDATE triagem SET tri_status = 4 WHERE tri_id = " . $pac['tri_id'];
    $cons->inserir($st);

    $data = new Datetime($pac['tri_data']);

    $org = $pac['tri_orgaos_vitais'] == 1 ? "Sim" : "Não";

    // $class = "";

    // switch ($pac['tri_classe_risco']) {
    //   case 1:
    //     $class = 'Azul';
    //     break;
    //   case 2:
    //     $class = 'Verde';
    //     break;
    //   case 3:
    //     $class = 'Amarelo';
    //     break;
    //   case 4:
    //     $class = 'Laranja';
    //     break;
    //   case 5:
    //     $class = 'Vermelho';
    //     break;
    // }

    $dados = $fila->getCor($pac['tri_classe_risco']);
    $class = $dados[0];

    $queryPac = "SELECT pessoa.pes_nome, pessoa.pes_data FROM pessoa
      INNER JOIN paciente ON paciente.pessoa_pes_id = pessoa.pes_id
      INNER JOIN atendimento ON atendimento.ate_pac_id = paciente.pac_id
      INNER JOIN triagem ON triagem.tri_ate_id = atendimento.ate_id
      WHERE triagem.tri_id = " . $_POST['triId'];

    $fetch = $sql->fetch($queryPac);
    $nome = $fetch['pes_nome'];
    $idade = date('Y') - $fetch['pes_data'];

    ?>
      <h2> Dados da triagem </h2>

      <table>
        <tr>
          <th>Data</th>
          <td> <?php echo $data->format('d/m/Y'); ?> </td>
        </tr>
        <tr>
          <th>Hora</th>
          <td> <?php echo $pac['tri_hora']; ?> </td>
        </tr>
      </table>

      <table>
        <tr>
          <th>#</th>
          <td> <?php echo $pac['tri_id']; ?></td>
        </tr>
        <tr>
          <th>Classificação de risco</th>
          <td> <?php echo $class; ?> </td>
        </tr>
        <tr>
          <th>Nome</th>
          <td> <?php echo $nome; ?> </td>

        </tr>
        <tr>
          <th>Idade</th>
          <td> <?php echo $idade ?> anos </td>
        </tr>
        <tr>
          <th>Peso</th>
          <td> <?php echo $pac['tri_peso']; ?> kg </td>
        </tr>
        <tr>
          <th>Altura</th>
          <td> <?php echo $pac['tri_altura']; ?> m </td>
        </tr>
        <tr>
          <th>Temperatura</th>
          <td> <?php echo $pac['tri_temperatura']; ?> ºC </td>
        </tr>
        <tr>
          <th>Pressão</th>
          <td> <?php echo $pac['tri_pressao']; ?> mmHg </td>
        </tr>
        <tr>
          <th>Batimento</th>
          <td> <?php echo $pac['tri_batimento']; ?> bpm </td>
        </tr>
        <tr>
          <th>Respiração</th>
          <td> <?php echo $pac['tri_respiracao']; ?> rpm </td>
        </tr>
        <tr>
          <th>Oxigenação</th>
          <td> <?php echo $pac['tri_oxigenacao']; ?> % </td>
        </tr>
        <tr>
          <th>Dor</th>
          <td> <?php echo $pac['tri_dor']; ?>/10 </td>
        </tr>
        <tr>
          <th>Comprometimento dos orgãos vitais</th>
          <td> <?php echo $org; ?> </td>
        </tr>

      </table>

      <form action="consulta.php" method="post">
        <input type="hidden" name="triId" value="<?php echo $_POST['triId'] ?>">
        <input type="hidden" name="chegada" value="<?php echo date('H:m:i') ?>">
        <input type="hidden" name="data" value="<?php echo date('Y-m-d') ?>">
        <label> Encaminhamento </label>
        <?php $sql->selectbox('encaminhamento'); ?>
        <label> Comentário </label>
        <input type="text" name="comentario"> <br>
        <input type="submit" name="cancelar" value="Cancelar consulta">
        <input type="submit" name="encerrar" value="Encerrar consulta">
      </form>
    <?php
  } elseif (isset($_POST['encerrar']) || isset($_POST['cancelar'])) {
    $chegada = $_POST['chegada'];
    $data = $_POST['data'];
    $saida = date('H:m:i');
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : "";
    $triId = $_POST['triId'];
    $encaminhamento = $_POST['encaminhamento'];

    $cons->setChegada($chegada);
    $cons->setData($data);
    $cons->setSaida($saida);
    $cons->setComentario($comentario);
    $cons->setTriId($triId);
    $cons->setMedId(1);
    $cons->setEncId($encaminhamento);

    $mensagem = "";

    if (isset($_POST['encerrar'])) {
      $st = "UPDATE triagem SET tri_status = 5 WHERE tri_id = " . $cons->getTriId();

      $query = "INSERT INTO consulta(con_hora_chegada, con_hora_saida, con_data, con_comentario, con_tri_id, con_med_id, con_enc_id)
        VALUES('" . $cons->getChegada() . "', '" . $cons->getSaida() . "', '" . $cons->getData() . "', '" . $cons->getComentario() .
        "', " . $cons->getTriId() . ", " . $cons->getMedId() . ", " . $cons->getEncId() . ");";

      $sql->inserir($query);
      $mensagem = "Inserido com sucesso.";
    } elseif (isset($_POST['cancelar'])) {
      $st = "UPDATE triagem SET tri_status = 6 WHERE tri_id = " . $cons->getTriId();
      $mensagem = "Consulta cancelada.";
    }

    $sql->inserir($st);
    echo $mensagem;
  } else {
    // $query = "SELECT * FROM triagem WHERE tri_status = 3";
    $query = "SELECT * FROM pessoa
      INNER JOIN paciente ON paciente.pessoa_pes_id = pessoa.pes_id
      INNER JOIN atendimento ON atendimento.ate_pac_id = paciente.pac_id
      INNER JOIN triagem ON triagem.tri_ate_id = atendimento.ate_id
      WHERE triagem.tri_status = 3";

    $res = $sql->inserir($query);

    ?>

    <table border="1">
      <thead>
        <th> # </th>
        <th> Nome </th>
        <th> Classificação </th>
        <th> Tempo de espera </th>
      </thead>
      <tbody>

    <?php

    if ($sql->num($query) == 0) {
      echo
      "<tr>
        <td colspan='4'> Não há ninguém aguardando atendimento </td>
      </tr>";
    } else {
      while ($pac = mysqli_fetch_array($res)) {
        $espera = $cons->calc($pac['tri_data'], $pac['tri_hora']);
        $dados = $fila->getCor($pac['tri_classe_risco']);
        $class = $dados[0];

        echo
        "<form action='consulta.php' method='post'>
          <tr>
            <td>" . $pac['tri_id'] . "</td>
            <td>" . $pac['pes_nome'] . "</td>
            <td>" . $class . "</td>
            <td>" . $espera  . " min </td>
            <input type='hidden' value='" . $pac['tri_id'] . "' name='triId'>
            <td> <input type='submit' name='consulta' value='Iniciar consulta'> </td>
          </tr>
        </form>";

      }
    }

    ?>

      </tbody>
    </table>

    <?php
  }
