-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24/03/2017 às 02:17
-- Versão do servidor: 10.1.21-MariaDB
-- Versão do PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hospital1`
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
  `end_numero` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `endereco`
--

INSERT INTO `endereco` (`end_id`, `end_pais`, `end_estado`, `end_cidade`, `end_cep`, `end_bairro`, `end_rua`, `end_numero`) VALUES
(1, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'centro', 'central', 345),
(2, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Centro', 'Central', 314),
(3, 'Brasil', 'SP', 'Ubatuba', '11680-000', 'Centro', 'Central', 304);

-- --------------------------------------------------------

--
-- Estrutura para tabela `enfermeiro`
--

CREATE TABLE `enfermeiro` (
  `enf_id` int(11) NOT NULL,
  `enf_registro` varchar(45) COLLATE utf8_bin NOT NULL,
  `funcionario_fun_id` int(11) NOT NULL,
  `funcionario_pessoa_pes_id` int(11) NOT NULL,
  `funcionario_pessoa_endereco_end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especializacao`
--

CREATE TABLE `especializacao` (
  `esp_id` int(11) NOT NULL,
  `esp_nome` varchar(60) COLLATE utf8_bin NOT NULL
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
  `fun_turno` int(1) NOT NULL,
  `usuario_usu_id` int(4) NOT NULL,
  `pessoa_pes_id` int(11) NOT NULL,
  `pessoa_endereco_end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `funcionario`
--

INSERT INTO `funcionario` (`fun_id`, `fun_cargo`, `fun_horario`, `fun_inscricao`, `fun_turno`, `usuario_usu_id`, `pessoa_pes_id`, `pessoa_endereco_end_id`) VALUES
(1, 'medico', '08:00:00', 1111111, 0, 1, 1, 1),
(2, 'enfermeiro', '08:00:00', 1111112, 0, 2, 2, 2);

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
(1, '2017-03-23 00:00:00', '192.168.1.100', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `medico`
--

CREATE TABLE `medico` (
  `med_id` int(11) NOT NULL,
  `med_crm` varchar(45) COLLATE utf8_bin NOT NULL,
  `especializacao_esp_id` int(4) NOT NULL,
  `funcionario_fun_id` int(11) NOT NULL,
  `funcionario_pessoa_pes_id` int(11) NOT NULL,
  `funcionario_pessoa_endereco_end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `pac_tipo_sangue` char(2) COLLATE utf8_bin DEFAULT NULL,
  `pac_remedio` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pac_doenca` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pac_educacao` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pac_hospitalizado` tinyint(1) DEFAULT NULL,
  `pessoa_pes_id` int(11) NOT NULL,
  `pessoa_endereco_end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `pac_tipo_sangue`, `pac_remedio`, `pac_doenca`, `pac_educacao`, `pac_hospitalizado`, `pessoa_pes_id`, `pessoa_endereco_end_id`) VALUES
(1, 'AB', 'nenhum', 'nenhuma', 'ensino medio completo', 0, 3, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pes_id` int(11) NOT NULL,
  `pes_nomel` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_pai` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_mae` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_rg` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `pes_cpf` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `pes_data` date DEFAULT NULL,
  `pes_tipo` int(1) DEFAULT NULL,
  `pes_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pes_estado_civil` int(1) DEFAULT NULL,
  `pes_cidadania` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pes_genero` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `pes_sexo_biologico` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `pes_telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `endereco_end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `pessoa`
--

INSERT INTO `pessoa` (`pes_id`, `pes_nomel`, `pes_pai`, `pes_mae`, `pes_rg`, `pes_cpf`, `pes_data`, `pes_tipo`, `pes_email`, `pes_estado_civil`, `pes_cidadania`, `pes_genero`, `pes_sexo_biologico`, `pes_telefone`, `endereco_end_id`) VALUES
(1, 'José da Silva Sauro', 'Roberval do Nascimento Morto', 'Mariane Da Silva Nascimento', '34.345.345-3', '345.345.345-34', '1998-02-27', 1, 'meuemail@mail.com', 0, 'ubatubense', 'masculino', 'masculino', '(12)9823458965', 1),
(2, 'Karina Mathos Ramos', 'Joaquim Mathos Ramos', 'Larisa Mathos', '43.434.434-3', '346.346.346-34', '2005-04-21', 1, 'karina@bol.com.br', 0, 'Ubatubense', 'Feminino', 'Feminino', '(12)982343434', 2),
(3, 'Tamara Porto', 'Juan Porto', 'Marta Porto', '50.890.001-8', '344.433.434-34', '1994-09-07', 1, 'tamara@email.com', 0, 'Ubatubense', 'Feminino', 'Feminino', '(12)988446605', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `set_id` int(11) NOT NULL,
  `set_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `set_descricao` varchar(255) COLLATE utf8_bin NOT NULL,
  `set_responsavel` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `setor`
--

INSERT INTO `setor` (`set_id`, `set_nome`, `set_descricao`, `set_responsavel`) VALUES
(1, 'Clinica', 'Clinica Geral', 'Josivaldo');

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
(1, 'João', '123', 'vcr@gmail.com', 1, 1),
(2, 'Joaquim', '1234', 'me@gmail.com', 1, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`end_id`);

--
-- Índices de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD PRIMARY KEY (`enf_id`,`funcionario_fun_id`,`funcionario_pessoa_pes_id`,`funcionario_pessoa_endereco_end_id`),
  ADD KEY `fk_enfermeiro_funcionario1_idx` (`funcionario_fun_id`,`funcionario_pessoa_pes_id`,`funcionario_pessoa_endereco_end_id`);

--
-- Índices de tabela `especializacao`
--
ALTER TABLE `especializacao`
  ADD PRIMARY KEY (`esp_id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`fun_id`,`pessoa_pes_id`,`pessoa_endereco_end_id`),
  ADD KEY `fk_FUNCIONARIOS_USUARIO1_idx` (`usuario_usu_id`),
  ADD KEY `fk_funcionario_pessoa1_idx` (`pessoa_pes_id`,`pessoa_endereco_end_id`);

--
-- Índices de tabela `login_acesso`
--
ALTER TABLE `login_acesso`
  ADD PRIMARY KEY (`log_id`,`usuario_usu_id`),
  ADD KEY `fk_login_acesso_usuario1_idx` (`usuario_usu_id`);

--
-- Índices de tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`med_id`,`funcionario_fun_id`,`funcionario_pessoa_pes_id`,`funcionario_pessoa_endereco_end_id`),
  ADD KEY `fk_MEDICO_ESPECIALIZACAO1_idx` (`especializacao_esp_id`),
  ADD KEY `fk_medico_funcionario1_idx` (`funcionario_fun_id`,`funcionario_pessoa_pes_id`,`funcionario_pessoa_endereco_end_id`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`,`pessoa_pes_id`,`pessoa_endereco_end_id`),
  ADD KEY `fk_paciente_pessoa1_idx` (`pessoa_pes_id`,`pessoa_endereco_end_id`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pes_id`,`endereco_end_id`),
  ADD KEY `fk_pessoa_endereco1_idx` (`endereco_end_id`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`set_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  MODIFY `enf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `especializacao`
--
ALTER TABLE `especializacao`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `fun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `login_acesso`
--
ALTER TABLE `login_acesso`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `pes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD CONSTRAINT `fk_enfermeiro_funcionario1` FOREIGN KEY (`funcionario_fun_id`,`funcionario_pessoa_pes_id`,`funcionario_pessoa_endereco_end_id`) REFERENCES `funcionario` (`fun_id`, `pessoa_pes_id`, `pessoa_endereco_end_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_FUNCIONARIOS_USUARIO1` FOREIGN KEY (`usuario_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcionario_pessoa1` FOREIGN KEY (`pessoa_pes_id`,`pessoa_endereco_end_id`) REFERENCES `pessoa` (`pes_id`, `endereco_end_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `login_acesso`
--
ALTER TABLE `login_acesso`
  ADD CONSTRAINT `fk_login_acesso_usuario1` FOREIGN KEY (`usuario_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `fk_MEDICO_ESPECIALIZACAO1` FOREIGN KEY (`especializacao_esp_id`) REFERENCES `especializacao` (`esp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_medico_funcionario1` FOREIGN KEY (`funcionario_fun_id`,`funcionario_pessoa_pes_id`,`funcionario_pessoa_endereco_end_id`) REFERENCES `funcionario` (`fun_id`, `pessoa_pes_id`, `pessoa_endereco_end_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_pessoa1` FOREIGN KEY (`pessoa_pes_id`,`pessoa_endereco_end_id`) REFERENCES `pessoa` (`pes_id`, `endereco_end_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `fk_pessoa_endereco1` FOREIGN KEY (`endereco_end_id`) REFERENCES `endereco` (`end_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
