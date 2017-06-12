<?php

class Receita {
  private $data;
  private $consultaId;

  private $quantidade;
  private $unidade;
  private $medicamento;
  private $tempo;
  private $unidadeTempo;
  private $periodo;

  private $receita;

  public function setData($data) {
    $this->data = $data;
  }

  public function getData() {
    return $this->data;
  }

  public function setConsultaId($consultaId) {
    $this->consultaId = $consultaId;
  }

  public function getConsultaId() {
    return $this->consultaId;
  }

  public function setQuantidade($quantidade) {
    $this->quantidade = $quantidade;
  }

  public function setUnidade($unidade) {
    $this->unidade = $unidade;
  }

  public function setMedicamento($medicamento) {
    $this->medicamento = $medicamento;
  }

  public function setTempo($tempo) {
    $this->tempo = $tempo;
  }

  public function setUnidadeTempo($unidadeTempo) {
    $this->unidadeTempo = $unidadeTempo;
  }

  public function setPeriodo($periodo) {
    $this->periodo = $periodo;
  }

  public function montar() {
    $this->receita .= $this->quantidade . " " . $this->unidade . " de " . $this->medicamento . " a cada " . $this->tempo . " " .
      $this->unidadeTempo . ", durante " . $this->periodo . " dias; ";
  }

  public function getReceita() {
    return substr($this->receita, 0, -2);
  }

}
