<?php

class Triagem {
  private $atId;
  private $peso;
  private $altura;
  private $batimento;
  private $class;
  private $resp;
  private $temp;
  private $pas;
  private $pad;
  private $oxi;
  private $org;
  private $dor;
  private $tipoSanguineo;
  private $doencas;
  private $remedios;
  private $sintomas;
  private $reclamacao;

  private $data;
  private $hora;
  private $status;

  public function setAtId($atId) {
    $this->atId = $atId;
  }

  public function getAtId() {
    return $this->atId;
  }

  public function setPeso($peso) {
    $this->peso = $peso;
  }

  public function getPeso() {
    return $this->peso;
  }

  public function setAltura($altura) {
    $this->altura = $altura;
  }

  public function getAltura() {
    return $this->altura;
  }

  public function setBatimento($batimento) {
    $this->batimento = $batimento;
  }

  public function getBatimento() {
    return $this->batimento;
  }

  public function setClass($class) {
    $this->class = $class;
  }

  public function getClass() {
    return $this->class;
  }

  public function setResp($resp) {
    $this->resp = $resp;
  }

  public function getResp() {
    return $this->resp;
  }

  public function setTemp($temp) {
    $this->temp = $temp;
  }

  public function getTemp() {
    return $this->temp;
  }

  public function setPas($pas) {
    $this->pas = $pas;
  }

  public function getPas() {
    return $this->pas;
  }

  public function setPad($pad) {
    $this->pad = $pad;
  }

  public function getPad() {
    return $this->pad;
  }

  public function setOxi($oxi) {
    $this->oxi = $oxi;
  }

  public function getOxi() {
    return $this->oxi;
  }

  public function setDor($dor) {
    $this->dor = $dor;
  }

  public function getDor() {
    return $this->dor;
  }

  public function setTipoSanguineo($tipoSanguineo) {
    $this->tipoSanguineo = $tipoSanguineo;
  }

  public function getTipoSanguineo() {
    return $this->tipoSanguineo;
  }

  public function setOrg($org) {
    $this->org = $org;
  }

  public function getOrg() {
    return $this->org;
  }

  public function setDoencas($doencas) {
    $this->doencas = $doencas;
  }

  public function getDoencas() {
    return $this->doencas;
  }

  public function setRemedios($remedios) {
    $this->remedios = $remedios;
  }

  public function getRemedios() {
    return $this->remedios;
  }

  public function setSintomas($sintomas) {
    $this->sintomas = $sintomas;
  }

  public function getSintomas() {
    return $this->sintomas;
  }

  public function setReclamacao($reclamacao) {
    $this->reclamacao = $reclamacao;
  }

  public function getReclamacao() {
    return $this->reclamacao;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getData() {
    return $this->data;
  }

  public function setHora($hora) {
    $this->hora = $hora;
  }

  public function getHora() {
    return $this->hora;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function getStatus() {
    return $this->status;
  }
}
