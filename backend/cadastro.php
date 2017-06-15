<?php
 session_start();
?>
<html>
  <head>
  <link rel='stylesheet' href='../css/main.css'>
  </head>
  <body>
    <?php
    include_once "funcoes.php";
    include_once "Posto.class.php";
    include_once "Sql.class.php";

    $metodo = new Metodo;
    $sql = new Sql;
    $con = $sql->conecta();

    $acao =isset($_GET['acao'])? $_GET['acao'] : "";

    if ($acao == "cadastro") {
      if (!isset($_GET['passo'])) {
        //formulário dados pessoais em arquivo separado, sendo incluso.
        if ($_SESSION['esc'] == 1) {
          $_SESSION['form'] = 1;
          include 'form_pessoa.php';
        } else {
          $_SESSION['form'] = 3;
          include 'form_pessoa.php';
        }

        $_GET['passo'] = "";

      } elseif ($_GET['passo'] == 2) {
        $metodo->setPes_nome($_POST['pes_nome']);
        $metodo->setPes_pai($_POST['pes_pai']);
        $metodo->setPes_mae($_POST['pes_mae']);
        $metodo->setPes_rg($_POST['pes_rg']);
        $metodo->setPes_cpf($_POST['pes_cpf']);
        $metodo->setPes_data($_POST['pes_data']);
        $metodo->setPes_email($_POST['pes_email']);
        $metodo->setPes_estado_civil($_POST['estado_civil']);
        $metodo->setPes_cidadania($_POST['pes_cidadania']);
        $metodo->setPes_genero($_POST['genero']);
        $metodo->setPes_sexo_biologico($_POST['sexo']);
        $metodo->setPes_telefone($_POST['pes_telefone']);

        if (isset($_POST['tipo'])) {
        $metodo->setPes_tipo($_POST['tipo']);
        }
        // TODO: arrumar cidade, estado
        $estado = tiraAcentos($_POST['end_estado']);
        $cidade = tiraAcentos($_POST['end_cidade']);

        $selId = "SELECT est_id FROM estado WHERE est_nome = '$estado'";
        $estadoId = $sql->selecionar($selId);

        $selId = "SELECT cid_id FROM cidade WHERE cid_nome = '$cidade' AND est_id = $estadoId";
        $cidadeId = $sql->selecionar($selId);

        $metodo->setEnd_pais($_POST['end_pais']);
        $metodo->setEnd_estado($estadoId);
        $metodo->setEnd_cidade($cidadeId);
        $metodo->setEnd_cep($_POST['end_cep']);
        $metodo->setEnd_bairro($_POST['end_bairro']);
        $metodo->setEnd_rua($_POST['end_rua']);
        $metodo->setEnd_numero($_POST['end_numero']);
        $metodo->setEnd_complemento($_POST['end_complemento']);

        // Verifica se a pessoa que está sendo cadastrada já foi cadastrada anteriormente


          ////////////////////Insere os dados do formulário anterior no banco/////////////////////////
        if ($_SESSION['esc'] == 1) {
          $selPes="SELECT * FROM pessoa WHERE pes_cpf='" . $_POST ['pes_cpf'] . "';";
          $qtd=$sql->selecionar($selPes);

          if ($qtd>=1) {
            echo "CPF já existente! Digite novamente!";
          }

          $tipo = 0;

          $insPes="INSERT INTO pessoa (pes_nome, pes_pai, pes_mae, pes_rg, pes_cpf, pes_data, pes_tipo, pes_email, pes_estado_civil, pes_cidadania, pes_genero, pes_sexo_biologico, pes_telefone)
            VALUES (
              '". $metodo->getPes_nome()          ."',
              '". $metodo->getPes_pai()           ."',
              '". $metodo->getPes_mae()           ."',
              '". $metodo->getPes_rg()            ."',
              '". $metodo->getPes_cpf()           ."',
              '". $metodo->getPes_data()          ."',
              '". $tipo                           ."',
              '". $metodo->getPes_email()         ."',
              '". $metodo->getPes_estado_civil()  ."',
              '". $metodo->getPes_cidadania()     ."',
              '". $metodo->getPes_genero()        ."',
              '". $metodo->getPes_sexo_biologico()."',
              '". $metodo->getPes_telefone()      ."'
            );";

            //Insere os dados na tabela pessoa
          $okPes=$sql->inserir($insPes);

            //Insere os dados na tabela endereço
          $sel_id="SELECT MAX(pes_id) AS pes_id FROM pessoa";
          $pes_id=$sql->selecionar($sel_id);

          $insEnd="INSERT INTO endereco (end_pais, end_estado, end_cidade, end_cep, end_bairro, end_rua, end_numero, end_complemento, pessoa_pes_id) VALUES (
                '" . $metodo->getEnd_pais()        . "',
                '" . $metodo->getEnd_estado()      . "',
                '" . $metodo->getEnd_cidade()      . "',
                '" . $metodo->getEnd_cep()         . "',
                '" . $metodo->getEnd_bairro()      . "',
                '" . $metodo->getEnd_rua()         . "',
                '" . $metodo->getEnd_numero()      . "',
                '" . $metodo->getEnd_complemento() . "',
                '" . $pes_id          . "'
            );";
           // Verifica se a query foi inserida corretamente
          $okEnd=$sql->inserir($insEnd);
           /////////////////////////fim da inserção de dados Pessoais////////////////////////////////
           //verifica se a query foi inserida corretamente
        } else {
          $tipo = 0;
          $updPes = "UPDATE pessoa SET pes_nome='" . $metodo->getPes_nome() . "',
                      pes_pai='" . $metodo->getPes_pai() . "',
                      pes_mae='" . $metodo->getPes_mae()  . "',
                      pes_rg='" . $metodo->getPes_rg() . "',
                      pes_cpf='" . $metodo->getPes_cpf() . "',
                      pes_data='" . $metodo->getPes_data() . "',
                      pes_tipo='" . $tipo . "',
                      pes_email='" . $metodo->getPes_email() . "',
                      pes_estado_civil='" . $metodo->getPes_estado_civil() . "',
                      pes_cidadania='" . $metodo->getPes_cidadania() . "',
                      pes_genero='" . $metodo->getPes_genero() . "',
                      pes_sexo_biologico='" . $metodo->getPes_sexo_biologico() . "',
                      pes_telefone='" . $metodo->getPes_telefone() . "'
                      WHERE pes_id='" . $_SESSION['id'] . "';";

           $okPes = $sql->inserir($updPes);

           $updEnd = "UPDATE endereco SET end_pais='" . $metodo->getEnd_pais() . "',
                      end_estado='". $metodo->getEnd_estado() . "',
                      end_cidade='". $metodo->getEnd_cidade()  . "',
                      end_cep='". $metodo->getEnd_cep() . "',
                      end_bairro='". $metodo->getEnd_bairro() . "',
                      end_rua='". $metodo->getEnd_rua() . "',
                      end_numero='". $metodo->getEnd_numero() . "',
                      end_complemento='". $metodo->getEnd_complemento() . "',
                      pessoa_pes_id='". $_SESSION['id'] . "'
                      WHERE pessoa_pes_id='". $_SESSION['id'] . "';";

           $okEnd = $sql->inserir($updEnd);
        }
        if ($okPes && $okEnd) {
          /* se o usuário logado for recepcionista ele só poderá cadastrar
          os dados de pacientes do formulário abaixo */
          if ($_SESSION['tipo'] == "recepcao") {
            if ($_SESSION['esc'] == 1) {
              $_SESSION['form'] = 1;
                /*formulário para o preenchimento de dados
                do paciente que está sendo cadastrado*/
              include 'form_paciente.php';
            } else {
              $_SESSION['form'] = 3;
              include 'form_paciente.php';
            }
          } else {
            if ($_SESSION['esc'] == 1) {
              /* Se o usuário logado for administrativo ele só poderá cadastrar
              os dados de funcionário do formulário abaixo
              */
              $_SESSION['form'] = 1;
              /*formulário para o preenchimento de dados
              do funcionario que está sendo cadastrado*/
              include 'form_funcionario.php';
            } else {
              $_SESSION['form'] = 3;
              include 'form_funcionario.php';
            }
          }
        } else {
          echo "Erro ao cadastrar pessoa!";
        }
      } elseif ($_GET['passo'] == 3) {
        if ($_SESSION['tipo'] == "recepcao") {
          $metodo->setPac_educacao($_POST['escolaridade']);

          $metodo->setPds_convenio_nome($_POST['pds_convenio_nome']);
          $metodo->setPds_numero_sus($_POST['pds_numero_sus']);
          $metodo->setPds_num_convenio($_POST['pds_num_convenio']);


          if ($_SESSION['esc'] == 1) {
          ////////Seleciona o ultimo id de pessoa e ultimo id de paciente para ser utilizado///////////
            $sel_id="SELECT MAX(pes_id) AS pes_id FROM pessoa";
            $pes_id=$sql->selecionar($sel_id);

            $sel_id="SELECT MAX(pac_id) AS pac_id FROM paciente";
            $pac_id=$sql->selecionar($sel_id);
            $pac_id++;

            ////////////////////inserção de dados nas tabelas paciente e plano_de_saude ///////////////
            $insPac="INSERT INTO paciente (pac_educacao, pac_hospitalizado, pessoa_pes_id) VALUES (
                    '" . $metodo->getPac_educacao()    . "',
                    0 ,
                    '" . $pes_id                       . "'

                    );";

            $insPds="INSERT INTO plano_de_saude (pds_convenio_nome,pds_numero_sus,pds_num_convenio,pac_id)  VALUES (
                    '" . $metodo->getPds_convenio_nome(). "',
                    '" . $metodo->getPds_numero_sus()   . "',
                    '" . $metodo->getPds_num_convenio() . "',
                    '" . $pac_id            . "'

                  );";
            $okPac=$sql->inserir($insPac);
            $okPds=$sql->inserir($insPds);
          ///////////////////////fim da inserção de dados///////////////////////////
          } else {
            $updPac="UPDATE paciente SET
                        pac_tipo_sangue='" . $metodo->getPac_tipo_sangue() . "',
                        pac_remedio='" . $metodo->getPac_remedio() . "',
                        pac_doenca='" . $metodo->getPac_doenca()  . "',
                        pac_educacao='" . $metodo->getPac_educacao() . "',
                        pac_hospitalizado='0',
                        pessoa_pes_id='" . $_SESSION['id'] . "',
                        WHERE pessoa_pes_id='" . $_SESSION['id'] . "';";

            $okPac=$sql->inserir($updPac);

            $sel="SELECT pac_id FROM paciente WHERE pessoa_pes_id='" . $_SESSION['id'] . "';";
            $pacId= $sql->selecionar($sel);

            $updPds="UPDATE plano_de_saude SET
                        pds_convenio_nome='" . $metodo->getPds_convenio_nome() . "',
                        pds_numero_sus='" . $metodo->getPds_numero_sus() . "',
                        pds_num_convenio='" . $metodo->getPds_num_convenio()  . "',
                        paciente_pac_id='" . $pacId  . "'
                        WHERE paciente_pac_id='" . $pacId . "';";

            $okPds=$sql->inserir($updPds);



          }
            if ($okPac && $okPds) {
              echo "<script>alert('Concluido!')
              location.href='index.php';</script>;";
            } else {
              echo "Erro!";
            }
            //}
        } else {
          $metodo->setFun_cargo($_POST['cargo']);
          $metodo->setFun_inscricao($_POST ['fun_inscricao']);
          $metodo->setFun_turno($_POST ['turno']);

          $metodo->setUsu_email($_POST['usu_email']);
          $metodo->setUsu_senha($_POST['usu_senha']);
          $metodo->setSet_setor($_POST['setor']);

          $selCar="SELECT * FROM cargo WHERE car_id='".$_POST['cargo']."';";
          $cargo=$sql->fetch($selCar);

          $_SESSION['fun_cargo'] = $cargo[1];

          if ($_SESSION['esc'] == 1) {
            if ($_POST['usu_senha'] <> $_POST['conf_senha']) {
              echo "<script>alert('Senhas não correspondem!')
              location.href='form_funcionario.php?voltar=1';</script>;";

            } else {
              $sel_id="SELECT MAX(usu_id) AS usu_id FROM usuario";
              $usu_id=$sql->selecionar($sel_id);
              $usu_id++;

              $sel_id="SELECT MAX(pes_id) AS pes_id FROM pessoa";
              $pes_id=$sql->selecionar($sel_id);

              $insFun="INSERT INTO funcionario (fun_cargo, fun_inscricao, fun_turno, pessoa_pes_id, setor_set_id) VALUES (
                      '" . $metodo->getFun_cargo()    . "',
                      '" . $metodo->getFun_inscricao(). "',
                      '" . $metodo->getFun_turno()    . "',
                      '" .     $pes_id                . "',
                      '" . $metodo->getSet_setor()    . "'
                    );";


              $sel_id="SELECT MAX(fun_id) AS fun_id FROM funcionario";
              $fun_id=$sql->selecionar($sel_id);
              $fun_id++;

              $insUsu="INSERT INTO usuario (usu_senha, usu_email, usu_ativo, usu_tipo, funcionario_id) VALUES (
                        '" . $metodo->getUsu_senha(). "',
                        '" . $metodo->getUsu_email(). "',
                        '     1                        ',
                        '     1                        ',
                        '" .    $fun_id             . "'
                      );";

              $okFun=$sql->inserir($insFun);
              $okUsu=$sql->inserir($insUsu);
            }
          } else {
            if ($_POST['usu_senha'] <> $_POST['conf_senha']) {
              echo "<script>
                      alert('Senhas não correspondem!');
                      window.history.go(-1);
                    </script>;";

            } else {
              $updFun="UPDATE funcionario SET
                          fun_cargo='" . $metodo->getFun_cargo() . "',
                          fun_inscricao='" . $metodo->getFun_inscricao() . "',
                          fun_turno='" . $metodo->getFun_turno()  . "',
                          pessoa_pes_id='" . $_SESSION['id']  . "',
                          setor_set_id='" . $metodo->getSet_setor(). "'
                          WHERE pessoa_pes_id='" . $_SESSION['id'] . "';";

              $sel="SELECT fun_id FROM funcionario WHERE pessoa_pes_id='" . $_SESSION['id'] . "';";
              $_SESSION['fun_id']=$sql->selecionar($sel);

              $updUsu="UPDATE usuario SET usu_senha='" . $metodo->getUsu_senha() . "',
                      usu_email='" . $metodo->getUsu_email() . "',  usu_ativo='1', usu_tipo='1',
                      funcionario_id='" . $_SESSION['fun_id'] . "' WHERE funcionario_id='" . $_SESSION['fun_id'] . "'
                      ;";

              $okFun=$sql->inserir($updFun);
              $okUsu=$sql->inserir($updUsu);
            }
          }
          if ($okFun && $okUsu) {
            echo "Cadastrado com sucesso!!";
            echo $_SESSION['fun_cargo'];
            if ($_SESSION['fun_cargo'] == "medico" || $_SESSION['fun_cargo'] == "enfermeiro" || $_SESSION['fun_cargo'] == "enfermeiro-chefe") {
              ////////////////formulário formação do médico ou enfermeiro ///////////////////
              if ($_SESSION['esc'] == 1) {
                $_SESSION['form'] = 1;
                include 'form_complementar.php';
              } else {
                $_SESSION['form'] = 3;
                include 'form_complementar.php';
              }
              /////////////////////fim//////////////////////////////////////////////////////
            } else {
              $_SESSION['form'] = 2;
              include 'form_pessoa.php';
            }

          } else {
            echo "Erro ao cadastrar";
          }
        }
      } elseif ($_GET['passo'] == 4) {
        //últimos inserts e/ou confirmação de cadastro de acordo com o que foi preenchido
        if ($_SESSION['fun_cargo'] == "medico") {
          $metodo->setMed_crm($_POST['med_crm']);
          $metodo->setEsp_nome($_POST['especializacao']);

          $esp=$metodo->getEsp_nome();

          if ($_SESSION['esc'] == 1) {
            $sel_id="SELECT MAX(fun_id) AS fun_id FROM funcionario";
            $fun_id=$sql->selecionar($sel_id);

            $insMed="INSERT INTO medico (med_crm, funcionario_fun_id) VALUES (
                    '" . $metodo->getMed_crm() . "',
                    '" . $fun_id               . "'
                    );";

            $sel_id="SELECT MAX(med_id) AS med_id FROM medico";
            $med_id=$sql->selecionar($sel_id);
            $med_id++;

            $insHas="INSERT INTO medico_has_especializacao (medico_med_id, especializacao_esp_id) VALUES(
                    '" . $med_id                . "',
                    '" . $metodo->getEsp_nome() . "'
                    );";

            $okMed=$sql->inserir($insMed);
            $okHas=$sql->inserir($insHas);
          } else {

            $updMed="UPDATE medico SET
                        med_crm='" . $metodo->getMed_crm() . "',
                        funcionario_fun_id='" . $_SESSION['fun_id']  . "'
                        WHERE funcionario_fun_id='" . $_SESSION['fun_id'] . "';";

            $sel="SELECT * FROM medico WHERE funcionario_fun_id='" . $_SESSION['fun_id'] . "';";
            $med=$sql->fetch($sel);

            $updHas="UPDATE medico_has_especializacao SET
                        medico_med_id='" . $med[0] . "',
                        especializacao_esp_id='" . $metodo->getEsp_nome() . "'
                        WHERE medico_med_id='" . $med[0]  . "';";

            $okMed=$sql->inserir($updMed);
            $okHas=$sql->inserir($updHas);
          }

          if ($okMed && $okHas) {
            echo "Médico(a) cadastrado!!";
            $_SESSION['form'] = 2;
            include 'form_pessoa.php';

          } else {
            echo "Não cadastrado!" . $insMed . "...." . $insHas ;
          }

        } elseif ($_SESSION['fun_cargo'] == "enfermeiro" || $_SESSION['fun_cargo'] == "enfermeiro-chefe") {
          $metodo->setEnf_registro($_POST['enf_registro']);

          $selEnf="SELECT enf_registro FROM enfermeiro WHERE '" . $_POST['enf_registro'] . "';";

          if ($_SESSION['esc'] == 1) {
            $sel_id="SELECT MAX(fun_id) AS fun_id FROM funcionario";
            $fun_id=$sql->selecionar($sel_id);

            $insEnf="INSERT INTO enfermeiro (enf_registro, funcionario_fun_id) VALUES(
                    '" . $metodo->getEnf_registro() . "',
                    '" . $fun_id                    . "'
                    );";
            $okEnf= $sql->inserir($insEnf);
            ////////////////////Fim do cadastro//////
          } else {
            $updEnf="UPDATE enfermeiro SET enf_registro='" . $metodo->getEnf_registro() . "',
                     funcionario_fun_id='". $_SESSION['fun_id'] . "' WHERE funcionario_fun_id='" . $_SESSION['fun_id'] . "';";

            $okEnf= $sql->inserir($updEnf);
          }

          if ($okEnf) {
            echo "Enfermeiro(a) Cadastrado!";
            $_SESSION['form'] = 2;
            include 'form_pessoa.php';

          } else {
            echo "Não cadastrado!!!";
          }
        } else {
          $_SESSION['form'] = 2;
          include'form_funcionario.php';

        }

      } elseif ($_GET['passo'] == 5) {
        if ($_SESSION['tipo'] == "administracao") {
          if ($_SESSION['fun_cargo'] == "medico" || $_SESSION['fun_cargo'] == "enfermeiro" ||
              $_SESSION['fun_cargo'] == "enfermeiro-chefe") {
            $_SESSION['form'] = 2;
            include 'form_funcionario.php';
          } else {
            echo "<script>alert('Concluido!')
            location.href='cadastro.php';</script>;";
          }

        } else {
          echo "paciente!!";
        }
      } elseif ($_GET['passo'] == 6) {
        if ($_SESSION['tipo'] == "administracao") {
         if ($_SESSION['fun_cargo'] == "medico" || $_SESSION['fun_cargo'] == "enfermeiro" ||
             $_SESSION['fun_cargo'] == "enfermeiro-chefe") {
          $_SESSION['form'] = 2;
          include 'form_complementar.php';

         }
        }
      } elseif ($_GET['passo'] == 7) {
        echo "<script>alert('Concluido!')
        location.href='cadastro.php';</script>;";


      } elseif ($acao == "logoff") {
        session_destroy();
        unset($_SESSION['tipo']);
        echo "<script>alert('Tchau!! Volte sempre!!')
        location.href='index.php';</script>;";
      }
    }
    mysqli_close($con);
    ?>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/funcoes.js"></script>
    <script src="../js/autocompletar.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=pt&region=BR&key=AIzaSyC0Qliqe7HjHeD2daBzwVtk6ndT3kJLVlc&libraries=places&callback=initAutocomplete" onerror="loadError()"
        async defer></script>
  </body>
</html>
