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
		$acao  = $_GET['acao'];
		$id    = $_SESSION['tipo'];
		
		
		?>
		<a href="?acao=cadastro">Cadastro</a>
		<a href="?acao=logoff">Sair</a>
		<?php
		if ($acao == "cadastro") {
		?>
			<form class="Form" action ="cadastrar.php" method="post">
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
				<input class="inp_class" type="text" name="pes_cidadania" size="28"><br>
				<label class="lbl_class">Genêro</label>
				<input class="inp_class" type="radio" name="pes_genero" value = "Masculino">Masculino
				<input class="inp_class" type="radio" name="pes_genero" value = "Feminino">Feminino<br>
				<label class="lbl_class">Sexo biologico:</label>
				<input class="inp_class" type="radio" name="pes_sexo_biologico" value = "Masculino">Masculino
				<input class="inp_class" type="radio" name="pes_sexo_biologico" value = "Feminino">Feminino<br>
				<label class="lbl_class">Telefone:</label>
				<input class="inp_class" type="text" name="pes_telefone" size = "15"><br>
				<label class="lbl_class">País:</label>
				<input class="inp_class" type="text" name="end_pais" size = "28"><br>
				<label class="lbl_class">Estado:</label>
				<select class="select" name = "end_estado">
				<option class="option" value="SP">SP</option>
				<option class="option" value="MG">MG</option>
				</select><br>
				<?php
				//$posto->opcao("estado");
				?>
				<label class="lbl_class">Cidade:</label>
				<input class="inp_class" type="text" name="end_cidade" size="28"><br>
				<label class="lbl_class">Cep:</label>
				<input class="inp_class" type="text" name="end_cep" size="28"><br>
				<label class="lbl_class">Bairro:</label>
				<input class="inp_class" type="text" name="end_bairro" size="28"><br>
				<label class="lbl_class">Distrito:</label>
				<input class="inp_class" type="text" name="end_distrito" size="28"><br>
				<label class="lbl_class">Rua:</label>
				<input class="inp_class" type="text" name="end_rua" size="28"><br>
				<label class="lbl_class">Numero:</label>
				<input class="inp_class" type="text" name="end_numero" size="28"><br>
				<input class="inp_class" type="submit" value="Proximo">
			</form>
			<?php
		}
				if ($_SESSION['cargo'] == "recepcao"){
				?>
				<form class="Form" action ="cadastrar.php" method="post">
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
				</form>
				<?php
				}
				if ($_SESSION['cargo'] == "administracao"){
				?>
				<form class="Form" action ="cadastrar.php" method="post">
					<h1>Funcionário</h1>
					<label class="lbl_class">Cargo:</label>
					<select class="select" name = "fun_cargo">
						<option class="option" value = "recepcao">Recepcionista</option>
						<option class="option" value = "medico">Médico</option>
						<option class="option" value = "enfermeiro">Enfermeiro</option>
					</select><br>
					<label class="lbl_class">Horario:</label>
					<input class="inp_class" type="time" name="fun_horario" size="28"><br>
					<label class="lbl_class">Inscrição:</label>
					<input class="inp_class" type="text" name="fun_inscricao" size="28"><br>
					<label class="lbl_class">Turno:</label>
					<select class="select" name = "fun_turno">
					 <option class="option" value = "manha">Manhã</option>
					 <option class="option" value = "tarde">Tarde</option>
					 <option class="option" value = "noite">Noite</option>
					</select><br>
					<select name = "setor">

					</select>

					<input class="inp_class" type="submit" value = "Proximo">
				</form>
			<?php
					if ($_SESSION['fun_cargo'] == "medico"){
						?>
						<form class="Form" action = "cadastrar.php" method="post">
							<h1>Médico</h1>
							<label class="lbl_class">CRM:</label>
							<input class="inp_class" type="text" name="med_crm" size="28"><br>
							<label class="lbl_class">Especialização:</label>
							<input class="inp_class" type="text" name="med_especializacao" size="28"><br>
							<input class="inp_class" type = "submit" value = "cadastrar">
						</form>
						<?php
					}
					else if ($_SESSION['fun_cargo'] == "enfermeiro"){
					?>
					<form class="Form" action="cadastrar.php" method="post">
						<h1>Enfermeiro</h1>
						<label class="lbl_class">Registro:</label>
						<input class="inp_class" type="text" name="enf_registro" size="28"><br>
						<input class="inp_class" type = "submit" value = "cadastrar">
					</form>
						<?php
					}
				}
						?>


	</body>
</html>
