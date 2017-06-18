<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/consulta.css">
<script type="text/javascript" src="../js/jquery-3.1.1.min.js" ></script>
<script type="text/javascript" src="../js/consulta.js" ></script>
<script type="text/javascript" src="../js/script.js" ></script>
<script type="text/javascript">
  window.history.forward();
</script>
<?php
  include_once 'Sql.class.php';
  include_once 'Fila.class.php';
  include_once 'Consulta.class.php';

  $sql = new Sql();
  $fila = new Fila();
  $cons = new Consulta();

  date_default_timezone_set('America/Sao_Paulo');

  if (isset($_POST['consulta'])) {
    $query = "SELECT * FROM pessoa
      INNER JOIN paciente ON paciente.pessoa_pes_id = pessoa.pes_id
      INNER JOIN atendimento ON atendimento.ate_pac_id = paciente.pac_id
      INNER JOIN triagem ON triagem.tri_ate_id = atendimento.ate_id
      WHERE triagem.tri_id = " . $_POST['triId'] . ";";

    $pac = $sql->fetch($query);

    $st = "UPDATE triagem SET tri_status = 4 WHERE tri_id = " . $pac['tri_id'];
    $sql->inserir($st);

    $data = new Datetime($pac['tri_data']);

    $org = $pac['tri_orgaos_vitais'] == 1 ? "Sim" : "Não";

    $dados = $fila->getCor($pac['tri_classe_risco']);
    $class = $dados[0];

    $idade = date('Y') - $pac['pes_data'];

    $tipoSanguineo = $sql->selecionar("SELECT tis_nome FROM tipo_sanguineo WHERE tis_id = " . $pac['tri_tipo_sanguineo'] . ";");

    ?>

    <div class="consulta-container">

      <div class="dados-triagem">
        <table class="table-consulta">
          <thead>
            <tr>
              <th class="dados-triagem-title" colspan="2">Dados da triagem</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>#</td>
              <td><?php echo $pac['tri_id']; ?></td>
            </tr>
            <tr>
              <td>Classificação de risco</td>
              <td><?= "<div class=\"consulta-color consulta-color-" . strtolower($class) . "\"></div>"?></td>
            </tr>
            <tr>
              <td>Nome</td>
              <td><?php echo $pac['pes_nome']; ?></td>
            </tr>
            <tr>
              <td>Idade</td>
              <td><?php echo $idade ?> anos</td>
            </tr>
            <tr>
              <td>Peso</td>
              <td><?php echo $pac['tri_peso']; ?> kg</td>
            </tr>
            <tr>
              <td>Altura</td>
              <td><?php echo $pac['tri_altura']; ?> m</td>
            </tr>
            <tr>
              <td>Temperatura</td>
              <td><?php echo $pac['tri_temperatura']; ?> ºC</td>
            </tr>
            <tr>
              <td>Pressão</td>
              <td><?php echo $pac['tri_pressao']; ?> mmHg</td>
            </tr>
            <tr>
              <td>Batimento</td>
              <td><?php echo $pac['tri_batimento']; ?> bpm</td>
            </tr>
            <tr>
              <td>Respiração</td>
              <td><?php echo $pac['tri_respiracao']; ?> rpm</td>
            </tr>
            <tr>
              <td>Oxigenação</td>
              <td><?php echo $pac['tri_oxigenacao']; ?> %</td>
            </tr>
            <tr>
              <td>Dor</td>
              <td><?php echo $pac['tri_dor']; ?>/10</td>
            </tr>
            <tr>
              <td>Tipo sanguíneo</td>
              <td><?php echo $tipoSanguineo; ?></td>
            </tr>
            <tr>
              <td>Comprometimento dos orgãos vitais</td>
              <td><?php echo $org; ?></td>
            </tr>
            <tr>
              <td>Doenças</td>
              <td><?php echo $pac['tri_doenca']; ?></td>
            </tr>
            <tr>
              <td>Remédios</td>
              <td><?php echo $pac['tri_remedio']; ?></td>
            </tr>
            <tr>
              <td>Sintomas</td>
              <td><?php echo $pac['tri_sintomas']; ?></td>
            </tr>
            <tr>
              <td>Reclamação</td>
              <td><?php echo $pac['tri_reclamacao']; ?></td>
            </tr>
          </table>
        </tbody>
      </div>

      <div class="dados-consulta">

        <div class="dados-consulta-hora">
          <table class="table-consulta">
            <tr>
              <td>Data</td>
              <td> <?php echo $data->format('d/m/Y'); ?> </td>
            </tr>
            <tr>
              <td>Hora</td>
              <td> <?php echo $pac['tri_hora']; ?> </td>
            </tr>
          </table>
        </div>

        <div class="dados-consulta-form">
          <form action="consulta.php" method="post">
            <input type="hidden" name="triId" value="<?php echo $pac['tri_id'] ?>">
            <input type="hidden" name="chegada" value="<?php echo date('H:m:i') ?>">
            <input type="hidden" name="data" value="<?php echo date('Y-m-d') ?>">
            <label> Reclamação: </label>
            <input type="text" name="reclamacao"> <br>
            <label> Sintomas: </label>
            <input type="text" name="sintomas"> <br>
            <label> Diagnóstico presuntivo: </label>
            <input type="text" name="diagnostico" required> <br>
            <label> Encaminhamento: </label>
            <?php $sql->selectbox('encaminhamento', 0); ?>
            <label> Comentário: </label>
            <input type="text" name="comentario"> <br>

            <h3> Receita </h3>

            <input type="hidden" class="btn-consulta med" name="med" value="">
            <button type="button" class="btn-consulta adicionar"> Adicionar medicamento </button>
            <button type="button" class="btn-consulta remover"> Remover medicamento </button>
            <button type="button" class="btn-consulta limpar"> Limpar </button> <br>

            <div class="receita"></div>

            <input type="submit" class="btn-consulta" name="cancelar" value="Cancelar consulta">
            <input type="submit" class="btn-consulta" name="encerrar" value="Encerrar consulta">
          </form>
        </div>
      </div>
    </div>

    <?php
  } elseif (isset($_POST['encerrar']) || isset($_POST['cancelar'])) {
    $chegada = $_POST['chegada'];
    $data = $_POST['data'];
    $saida = date('H:m:i');
    $reclamacao = isset($_POST['reclamacao']) ? trim($_POST['reclamacao']) : "";
    $sintomas = isset($_POST['sintomas']) ? trim($_POST['sintomas']) : "";
    $diagnostico = isset($_POST['diagnostico']) ? trim($_POST['diagnostico']) : "";
    $encaminhamento = $_POST['encaminhamento'];
    $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : "";
    $triId = $_POST['triId'];

    session_start();

    $selMedId = "SELECT med_id FROM medico
    INNER JOIN funcionario ON funcionario.fun_id = medico.funcionario_fun_id
    INNER JOIN usuario ON usuario.funcionario_id = funcionario.fun_id WHERE usu_id = " . $_SESSION['id_usu'] . ";";

    $medId = $sql->selecionar($selMedId);

    $cons->setChegada($chegada);
    $cons->setData($data);
    $cons->setSaida($saida);
    $cons->setReclamacao($reclamacao);
    $cons->setSintomas($sintomas);
    $cons->setDiagnostico($diagnostico);
    $cons->setEncId($encaminhamento);
    $cons->setComentario($comentario);
    $cons->setTriId($triId);
    $cons->setMedId($medId);

    $mensagem = "";

    if (isset($_POST['encerrar'])) {
      $st = "UPDATE triagem SET tri_status = 5 WHERE tri_id = " . $cons->getTriId();

      $query = "INSERT INTO consulta(con_hora_chegada, con_hora_saida, con_data, con_reclamacao,
        con_doenca, con_diagnostico, con_enc_id, con_comentario, con_tri_id, con_med_id) VALUES('"
        . $cons->getChegada() . "', '" . $cons->getSaida() . "', '" . $cons->getData() . "', '"
        . $cons->getReclamacao() . "', '" . $cons->getSintomas() . "', '" . $cons->getDiagnostico() . "', "
        . $cons->getEncId() . ", '" . $cons->getComentario() . "', " . $cons->getTriId() . ", " . $cons->getMedId() . ");";

      if ($sql->num("SELECT con_id FROM consulta WHERE con_tri_id = " . $cons->getTriId() . ";") == 0) {
        $con = $sql->conecta();

        mysqli_query($con, $query) or die("Erro");

        if ($_POST['med'] > 0) {
          include_once 'Receita.class.php';
          $rec = new Receita();

          for ($i = 1; $i <= $_POST['med']; $i++) {
            $rec->setQuantidade($_POST['quantidade' . $i]);
            $rec->setUnidade($_POST['unidade' . $i]);
            $rec->setMedicamento($_POST['medicamento' . $i]);
            $rec->setTempo($_POST['tempo' . $i]);
            $rec->setUnidadeTempo($_POST['unidadeTempo' . $i]);
            $rec->setPeriodo($_POST['periodo' . $i]);

            $rec->montar();
          }

          echo $rec->getReceita() . "<br>";

          $rec->setData(date('Y-m-d'));
          $rec->setConsultaId(mysqli_insert_id($con));

          $queryReceita = "INSERT INTO receita(rec_data, rec_prescricao, rec_consulta) VALUES('"
            . $rec->getData() . "', '" . $rec->getReceita() . "', " . $rec->getConsultaId() . ");";

          $sql->inserir($queryReceita);
        }

        mysqli_close($con);

        $mensagem = "Inserido com sucesso.";
      } else {
        $mensagem = "O paciente já passou pela consulta.";
      }

    } elseif (isset($_POST['cancelar'])) {
      $st = "UPDATE triagem SET tri_status = 6 WHERE tri_id = " . $cons->getTriId();
      $mensagem = "Consulta cancelada.";
    }

    $sql->inserir($st);
    echo $mensagem;
  } else {
    ?>
    <meta http-equiv="refresh" content="30">
    <?php

    $query = "SELECT * FROM pessoa
      INNER JOIN paciente ON paciente.pessoa_pes_id = pessoa.pes_id
      INNER JOIN atendimento ON atendimento.ate_pac_id = paciente.pac_id
      INNER JOIN triagem ON triagem.tri_ate_id = atendimento.ate_id
      WHERE triagem.tri_status = 3";

    $res = $sql->inserir($query);

    ?>

    <div class="fila-consulta">
      <table class="table-consulta">

        <thead>
          <th>#</th>
          <th>Nome</th>
          <th>Classificação</th>
          <th>Tempo de espera</th>
          <th></th>
        </thead>

        <tbody>
          <?php

          if ($sql->num($query) == 0) {
            echo
            "<tr>
              <td class='fila-consulta-mensagem' colspan='5'> Não há ninguém aguardando atendimento </td>
             </tr>";
          } else {
            while ($pac = mysqli_fetch_array($res)) {
              $espera = $fila->calc($pac['tri_data'], $pac['tri_hora']);
              $cor = $fila->getCor($pac['tri_classe_risco']);
              $class = $cor[0];

              echo
              "<form action='consulta.php' method='post'>
                <tr>
                  <td>" . $pac['tri_id'] . "</td>
                  <td>" . $pac['pes_nome'] . "</td>
                  <td><div class=\"consulta-color consulta-color-" . strtolower($class) . "\"></div></td>
                  <td>" . $espera  . "/" . $cor[1] . " min </td>
                  <input type='hidden' value='" . $pac['tri_id'] . "' name='triId'>
                  <td> <input class='btn-chamada' type='submit' name='consulta' value='Iniciar consulta'> </td>
                </tr>
              </form>";
            }
          }

          ?>
        </tbody>
      </table>
    </div>

    <?php
  }
