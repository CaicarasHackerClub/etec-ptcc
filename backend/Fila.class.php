<?php

include_once 'Sql.class.php';

class Fila extends Sql {
  private $emConsulta;
  private $emEspera;

  private $espera;
  private $nome;
  private $id;
  private $tempoAtual;

  private $cor;
  private $tempo = array(10, 60, 120, 240);

  private $tabela =
  "
  <table border='1'>
  <thead>
  <th> # </th>
  <th> Nome </th>
  <th> Tempo de espera </th>
  </thead>";


  function getTempo() {
    return $this->tempo;
  }

  function getCor() {
    return $this->cor;
  }

  function __construct() {
    $this->atualizar(0, 0, -1);
    $this->cor[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Laranja' AND tri_status = 'Em espera';";
    $this->cor[1] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Amarelo' AND tri_status = 'Em espera';";
    $this->cor[2] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Verde' AND tri_status = 'Em espera'";
    ;
    $this->cor[3] = "SELECT * FROM triagem WHERE tri_classe_risco = 'Azul' AND tri_status = 'Em espera';";
  }

  function setEspera($espera) {
    $this->espera = $espera;
  }

  function getEspera() {
    return $this->espera;
  }

  function getEmEspera() {
    return $this->emEspera;
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
    if ($this->id != 0) {
      parent::inserir("UPDATE triagem SET tri_status = 'Em consulta' WHERE tri_id = " . $this->id . ";");

      echo "Chamada: $this->nome, ID:  $this->id, tempo de espera: $this->espera <br>";
    }
  }

  function cat() {
    $this->tabela .=
  "<tr>
    <td>" . $this->id . "</td>
    <td>" . $this->nome . "</td>
    <td>" . $this->espera . "/" . $this->tempoAtual . " minutos </td>
  </tr>";
  }

  function atualizar($pes, $id, $i) {
    $this->emConsulta = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 'Em consulta';");
    $this->emEspera = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 'Em espera'");

    if ($pes != 0) {
      $pesId = parent::selecionar("SELECT pessoa_pes_id FROM paciente WHERE pac_id = " . $pes . ";");
      $this->nome = parent::selecionar("SELECT pes_nome FROM pessoa WHERE pes_id = " . $pesId . ";");
    }
    if ($id != 0) {
      $this->id = $id;
    }

    if ($i != -1) {
      $this->tempoAtual = $tempo[$i];
    }
  }

  function imprimir() {
    $tabela .= "</table>";

    echo $this->tabela;
  }
}

?>
