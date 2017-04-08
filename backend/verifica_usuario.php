<?php
	session_start();
?>
<html>
	<head>
	</head>
	<body>

		<?php
		//Verifica usuario e senha do index.php (login)

		if (!isset ($_SESSION['tipo'])) {
			if ($_POST['usu_email'] == "" || $_POST['usu_senha'] == "") {
				//Direciona pro formulário de acesso
				//echo "Digite os campos corretamente";
				echo "<script>alert('Digite os campos corretamente')
								location.href='index.php';</script>;";
			}
			else {
				include_once ("Sql.class.php");
				$sql = new Sql;

				$sel= "SELECT * FROM usuario WHERE usu_senha = '".$_POST['usu_senha'].
						"' AND usu_email = '".$_POST['usu_email']."';";
				$qtd = $sql->selecionar($sel);

				if ($qtd >=1){
					$_SESSION['tipo'] = $qtd;
					echo "Logado !!! <br>";
					$log_data = date ("y-m-d");
					$log_ip = $_SERVER['REMOTE_ADDR'];
					$log_id = $_SESSION['tipo'];
					$sel = "SELECT * FROM login_acesso WHERE
								log_ip   = '" . $log_ip . "' AND
								log_data = '" . $log_data . "' AND
								USUARIO_usu_id = "  . $_SESSION['tipo'] . "
								;";
					$ins = "INSERT INTO login_acesso (log_ip,log_data,USUARIO_usu_id) VALUES (
								'" . $log_ip 					 . "',
								'" . $log_data 				 . "',
								 " . $_SESSION['tipo'] . "
								);";
					echo "olá" . $ins;

					$qtd = $sql->selecionar($sel);
					if ($qtd >=1){
						echo"Sessão cadastrada anteriormente!!";
					}
					else{
						$ok = $sql->inserir($ins);

						if ($ok) {
							echo "Cadastrado com sucesso!";
						}
						else {
							echo "Sessão não cadastrada com sucesso!";
						}
						//Direciona pra página de usuário logado
					}
					echo
					"<script>
						alert('Bem vindo!!');
						location.href='../index.php';
					</script>;";
				}
				else {
				//Direciona pro formulário de acesso
					echo
					"<script>
						alert('Usuario e/ou senha invalidos!!');
						location.href='index.php';
					</script>;";
				}
			}
		}
		else {
			//Direciona pra página de usuário logado
			echo
			"<script>
				alert('Oláaa');
				location.href='../index.php';
			</script>;";
		}
		?>
	</body>
</html>
