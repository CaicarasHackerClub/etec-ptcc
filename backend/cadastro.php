<?php
 session_start();
?>
<html>
	<head>
	</head>
	<body>
		<?php
		include_once ("Posto.class.php");
		$posto = new Posto;
		
		$acao  = isset($_GET['acao'])? $_GET['acao'] : "";
		
		$con = $posto->conectar();
		$selCar = "SELECT * FROM funcionario WHERE USUARIO_usu_id = '" . $_SESSION['tipo']. "';";
		$res = mysqli_query($con, $selCar) or die ("Erro no select de procura do id do funcionário" . mysqli_error($con) . "<br>" . $selCar);
		$cargo = mysqli_fetch_array($res);							
			
		$_SESSION['cargo'] = $cargo['fun_cargo'];
		?>
		<a href="?acao=cadastro">Cadastro</a>
		<a href="?acao=logoff">Sair</a>
		<?php
		if ($acao == "cadastro") {
			if (!isset($_GET['passo'])) {
				?>
				<form class="Form" action="cadastro.php?acao=cadastro&passo=2" method="post">
					<h1>Cadastro de Pessoa</h1>
					<label class="lbl_class">Nome:</label>
					<input class="inp_class" type="text" name="pes_nome" size="28"><br>
					<label class="lbl_class">Nome do pai:</label>
					<input class="inp_class" type="text" name="pes_pai" size="28"><br>
					<label class="lbl_class">Nome da mãe:</label>
					<input class="inp_class" type="text" name="pes_mae" size="28"><br>
					<label class="lbl_class">RG:</label>
					<input class="inp_class" type="text" name="pes_rg" size="28"><br>
					<label class="lbl_class">CPF:</label>
					<input class="inp_class" type="text" name="pes_cpf" size="28"><br>
					<label class="lbl_class">Data de nascimento:</label>
					<input class="inp_class" type="date" name="pes_data" size="28"><br>
					<label class="lbl_class">Email</label>
					<input class="inp_class" type="text" name="pes_email" size="28"><br>
					<label class="lbl_class">Estado civil:</label>
					<select class="select" name = "pes_estado_civil">
						<option class="option" value = "Solteiro">Solteiro</option>
						<option class="option" value = "Casado">Casado</option>
					</select><br>
					<label class="lbl_class">Cidadania:</label>
					<input class="inp_class" type="text" name="pes_cidadania" size="28" value="Brasileira"><br>
					<label class="lbl_class">Gênero</label>
					<input class="inp_class" type="radio" name="pes_genero" value = "Masculino">Masculino
					<input class="inp_class" type="radio" name="pes_genero" value = "Feminino">Feminino<br>
					<label class="lbl_class">Sexo biológico:</label>
					<input class="inp_class" type="radio" name="pes_sexo_biologico" value = "Masculino">Masculino
					<input class="inp_class" type="radio" name="pes_sexo_biologico" value = "Feminino">Feminino<br>
					<label class="lbl_class">Telefone:</label>
					<input class="inp_class" type="text" name="pes_telefone" size = "15"><br>
					<label class="lbl_class">País:</label>
					<input class="inp_class" type="text" name="end_pais" size = "28" value="Brasil"><br>
					<label class="lbl_class">Estado:</label>
					<select class="select" name = "end_estado">
					<option class="option" value="SP" selected>SP</option>
					<option class="option" value="MG">MG</option>
					<option class="option" value="RJ">RJ</option>
					</select><br>

					<label class="lbl_class">Cidade:</label>
					<input class="inp_class" type="text" name="end_cidade" size="28"><br>
					<label class="lbl_class">Cep:</label>
					<input class="inp_class" type="text" name="end_cep" size="28"><br>
					<label class="lbl_class">Bairro:</label>
					<input class="inp_class" type="text" name="end_bairro" size="28"><br>
					<label class="lbl_class">Rua:</label>
					<input class="inp_class" type="text" name="end_rua" size="28"><br>
					<label class="lbl_class">Numero:</label>
					<input class="inp_class" type="text" name="end_numero" size="28"><br>
					<input class="inp_class" type="submit" value="Proximo">
				</form>
				<?php
			}
			else if ($_GET['passo'] == 2) {
				$posto->setPes_nome     		($_POST['pes_nome']);
				$posto->setPes_pai     			($_POST['pes_pai']);
				$posto->setPes_mae     			($_POST['pes_mae']);
				$posto->setPes_rg       		($_POST['pes_rg']);
				$posto->setPes_cpf      		($_POST['pes_cpf']);
				$posto->setPes_data     		($_POST['pes_data']);
				$posto->setPes_email    		($_POST['pes_email']);
				$posto->setPes_estado_civil 	($_POST['pes_estado_civil']);
				$posto->setPes_Cidadania 		($_POST['pes_cidadania']);
				$posto->setPes_genero		 	($_POST['pes_genero']);
				$posto->setPes_sexo_biologico	($_POST['pes_sexo_biologico']);
				$posto->setPes_telefone			($_POST['pes_telefone']);
				
				$posto->setEnd_pais			    ($_POST['end_pais']);
				$posto->setEnd_Estado			($_POST['end_estado']);
				$posto->setEnd_cidade   		($_POST['end_cidade']);
				$posto->setEnd_cep      		($_POST['end_cep']);
				$posto->setEnd_bairro   		($_POST['end_bairro']);
				$posto->setEnd_rua			 	($_POST['end_rua']);
				$posto->setEnd_numero			($_POST['end_numero']);
								 
				// Verifica se a pessoa que está sendo cadastrada já foi cadastrada anteriormente
				$selPes = "SELECT * FROM pessoa WHERE pes_cpf = '" . $_POST ['pes_cpf'] . "';";
				$qtd = $posto->selecionar($selPes);
				$qtd = 0;
				if ($qtd >= 1) {
					echo "Pessoa já cadastrada!!";
					?>
					<a href="?acao=cadastro">Voltar</a>
					<?php
				}
				else {
					$sel_id = "SELECT MAX(pes_id) AS pes_id FROM pessoa";
					$pes_id = $posto->selecionar($sel_id);
					//Insere os dados na tabela endereço
					$insEnd = "INSERT INTO endereco (end_pais, end_estado,end_cidade, end_cep,end_bairro, end_rua,end_numero,pessoa_pes_id) VALUES (
									'" . $posto->getEnd_pais()   . "',
									'" . $posto->getEnd_estado() . "',
									'" . $posto->getEnd_cidade() . "',
									'" . $posto->getEnd_cep()    . "',
									'" . $posto->getEnd_bairro() . "',
									'" . $posto->getEnd_rua() 	 . "',
									'" . $posto->getEnd_numero() . "',
									'" . $pes_id                 . "'
						);";
					// Verifica se a query foi inserida corretamente 
					$okEnd = $posto->inserir($insEnd);
										
					//Insere os dados na tabela pessoa			
					$insPes = "INSERT INTO pessoa (pes_nome, pes_pai, pes_mae, pes_rg, pes_cpf, pes_data, pes_email, pes_estado_civil, pes_cidadania, pes_genero, pes_sexo_biologico, pes_telefone) VALUES ( 
									'". $posto->getPes_nome()    	  	."',
									'". $posto->getPes_pai()     	  	."',
									'". $posto->getPes_mae()          	."',
									'". $posto->getPes_rg()           	."',
									'". $posto->getPes_cpf()          	."',
									'". $posto->getPes_data()         	."',
									'". $posto->getPes_email()        	."',
									'". $posto->getPes_estado_civil()  	."',
									'". $posto->getPes_cidadania()    	."',
									'". $posto->getPes_genero()       	."',
									'". $posto->getPes_sexo_biologico()	."',
									'". $posto->getPes_telefone()      	."'
									
						);";
					//verifica se a query foi inserida corretamente
					$okPes = $posto->inserir($insPes);
					
					if ($okPes && $okEnd) {
						echo "Pessoa cadastrada com sucesso!!!" . $_SESSION['cargo'];
						/* se o usuário logado for recepcionista ele só poderá cadastrar 
						os dados de pacientes do formulário abaixo */
						echo "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=3\" method=\"post\">";
						if ($_SESSION['cargo'] == "recepcao") {
							?>
							<br>
							<h1>Paciente</h1>
							<label class="lbl_class">Tipo Sanguineo</label>
							<input class="inp_class" type="text" name="pac_tipo_sangue" size="28"><br>
							<label class="lbl_class">Plano de Saúde:</label>
							<input class="inp_class" type="text" name="pac_plano_saude" size="28"><br>
							<label class="lbl_class">Remedio</label>
							<input class="inp_class" type="text" name="pac_remedio" size="28"><br>
							<label class="lbl_class">Doença</label>
							<input class="inp_class" type="text" name="pac_doenca" size="28"><br>
		       				<label class="lbl_class">Grau de escolaridade:</label><br>
							<input class="inp_class" type="radio" name="pac_educacao" value = "Ef1">Ensino Fundamental 1 <br>
							<input class="inp_class" type="radio" name="pac_educacao" value = "EF2">Ensino Fundamental 2<br>
							<input class="inp_class" type="radio" name="pac_educacao" value = "EM">Ensino Médio<br>
							<input class="inp_class" type="radio" name="pac_educacao" value = "ES">Ensino Superior<br>
							<label class="lbl_class">Profissão:</label>
							<input class="inp_class" type="text" name="pac_profissao" size="28">
							<input class="inp_class" type="hidden" name="tipo" value="rec_paciente"><br>
							<label class="lbl_class">Convênio:</label>
							<input class="inp_class" type="text" name="pds_convenio_nome" size="28">
							<label class="lbl_class">SUS:</label>
							<input class="inp_class" type="text" name="pds_numero_sus" size="28">
							<input class="inp_class" type="submit" value = "Confirmar">
							<?php
						}
						/* Se o usuário logado for recepcionista ele só poderá cadastrar 
						os dados de funcionário do formulário abaixo
						*/
						else if ($_SESSION['cargo'] == "administracao") {
							?>
							<h1>Funcionário</h1>
							<label class="lbl_class">Cargo:</label>
							<select class="select" name="fun_cargo">
								<option class="option" value="recepcao">Recepcionista</option>
								<option class="option" value="medico">Médico</option>
								<option class="option" value="enfermeiro">Enfermeiro</option>
								<option class="option" value="funcionario">Funcionário</option>
							</select><br>
							<label class="lbl_class">Horario:</label>
							<input class="inp_class" type="time" name="fun_horario" size="28"><br>
							<label class="lbl_class">Inscrição:</label>
							<input class="inp_class" type="text" name="fun_inscricao" size="28"><br>
							<label class="lbl_class">Turno:</label>
							<select class="select" name="fun_turno">
								<option class="option" value="manha">Manhã</option>
								<option class="option" value="tarde">Tarde</option>
								<option class="option" value="noite">Noite</option>
							</select><br>
							<label class="lbl_class">E-mail:</label>
							<input class="inp_class" type="text" name="usu_email" size="28"><br>
							<label class="lbl_class">Senha:</label>
							<input class="inp_class" type="password" name="usu_senha" size="28"><br>


							<input class="inp_class" type="submit" value="Proximo">
						<?php
						}
						echo "</form>";
					}
					else {
						echo "Erro ao cadastrar pessoa";
					}
				}
			}
			else if ($_GET['passo'] == 3) {
				if ($_SESSION['cargo'] == "recepcao") {
					$posto->setPac_tipo_sangue		($_POST['pac_tipo_sangue']);
					$posto->setPac_remedio			($_POST['pac_remedio']);
					$posto->setPac_doenca			($_POST['pac_doenca']);
					$posto->setPac_educacao			($_POST['pac_educacao']);
					$posto->setPac_profissao	    ($_POST['pac_profissao']);
					$posto->setPds_convenio_nome    ($_POST['pds_convenio_nome']);
					$posto->setPds_numero_sus       ($_POST['pds_numero_sus']);
					
					$qtdPds = "SELECT * FROM plano_de_saude WHERE pds_sus = 
							  '" . $_POST['pds_numero_sus'] . "';";
								
					if ($qtdPds >= 1) {
						echo "Paciente já cadastrado!";
					}
					else {
						$insPac = "INSERT INTO paciente (pac_tipo_sangue, pac_remedio, pac_doenca, pac_educacao, pac_profissao) VALUES (
								'" . getPac_tipo_sangue() . "'
								'" . getPac_remedio()     . "'
								'" . getPac_doenca()      . "'
								'" . getPac_educacao()    . "'
								'" . getPac_profissao()   . "'
							);";
						$insPds = "INSERT INTO plano_de_saude (pds_convenio,pds_sus) VALUES ( 
								'" . getPds_convenio_nome() . "', 
								'" . getPds_numero_sus() . "'
							);";

						$okPac = $posto->inserir($insPac);
						$okPds = $posto->inserir($insPds);
						if ($okPac && $okPds) {
							echo "Paciente cadastrado!!!!!!!!";
						}
						else {
							echo "Não cadastrado!!!!!!!!!";
						}
					}
				}
				else if ($_SESSION['cargo'] == "administracao") {
					$posto->setFun_cargo 		($_POST ['fun_cargo']);
					$posto->setFun_horario 		($_POST ['fun_horario']);
					$posto->setFun_inscricao	($_POST ['fun_inscricao']);
					$posto->setFun_turno 		($_POST ['fun_turno']);
					$posto->setUsu_email        ($_POST['usu_email']);
					$posto->setUsu_senha        ($_POST['usu_senha']);
					 
					// Seleção e inserção na tabela funcionário
					//$selFun  = "SELECT fun_inscricao FROM funcionario WHERE '" . $_POST['fun_inscricao'] . "';";
					
					 /*  $qtdFun = $posto->selecionar($selfun);
					if ($qtd >= 1) {
						echo"Funcionario já cadastrado!";
					}
					else {
					*/  $selNome = "SELECT MAX(pes_nome) AS pes_nome FROM pessoa";
						$usu_nome = $posto->select($selNome);


						"INSERT INTO usuario (usu_nome, usu_senha, usu_email, usu_ativo, usu_tipo) VALUES (
							'" . $usu_nome[2]           . "'
							'" . $posto->getUsu_senha() . "',
							'" . $posto->getUsu_email() . "',
							' .          1              . ',
							' .          1              . '

							);";

						$sel_id = "SELECT MAX(usu_id) AS usu_id FROM usuario";
					   	$usu_id = $posto->selecionar($sel_id);
					   	
					   	$sel_id = "SELECT MAX(pes_id) AS pes_id FROM pessoa";
					   	$pes_id = $posto->selecionar($sel_id);

						$insFun	 = "INSERT INTO funcionario (fun_cargo, fun_horario, fun_inscricao, fun_turno, usuario_usu_id, pessoa_pes_id) VALUES ( 
								'" . $posto->getFun_cargo()      . "',
								'" . $posto->getFun_horario()    . "',
								'" . $posto->getFun_inscricao()  . "',
								'" . $posto->getFun_turno()      . "',
								'" .         $usu_id             . "',
								'" .         $pes_id             . "'
							);";

						$okFun = $posto->inserir($insFun);
						if ($okFun) {
							echo "Cadastrado com sucesso!!";
						}
						else {
							echo "Erro ao cadastrar";
						}
					
					//}
				}

				if ($_POST['fun_cargo'] == "medico" || $_POST['fun_cargo'] == "enfermeiro" || $_POST['recepcionista']) {
					echo "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=4\" method=\"post\">";
					if ($_POST['fun_cargo'] == "medico") {
						?>
						<h1>Médico</h1>
						<label class="lbl_class">CRM:</label>
						<input class="inp_class" type="text" name="med_crm" size="28"><br>
						<label class="lbl_class">Especialização:</label>
						<input class="inp_class" type="text" name="med_especializacao" size="28"><br>
						<input class="inp_class" type = "submit" value = "cadastrar">
						<?php
					}
					// Se o funcionário for enfermeiro ao clicar no botão de proximo irá para o formulário abaixo
					else if ($_POST['fun_cargo'] == "enfermeiro") {
						?>
						<h1>Enfermeiro</h1>
						<label class="lbl_class">Registro:</label>
						<input class="inp_class" type="text" name="enf_registro" size="28"><br>
						<input class="inp_class" type = "submit" value = "cadastrar">
						<?php
					}
					else if ($_POST['fun_cargo'] == "recepcionista"){
					}
					echo "</form>";
				}
				else {
					header("Location:cadastro.php?passo=4");
				}
			}
			else if ($_GET['passo'] == 4) {
				//últimos inserts e/ou confirmação de cadastro de acordo com o que foi preenchido
				if ($_POST['fun_cargo'] == "medico") {
					$posto->setMed_crm            ($_POST['med_crm']);
					$posto->setMed_especializacao ($_POST['med_especializacao']);
					
					$selMed = "SELECT * FROM medico WHERE '" . $_POST['med_crm'] . "';";
					
					$insMed = "INSERT INTO medico (med_crm,med_especializacao) VALUES (
									'" . $posto->getMed_crm() . "',
									'" . $posto->getMed_especializacao() . "'
								);";

					$okMed = $posto->inserir($insMed);
					
					if ($okMed){
						echo "Médico(a) cadastrado!!";
					}
					else {
						echo "Não cadastrado!";
					}
				} 
				else if ($_POST['fun_cargo'] == "enfermeiro") {
					$posto->setEnf_registro($_POST['enf_registro']);	
					$selEnf = "SELECT enf_registro FROM enfermeiro WHERE '" . $_POST['enf_registro'] . "';";
					
					$insEnf = "INSERT INTO enfermeiro (enf_registro) VALUES('" . $posto->getEnf_registro() . "');";
					$okEnf =	$posto->inserir($insEnf);
					if ($okEnf) {
						echo "Enfermeiro(a) Cadastrado!";
					}
					else {
						echo "Não cadastrado!!!";
					}
				}

				////////////////////Fim do cadastro//////

						echo "recepcao";
				echo "Confirmação final - Passo 4";
			}
		}
		else { 
			echo "LOGOFF";
		}
		mysqli_close($con);
		?>
	</body>
</html>
