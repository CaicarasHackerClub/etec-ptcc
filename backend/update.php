<?php	
   $_SESSION['form'] = isset($_SESSION['form'])? $_SESSION['form'] : "";
   
   if ($_SESSION['form'] == 2 || $_SESSION['form'] == 3 ) {
  	include 'form_pessoa.php';
   	if ($_GET['p'] == 1) {
   	  
   	  if ($_SESSION['tipo'] == "administracao") {
   	  	include 'form_funcionario.php';
   	  	} else {
   	  	include 'form_paciente.php';
   	  }
   	
   	} elseif ($_GET['p'] == 2) {
   		if ($_SESSION['tipo'] == "administracao") {
   		  echo "adm";
   		  if ($_SESSION['fun_cargo'] == "medico") {
   		  	echo "medicoo";
   		  	include 'form_complementar.php';
   		  } elseif ($_SESSION['fun_cargo'] == "enfermeiro") {
   		  	echo "enfermeiroo";
   		  	include 'form_complementar.php';
   		  } 
   		} elseif ($_SESSION['tipo'] == "recepcao") {
   			include 'form_paciente.php';
   		}
   	} else {
   		echo "passo 3";
   	}
   } 
?>