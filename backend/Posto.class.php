<?php
class Metodo {
    //pessoa
  private $pes_nome;
  private $pes_pai;
  private $pes_mae;
  private $pes_rg;
  private $pes_cpf;
  private $pes_data;
  private $pes_tipo;
  private $pes_email;
  private $pes_estado_civil;
  private $pes_cidadania;
  private $pes_genero;
  private $pes_sexo_biologico;
  private $pes_telefone;
  private $end_id;

  //Variaveis Endereço
  private $end_pais;
  private $end_estado;
  private $end_cidade;
  private $end_cep;
  private $end_bairro;
  private $end_destrito;
  private $end_rua;
  private $end_numero;

  //Funcionario
  private $fun_cargo;
  private $fun_setor;
  private $fun_horario;
  private $fun_inscricao;

  //usuario
  private $usu_senha;
  private $usu_email;

  //medico
  private $med_crm;
  // especializacao
  private $esp_nome;

  //paciente
  private $pac_tipo_sangue;
  private $pac_remedio;
  private $pac_doenca;
  private $pac_educacao;

  //enfermeiro
  private $enf_registro;

  //plano_de_saude
  private $pds_convenio_nome;
  private $pds_numero_sus;
  private $pds_num_convenio;

  //setor
  private $set_setor;

  //pessoa
  public function setPes_nome($nome) {
    $this->pes_nome = $nome;
  }
  public function setPes_pai($pai) {
     $this->pes_pai = $pai;
  }
  public function setPes_mae($mae) {
    $this->pes_mae = $mae;
  }
  public function setPes_rg($rg) {
    $this->pes_rg = $rg;
  }
  public function setPes_cpf($cpf) {
    $this->pes_cpf = $cpf;
  }
  public function setPes_data($data) {
    $this->pes_data  = $data;
  }
  public function setPes_tipo($tipo) {
    $this->pes_tipo = $tipo;
  }
  public function setPes_email($email) {
    $this->pes_email = $email;
  }
  public function setPes_estado_civil($estado_civil) {
    $this->pes_estado_civil = $estado_civil;
  }
  public function setPes_cidadania($cidadania) {
    $this->pes_cidadania = $cidadania;
  }
  public function setPes_genero($genero) {
    $this->pes_genero = $genero;
  }
  public function setPes_sexo_biologico($sexo_biologico) {
    $this->pes_sexo_biologico = $sexo_biologico;
  }
  public function setPes_telefone($telefone) {
    $this->pes_telefone = $telefone;
  }
  public function setPes_end_id($end_id) {
    $this->$end_id = $end_id;
  }

  //endereco
  public function setEnd_pais($pais) {
      $this->end_pais = $pais;
  }
  public function setEnd_estado($estado) {
    $this->end_estado = $estado;
  }
  public function setEnd_cidade($cidade) {
    $this->end_cidade = $cidade;
  }
  public function setEnd_cep($cep) {
    $this->end_cep = $cep;
  }
  public function setEnd_bairro($bairro) {
    $this->end_bairro = $bairro;
  }
  public function setEnd_distrito($distrito) {
    $this->end_distrito = $distrito;
  }
  public function setEnd_rua($rua) {
    $this->end_rua = $rua;
  }
  public function setEnd_numero($numero) {
    $this->end_numero = $numero;
  }
  //funcionario
  public function setFun_cargo($cargo) {
    $this->fun_cargo = $cargo;
  }
  public function setFun_horario($horario) {
    $this->fun_horario = $horario;
  }
  public function setFun_inscricao($inscricao) {
    $this->fun_inscricao = $inscricao;
  }
  public function setFun_turno($turno) {
    $this->fun_turno = $turno;
  }
  //usuario
  public function setUsu_senha($senha) {
    $this->usu_senha = $senha;
  }
  public function setUsu_email($email) {
    $this->usu_email = $email;
  }

  //medico
  public function setMed_crm($crm) {
    $this->med_crm = $crm;
  }
  //especializacao
  public function setEsp_nome($esp_nome) {
    $this->esp_nome= $esp_nome;
  }
  //enfermeiro
  public function setEnf_registro($registro) {
    $this->enf_registro = $registro;
  }
  //paciente
  public function setPac_tipo_sangue($tipo_sangue) {
    $this->pac_tipo_sangue = $tipo_sangue;
  }
  public function setPac_remedio($pac_remedio) {
    $this->pac_remedio = $pac_remedio;
  }
  public function setPac_doenca($pac_doenca) {
    $this->pac_doenca = $pac_doenca;
  }
  public function setPac_educacao($pac_educacao) {
    $this->pac_educacao = $pac_educacao;
  }

  //plano_de_saude
  public function setPds_convenio_nome($pds_convenio_nome) {
    $this->pds_convenio_nome = $pds_convenio_nome;
  }
  public function setPds_num_convenio($pds_num_convenio) {
    $this->pds_num_convenio = $pds_num_convenio;
  }
  public function setPds_numero_sus($pds_numero_sus) {
    $this->pds_numero_sus = $pds_numero_sus;
  }

  //setor
  public function setSet_setor($setor){
    $this->set_setor = $setor;
  }
  //get pessoa
  public function getPes_nome() {
    return $this->pes_nome;
  }
  public function getPes_pai() {
    return $this->pes_pai;
  }
  public function getPes_mae() {
    return $this->pes_mae;
  }
  public function getPes_rg() {
    return $this->pes_rg;
  }
  public function getPes_cpf() {
    return $this->pes_cpf;
  }
  public function getPes_data() {
    return $this->pes_data;
  }
  public function getPes_tipo() {
    return $this->pes_tipo;
  }
  public function getPes_email() {
    return $this->pes_email;
  }
  public function getPes_estado_civil() {
    return $this->pes_estado_civil;
  }
  public function getPes_cidadania() {
    return $this->pes_cidadania;
  }
  public function getPes_genero() {
    return $this->pes_genero;
  }
  public function getPes_sexo_biologico() {
    return $this->pes_sexo_biologico;
  }
  public function getPes_telefone() {
    return $this->pes_telefone;
  }
  public function getPes_end_id() {
    return $this->end_id;
  }


  //get endereco
  public function getEnd_pais() {
    return $this->end_pais;
  }
  public function getEnd_estado() {
    return $this->end_estado;
  }
  public function getEnd_cidade() {
    return $this->end_cidade;
  }
  public function getEnd_cep() {
    return $this->end_cep;
  }
  public function getEnd_bairro() {
    return $this->end_bairro;
  }
  public function getEnd_distrito() {
    return $this->end_distrito;
  }
  public function getEnd_rua() {
    return $this->end_rua;
  }
  public function getEnd_numero() {
    return $this->end_numero;
  }

  //get funcionario
  public function getFun_cargo() {
    return $this->fun_cargo;
  }
  public function getFun_horario() {
    return $this->fun_horario;
  }
  public function getFun_inscricao() {
    return $this->fun_inscricao;
  }
  public function getFun_turno() {
    return $this->fun_turno;
  }

  //get senha
  public function getUsu_senha() {
    return $this->usu_senha;
  }
  public function getUsu_email() {
    return $this->usu_email;
  }

  //get paciente
  public function getPac_tipo_sangue() {
    return $this->pac_tipo_sangue;
  }
  public function getPac_remedio() {
    return $this->pac_remedio;
  }
  public function getPac_doenca() {
    return $this->pac_doenca;
  }
  public function getPac_educacao() {
    return $this->pac_educacao;
  }

  //plano_de_saude
  public function getPds_convenio_nome() {
    return $this->pds_convenio_nome;
  }
  public function getPds_numero_sus() {
    return $this->pds_numero_sus;
  }
  public function getPds_num_convenio() {
    return $this->pds_num_convenio;
  }

  //enfermeiro
  public function getEnf_registro() {
    return $this->enf_registro;
  }

  //medico
  public function getMed_crm() {
    return $this->med_crm;
  }

  //especializacao
  public function getEsp_nome() {
    return $this->esp_nome;
  }

  //setor
  public function getSet_setor() {
    return $this->set_setor;
  }
}
