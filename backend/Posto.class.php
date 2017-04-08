<?php
Class Metodo
{
	//pessoa
	private $pes_nome;
	private $pes_pai;
	private $pes_mae;
	private $pes_rg;
	private $pes_cpf;
	private $pes_data;
	private	$pes_tipo;
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
	private $med_especializacao;
	private $med_crm;

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

	//pessoa
	function setPes_nome($nome){
		$this->pes_nome = $nome;
	}
	function setPes_pai($pai){
	  $this->pes_pai = $pai;
	}
	function setPes_mae($mae){
	  $this->pes_mae = $mae;
	}
	function setPes_rg($rg){
		$this->pes_rg = $rg;
	}
	function setPes_cpf($cpf){
		$this->pes_cpf = $cpf;
	}
	function setPes_data($data){
		$this->pes_data  = $data;
	}
	function setPes_tipo($tipo){
		$this->pes_tipo = $tipo;
	}
	function setPes_email($email){
		$this->pes_email = $email;
	}
	function setPes_estado_civil($estado_civil){
		$this->pes_estado_civil = $estado_civil;
	}
	function setPes_cidadania($cidadania){
		$this->pes_cidadania = $cidadania;
	}
	function setPes_genero($genero){
		$this->pes_genero = $genero;
	}
	function setPes_sexo_biologico($sexo_biologico){
		$this->pes_sexo_biologico = $sexo_biologico;
	}
	function setPes_telefone($telefone){
		$this->pes_telefone = $telefone;
	}
	function setPes_end_id($end_id){
		$this->$end_id = $end_id;
	}

	//endereco
	function setEnd_pais($pais){
		$this->end_pais = $pais;
	}
	function setEnd_estado($estado){
		$this->end_estado = $estado;
	}
	function setEnd_cidade($cidade){
		$this->end_cidade = $cidade;
	}
	function setEnd_cep($cep){
		$this->end_cep = $cep;
	}
	function setEnd_bairro($bairro){
		$this->end_bairro = $bairro;
	}
	function setEnd_distrito($distrito){
		$this->end_distrito = $distrito;
	}
	function setEnd_rua($rua){
		$this->end_rua = $rua;
	}
	function setEnd_numero($numero){
		$this->end_numero = $numero;
	}

	//funcionario
	function setFun_cargo($cargo){
		$this->fun_cargo = $cargo;
	}
	function setFun_horario($horario){
		$this->fun_horario = $horario;
	}
	function setFun_inscricao($inscricao){
		$this->fun_inscricao = $inscricao;
	}
	function setFun_turno($turno){
		$this->fun_turno = $turno;
	}

	//usuario
	function setUsu_senha($senha){
		$this->usu_senha = $senha;
	}
	function setUsu_email($email){
		$this->usu_email = $email;
	}

	//medico
	function setMed_turno($turno){
		$this->med_turno = $turno;
	}
	function setMed_crm($crm){
		$this->med_crm = $crm;
	}
	//enfermeiro
	function setEnf_registro($registro){
		$this->enf_registro = $registro;
	}
	//paciente
	function setPac_tipo_sangue($tipo_sangue){
		$this->pac_tipo_sangue = $tipo_sangue;
	}
	function setPac_remedio($pac_remedio){
		$this->pac_remedio = $pac_remedio;
	}
	function setPac_doenca($pac_doenca){
		$this->pac_doenca = $pac_doenca;
	}
	function setPac_educacao($pac_educacao){
		$this->pac_educacao = $pac_educacao;
	}

	//plano_de_saude
	function setPds_convenio_nome($pds_convenio_nome){
		$this->pds_convenio_nome = $pds_convenio_nome;
	}
	function setPds_num_convenio($pds_num_convenio){
		$this->pds_num_convenio = $pds_num_convenio;
	}
	function setPds_numero_sus($pds_numero_sus){
		$this->pds_numero_sus = $pds_numero_sus;
	}
	//get pessoa
	function getPes_nome(){
		return $this->pes_nome;
	}
	function getPes_pai(){
		return $this->pes_pai;
	}
	function getPes_mae(){
		return $this->pes_mae;
	}
	function getPes_rg(){
		return $this->pes_rg;
	}
	function getPes_cpf(){
		return $this->pes_cpf;
	}
	function getPes_data(){
		return $this->pes_data;
	}
	function getPes_tipo(){
		return $this->pes_tipo;
	}
	function getPes_email(){
		return $this->pes_email;
	}
	function getPes_estado_civil(){
		return $this->pes_estado_civil;
	}
	function getPes_cidadania(){
		return $this->pes_cidadania;
	}
	function getPes_genero(){
		return $this->pes_genero;
	}
	function getPes_sexo_biologico(){
		return $this->pes_sexo_biologico;
	}
	function getPes_telefone(){
		return $this->pes_telefone;
	}
	function getPes_end_id(){
		return $this->end_id;
	}


	//get endereco
	function getEnd_pais(){
		return $this->end_pais;
	}
	function getEnd_estado(){
		return $this->end_estado;
	}
	function getEnd_cidade(){
		return $this->end_cidade;
	}
	function getEnd_cep(){
		return $this->end_cep;
	}
	function getEnd_bairro(){
		return $this->end_bairro;
	}
	function getEnd_distrito(){
		return $this->end_distrito;
	}
	function getEnd_rua(){
		return $this->end_rua;
	}
	function getEnd_numero(){
		return $this->end_numero;
	}
	//get funcionario
	function getFun_cargo(){
		return $this->fun_cargo;
	}
	function getFun_horario(){
		return $this->fun_horario;
	}
	function getFun_inscricao(){
		return $this->fun_inscricao;
	}
	function getFun_turno(){
		return $this->fun_turno;
	}


	//get senha
	function getUsu_senha(){
		return $this->usu_senha;
	}
	function getUsu_email(){
		return $this->usu_email;
	}

	//get paciente
	function getPac_tipo_sangue(){
		return $this->pac_tipo_sangue;
	}
	function getPac_remedio(){
		return $this->pac_remedio;
	}
	function getPac_doenca(){
		return $this->pac_doenca;
	}
	function getPac_educacao(){
		return $this->pac_educacao;
	}

	//plano_de_saude
	function getPds_convenio_nome(){
		return $this->pds_convenio_nome;
	}
	function getPds_numero_sus(){
		return $this->pds_numero_sus;
	}
	function getPds_num_convenio(){
		return $this->pds_num_convenio;
	}
	//enfermeiro
	function getEnf_registro(){
		return $this->enf_registro;
	}

}

?>
