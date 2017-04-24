<?php

include_once 'Sql.class.php';

class Fila extends Sql {
  private $naFila;
  private $emConsulta;
  private $pacMax;

  private $id;
  private $nome;
  private $chegada;
  private $espera;
  private $tempoMax;
  private $cor;
  private $numCor;

  private $sel;
  private $tempo = array(10, 60, 120, 240);

  private $tabela = "
  <table border='1'>
    <caption> Fila de espera </caption>
    <thead>
      <th> # </th>
      <th> Nome </th>
      <th> Chegada </th>
      <th> Tempo de espera </th>
      <th> Classificação </th>
    </thead>
    <tbody>";

  function __construct() {
    $this->atualizar();
    $this->sel[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 4 AND tri_status = 'Em espera';";
    $this->sel[1] = "SELECT * FROM triagem WHERE tri_classe_risco = 3 AND tri_status = 'Em espera';";
    $this->sel[2] = "SELECT * FROM triagem WHERE tri_classe_risco = 2 AND tri_status = 'Em espera'";
    $this->sel[3] = "SELECT * FROM triagem WHERE tri_classe_risco = 1 AND tri_status = 'Em espera';";
  }

  function getTempo() {
    return $this->tempo;
  }

  function getSel() {
    return $this->sel;
  }

  function setPacMax($pacMax) {
    $this->pacMax = $pacMax;
  }

  function getPacMax() {
    return $this->pacMax;
  }

  function setPac($id, $pes, $espera, $tempoMax) {
    $this->id = $id;

    $pesId = parent::selecionar("SELECT pessoa_pes_id FROM paciente WHERE pac_id = " . $pes . ";");
    $this->nome = parent::selecionar("SELECT pes_nome FROM pessoa WHERE pes_id = " . $pesId . ";");

    $this->espera = $espera;
    $this->tempoMax = $tempoMax;

    switch ($this->tempoMax) {
      case 10:
        $this->cor = "Laranja";
        $this->numCor = 4;
        break;
      case 60:
        $this->cor = "Amarelo";
        $this->numCor = 3;
        break;
      case 120:
        $this->cor = "Verde";
        $this->numCor = 2;
        break;
      case 240:
        $this->cor = "Azul";
        $this->numCor = 1;
        break;
    }
  }

  function getEspera() {
    return $this->espera;
  }

  function getTempoMax() {
    return $this->tempoMax;
  }

  function getNaFila() {
    return $this->naFila;
  }

  function getEmConsulta() {
    return $this->emConsulta;
  }

  function calc($dataPac, $horaPac) {
    date_default_timezone_set('America/Sao_Paulo');

    $data = new DateTime($dataPac);
    $horario = new DateTime($horaPac);

    $this->chegada = $data->format('d/m/Y') . " - " . $horario->format('H:i');

    $dias = $data->diff(new DateTime(date('Y-m-d')));
    $horas = $horario->diff(new DateTime(date('H:i')));

    $tempo = $horas->format('%H:%I');
    $tempo = explode(':', $tempo);
    $h = $tempo[0];
    $m = $tempo[1];
    $h += $dias->d * 24;

    $tempoFinal = $h*60 + $m;

    if (strlen($tempoFinal) < 2) {
      $tempoFinal = "0" . $tempoFinal;
    }

    return $tempoFinal;
  }

  function reclassificar($id, $class) {
    if(!empty($class)) {
      if ($class == 5) {
        parent::inserir("UPDATE triagem SET tri_classe_risco = " . $class . ", tri_status = 'Em consulta' WHERE tri_id = " . $id . ";");
      } else {
        parent::inserir("UPDATE triagem SET tri_classe_risco = " . $class . " WHERE tri_id = " . $id . ";");
      }

      $this->atualizar();
    }
  }

  function deletar($id) {
    parent::inserir("DELETE FROM triagem WHERE tri_id = " . $id . ";");
  }

  function chamar() {
    parent::inserir("UPDATE triagem SET tri_status = 'Em consulta' WHERE tri_id = " . $this->id . ";");
    echo "Chamada: #" . $this->id . ", " . $this->nome . ", tempo de espera: " . $this->espera . "/" . $this->tempoMax . " minutos <br>";
  }

  function cat() {
    $this->tabela .= "
    <tr>
      <form action='fila.php' method='post'>
        <td>" . $this->id . "</td>
        <td>" . $this->nome . "</td>
        <td>" . $this->chegada . "</td>
        <td>" . $this->espera . "/" . $this->tempoMax . " minutos </td>
        <td>" . $this->cor . "</td>
        <td>
          <input type='hidden' name='id' value='" . $this->id . "'>
          <input type='radio' name='class' value='1'";
          // $this->tabela .= $this->numCor == 1 ? ' checked' : "";
          $this->tabela .= "> Azul
          <input type='radio' name='class' value='2'";
          // $this->tabela .= $this->numCor == 2 ? ' checked' : "";
          $this->tabela .= "> Verde
          <input type='radio' name='class' value='3'";
          // $this->tabela .= $this->numCor == 3 ? ' checked' : "";
          $this->tabela .= "> Amarelo
          <input type='radio' name='class' value='4'";
          // $this->tabela .= $this->numCor == 4 ? ' checked' : "";
          $this->tabela .= "> Laranja
          <input type='radio' name='class' value='5'";
          // $this->tabela .= $this->numCor == 5 ? ' checked' : "";
          $this->tabela .= ">Vermelho
          <input type='submit' name='reclassificar' value='Reclassificar'>
        </td>
        <td>
          <input type='submit' name='deletar' value='Deletar'>
        </td>
      </form>
    </tr>";
  }

  function atualizar() {
    $this->naFila = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 'Em espera'");
    $this->emConsulta = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 'Em consulta';");
  }

  function imprimir() {
    $this->atualizar();

    if ($this->naFila == 0 || $this->emConsulta < 5) {
      $this->tabela .= "
      <tr>
        <td colspan='5'> Não há ninguém na fila </td>
      </tr>
      ";
    }

    $this->tabela .= "</tbody> </table>";

    echo $this->tabela;
  }
}
