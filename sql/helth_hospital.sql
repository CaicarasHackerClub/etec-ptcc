-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 15/04/2017 às 01:18
-- Versão do servidor: 10.1.21-MariaDB
-- Versão do PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `helth_hospital`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `end_id` int(11) NOT NULL,
  `end_pais` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'País da pessoa',
  `end_estado` char(2) COLLATE utf8_bin NOT NULL COMMENT 'Estado da pessoa',
  `end_cidade` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Cidade da pessoa',
  `end_cep` varchar(13) COLLATE utf8_bin NOT NULL COMMENT 'Cep da cidade ou região da pessoa',
  `end_bairro` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'Bairro onde mora a pessoa',
  `end_rua` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'logradouro da pessoa',
  `end_numero` int(9) NOT NULL COMMENT 'numero da casa/apt/etc da pessoa',
  `pessoa_pes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `endereco`
--

INSERT INTO `endereco` (`end_id`, `end_pais`, `end_estado`, `end_cidade`, `end_cep`, `end_bairro`, `end_rua`, `end_numero`, `pessoa_pes_id`) VALUES
(1, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Centro', 'Central', 314, 1),
(2, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Centro', 'Castro Alves', 507, 2),
(3, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Centro', 'Taubaté', 314, 3),
(4, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Ipiranguinha', 'Cascata', 288, 4),
(5, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Estufa 2', 'Comercial', 212, 5),
(6, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Sumaré', 'Longitude', 344, 6),
(7, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Estufa 2', 'Vasco da Gama', 31, 7),
(8, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Ipiranguinha', 'Cascata', 14, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `enfermeiro`
--

CREATE TABLE `enfermeiro` (
  `enf_id` int(11) NOT NULL,
  `enf_registro` varchar(8) COLLATE utf8_bin NOT NULL COMMENT 'Coren do enfermeiro',
  `funcionario_fun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `enfermeiro`
--

INSERT INTO `enfermeiro` (`enf_id`, `enf_registro`, `funcionario_fun_id`) VALUES
(1, '874589', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `escolaridade`
--

CREATE TABLE `escolaridade` (
  `esc_id` int(11) NOT NULL,
  `esc_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'grau de escolaridade da pessoa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `escolaridade`
--

INSERT INTO `escolaridade` (`esc_id`, `esc_nome`) VALUES
(1, 'Ensino Fundamental 1'),
(2, 'Ensino Fundamental 2'),
(3, 'Ensino Medio'),
(4, 'Ensino Superior');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especializacao`
--

CREATE TABLE `especializacao` (
  `esp_id` int(11) NOT NULL,
  `esp_nome` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'nome da especialização do médico'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `especializacao`
--

INSERT INTO `especializacao` (`esp_id`, `esp_nome`) VALUES
(1, 'Acunpuntura'),
(2, 'Alergia e Imunologia'),
(3, 'Anestesiologia'),
(4, 'Angiologia'),
(5, 'Cancerologia'),
(6, 'Cardiologia'),
(7, 'Cirurgia Cardiovascular'),
(8, 'Cirurgia da Mão'),
(9, 'Cirurgia de cabeça e pescoço'),
(10, 'Cirurgia do Aparelho Digestivo'),
(11, 'Cirurgia Geral'),
(12, 'Cirurgia Pediátrica'),
(13, 'Cirurgia Plástica'),
(14, 'Cirurgia Torácica'),
(15, 'Cirurgia Vascular'),
(16, 'Clínica Médica'),
(17, 'Coloproctologia'),
(18, 'Dermatologia'),
(19, 'Endocrinologia e Metabologia'),
(20, 'Endoscopia'),
(21, 'Gastroenterologia'),
(22, 'Genética médica'),
(23, 'Geriatria'),
(24, 'Ginecologia e obstetrícia'),
(25, 'Hematologia'),
(26, 'Hemoterapia'),
(27, 'Infectologia'),
(28, 'Mastologia'),
(29, 'Medicina de Família e Comunidade'),
(30, 'Medicina do Trabalho'),
(31, 'Medicina do Tráfego'),
(32, 'Medicina Esportiva'),
(33, 'Medicina Física e Reabilitação'),
(34, 'Medicina Intensiva'),
(35, 'Medicina Legal e Perícia Médica'),
(36, 'Medicina Nuclear'),
(37, 'Medicina Preventiva e Social'),
(38, 'Nefrologia'),
(39, 'Neurocirurgia'),
(40, 'Neurologia'),
(41, 'Nutrologia'),
(42, 'Obstetrícia'),
(43, 'Oftalmologia'),
(44, 'Ortopedia e Traumatologia'),
(45, 'Otorrinolaringologia'),
(46, 'Patologia'),
(47, 'Patologia Clínica'),
(48, 'Pediatria'),
(49, 'Pneumologia'),
(50, 'Psiquiatria'),
(51, 'Radiologia'),
(52, 'Radioterapia'),
(53, 'Reumatologia'),
(54, 'Urologia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado_civil`
--

CREATE TABLE `estado_civil` (
  `etc_id` int(11) NOT NULL,
  `etc_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'estado civil da pessoa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `estado_civil`
--

INSERT INTO `estado_civil` (`etc_id`, `etc_nome`) VALUES
(1, 'Solteiro'),
(2, 'Casado'),
(3, 'Viúvo'),
(4, 'Separado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fila_de_espera`
--

CREATE TABLE `fila_de_espera` (
  `fde_id` int(11) NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `fun_id` int(11) NOT NULL,
  `fun_cargo` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'cargo ocupado pelo funcionário',
  `fun_horario` time NOT NULL COMMENT 'quantas horas trabalha por dia o funcionário',
  `fun_inscricao` int(9) NOT NULL COMMENT 'número que foi registrado ou carteira do funcionario',
  `fun_turno` varchar(8) COLLATE utf8_bin NOT NULL COMMENT 'em qual turno trabalha ',
  `pessoa_pes_id` int(11) NOT NULL,
  `setor_set_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `funcionario`
--

INSERT INTO `funcionario` (`fun_id`, `fun_cargo`, `fun_horario`, `fun_inscricao`, `fun_turno`, `pessoa_pes_id`, `setor_set_id`) VALUES
(1, 'medico', '08:00:00', 1111111, 'noturno', 1, 3),
(2, 'enfermeiro', '08:00:00', 1111112, 'noturno', 2, 5),
(3, 'administracao', '07:00:00', 1222222, 'noturno', 4, 1),
(4, 'recepcao', '07:00:00', 13333333, 'noturno', 5, 1),
(5, 'recpcionista', '07:00:00', 1444444, 'noturno', 6, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_acesso`
--

CREATE TABLE `login_acesso` (
  `log_id` int(11) NOT NULL,
  `log_data` datetime NOT NULL COMMENT 'data e hora em que o usuario logou',
  `log_ip` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'ip para saber em qual maquina usario fez o login',
  `usuario_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `login_acesso`
--

INSERT INTO `login_acesso` (`log_id`, `log_data`, `log_ip`, `usuario_usu_id`) VALUES
(1, '0000-00-00 00:00:00', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `medico`
--

CREATE TABLE `medico` (
  `med_id` int(11) NOT NULL,
  `med_crm` varchar(8) COLLATE utf8_bin NOT NULL COMMENT 'número do CRM do médico',
  `funcionario_fun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `medico`
--

INSERT INTO `medico` (`med_id`, `med_crm`, `funcionario_fun_id`) VALUES
(1, '12309-SP', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `medico_has_especializacao`
--

CREATE TABLE `medico_has_especializacao` (
  `medico_med_id` int(11) NOT NULL,
  `especializacao_esp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `pac_id` int(11) NOT NULL,
  `pac_tipo_sangue` int(11) DEFAULT NULL COMMENT 'tipo sanguíneo',
  `pac_remedio` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'se tomar remédio, avisair quais',
  `pac_doenca` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'se tiver alguma doença avisar quais',
  `pac_educacao` int(11) DEFAULT NULL COMMENT 'nivel de escolaridade',
  `pac_hospitalizado` tinyint(1) DEFAULT NULL COMMENT 'se está ou não hospitalizado',
  `pessoa_pes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `paciente`
--

INSERT INTO `paciente` (`pac_id`, `pac_tipo_sangue`, `pac_remedio`, `pac_doenca`, `pac_educacao`, `pac_hospitalizado`, `pessoa_pes_id`) VALUES
(1, 1, 'nenhum', 'nenhuma', 4, 0, 3),
(2, 4, 'nenhum', 'nenhuma', 3, 0, 7),
(3, 3, 'nenhum', 'nenhuma', 4, 0, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pes_id` int(11) NOT NULL,
  `pes_nome` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nome da pessoa',
  `pes_pai` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nome do pai da pessoa',
  `pes_mae` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nome da mãe da pessoa',
  `pes_rg` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'informar o RG',
  `pes_cpf` varchar(14) COLLATE utf8_bin DEFAULT NULL COMMENT 'Informar o CPF',
  `pes_data` date DEFAULT NULL COMMENT 'data de nascimento da pessoa',
  `pes_tipo` int(1) DEFAULT NULL COMMENT 'que tipo de pessoa é',
  `pes_email` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'email para contato',
  `pes_estado_civil` int(11) DEFAULT NULL COMMENT 'qual o estado civil',
  `pes_cidadania` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'sua cidadania',
  `pes_genero` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT 'gênero em que a pessoa se identifica',
  `pes_sexo_biologico` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT 'sexo com o qual a pessoa nasceu',
  `pes_telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `pessoa`
--

INSERT INTO `pessoa` (`pes_id`, `pes_nome`, `pes_pai`, `pes_mae`, `pes_rg`, `pes_cpf`, `pes_data`, `pes_tipo`, `pes_email`, `pes_estado_civil`, `pes_cidadania`, `pes_genero`, `pes_sexo_biologico`, `pes_telefone`) VALUES
(1, 'Karina Ramos', 'Mathos Ramos', 'Larisa Matos', '43.434.434-3', '346.346.346-34', '2005-04-21', 1, 'karina@bol.com.br', 1, 'Ubatubense', 'Feminino', 'Feminino', '(12)982343434'),
(2, 'Marta wender', 'Joao da Silva', 'Jorge Wender', '366.457.987.98', '445.346.987.65', '2003-08-01', 2, 'martinhawender@email.com.br', 3, 'Paulista', 'Masculino', 'Feminino', '(12)981236789'),
(3, 'Paula dos Santos', 'Roberto Nascimento', 'Larisa Pereira', '33.050.250-3', '123.456.789-10', '1996-12-06', 3, 'Paulinha@gmail.com', 4, 'Paraense', 'Feminino', 'Feminino', '(35)997667890'),
(4, 'Kleber Ramos', 'Jose Ramos', 'Pata Mathos', '909.876.897.76', '763.765.899.09', '1988-02-10', 1, 'klberzinho@email.com', 2, 'Ubatubense', 'Masculino', 'Masculino', '(12)987667894'),
(5, 'luiza Fonseca', 'Pedro Fonseca', 'Maria dias Fonseca', '333.654.765.98', '786.567.823.76', '1984-08-01', 1, 'Luizinha@hot.com', 1, 'Ubatubense', 'Feminino', 'Feminino', '(12)982456674'),
(6, 'Rafael Nunes', 'Mario da Cruz Nunes', 'Joana lopes Nunes', '771.123.678.90', '456.765.912.56', '1997-06-25', 1, 'rafanudes@gmail.com', 2, 'Ubatubense', 'masculino', 'masculino', '(12)38765590'),
(7, 'Orlando Olindo', 'Manuel Olindo ', 'Clara Silva', '33.434.434-3', '876.346.346-34', '1989-04-21', 2, 'olindo@mail.com', 2, 'Ubatubense', 'Masculino', 'Masculino', '(12)972343434'),
(8, 'Soraia Santos', 'Dilmar Santos', '', '18.434.434-3', '996.346.346-34', '2005-04-21', 2, 'soraia@sol.com', 1, 'Ubatubense', 'Feminino', 'Feminino', '(12)981443434');

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano_de_saude`
--

CREATE TABLE `plano_de_saude` (
  `pds_id` int(11) NOT NULL,
  `pds_convenio_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'nome do convenio ou plano de saude',
  `pds_numero_sus` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT 'número do cartão SUS',
  `pds_num_convenio` varchar(16) COLLATE utf8_bin DEFAULT NULL COMMENT 'número do convenio ou plano de saude',
  `pac_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `quadro_clinico`
--

CREATE TABLE `quadro_clinico` (
  `id_quadro` int(11) NOT NULL,
  `qdc_quadro` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `qdc_gravidade` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `set_id` int(11) NOT NULL,
  `set_nome` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'nome do setor',
  `set_descricao` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'breve descrição do setor',
  `set_responsavel` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'nome ou cargo do responsavel pelo setor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `setor`
--

INSERT INTO `setor` (`set_id`, `set_nome`, `set_descricao`, `set_responsavel`) VALUES
(1, 'recepção', 'recepciona de paciente', 'recepcionista'),
(2, 'enfermaria', 'sala de enfermeiros', 'enfermeiro chefe'),
(3, 'cirurgia', 'cirurgia', 'médico'),
(4, 'uti', 'unidade de tratamento intensivo', 'médico'),
(5, 'maternidade', 'ala observatória de recem nascidos', 'enfermeiro chefe'),
(6, 'farmacia', 'controle de remédios', 'farmaceutico'),
(7, 'laboratório', 'sala de exames', 'médico'),
(8, 'radiografia', 'sala de raio x', 'enfermeiro especializado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sub_setor`
--

CREATE TABLE `sub_setor` (
  `sbs_id` int(11) NOT NULL,
  `sbs_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'nome do subsetor',
  `setor_set_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `sub_setor`
--

INSERT INTO `sub_setor` (`sbs_id`, `sbs_nome`, `setor_set_id`) VALUES
(1, 'sala de curativos', 1),
(2, 'sala de exames', 7),
(3, 'cirurgia vascular', 3),
(4, 'berçario', 5),
(5, 'CAF', 6),
(6, 'raio x', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_sanguineo`
--

CREATE TABLE `tipo_sanguineo` (
  `tis_id` int(11) NOT NULL,
  `tis_nome` varchar(3) COLLATE utf8_bin NOT NULL COMMENT 'nome do tipo sanguineo do paciente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `tipo_sanguineo`
--

INSERT INTO `tipo_sanguineo` (`tis_id`, `tis_nome`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'O+'),
(4, 'O-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'B+'),
(8, 'B-');

-- --------------------------------------------------------

--
-- Estrutura para tabela `triagem`
--

CREATE TABLE `triagem` (
  `tri_id` int(11) NOT NULL,
  `tri_temperatura` float DEFAULT NULL COMMENT 'temperatura corporal',
  `tri_pressao` varchar(8) COLLATE utf8_bin DEFAULT NULL COMMENT 'pressao arterial',
  `tri_peso` float DEFAULT NULL COMMENT 'peso ',
  `tri_altura` float DEFAULT NULL COMMENT 'altura',
  `tri_batimento` int(3) DEFAULT NULL COMMENT 'batimentos cardiacos',
  `tri_oxigenacao` int(3) DEFAULT NULL COMMENT 'oxigenação do sangue',
  `tri_classe_risco` varchar(8) COLLATE utf8_bin DEFAULT NULL COMMENT 'cor da classe de risco segundo o protocolo de Manchester',
  `tri_respiracao` int(2) DEFAULT NULL COMMENT 'frequencia respiratória',
  `tri_dor` int(2) DEFAULT NULL COMMENT 'grau de dor',
  `tri_orgaos_vitais` tinyint(1) DEFAULT NULL COMMENT 'se esta comprometido ou não',
  `tri_data` date DEFAULT NULL COMMENT 'data da entrada',
  `tri_hora` time DEFAULT NULL COMMENT 'hora da entrada',
  `tri_status` varchar(11) COLLATE utf8_bin DEFAULT NULL COMMENT 'status da triagem',
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_senha` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'senha para logar',
  `usu_email` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'email que usará para logar',
  `usu_ativo` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'se esta ativo ou não',
  `usu_tipo` int(11) NOT NULL COMMENT 'tipo do usuario',
  `funcionario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_senha`, `usu_email`, `usu_ativo`, `usu_tipo`, `funcionario_id`) VALUES
(1, '123', 'gih@gih', 1, 1, 1),
(2, 'admin', 'admin@admin', 1, 1, 2),
(3, '123', 'etec1@etec', 1, 1, 3),
(4, '123', 'etec2@etec', 1, 1, 4),
(5, '123', 'etec3@etec', 1, 1, 5);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`end_id`),
  ADD KEY `fk_endereco_pessoa1_idx` (`pessoa_pes_id`);

--
-- Índices de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD PRIMARY KEY (`enf_id`),
  ADD UNIQUE KEY `enf_registro` (`enf_registro`),
  ADD KEY `fk_enfermeiro_funcionario1_idx` (`funcionario_fun_id`);

--
-- Índices de tabela `escolaridade`
--
ALTER TABLE `escolaridade`
  ADD PRIMARY KEY (`esc_id`);

--
-- Índices de tabela `especializacao`
--
ALTER TABLE `especializacao`
  ADD PRIMARY KEY (`esp_id`);

--
-- Índices de tabela `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`etc_id`);

--
-- Índices de tabela `fila_de_espera`
--
ALTER TABLE `fila_de_espera`
  ADD PRIMARY KEY (`fde_id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`fun_id`),
  ADD UNIQUE KEY `fun_inscricao` (`fun_inscricao`),
  ADD KEY `fk_funcionario_pessoa1_idx` (`pessoa_pes_id`),
  ADD KEY `setor_set_id` (`setor_set_id`);

--
-- Índices de tabela `login_acesso`
--
ALTER TABLE `login_acesso`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_login_acesso_usuario1_idx` (`usuario_usu_id`);

--
-- Índices de tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`med_id`),
  ADD UNIQUE KEY `med_crm` (`med_crm`),
  ADD KEY `fk_medico_funcionario1_idx` (`funcionario_fun_id`);

--
-- Índices de tabela `medico_has_especializacao`
--
ALTER TABLE `medico_has_especializacao`
  ADD PRIMARY KEY (`medico_med_id`,`especializacao_esp_id`),
  ADD KEY `fk_medico_has_especializacao_especializacao1_idx` (`especializacao_esp_id`),
  ADD KEY `fk_medico_has_especializacao_medico1_idx` (`medico_med_id`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`pac_id`),
  ADD KEY `fk_paciente_pessoa1_idx` (`pessoa_pes_id`),
  ADD KEY `pac_tipo_sangue` (`pac_tipo_sangue`),
  ADD KEY `pac_educacao` (`pac_educacao`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pes_id`),
  ADD UNIQUE KEY `pes_cpf` (`pes_cpf`),
  ADD UNIQUE KEY `pes_rg` (`pes_rg`),
  ADD KEY `pes_estado_civil` (`pes_estado_civil`);

--
-- Índices de tabela `plano_de_saude`
--
ALTER TABLE `plano_de_saude`
  ADD PRIMARY KEY (`pds_id`),
  ADD UNIQUE KEY `pds_num_convenio` (`pds_num_convenio`),
  ADD UNIQUE KEY `pds_numero_sus` (`pds_numero_sus`),
  ADD KEY `fk_plano_de_saude_paciente1_idx` (`pac_id`);

--
-- Índices de tabela `quadro_clinico`
--
ALTER TABLE `quadro_clinico`
  ADD PRIMARY KEY (`id_quadro`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`set_id`);

--
-- Índices de tabela `sub_setor`
--
ALTER TABLE `sub_setor`
  ADD PRIMARY KEY (`sbs_id`),
  ADD KEY `fk_sub_setor_setor1_idx` (`setor_set_id`);

--
-- Índices de tabela `tipo_sanguineo`
--
ALTER TABLE `tipo_sanguineo`
  ADD PRIMARY KEY (`tis_id`);

--
-- Índices de tabela `triagem`
--
ALTER TABLE `triagem`
  ADD PRIMARY KEY (`tri_id`),
  ADD KEY `fk_triagem_paciente1_idx` (`id_paciente`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD UNIQUE KEY `usu_email` (`usu_email`),
  ADD KEY `funcionario_id` (`funcionario_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  MODIFY `enf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `escolaridade`
--
ALTER TABLE `escolaridade`
  MODIFY `esc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `especializacao`
--
ALTER TABLE `especializacao`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de tabela `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `etc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `fila_de_espera`
--
ALTER TABLE `fila_de_espera`
  MODIFY `fde_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `fun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `login_acesso`
--
ALTER TABLE `login_acesso`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `pac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `pes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `plano_de_saude`
--
ALTER TABLE `plano_de_saude`
  MODIFY `pds_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `quadro_clinico`
--
ALTER TABLE `quadro_clinico`
  MODIFY `id_quadro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `tipo_sanguineo`
--
ALTER TABLE `tipo_sanguineo`
  MODIFY `tis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `triagem`
--
ALTER TABLE `triagem`
  MODIFY `tri_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_pessoa1` FOREIGN KEY (`pessoa_pes_id`) REFERENCES `pessoa` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD CONSTRAINT `fk_enfermeiro_funcionario1` FOREIGN KEY (`funcionario_fun_id`) REFERENCES `funcionario` (`fun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_pessoa1` FOREIGN KEY (`pessoa_pes_id`) REFERENCES `pessoa` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`setor_set_id`) REFERENCES `setor` (`set_id`);

--
-- Restrições para tabelas `login_acesso`
--
ALTER TABLE `login_acesso`
  ADD CONSTRAINT `fk_login_acesso_usuario1` FOREIGN KEY (`usuario_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `fk_medico_funcionario1` FOREIGN KEY (`funcionario_fun_id`) REFERENCES `funcionario` (`fun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `medico_has_especializacao`
--
ALTER TABLE `medico_has_especializacao`
  ADD CONSTRAINT `medico_has_especializacao_ibfk_1` FOREIGN KEY (`medico_med_id`) REFERENCES `medico` (`med_id`),
  ADD CONSTRAINT `medico_has_especializacao_ibfk_2` FOREIGN KEY (`especializacao_esp_id`) REFERENCES `especializacao` (`esp_id`);

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_pessoa1` FOREIGN KEY (`pessoa_pes_id`) REFERENCES `pessoa` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`pac_tipo_sangue`) REFERENCES `tipo_sanguineo` (`tis_id`),
  ADD CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`pac_educacao`) REFERENCES `escolaridade` (`esc_id`);

--
-- Restrições para tabelas `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`pes_estado_civil`) REFERENCES `estado_civil` (`etc_id`);

--
-- Restrições para tabelas `plano_de_saude`
--
ALTER TABLE `plano_de_saude`
  ADD CONSTRAINT `fk_plano_de_saude_paciente1` FOREIGN KEY (`pac_id`) REFERENCES `paciente` (`pac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `sub_setor`
--
ALTER TABLE `sub_setor`
  ADD CONSTRAINT `fk_sub_setor_setor1` FOREIGN KEY (`setor_set_id`) REFERENCES `setor` (`set_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `triagem`
--
ALTER TABLE `triagem`
  ADD CONSTRAINT `fk_triagem_paciente1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`pac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`fun_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
