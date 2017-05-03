<?php
 session_start();
?>
<html>
  <head>
  <link rel='stylesheet' href='../css/main.css'>
  </head>
  <body>
    <?php
    include_once("Posto.class.php");
    $metodo=new Metodo;
    include_once("Sql.class.php");
    $sql=new Sql;

    $acao =isset($_GET['acao'])? $_GET['acao'] : "";

    $con=$sql->conecta();

    $selCar="SELECT f.fun_cargo FROM funcionario f INNER JOIN usuario u ON f.fun_id=u.funcionario_id WHERE u.usu_id='" . $_SESSION['id_usu']. "';";

    $res=mysqli_query($con, $selCar) or die("Erro: id funcionario " . mysqli_error($con) . "<br> Query: " . $query);
    $cargo=mysqli_fetch_array($res);

    $_SESSION['tipo']=$cargo['fun_cargo'];
    ?>
    <?php
    if ($acao == "cadastro") {
      if (!isset($_GET['passo'])) {
        ?>
        <form class="form form-cadastro" action="cadastro.php?acao=cadastro&passo=2" method="post">
          <h1 class="titulo">Cadastro de Pessoa</h1>
          <br>
          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Nome:</label>
            <input class="inp_class" type="text" name="pes_nome" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Nome do pai:</label>
            <input class="inp_class" type="text" name="pes_pai" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Nome da mãe:</label>
            <input class="inp_class" type="text" name="pes_mae" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">RG:</label>
            <input class="inp_class" type="text" name="pes_rg" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">CPF:</label>
            <input class="inp_class" type="text" name="pes_cpf" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class lbl-extend-class">Data de Nascimento:</label>
            <input class="inp_class" type="date" name="pes_data" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Email</label>
            <input class="inp_class" type="text" name="pes_email" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Estado civil:</label>
            <?php
              $sql->selectbox("estado_civil");
            ?>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Cidadania:</label>
            <input class="inp_class" type="text" name="pes_cidadania" size="28" value="Brasileira"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Gênero</label>
            <?php
              $sql->selectbox("genero");
            ?>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Sexo biológico:</label>
            <?php
              $sql->selectbox("sexo");
            ?>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Telefone:</label>
            <input class="inp_class" type="text" name="pes_telefone" size="15"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">País:</label>
            <input class="inp_class" type="text" name="end_pais" size="28" value="Brasil"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Estado:</label>
            <?php
              $sql->selectbox("estado");
            ?>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Cidade:</label>
            <?php
              $sql->selectbox("cidade");
            ?>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Cep:</label>
            <input class="inp_class" type="text" name="end_cep" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Bairro:</label>
            <input class="inp_class" type="text" name="end_bairro" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Rua:</label>
            <input class="inp_class" type="text" name="end_rua" size="28"><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Numero:</label>
            <input class="inp_class" type="text" name="end_numero" size="28"><br>
          </div>

          <input class="inp_class submit" type="submit" value="Proximo">
        </form>
        <?php

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

        $metodo->setEnd_pais($_POST['end_pais']);
        $metodo->setEnd_estado($_POST['estado']);
        $metodo->setEnd_cidade($_POST['cidade']);
        $metodo->setEnd_cep($_POST['end_cep']);
        $metodo->setEnd_bairro($_POST['end_bairro']);
        $metodo->setEnd_rua($_POST['end_rua']);
        $metodo->setEnd_numero($_POST['end_numero']);

        // Verifica se a pessoa que está sendo cadastrada já foi cadastrada anteriormente
        $selPes="SELECT * FROM pessoa WHERE pes_cpf='" . $_POST ['pes_cpf'] . "';";
        $qtd=$sql->selecionar($selPes);

        ///////////NÃO ESQUECER//////////////
        //Descomentar a quantidade zero para funcionar corretamente
        $qtd=0;
        ///////////NÃO ESQUECER//////////////

        if ($qtd >= 1) {
          echo "Pessoa já cadastrada!!";
          ?>
          <a href="?acao=cadastro">Voltar</a>
          <?php
        } else {
          ////////////////////Insere os dados do formulário anterior no banco/////////////////////////
          $insPes="INSERT INTO pessoa (pes_nome, pes_pai, pes_mae, pes_rg, pes_cpf, pes_data, pes_email, pes_estado_civil, pes_cidadania, pes_genero, pes_sexo_biologico, pes_telefone) VALUES (
              '". $metodo->getPes_nome()          ."',
              '". $metodo->getPes_pai()           ."',
              '". $metodo->getPes_mae()           ."',
              '". $metodo->getPes_rg()            ."',
              '". $metodo->getPes_cpf()           ."',
              '". $metodo->getPes_data()          ."',
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

          $insEnd="INSERT INTO endereco (end_pais, end_estado,end_cidade, end_cep,end_bairro, end_rua,end_numero,pessoa_pes_id) VALUES (
                '" . $metodo->getEnd_pais()   . "',
                '" . $metodo->getEnd_estado() . "',
                '" . $metodo->getEnd_cidade() . "',
                '" . $metodo->getEnd_cep()    . "',
                '" . $metodo->getEnd_bairro() . "',
                '" . $metodo->getEnd_rua()    . "',
                '" . $metodo->getEnd_numero() . "',
                '" . $pes_id          . "'
            );";

          // Verifica se a query foi inserida corretamente
          $okEnd=$sql->inserir($insEnd);

          /////////////////////////fim da inserção de dados Pessoais////////////////////////////////

          //verifica se a query foi inserida corretamente
          if ($okPes && $okEnd) {
            echo "Pessoa cadastrada com sucesso!!!" . $_SESSION['tipo'];

            /* se o usuário logado for recepcionista ele só poderá cadastrar
            os dados de pacientes do formulário abaixo */
            echo "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=3\" method=\"post\">";
            if ($_SESSION['tipo'] == "recepcao") {
              ?>
              <br>
              <h1 class="titulo">Paciente</h1>
              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Tipo Sanguineo</label>
                <?php
                  $sql->selectbox("tipo_sanguineo");
                ?>
              </div>

              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Remedio</label>
                <input class="inp_class" type="text" name="pac_remedio" size="28"><br>
              </div>

              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Doença</label>
                <input class="inp_class" type="text" name="pac_doenca" size="28"><br>
              </div>

              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Grau de escolaridade:</label>
                <?php
                  $sql->selectbox("escolaridade");
                ?>
              </div>

              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Convênio:</label>
                <input class="inp_class" type="text" name="pds_convenio_nome" size="28"><br>
              </div>

              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Número :</label>
                <input class="inp_class" type="text" name="pds_num_convenio" size="28"><br>
              </div>

              <div class="group-form group-form-cadastro">
                <label class="lbl_class">SUS:</label>
                <input class="inp_class" type="text" name="pds_numero_sus" size="28">
              </div>
              <input class="inp_class submmit" type="submit" value="Confirmar">
              <?php
            } elseif ($_SESSION['tipo'] == "administracao") {
              /* Se o usuário logado for administrativo ele só poderá cadastrar
              os dados de funcionário do formulário abaixo
              */
                ?>
                <h1 class="titulo">Funcionário</h1>

                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">Cargo:</label>
                  <select class="select" name="fun_cargo">
                    <option class="option" value="recepcao">Recepcionista</option>
                    <option class="option" value="medico">Médico</option>
                    <option class="option" value="enfermeiro">Enfermeiro</option>
                    <option class="option" value="funcionario">Funcionário</option>
                  </select>
                  <br>
                </div>
                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">Setor:</label>
                  <?php
                    $sql->selectbox("setor");
                  ?>
                </div>

                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">Horario:</label>
                  <input class="inp_class" type="time" name="fun_horario" size="28"><br>
                </div>

                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">Inscrição:</label>
                  <input class="inp_class" type="text" name="fun_inscricao" size="28"><br>
                </div>

                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">Turno:</label>
                  <select class="select" name="fun_turno">
                    <option class="option" value="manha">Manhã</option>
                    <option class="option" value="tarde">Tarde</option>
                    <option class="option" value="noite">Noite</option>
                  </select><br>
                </div>

                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">E-mail:</label>
                  <input class="inp_class" type="text" name="usu_email" size="28"><br>
                </div>

                <div class="group-form group-form-cadastro">
                  <label class="lbl_class">Senha:</label>
                  <input class="inp_class" type="password" name="usu_senha" size="28"><br>
                </div>

                <input class="inp_class" type="submit" value="Proximo">
                </form>
                <?php
            } else {
              echo "Apenas adm e recepcionistas";
            }
          } else {
            echo "Erro ao cadastrar pessoa!";
          }
        }
      }

      if ($_GET['passo'] == 3) {
        if ($_SESSION['tipo'] == "recepcao") {
          $metodo->setPac_tipo_sangue($_POST['tipo_sanguineo']);
          $metodo->setPac_remedio($_POST['pac_remedio']);
          $metodo->setPac_doenca($_POST['pac_doenca']);
          $metodo->setPac_educacao($_POST['escolaridade']);

          $metodo->setPds_convenio_nome($_POST['pds_convenio_nome']);
          $metodo->setPds_numero_sus($_POST['pds_numero_sus']);
          $metodo->setPds_num_convenio($_POST['pds_num_convenio']);



          //$qtdPds="SELECT * FROM plano_de_saude WHERE pds_sus =
          //      '" . $_POST['pds_numero_sus'] . "';";

          /*if ($qtdPds >= 1) {
            echo "Paciente já cadastrado!";
          }
          else {
          */  ////////Seleciona o ultimo id de pessoa e ultimo id de paciente para ser utilizado///////////
          $sel_id="SELECT MAX(pes_id) AS pes_id FROM pessoa";
          $pes_id=$sql->selecionar($sel_id);

          $sel_id="SELECT MAX(pac_id) AS pac_id FROM paciente";
          $pac_id=$sql->selecionar($sel_id);
          $pac_id++;

          ////////////////////inserção de dados nas tabelas paciente e plano_de_saude ///////////////
          $insPac="INSERT INTO paciente (pac_tipo_sangue, pac_remedio, pac_doenca, pac_educacao,           pac_hospitalizado, pessoa_pes_id) VALUES (
                  '" . $metodo->getPac_tipo_sangue() . "',
                  '" . $metodo->getPac_remedio()     . "',
                  '" . $metodo->getPac_doenca()      . "',
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
            if ($okPac && $okPds) {
              echo "Paciente cadastrado!!!!!!!!";
                ///////////fim de cadastro/////////////
            } else {
                  echo "Não cadastrado!!!!!!!!!";
            }
            //}
        } elseif ($_SESSION['tipo'] == "administracao") {
          $metodo->setFun_cargo($_POST ['fun_cargo']);
          $metodo->setFun_horario($_POST ['fun_horario']);
          $metodo->setFun_inscricao($_POST ['fun_inscricao']);
          $metodo->setFun_turno($_POST ['fun_turno']);

          $metodo->setUsu_email($_POST['usu_email']);
          $metodo->setUsu_senha($_POST['usu_senha']);
          $metodo->setSet_setor($_POST['setor']);

          $_SESSION['fun_cargo'] = $_POST['fun_cargo'];
          // Seleção e inserção na tabela funcionário
          //$selFun ="SELECT fun_inscricao FROM funcionario WHERE '" . $_POST['fun_inscricao'] . "';";

           /*  $qtdFun=$posto->selecionar($selfun);
          if ($qtd >= 1) {
            echo"Funcionario já cadastrado!";
          }
          else {
            */
          $sel_id="SELECT MAX(usu_id) AS usu_id FROM usuario";
          $usu_id=$sql->selecionar($sel_id);
          $usu_id++;

          $sel_id="SELECT MAX(pes_id) AS pes_id FROM pessoa";
          $pes_id=$sql->selecionar($sel_id);

          $insFun="INSERT INTO funcionario (fun_cargo, fun_horario, fun_inscricao, fun_turno, pessoa_pes_id, setor_set_id) VALUES (
                  '" . $metodo->getFun_cargo()    . "',
                  '" . $metodo->getFun_horario()  . "',
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
          if ($okFun && $okUsu) {
            echo "Cadastrado com sucesso!!";
          } else {
            echo "Erro ao cadastrar";
          }
          if ($_SESSION['fun_cargo'] == "medico" || $_SESSION['fun_cargo'] == "enfermeiro") {
            echo "<form class=\"Form\" action=\"cadastro.php?acao=cadastro&passo=4\" method=\"post\">";
            if ($_SESSION['fun_cargo'] == "medico") {
              ?>
              <h1>Médico</h1>
              <div class="group-form group-form-cadastro">
                <label class="lbl_class">CRM:</label>
                <input class="inp_class" type="text" name="med_crm" size="28"><br>
                <label class="lbl_class">Especialização:</label>
              <?php
                $sql->selectbox("especializacao");
              ?>
              </div>
            <?php
            } elseif ($_SESSION['fun_cargo'] == "enfermeiro") {
            // Se o funcionário for enfermeiro ao clicar no botão de proximo irá para o formulário abaixo
            ?>
              <h1>Enfermeiro</h1>
              <div class="group-form group-form-cadastro">
                <label class="lbl_class">Registro:</label>
                <input class="inp_class" type="text" name="enf_registro" size="28"><br>
              </div>
              <?php
            } else {
              echo "Não está sendo cadastrado medico ou enfermeiro";
            }
            ?>
            <input type="submit" value="Confirmar">
          <?php
          } else {
            header("Location:cadastro.php&passo=4");
          }
        } else {
          header("Location:cadastro.php?passo=4");
        }
      } elseif ($_GET['passo'] == 4) {
        //últimos inserts e/ou confirmação de cadastro de acordo com o que foi preenchido
        if ($_SESSION['fun_cargo'] == "medico") {
          $metodo->setMed_crm($_POST['med_crm']);
          $metodo->setEsp_nome($_POST['especializacao']);

          $esp=$metodo->getEsp_nome();
          echo $esp;
          //$selMed="SELECT * FROM medico WHERE '" . $_POST['med_crm'] . "';";

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

          if ($okMed && $okHas) {
            echo "Médico(a) cadastrado!!";
          } else {
            echo "Não cadastrado!" . $insMed . "...." . $insHas ;
          }
        } elseif ($_SESSION['fun_cargo'] == "enfermeiro") {
          $metodo->setEnf_registro($_POST['enf_registro']);

          $selEnf="SELECT enf_registro FROM enfermeiro WHERE '" . $_POST['enf_registro'] . "';";

          $sel_id="SELECT MAX(fun_id) AS fun_id FROM funcionario";
          $fun_id=$sql->selecionar($sel_id);


          $insEnf="INSERT INTO enfermeiro (enf_registro, funcionario_fun_id) VALUES(
                  '" . $metodo->getEnf_registro() . "',
                  '" . $fun_id                    . "'
                  );";
          $okEnf= $sql->inserir($insEnf);
          if ($okEnf) {
            echo "Enfermeiro(a) Cadastrado!";
          } else {
            echo "Não cadastrado!!!";
          }
        } else {
          echo "Não é enfermeiro ou médico";
        }
      ////////////////////Fim do cadastro//////
        $maxId1="SELECT MAX(pes_id) AS pes_id FROM pessoa";
        $id1=$sql->selecionar($maxId1);
        $sel1="SELECT * FROM pessoa WHERE pes_id='" . $id1 . "';";
        $pessoa=$sql->fetch($sel1);

        $maxId2="SELECT MAX(end_id) AS end_id FROM endereco";
        $id2=$sql->selecionar($maxId2);
        $sel2="SELECT * FROM pessoa WHERE pes_id='" . $id2 . "';";
        $endereco=$sql->fetch($sel2);

        $maxId3="SELECT MAX(usu_id) AS usu_id FROM usuario";
        $id3=$sql->selecionar($maxId3);
        $sel3="SELECT * FROM usuario WHERE usu_id='" . $id3 . "';";
        $usuario=$sql->fetch($sel3);
        ?>

        <form class="form form-cadastro" action="cadastro.php?acao=cadastro&passo=5" method="post">
          <h1 class="titulo">Confirmação Final</h1>
          <br>
          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Nome:</label>
            <input class="inp_class" type="text" name="pes_nome" size="28" disabled value=<?=$pessoa[1]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Nome do pai:</label>
            <input class="inp_class" type="text" name="pes_pai" size="28" disabled value=<?=$pessoa[2]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Nome da mãe:</label>
            <input class="inp_class" type="text" name="pes_mae" size="28" disabled value=<?=$pessoa[3]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">RG:</label>
            <input class="inp_class" type="text" name="pes_rg" size="28" disabled value=<?=$pessoa[4]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">CPF:</label>
            <input class="inp_class" type="text" name="pes_cpf" size="28" disabled value=<?=$pessoa[5]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class lbl-extend-class">Data de Nascimento:</label>
            <input class="inp_class" type="date" name="pes_data" size="28" disabled value=<?=$pessoa[6]?>><br>
           </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Email</label>
            <input class="inp_class" type="text" name="pes_email" size="28" disabled value=<?=$pessoa[7]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Estado civil:</label>
            <input class="inp_class" type="text" name="pes_estado_civil" size="28" disabled value=<?=$pessoa[8]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Cidadania:</label>
            <input class="inp_class" type="text" name="pes_cidadania" size="28" value=<?=$pessoa[9]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Gênero</label>
            <input class="inp_class" type="text" name="pes_genero" size="28" disabled value=<?=$pessoa[10]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Sexo biológico:</label>
            <input class="inp_class" type="text" name="pes_sexo_biologico" size="28" disabled value=<?=$pessoa[11]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Telefone:</label>
            <input class="inp_class" type="text" name="pes_telefone" size="15" disabled value=<?=$pessoa[12]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">País:</label>
            <input class="inp_class" type="text" name="end_pais" size="28" disabled value=<?=$endereco[1]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Estado:</label>
            <input class="inp_class" type="text" name="end_estado" size="28" disabled value=<?=$endereco[2]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Cidade:</label>
            <input class="inp_class" type="text" name="end_cidade" size="28" disabled value=<?=$endereco[3]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Cep:</label>
            <input class="inp_class" type="text" name="end_cep" size="28" disabled value=<?=$endereco[4]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Bairro:</label>
            <input class="inp_class" type="text" name="end_bairro" size="28" disabled value=<?=$endereco[5]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Rua:</label>
            <input class="inp_class" type="text" name="end_rua" size="28" disabled value=<?=$endereco[6]?>><br>
          </div>

          <div class="group-form group-form-cadastro">
            <label class="lbl_class">Numero:</label>
            <input class="inp_class" type="text" name="end_numero" size="28" disabled value=<?=$endereco[7]?>><br>
          </div>

          <input type="button" value="Alterar" onclick="habilita()">
          <input class="inp_class submit" type="submit" value="Proximo"><br>
        </form>

      <?php
      }elseif ($_GET['passo'] == 5) {
        echo "Foi clicado em proximo!!"; //teste

        $maxId="SELECT MAX(fun_id) AS fun_id FROM funcionario";
        $id=$sql->selecionar($maxId);
        $sel="SELECT * FROM funcionario WHERE fun_id='" . $id . "';";
        $funcionario=$sql->fetch($sel);

        $maxId="SELECT MAX(usu_id) AS usu_id FROM usuario";
        $id=$sql->selecionar($maxId);
        $sel="SELECT * FROM usuario WHERE usu_id='" . $id . "';";
        $usuario=$sql->fetch($sel);

      } elseif ($acao == "logoff") {
        session_destroy();
        unset($_SESSION['tipo']);
        echo "<script>alert('Tchau!! Volte sempre!!')
        location.href='index.php';</script>;";
      }
    }
    mysqli_close($con);
    ?>
  </body>
</html>
