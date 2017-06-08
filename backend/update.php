<?php
   $_SESSION['form'] = isset($_SESSION['form'])? $_SESSION['form'] : "";
   $_GET['p'] = isset ($_GET['p'])? $_GET['p'] : "";

   if ($_SESSION['form'] == 2 || $_SESSION['form'] == 3 ) {

    include 'form_pessoa.php';
    echo "update!";

    if ($_GET['p'] == 1) {

    echo "aqui entrará o formulário FUNCIONARIO";

   	} elseif ($_GET['p'] == 2) {
      if ($_SESSION['fun_cargo'] == "medico") {

        include 'form_complementar.php';
      }
   	} elseif ($_GET['p'] == 3){
   		echo "passo 3";
   	}
   }
?>
