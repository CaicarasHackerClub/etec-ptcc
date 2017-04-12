-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 12/04/2017 às 21:52
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
  `end_pais` varchar(60) COLLATE utf8_bin NOT NULL,
  `end_estado` char(2) COLLATE utf8_bin NOT NULL,
  `end_cidade` varchar(100) COLLATE utf8_bin NOT NULL,
  `end_cep` varchar(13) COLLATE utf8_bin NOT NULL,
  `end_bairro` varchar(45) COLLATE utf8_bin NOT NULL,
  `end_rua` varchar(45) COLLATE utf8_bin NOT NULL,
  `end_numero` int(9) NOT NULL,
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
(6, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Sumaré', 'Longitude', 344, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `enfermeiro`
--

CREATE TABLE `enfermeiro` (
  `enf_id` int(11) NOT NULL,
  `enf_registro` varchar(8) COLLATE utf8_bin NOT NULL,
  `funcionario_fun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `enfermeiro`
--

INSERT INTO `enfermeiro` (`enf_id`, `enf_registro`, `funcionario_fun_id`) VALUES
(1, '874589', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `especializacao`
--

CREATE TABLE `especializacao` (
  `esp_id` int(11) NOT NULL,
  `esp_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `medico_med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `especializacao`
--

INSERT INTO `especializacao` (`esp_id`, `esp_nome`, `medico_med_id`) VALUES
(1, 'Pediatria', 1);

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
  `fun_cargo` varchar(45) COLLATE utf8_bin NOT NULL,
  `fun_horario` time NOT NULL,
  `fun_inscricao` int(9) NOT NULL,
  `fun_turno` varchar(8) COLLATE utf8_bin NOT NULL,
  `usuario_usu_id` int(4) NOT NULL,
  `pessoa_pes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `funcionario`
--

INSERT INTO `funcionario` (`fun_id`, `fun_cargo`, `fun_horario`, `fun_inscricao`, `fun_turno`, `usuario_usu_id`, `pessoa_pes_id`) VALUES
(1, 'medico', '08:00:00', 1111111, 'noturno', 1, 1),
(2, 'enfermeiro', '08:00:00', 1111112, 'noturno', 1, 2),
(3, 'administracao', '07:00:00', 1222222, 'noturno', 3, 4),
(4, 'recepcao', '07:00:00', 13333333, 'noturno', 4, 5),
(5, 'recpcionista', '07:00:00', 1444444, 'noturno', 5, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_acesso`
--

CREATE TABLE `login_acesso` (
  `log_id` int(11) NOT NULL,
  `log_data` datetime NOT NULL,
  `log_ip` varchar(45) COLLATE utf8_bin NOT NULL,
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
  `med_crm` varchar(8) COLLATE utf8_bin NOT NULL,
  `funcionario_fun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `medico`
--

INSERT INTO `medico` (`med_id`, `med_crm`, `funcionario_fun_id`) VALUES
(1, '12309-SP', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `pac_id` int(11) NOT NULL,
  `pac_tipo_sangue` char(2) COLLATE utf8_bin DEFAULT NULL,
  `pac_remedio` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pac_doenca` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pac_educacao` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pac_hospitalizado` tinyint(1) DEFAULT NULL,
  `pessoa_pes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `paciente`
--

INSERT INTO `paciente` (`pac_id`, `pac_tipo_sangue`, `pac_remedio`, `pac_doenca`, `pac_educacao`, `pac_hospitalizado`, `pessoa_pes_id`) VALUES
(1, 'AB', 'nenhum', 'nenhuma', 'cursando o ensino médio ', 0, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pes_id` int(11) NOT NULL,
  `pes_nome` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_pai` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_mae` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_rg` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `pes_cpf` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `pes_data` date DEFAULT NULL,
  `pes_tipo` int(1) DEFAULT NULL,
  `pes_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_estado_civil` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `pes_cidadania` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pes_genero` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `pes_sexo_biologico` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `pes_telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `pessoa`
--

INSERT INTO `pessoa` (`pes_id`, `pes_nome`, `pes_pai`, `pes_mae`, `pes_rg`, `pes_cpf`, `pes_data`, `pes_tipo`, `pes_email`, `pes_estado_civil`, `pes_cidadania`, `pes_genero`, `pes_sexo_biologico`, `pes_telefone`) VALUES
(1, 'Karina Ramos', 'Mathos Ramos', 'Larisa Matos', '43.434.434-3', '346.346.346-34', '2005-04-21', 1, 'karina@bol.com.br', 'Solteira', 'Ubatubense', 'Feminino', 'Feminino', '(12)982343434'),
(2, 'Marta wender', 'Joao da Silva', 'Jorge Wender', '366.457.987.98', '445.346.987.65', '2003-08-01', 2, 'martinhawender@email.com.br', 'Casada', 'Paulista', 'Masculino', 'Feminino', '(12)981236789'),
(3, 'Paula dos Santos', 'Roberto Nascimento', 'Larisa Pereira', '33.050.250-3', '123.456.789-10', '1996-12-06', 3, 'Paulinha@gmail.com', 'Solteira', 'Paraense', 'Feminino', 'Feminino', '(35)997667890'),
(4, 'Kleber Ramos', 'Jose Ramos', 'Pata Mathos', '909.876.897.76', '763.765.899.09', '0000-00-00', 1, 'klberzinho@email.com', 'Casado', 'Ubatubense', 'Masculino', 'Masculino', '(12)987667894'),
(5, 'luiza Fonseca', 'Pedro Fonseca', 'Maria dias Fonseca', '333.654.765.98', '786.567.823.76', '1984-08-01', 1, 'Luizinha@hot.com', 'Solteira', 'Ubatubense', 'Feminino', 'Feminino', '(12)982456674'),
(6, 'Rafael Nunes', 'Mario da Cruz Nunes', 'Joana lopes Nunes', '771.123.678.90', '456.765.912.56', '1997-06-25', 1, 'rafanudes@gmail.com', 'Solteiro', 'Ubatubense', 'masculino', 'masculino', '(12)38765590');

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano_de_saude`
--

CREATE TABLE `plano_de_saude` (
  `pds_id` int(11) NOT NULL,
  `pds_convenio_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pds_numero_sus` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `pds_num_convenio` varchar(16) COLLATE utf8_bin DEFAULT NULL,
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
  `set_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `set_descricao` varchar(255) COLLATE utf8_bin NOT NULL,
  `set_responsavel` varchar(60) COLLATE utf8_bin NOT NULL,
  `funcionario_fun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sub_setor`
--

CREATE TABLE `sub_setor` (
  `sbs_id` int(11) NOT NULL,
  `sbs_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `setor_set_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `triagem`
--

CREATE TABLE `triagem` (
  `tri_id` int(11) NOT NULL,
  `tri_temperatura` float DEFAULT NULL,
  `tri_pressao` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `tri_peso` float DEFAULT NULL,
  `tri_altura` float DEFAULT NULL,
  `tri_batimento` int(3) DEFAULT NULL,
  `tri_oxigenacao` int(3) DEFAULT NULL,
  `tri_classe_risco` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `tri_respiracao` int(2) DEFAULT NULL,
  `tri_dor` int(2) DEFAULT NULL,
  `tri_orgaos_vitais` tinyint(1) DEFAULT NULL,
  `tri_data` date DEFAULT NULL,
  `tri_hora` time DEFAULT NULL,
  `tri_status` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `usu_senha` varchar(64) COLLATE utf8_bin NOT NULL,
  `usu_email` varchar(45) COLLATE utf8_bin NOT NULL,
  `usu_ativo` tinyint(1) NOT NULL DEFAULT '1',
  `usu_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nome`, `usu_senha`, `usu_email`, `usu_ativo`, `usu_tipo`) VALUES
(1, 'Gisele', '123', 'gih@gih', 1, 1),
(2, 'Admin', 'admin', 'admin@admin', 1, 1),
(3, 'Kleber', '123', 'etec1@etec', 1, 1),
(4, 'Luiza', '123', 'etec2@etec', 1, 1),
(5, 'Rafael', '123', 'etec3@etec', 1, 1);

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
-- Índices de tabela `especializacao`
--
ALTER TABLE `especializacao`
  ADD PRIMARY KEY (`esp_id`),
  ADD KEY `fk_especializacao_medico1_idx` (`medico_med_id`);

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
  ADD KEY `fk_FUNCIONARIOS_USUARIO1_idx` (`usuario_usu_id`),
  ADD KEY `fk_funcionario_pessoa1_idx` (`pessoa_pes_id`);

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
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`pac_id`),
  ADD KEY `fk_paciente_pessoa1_idx` (`pessoa_pes_id`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pes_id`),
  ADD UNIQUE KEY `pes_cpf` (`pes_cpf`),
  ADD UNIQUE KEY `pes_rg` (`pes_rg`);

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
  ADD PRIMARY KEY (`set_id`),
  ADD KEY `fk_setor_funcionario1_idx` (`funcionario_fun_id`);

--
-- Índices de tabela `sub_setor`
--
ALTER TABLE `sub_setor`
  ADD PRIMARY KEY (`sbs_id`),
  ADD KEY `fk_sub_setor_setor1_idx` (`setor_set_id`);

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
  ADD UNIQUE KEY `usu_email` (`usu_email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  MODIFY `enf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `especializacao`
--
ALTER TABLE `especializacao`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `pac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `pes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT;
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
-- Restrições para tabelas `especializacao`
--
ALTER TABLE `especializacao`
  ADD CONSTRAINT `fk_especializacao_medico1` FOREIGN KEY (`medico_med_id`) REFERENCES `medico` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_pessoa1` FOREIGN KEY (`pessoa_pes_id`) REFERENCES `pessoa` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_pessoa1` FOREIGN KEY (`pessoa_pes_id`) REFERENCES `pessoa` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `plano_de_saude`
--
ALTER TABLE `plano_de_saude`
  ADD CONSTRAINT `fk_plano_de_saude_paciente1` FOREIGN KEY (`pac_id`) REFERENCES `paciente` (`pac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `fk_setor_funcionario1` FOREIGN KEY (`funcionario_fun_id`) REFERENCES `funcionario` (`fun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
