<?php

include 'Fila.class.php';

class Consulta {
  private $chegada;
  private $saida;
  private $data;
  private $reclamacao;
  private $sintomas;
  private $diagnostico;
  private $encId;
  private $comentario;
  private $triId;
  private $medId;

  public function setChegada($chegada) {
    $this->chegada = $chegada;
  }

  public function getChegada() {
    return $this->chegada;
  }

  public function setSaida($saida) {
    $this->saida = $saida;
  }

  public function getSaida() {
    return $this->saida;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getData() {
    return $this->data;
  }

  public function setReclamacao($reclamacao) {
    $this->reclamacao = $reclamacao;
  }

  public function getReclamacao() {
    return $this->reclamacao;
  }

  public function setSintomas($sintomas) {
    $this->sintomas = $sintomas;
  }

  public function getSintomas() {
    return $this->sintomas;
  }

  public function setDiagnostico($diagnostico) {
    $this->diagnostico = $diagnostico;
  }

  public function getDiagnostico() {
    return $this->diagnostico;
  }

  public function setEncId($encId) {
    $this->encId = $encId;
  }

  public function getEncId() {
    return $this->encId;
  }

  public function setComentario($comentario) {
    $this->comentario = $comentario;
  }

  public function getComentario() {
    return $this->comentario;
  }

  public function setTriId($triId) {
    $this->triId = $triId;
  }

  public function getTriId() {
    return $this->triId;
  }

  public function setMedId($medId) {
    $this->medId = $medId;
  }

  public function getMedId() {
    return $this->medId;
  }
}
