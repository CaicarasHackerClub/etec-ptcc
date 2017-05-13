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
  private $prox;

  private $sel;
  private $tempo = [10, 60, 120, 240];

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

  public function __construct() {
    $this->atualizar();
    $this->sel[0] = "SELECT * FROM triagem WHERE tri_classe_risco = 4 AND (tri_status = 1 OR tri_status = 2);";
    $this->sel[1] = "SELECT * FROM triagem WHERE tri_classe_risco = 3 AND (tri_status = 1 OR tri_status = 2);";
    $this->sel[2] = "SELECT * FROM triagem WHERE tri_classe_risco = 2 AND (tri_status = 1 OR tri_status = 2);";
    $this->sel[3] = "SELECT * FROM triagem WHERE tri_classe_risco = 1 AND (tri_status = 1 OR tri_status = 2);";
  }

  public function getTempo() {
    return $this->tempo;
  }

  public function getSel() {
    return $this->sel;
  }

  public function setPacMax($pacMax) {
    $this->pacMax = $pacMax;
  }

  public function getPacMax() {
    return $this->pacMax;
  }

  public function setPac($id, $espera, $cor) {
    $this->id = $id;

    $pes = parent::selecionar("SELECT id_paciente FROM triagem WHERE tri_id = " . $this->id . ";");
    $pesId = parent::selecionar("SELECT pessoa_pes_id FROM paciente WHERE pac_id = " . $pes . ";");
    $this->nome = parent::selecionar("SELECT pes_nome FROM pessoa WHERE pes_id = " . $pesId . ";");

    $this->espera = $espera;

    switch ($cor) {
      case 1:
        $this->cor = 'Azul';
        $this->numCor = 1;
        $this->tempoMax = '240';
        break;
      case 2:
        $this->cor = 'Verde';
        $this->numCor = 2;
        $this->tempoMax = '120';
        break;
      case 3:
        $this->cor = 'Amarelo';
        $this->numCor = 3;
        $this->tempoMax = '60';
        break;
      case 4:
        $this->cor = 'Laranja';
        $this->numCor = 4;
        $this->tempoMax = '10';
        break;
      case 5:
        $this->cor = 'Vermelho';
        $this->numCor = 5;
        $this->tempoMax = '00';
        break;
    }
  }

  public function getPac() {
    $pac = [$this->id, $this->nome, $this->cor, $this->espera, $this->tempoMax];
    return $pac;
  }

  public function getEspera() {
    return $this->espera;
  }

  public function getTempoMax() {
    return $this->tempoMax;
  }

  public function getNaFila() {
    return $this->naFila;
  }

  public function getEmConsulta() {
    return $this->emConsulta;
  }

  public function calc($dataPac, $horaPac) {
    date_default_timezone_set('America/Sao_Paulo');

    $data = new DateTime($dataPac);
    $horario = new DateTime($horaPac);

    $this->chegada = $data->format('d/m') . " - " . $horario->format('H:i');

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

  public function setProx($prox) {
    $this->prox = $prox;
  }

  public function reclassificar($id, $class) {
    if (!empty($class)) {
      if ($class == 5) {
        parent::inserir("UPDATE triagem SET tri_classe_risco = " . $class . ", tri_status = 3 WHERE tri_id = " . $id . ";");
      } else {
        parent::inserir("UPDATE triagem SET tri_classe_risco = " . $class . " WHERE tri_id = " . $id . ";");
      }

      $this->atualizar();
    }
  }

  public function desistir($id) {
    parent::inserir("UPDATE triagem SET tri_status = 6 WHERE tri_id = " . $id . ";");
  }

  public function proximo() {
    if ($this->prox) {
      parent::inserir("UPDATE triagem SET tri_status = 2 WHERE tri_id = " . $this->id);

      $this->tabela .= "
      <td>
        <input class='submit' type='submit' name='chamar' value='Chamar'>
      </td>";
    } else {
      parent::inserir("UPDATE triagem SET tri_status = 1 WHERE tri_id = " . $this->id . ";");
    }
  }

  public function cat() {
    $this->tabela .= "
    <tr class='tr_fila'>
      <form action='fila.php' class='form form-classi' method='post'>
        <td>" . $this->id . "</td>
        <td>" . $this->nome . "</td>
        <td>" . $this->chegada . "</td>
        <td>" . $this->espera . "/" . $this->tempoMax . " min </td>
        <td>" . $this->cor . "</td>
          <div id='abrirModal' class='modal'>
          	<div>
              Paciente: " . $this->nome . " <br>
              Classificação: " . strtolower($this->cor) . " <br>
          		<a href='#fechar' title='Fechar' class='fechar'>x</a>
              <input type='hidden' name='id' value='" . $this->id . "'>

              <input type='radio' id='azul' name='class' value='1'";
              $this->tabela .= $this->numCor == 1 ? ' checked' : "";
              $this->tabela .= ">
              <label for='azul' class='lbl-radio-class lbl_class'></label>

              <input type='radio' id='verde' name='class' value='2'";
              $this->tabela .= $this->numCor == 2 ? ' checked' : "";
              $this->tabela .= ">
              <label for='verde' class='lbl-radio-class lbl_class'></label>

              <input type='radio' id='amarelo' name='class' value='3'";
              $this->tabela .= $this->numCor == 3 ? ' checked' : "";
              $this->tabela .= ">
              <label for='amarelo' class='lbl-radio-class lbl_class'></label>

              <input type='radio' id='laranja' name='class' value='4'";
              $this->tabela .= $this->numCor == 4 ? ' checked' : "";
              $this->tabela .= ">
              <label for='laranja' class='lbl-radio-class lbl_class'></label>

              <input type='radio' id='vermelho' name='class' value='5'";
              $this->tabela .= $this->numCor == 5 ? ' checked' : "";
              $this->tabela .= ">
              <label for='vermelho' class='lbl-radio-class lbl_class'></label>

              <input type='password' name='senha' class='inp_class'> <br>
              <input class='submit' type='submit' name='reclassificar' value='Reclassificar'>
				   </div>
         </div>

        <td>
          <a class='submit anchor' name='reclassificar' href='#abrirModal'>Reclassificar</a>
        </td>
        <td>
          <input class='submit' type='submit' name='desistir' value='Desistente'>
        </td>
    ";

    $this->proximo();

    $this->tabela .= "</form> </tr>";
  }

  public function atualizar() {
    $this->naFila = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 1 OR tri_status = 2;");
    $this->emConsulta = parent::num("SELECT tri_id FROM triagem WHERE tri_status = 3 OR tri_status = 4;");
  }

  public function imprimir() {
    $this->atualizar();

    echo "
    <div class='pessoas'>
      <label class='lbl_class'>Pessoas em consulta: " . $this->emConsulta . " <label><hr>
      <label class='lbl_class'>Pessoas em espera: " . $this->naFila . "</labal>
    </div>";

    if ($this->naFila == 0) {
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
