<?php
if ($_SESSION['form'] == 1) {
  $tipo = "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=3\" method=\"post\">";
} elseif ($_SESSION['form'] == 2) {
  $tipo = "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=6\" method=\"post\">";
} else {
  $tipo = "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=3\" method=\"post\">";
}
?>
<!--Formulário de dados da pessoa como paciente-->
