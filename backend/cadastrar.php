<?php
	session_start();
?>
<html>
		<head>
		</head>
		<body>
		 <?php
		 include_once("Posto.class.php");
		 $posto = new Posto;
						 $posto->setPes_nome     			($_POST['pes_nome']);
						 $posto->setPes_pai     			($_POST['pes_pai']);
						 $posto->setPes_mae     			($_POST['pes_mae']);
						 $posto->setPes_rg       			($_POST['pes_rg']);
						 $posto->setPes_cpf      			($_POST['pes_cpf']);
						 $posto->setPes_data     			($_POST['pes_data']);
						 $posto->setPes_email    			($_POST['pes_email']);
						 $posto->setPes_estado_civil 		($_POST['pes_estado_civil']);
						 $posto->setPes_Cidadania 			($_POST['pes_cidadania']);
						 $posto->setPes_genero		 		($_POST['pes_genero']);
						 $posto->setPes_sexo_biologico		($_POST['pes_sexo_biologico']);
						 $posto->setPes_telefone			($_POST['pes_telefone']);
						 $posto->setEnd_pais			    ($_POST['end_pais']);
						 $posto->setEnd_Estado			    ($_POST['end_estado']);
						 $posto->setEnd_cidade   		    ($_POST['end_cidade']);
						 $posto->setEnd_cep      		    ($_POST['end_cep']);
						 $posto->setEnd_bairro   		    ($_POST['end_bairro']);
						 $posto->setEnd_distrito 		    ($_POST['end_distrito']);
						 $posto->setEnd_rua			 	    ($_POST['end_rua']);
						 $posto->setEnd_numero			    ($_POST['end_numero']);
						 
							
							 
						
						$selPes = "SELECT * FROM pessoa WHERE pes_cpf = '" . $_POST ['pes_cpf'] . "';";
						$qtd = $posto->selecionar($selPes);
						if ($qtd >= 1){
							echo "Pessoa já cadastrada!!";
							?>
							<a href="?acao=cadastro">Voltar</a>
							<?php
						}
						else{
										
							$insPes = "INSERT INTO pessoa (pes_nome,pes_pai,pes_mae,pes_rg,pes_cpf,pes_data,pes_tipo,pes_email,
											pes_estado_civil,pes_cidadania,pes_genero,pes_sexo_biologico,pes_telefone)VALUES ( 
											'". $posto->getPes_nome()    	  	."',
											'". $posto->getPes_pai()     	  	."',
											'". $posto->getPes_mae()          	."',
											'". $posto->getPes_rg()           	."',
											'". $posto->getPes_cpf()          	."',
											'". $posto->getPes_data()         	."',
											'". $posto->getPes_tipo()     	  	."',
											'". $posto->getPes_email()        	."',
											'". $posto->getPes_estado_civil()  	."',
											'". $posto->getPes_cidadania()    	."',
											'". $posto->getPes_genero()       	."',
											'". $posto->getPes_sexo_biologico()	."',
											'". $posto->getPes_telefone()      	."'
											
											
											
											);";
						$okPes = $posto->inserir($insPes);
							$insEnd = "INSERT INTO endereco (end_pais,end_estado,end_cidade,end_cep,end_bairro,end_distrito,
											end_rua,end_numero) VALUES (
												'" . $posto->getEnd_pais()     . "',
												'" . $posto->getEnd_estado()   . "',
												'" . $posto->getEnd_cidade()   . "',
												'" . $posto->getEnd_cep()      . "',
												'" . $posto->getEnd_bairro()   . "',
												'" . $posto->getEnd_distrito() . "',
												'" . $posto->getEnd_rua() 	   . "',
												'" . $posto->getEnd_numero()   . "'
											);";
						$okEnd = $posto->inserir($insEnd);
						if ($okPes && $okEnd) {
							echo "Pessoa cadastrada com sucesso!!!";
							
							//Aqui procura qual o cargo do id logado.
							$con = $posto->conectar();
							$selCar = "SELECT * FROM funcionario WHERE USUARIO_usu_id = '" . $_SESSION['tipo']. "';";
							echo $selCar; 											
							$res = mysqli_query($con, $selCar) or die ("Erro no select de procura do id do funcionário" . mysqli_error($con) . "<br>" . $selCar);
							$cargo = mysqli_fetch_array($res);							
							
							$_SESSION['cargo'] = $cargo['fun_cargo'];

							mysqli_close($con);
								
//							header("Location:cadastro.php");
							
						}
						else 
							echo "Erro ao cadastrar pessoa";

						
						if ($_SESSION['cargo'] == "recepcao"){
							$posto->setPac_tipo_sangue			($_POST['pac_tipo_sangue']);
							$posto->setPac_remedio				($_POST['pac_remedio']);
							$posto->setPac_doenca				($_POST['pac_doenca']);
							$posto->setPac_educacao				($_POST['pac_educacao']);
							$posto->setPac_profissao	        ($_POST['pac_profissao']);
							$posto->setPds_convenio_nome        ($_POST['pds_convenio_nome'])
							$posto->setPds_numero_sus           ($_POST['pds_numero_sus'])
							
							$qtdPds = "SELECT * FROM plano_de_saude WHERE pds_sus = 
									  '" . $_POST['pds_numero_sus'] . "';";

							
							if ($qtdPds >=1){
								echo"Paciente já cadastrado!";
							}
							else {
								$insPac = "INSERT INTO paciente (pac_tipo_sangue,pac_plano_saude,pac_remedio,pac_doenca,pac_educacao,pac_profissao) VALUES (
										'" . GetPac_tipo_sangue() 		. "'
										'" . GetPac_remedio()     		. "'
										'" . GetPac_doenca()      		. "'
										'" . GetPac_educacao()    		. "'
										'" . GetPac_profissao()         . "'
								
								);";
								$insPds = "INSERT INTO plano_de_saude (pds_convenio,pds_sus) VALUES( 
											'" . GetPds_convenio_nome() . "'
											'" . GetPds_numero_sus()    . "'
											);";

								$okPac = $posto->inserir($insPac);
								$okPds = $posto->inserir($insPds);
								if ($okPac && $okPds) {
									echo "Paciente cadastrado!!!!!!!!";
								}
								else 
									echo "Não cadastrado!!!!!!!!!";
							}
							
						}						
						else if ($_SESSION['cargo'] == "administracao"){
							 $posto->setFun_cargo 		 ($_POST ['fun_cargo']);
							 $posto->setFun_horario 	 ($_POST ['fun_horario']);
							 $posto->setFun_inscricao  	 ($_POST ['fun_inscricao']);
							 $posto->setFun_turno 		 ($_POST ['fun_turno']);
							 
								// Seleção e inserção na tabela funcionário
								$selFun  = "SELECT fun_inscricao FROM funcionario WHERE '" . $_POST['fun_inscricao'] . "';";
								
								$qtdFun = $posto->selecionar($selfun);
									if ($qtd >=1) {
										echo"Funcionario já cadastrado!";
									}
								
									else{
										
										$insFun	 = "INSERT INTO funcionario (fun_cargo, fun_horario, fun_inscricao, fun_turno) VALUES ( 
												'" . $posto->getFun_cargo()      . "',
												'" . $posto->getFun_horario()    . "',
												'" . $posto->getFun_inscricao()  . "',
												'" . $posto->getFun_turno()      . "'
												
											 );";

										$okFun = $posto->inserir($insFun);
										if ($okFun) {
											echo "Cadastrado com sucesso!!";
										}
										else {
											echo "Erro ao cadastrar";
										}
									}

									$_SESSION['fun_cargo'] = $_POST['fun_cargo'];
								 }
								 	//header("Location:cadastro.php");

									if ($_SESSION['fun_cargo'] == "medico"){
											$posto->setMed_crm           ($_POST['med_crm']);
											$posto->setMed_especializacao($_POST['med_especializacao']);
											
											$selMed = "SELECT * FROM medico WHERE '" . $_POST['med_crm'] . "';";
											
											$insMed = "INSERT INTO medico (med_crm,med_especializacao) VALUES ('" . $posto->getMed_crm() . "',                    		  '" . $posto->getMed_especializacao() . "'
														);";	
										$okMed = $posto->inserir($insMed);
										if ($okMed){
											echo "Médico(a) cadastrado!!";
										}
										else {
											echo "Não cadastrado!";
										}
									} 
									else if ($_SESSION['fun_cargo'] == "enfermeiro"){
											$posto->setEnf_registro($_POST['enf_registro']);	
													$selEnf = "SELECT enf_registro FROM enfermeiro WHERE      '" . $_POST['enf_registro'] . "'
															  ;";
													
													$insEnf = "INSERT INTO enfermeiro (enf_registro) VALUES(
														'" . $posto->getEnf_registro() . "'
													);";
											$okEnf =	$posto->inserir($insEnf);
											if ($okEnf){
												echo "Enfermeiro(a) Cadastrado!";
											}
											else {
												echo "Não cadastrado!!!";
											}
									}
						}	
									
						
				
					
				
			
		 ?>
		</body>
</html>