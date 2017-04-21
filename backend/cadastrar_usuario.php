<html>
        <head>
        </head>
        <body>
                <?php
                //cadastro de usuario e senha

                include_once ("Posto.class.php");
                $posto = new Posto;

                $posto->setUsu_email($_POST['Usu_email']);
                $posto->setUsu_senha($_POST['Usu_senha']);

                    $sel = "SELECT * FROM usuario WHERE usu_email ='" . $_POST['usu_email'] . "' ;";
                    $ins = "INSERT INTO usuario (usu_email,usu_senha) VALUES (
                                    '" . $posto->getUsu_email() . "'
                                    '" . $posto->getUsu_senha() . "'
                    );";
                    $ok = $posto->inserir($sel,$ins);
                        if ($ok) {
                            echo "Usuario cadastrado";
                        } else {
                            echo "Email j? existe!";
                        }








                ?>
        </body>
</html>