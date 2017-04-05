<?php

class Triagem {
  private $pacId;
  private $peso;
  private $altura;
  private $batimento;
  private $resp;
  private $temp;
  private $pas;
  private $pad;
  private $oxi;
  private $class;
  private $org;
  private $dor;

  function setPacId($pacId) {
    $this->pacId = $pacId;
  }

  function getPacId() {
    return $this->pacId;
  }

  function setPeso($peso) {
    $this->peso = $peso;
  }

  function getPeso() {
    return $this->peso;
  }

  function setAltura($altura) {
    $this->altura = $altura;
  }

  function getAltura() {
    return $this->altura;
  }

  function setBatimento($batimento) {
    $this->batimento = $batimento;
  }

  function getBatimento() {
    return $this->batimento;
  }

  function setResp($resp) {
    $this->resp = $resp;
  }

  function getResp() {
    return $this->resp;
  }

  function setTemp($temp) {
    $this->temp = $temp;
  }

  function getTemp() {
    return $this->temp;
  }

  function setPas($pas) {
    $this->pas = $pas;
  }

  function getPas() {
    return $this->pas;
  }

  function setPad($pad) {
    $this->pad = $pad;
  }

  function getPad() {
    return $this->pad;
  }

  function setOxi($oxi) {
    $this->oxi = $oxi;
  }

  function getOxi() {
    return $this->oxi;
  }

  function setDor($dor) {
    $this->dor = $dor;
  }

  function getDor() {
    return $this->dor;
  }

  function setOrg($org) {
    $this->org = $org;
  }

  function getOrg() {
    return $this->org;
  }

  function setClass($class) {
    $this->class = $class;
  }

  function getClass() {
    return $this->class;
  }

}

?>
