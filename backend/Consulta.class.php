<?php

include_once 'Fila.class.php';

class Consulta extends Fila {
  private $chegada;
  private $saida;
  private $data;
  private $comentario;
  private $triId;
  private $medId;
  private $encId;

  function setChegada($chegada) {
    $this->chegada = $chegada;
  }

  function getChegada() {
    return $this->chegada;
  }

  function setSaida($saida) {
    $this->saida = $saida;
  }

  function getSaida() {
    return $this->saida;
  }

  function setData($data) {
    $this->data = $data;
  }

  function getData() {
    return $this->data;
  }

  function setComentario($comentario) {
    $this->comentario = $comentario;
  }

  function getComentario() {
    return $this->comentario;
  }

  function setTriId($triId) {
    $this->triId = $triId;
  }

  function getTriId() {
    return $this->triId;
  }

  function setMedId($medId) {
    $this->medId = $medId;
  }

  function getMedId() {
    return $this->medId;
  }

  function setEncId($encId) {
    $this->encId = $encId;
  }

  function getEncId() {
    return $this->encId;
  }
}
