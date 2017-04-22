<?php

include_once 'Sql.class.php';

class Fila extends Sql {
  private $naFila;
  private $emConsulta;
  private $pacMax;

  private $id;
  private $nome;
  private $espera;
  private $tempoMax;

  private $sel;
  private $tempo = array(10, 60, 120, 240);

  private $tabela = "
  <table border='1'>
  <caption> Fila de espera </caption>
  <thead>
    <th> # </th>
    <th> Nome </th>
    <th> Tempo de espera </th>
    <th> Classificação </th>
  </thead>
  <tbody>";

  function __construct() {
    $this->atualizar();
    $this->sel[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Laranja' AND tri_status = 'Em espera';";
    $this->sel[1] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Amarelo' AND tri_status = 'Em espera';";
    $this->sel[2] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Verde' AND tri_status = 'Em espera'";
    $this->sel[3] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Azul' AND tri_status = 'Em espera';";
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
        break;
      case 60:
        $this->cor = "Amarelo";
        break;
      case 120:
        $this->cor = "Verde";
        break;
      case 240:
        $this->cor = "Azul";
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
    $data = new DateTime($dataPac);
    $horario = new DateTime($horaPac);

    $dias = $data->diff(new DateTime(date('Y-m-d')));
    $horas = $horario->diff(new DateTime(date('H:i')));

    $tempo = $horas->format('%H:%I');
    $tempo = explode(':', $tempo);
    $h = $tempo[0];
    $m = $tempo[1];
    $h += $dias->d * 24;

    $tempoFinal = $h*60 + $m;

    return $tempoFinal;
  }

  function chamar() {
    parent::inserir("UPDATE triagem SET tri_status = 'Em consulta' WHERE tri_id = " . $this->id . ";");
    echo "Chamada: " . $this->nome . ", ID: " . $this->id  . ", tempo de espera: " . $this->espera . "/" . $this->tempoMax ." minutos <br>";
  }

  function cat() {
    $this->tabela .= "
    <tr>
      <td>" . $this->id . "</td>
      <td>" . $this->nome . "</td>
      <td>" . $this->espera . "/" . $this->tempoMax . " minutos </td>
      <td>" . $this->cor . "</td>
    </tr>";
  }

  function atualizar() {
    $this->naFila = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 'Em espera'");
    $this->emConsulta = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 'Em consulta';");
  }

  function imprimir() {
    if ($this->naFila == 0) {
      $this->tabela .= "
      <tr>
        <td colspan='4'> Não há ninguém na fila </td>
      </tr>
      ";
    }

    $this->tabela .= "</tbody> </table>";

    echo $this->tabela;
  }
}
