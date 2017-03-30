-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/03/2017 às 04:48
-- Versão do servidor: 10.1.21-MariaDB
-- Versão do PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hospital`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ACOMPANHAMENTO`
--

CREATE TABLE `ACOMPANHAMENTO` (
  `aco_id` int(11) NOT NULL,
  `aco_autoexame` tinyint(1) NOT NULL,
  `aco_colcoscopia` tinyint(1) NOT NULL,
  `aco_papanicolau` tinyint(1) NOT NULL,
  `aco_mamografia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ADMINISTRACAO`
--

CREATE TABLE `ADMINISTRACAO` (
  `adm_id` int(11) NOT NULL,
  `adm_funcao` varchar(155) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ALA`
--

CREATE TABLE `ALA` (
  `ala_id` int(11) NOT NULL,
  `ala_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ala_andar` int(2) DEFAULT NULL,
  `ala_genero` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ala_telefone_acesso` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `ala_micro-ondas` tinyint(1) DEFAULT NULL,
  `ala_info` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ala_numero_camas` int(4) DEFAULT NULL,
  `ala_refrigerador` tinyint(1) DEFAULT NULL,
  `ala_ar-condionado` tinyint(1) DEFAULT NULL,
  `ala_banheiro_privativo` tinyint(1) DEFAULT NULL,
  `ala_televisao` tinyint(1) DEFAULT NULL,
  `ala_sofa-cama_convidado` tinyint(1) DEFAULT NULL,
  `ala_estado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ala_privado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ala_risco_biologico` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `CAMA_cam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ALCOOL`
--

CREATE TABLE `ALCOOL` (
  `alc_id` int(11) NOT NULL,
  `alc_alcoolatra` tinyint(1) NOT NULL,
  `alc_ex_alcoolatra` tinyint(1) NOT NULL,
  `alc_idade_inicio` date NOT NULL,
  `alc_idade_fim` date NOT NULL,
  `alc_vinho_dia` varchar(45) COLLATE utf8_bin NOT NULL,
  `alc_cervejas_dia` int(2) NOT NULL,
  `alc_destilados_dia` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ASSOCIADOS`
--

CREATE TABLE `ASSOCIADOS` (
  `ass_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CAMA`
--

CREATE TABLE `CAMA` (
  `cam_id` int(11) NOT NULL,
  `cam_info` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cam_numero` int(2) DEFAULT NULL,
  `cam_tipo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cam_suprimento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cam_estado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cam_numero_telefone` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CIRURGIA`
--

CREATE TABLE `CIRURGIA` (
  `cir_id` int(11) NOT NULL,
  `cir_descricao` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `cir_data` date NOT NULL,
  `cir_urgencia` tinyint(1) DEFAULT NULL,
  `cir_cirugiao` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cir_anestesista` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cir_asa_ps` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cir_ferida` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CONDICAO`
--

CREATE TABLE `CONDICAO` (
  `cnd_id` int(11) NOT NULL,
  `cnd_nome` varchar(145) COLLATE utf8_bin NOT NULL,
  `cnd_categoria` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `cnd_codigo` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CONSELHO_DELIBERATIVO`
--

CREATE TABLE `CONSELHO_DELIBERATIVO` (
  `cde_id` int(11) NOT NULL,
  `cde_presidente` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cde_vice_presidente` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cde_primeiro_secretario` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cde_segundo_secretario` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CONSELHO_GERAL`
--

CREATE TABLE `CONSELHO_GERAL` (
  `cog_id` int(11) NOT NULL,
  `cog_presidente` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cog_vice_pesidente` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `con_pimeiro_secretario` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CONSULTA`
--

CREATE TABLE `CONSULTA` (
  `con_id` int(11) NOT NULL,
  `con_data` datetime NOT NULL,
  `con_status` varchar(45) COLLATE utf8_bin NOT NULL,
  `con_urgencia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `DIETA`
--

CREATE TABLE `DIETA` (
  `die_id` int(11) NOT NULL,
  `die_cafe` int(1) NOT NULL,
  `die_sal` varchar(45) COLLATE utf8_bin NOT NULL,
  `die_autonomo` varchar(45) COLLATE utf8_bin NOT NULL,
  `die_refeicoes_dia` int(1) NOT NULL,
  `die_regime` varchar(45) COLLATE utf8_bin NOT NULL,
  `die_comentarios` varchar(100) COLLATE utf8_bin NOT NULL,
  `die_vegetariano` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `DROGAS`
--

CREATE TABLE `DROGAS` (
  `dro_id` int(11) NOT NULL,
  `dro_nome_vulgar` varchar(45) COLLATE utf8_bin NOT NULL,
  `dro_nome` varchar(45) COLLATE utf8_bin NOT NULL,
  `dro_toxicidade` varchar(45) COLLATE utf8_bin NOT NULL,
  `dro_codigo` varchar(45) COLLATE utf8_bin NOT NULL,
  `dro_catergoria` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ENDERECO`
--

CREATE TABLE `ENDERECO` (
  `end_id` int(11) NOT NULL,
  `end_pais` varchar(60) COLLATE utf8_bin NOT NULL,
  `end_estado` char(2) COLLATE utf8_bin NOT NULL,
  `end_cidade` varchar(100) COLLATE utf8_bin NOT NULL,
  `end_cep` varchar(13) COLLATE utf8_bin NOT NULL,
  `end_bairro` varchar(45) COLLATE utf8_bin NOT NULL,
  `end_distrito` varchar(45) COLLATE utf8_bin NOT NULL,
  `end_rua` varchar(45) COLLATE utf8_bin NOT NULL,
  `end_numero` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ENFERMEIRO`
--

CREATE TABLE `ENFERMEIRO` (
  `enf_id` int(11) NOT NULL,
  `enf_registro` varchar(45) COLLATE utf8_bin NOT NULL,
  `FUNCIONARIO_fun_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ESPECIALIZACAO`
--

CREATE TABLE `ESPECIALIZACAO` (
  `esp_id` int(11) NOT NULL,
  `esp_nome` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ESTILO_DE_VIDA`
--

CREATE TABLE `ESTILO_DE_VIDA` (
  `edv_id` int(11) NOT NULL,
  `edv_vicios` int(11) NOT NULL,
  `edv_sono` int(11) NOT NULL,
  `edv_exercicio` int(11) NOT NULL,
  `DIETA_die_id` int(11) NOT NULL,
  `SEXUALIDADE_sex_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `EXAME_ANALISE`
--

CREATE TABLE `EXAME_ANALISE` (
  `exa_id` int(11) NOT NULL,
  `exa_valor` float DEFAULT NULL,
  `exa_data` date DEFAULT NULL,
  `exa_resultado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `exa_diagnostico` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `EXAME_SOLICITACAO`
--

CREATE TABLE `EXAME_SOLICITACAO` (
  `exs_id` int(11) NOT NULL,
  `exs_estado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `exs_urgente` tinyint(1) DEFAULT NULL,
  `exs_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `EXERCICIO`
--

CREATE TABLE `EXERCICIO` (
  `exe_id` int(11) NOT NULL,
  `exe_pratica` tinyint(1) NOT NULL,
  `exe_minutos_dia` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `FAMILIA`
--

CREATE TABLE `FAMILIA` (
  `fam_id` int(11) NOT NULL,
  `fam_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `fam_parentesco` varchar(30) COLLATE utf8_bin NOT NULL,
  `fam_telefone` varchar(15) COLLATE utf8_bin NOT NULL,
  `fam_email` varchar(60) COLLATE utf8_bin NOT NULL,
  `PACIENTE_pac_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `FUMANTE`
--

CREATE TABLE `FUMANTE` (
  `fum_id` int(11) NOT NULL,
  `fum_passivo` tinyint(1) NOT NULL,
  `fum_cigarros_dia` int(2) NOT NULL,
  `fum_idade_inicio` date NOT NULL,
  `fum_idade_fim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `FUNCIONARIO`
--

CREATE TABLE `FUNCIONARIO` (
  `fun_id` int(11) NOT NULL,
  `fun_cargo` varchar(45) COLLATE utf8_bin NOT NULL,
  `fun_horario` time NOT NULL,
  `fun_inscricao` int(9) NOT NULL,
  `fun_turno` int(1) NOT NULL,
  `PERMISSOES_per_id` int(4) NOT NULL,
  `USUARIO_usu_id` int(4) NOT NULL,
  `SETOR_set_id` int(4) NOT NULL,
  `PESSOA_pes_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `GENETICA`
--

CREATE TABLE `GENETICA` (
  `gen_id` int(11) NOT NULL,
  `gen_proteina` varchar(45) COLLATE utf8_bin NOT NULL,
  `gen_cromosomos` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `GRUPO`
--

CREATE TABLE `GRUPO` (
  `grp_id` int(11) NOT NULL,
  `grp_descricao` varchar(155) COLLATE utf8_bin NOT NULL,
  `grp_informacao` varchar(155) COLLATE utf8_bin NOT NULL,
  `grp_codigo` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `HISTORICO_MENSTRUAL`
--

CREATE TABLE `HISTORICO_MENSTRUAL` (
  `men_id` int(11) NOT NULL,
  `men_data_mens` date NOT NULL,
  `men_data_aval` date NOT NULL,
  `men_frequencia` varchar(25) COLLATE utf8_bin NOT NULL,
  `men_duracao` int(2) NOT NULL,
  `men_dismenorreia` tinyint(1) NOT NULL,
  `men_normal` tinyint(1) NOT NULL,
  `MEDICO_med_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `INSTITUICAO`
--

CREATE TABLE `INSTITUICAO` (
  `ins_id` int(11) NOT NULL,
  `ins_nome` varchar(65) COLLATE utf8_bin NOT NULL,
  `ins_numero_camas` int(11) DEFAULT NULL,
  `ins_ativo` tinyint(1) DEFAULT NULL,
  `ins_administracao` int(4) DEFAULT NULL,
  `ins_nivel_trauma` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ins_tipo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ins_centro_trauma` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ins_heliporto` tinyint(1) DEFAULT NULL,
  `ins_numero_sala_operacao` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `ALA_ala_id` int(11) NOT NULL,
  `SETOR_OPERACIONAL_seo_id` int(11) NOT NULL,
  `SALA_OPERACAO_sao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `LOGIN_ACESSO`
--

CREATE TABLE `LOGIN_ACESSO` (
  `log_id` int(11) NOT NULL,
  `log_data` datetime NOT NULL,
  `log_ip` varchar(45) COLLATE utf8_bin NOT NULL,
  `USUARIO_usu_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MEDICACAO`
--

CREATE TABLE `MEDICACAO` (
  `mco_id` int(11) NOT NULL,
  `mco_ativo` tinyint(1) NOT NULL,
  `mco_notas` varchar(60) COLLATE utf8_bin NOT NULL,
  `mco_inicio` date NOT NULL,
  `mco_ fim` date NOT NULL,
  `mco_horario` time NOT NULL,
  `mco_frequencia` varchar(45) COLLATE utf8_bin NOT NULL,
  `mco_periodo` varchar(45) COLLATE utf8_bin NOT NULL,
  `mco_duracao` varchar(45) COLLATE utf8_bin NOT NULL,
  `mco_completou` tinyint(1) NOT NULL,
  `mco_suspendido` tinyint(1) NOT NULL,
  `mco_dose` varchar(60) COLLATE utf8_bin NOT NULL,
  `PRESCRICAO_pre_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MEDICAMENTO`
--

CREATE TABLE `MEDICAMENTO` (
  `med_id` int(11) NOT NULL,
  `med_descricao` varchar(150) COLLATE utf8_bin NOT NULL,
  `med_nome` varchar(45) COLLATE utf8_bin NOT NULL,
  `med_indicacao` varchar(150) COLLATE utf8_bin NOT NULL,
  `med_componente_ativo` varchar(45) COLLATE utf8_bin NOT NULL,
  `med_unidade` int(3) NOT NULL,
  `med_armazenamento` varchar(45) COLLATE utf8_bin NOT NULL,
  `med_concentracao` varchar(45) COLLATE utf8_bin NOT NULL,
  `med_categoria` varchar(45) COLLATE utf8_bin NOT NULL,
  `med_vacina` varchar(45) COLLATE utf8_bin NOT NULL,
  `PRODUTO_prt_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MEDICO`
--

CREATE TABLE `MEDICO` (
  `med_id` int(11) NOT NULL,
  `med_crm` varchar(45) COLLATE utf8_bin NOT NULL,
  `ESPECIALIZACAO_esp_id` int(4) NOT NULL,
  `FUNCIONARIO_fun_id` int(4) NOT NULL,
  `CONSULTA_con_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MESA_ADMINISTRATIVA`
--

CREATE TABLE `MESA_ADMINISTRATIVA` (
  `mes_id` int(11) NOT NULL,
  `mes_provedor` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mes_vice_provedor` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mes_primeiro_tesoureiro` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mes_segundo_tesoureiro` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mes_primeiro_secretario` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mes_segundo_secretario` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mes_mordomo_geral` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MODULOS`
--

CREATE TABLE `MODULOS` (
  `mod_id` int(11) NOT NULL,
  `mod_nome` varchar(45) COLLATE utf8_bin NOT NULL,
  `mod_descricao` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `OBITO`
--

CREATE TABLE `OBITO` (
  `obi_id` int(11) NOT NULL,
  `obi_data` date NOT NULL,
  `obi_hora` time NOT NULL,
  `obi_causamortis` varchar(255) COLLATE utf8_bin NOT NULL,
  `obi_local` varchar(45) COLLATE utf8_bin NOT NULL,
  `obi_autopsia` tinyint(1) NOT NULL,
  `PACIENTE_pac_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `OBSTETRIA_GINECOLOGISTA`
--

CREATE TABLE `OBSTETRIA_GINECOLOGISTA` (
  `ob_id` int(11) NOT NULL,
  `ob_gravidez_mult` varchar(45) COLLATE utf8_bin NOT NULL,
  `ob_idade_menarca` int(2) NOT NULL,
  `ob_gravida` varchar(45) COLLATE utf8_bin NOT NULL,
  `ob_fertil` varchar(45) COLLATE utf8_bin NOT NULL,
  `ob_menopausa` tinyint(1) NOT NULL,
  `ob_idade_menopausa` varchar(45) COLLATE utf8_bin NOT NULL,
  `ob_num_gravidez` int(2) NOT NULL,
  `ob_num_prematuros` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PACIENTE`
--

CREATE TABLE `PACIENTE` (
  `pac_id` int(11) NOT NULL,
  `pac_tipo_sangue` char(2) COLLATE utf8_bin NOT NULL,
  `pac_remedio` varchar(45) COLLATE utf8_bin NOT NULL,
  `pac_doenca` varchar(45) COLLATE utf8_bin NOT NULL,
  `pac_educacao` varchar(100) COLLATE utf8_bin NOT NULL,
  `pac_profissao` varchar(100) COLLATE utf8_bin NOT NULL,
  `pac_hospitalizado` tinyint(1) NOT NULL,
  `PESSOA_id_dados` int(11) NOT NULL,
  `ESTILO_DE_VIDA_edv_id` int(11) NOT NULL,
  `SOCIO_ECONOMICO_soe_id` int(4) NOT NULL,
  `PATOLOGIA_ptl_id` int(4) NOT NULL,
  `PLANO_DE_SAUDE_pds_id` int(4) NOT NULL,
  `CONSULTA_con_id` int(4) NOT NULL,
  `PRESCRICAO_pre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PATOLOGIA`
--

CREATE TABLE `PATOLOGIA` (
  `ptl_id` int(11) NOT NULL,
  `ptl_codigo` int(10) NOT NULL,
  `ptl_nome` varchar(45) COLLATE utf8_bin NOT NULL,
  `ptl_categoria` varchar(45) COLLATE utf8_bin NOT NULL,
  `ptl_informacao` varchar(255) COLLATE utf8_bin NOT NULL,
  `ptl_gene` int(11) NOT NULL,
  `ptl_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PERMISSOES`
--

CREATE TABLE `PERMISSOES` (
  `per_id` int(11) NOT NULL,
  `per_modulo` int(11) NOT NULL,
  `per_nivel` int(1) NOT NULL,
  `USUARIO_usu_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PESSOA`
--

CREATE TABLE `PESSOA` (
  `pes_id` int(11) NOT NULL,
  `pes_nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `pes_pai` varchar(100) COLLATE utf8_bin NOT NULL,
  `pes_mae` varchar(100) COLLATE utf8_bin NOT NULL,
  `pes_rg` varchar(15) COLLATE utf8_bin NOT NULL,
  `pes_cpf` varchar(15) COLLATE utf8_bin NOT NULL,
  `pes_data` date NOT NULL,
  `pes_tipo` int(1) NOT NULL,
  `pes_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `pes_estado_civil` int(1) NOT NULL,
  `pes_cidadania` varchar(45) COLLATE utf8_bin NOT NULL,
  `pes_genero` varchar(25) COLLATE utf8_bin NOT NULL,
  `pes_sexo_biologico` varchar(25) COLLATE utf8_bin NOT NULL,
  `pes_telefone` varchar(15) COLLATE utf8_bin NOT NULL,
  `pes_endereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PLANO_DE_SAUDE`
--

CREATE TABLE `PLANO_DE_SAUDE` (
  `pds_id` int(11) NOT NULL,
  `pds_convenio` varchar(60) COLLATE utf8_bin NOT NULL,
  `pds_sus` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PRATICA_SEXO`
--

CREATE TABLE `PRATICA_SEXO` (
  `prs_id` int(11) NOT NULL,
  `prs_prostituta` tinyint(1) NOT NULL,
  `prs_anal` tinyint(1) NOT NULL,
  `prs_oral` tinyint(1) NOT NULL,
  `prs_sexo_com_prostituta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PRESCRICAO`
--

CREATE TABLE `PRESCRICAO` (
  `pre_id` int(11) NOT NULL,
  `pre_data` varchar(45) COLLATE utf8_bin NOT NULL,
  `pre_verificada` tinyint(1) NOT NULL,
  `pre_info` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PROCEDIMENTOS`
--

CREATE TABLE `PROCEDIMENTOS` (
  `pcd_id` int(11) NOT NULL,
  `pcd_nome` varchar(145) COLLATE utf8_bin NOT NULL,
  `pcd_codigo` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PRODUTO`
--

CREATE TABLE `PRODUTO` (
  `prt_id` int(11) NOT NULL,
  `prt_preco_custo` float NOT NULL,
  `prt_preco_lista` float NOT NULL,
  `prt_categoria` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PROVEDORIA`
--

CREATE TABLE `PROVEDORIA` (
  `pro_id` int(11) NOT NULL,
  `pro_provedor` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pro_vice_provedorl` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pro_superintendente` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `QUADRO_CLINICO`
--

CREATE TABLE `QUADRO_CLINICO` (
  `qcl_id` int(11) NOT NULL,
  `qcl_quadro` varchar(60) COLLATE utf8_bin NOT NULL,
  `qcl_gravidade` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `QUIMICO`
--

CREATE TABLE `QUIMICO` (
  `qui_id` int(11) NOT NULL,
  `qui_intravenosso` tinyint(1) NOT NULL,
  `qui_idade_fim` date NOT NULL,
  `qui_idade_inicio` date NOT NULL,
  `qui_ex_viciado` tinyint(1) NOT NULL,
  `qui_outra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SALA_OPERACAO`
--

CREATE TABLE `SALA_OPERACAO` (
  `sao_id` int(11) NOT NULL,
  `sao_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sao_numero_camas` int(2) DEFAULT NULL,
  `sao_estado` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SETOR`
--

CREATE TABLE `SETOR` (
  `set_id` int(11) NOT NULL,
  `set_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `set_descricao` varchar(255) COLLATE utf8_bin NOT NULL,
  `set_responsavel` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SETOR_OPERACIONAL`
--

CREATE TABLE `SETOR_OPERACIONAL` (
  `seo_id` int(11) NOT NULL,
  `seo_nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `seo_area` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SEXUALIDADE`
--

CREATE TABLE `SEXUALIDADE` (
  `sex_id` int(11) NOT NULL,
  `sex_parceiros` int(2) NOT NULL,
  `sex_pref_sexual` varchar(45) COLLATE utf8_bin NOT NULL,
  `sex_seguro` varchar(45) COLLATE utf8_bin NOT NULL,
  `sex_idade_iniciacao` int(2) NOT NULL,
  `sex_pratica_sexo` int(11) NOT NULL,
  `sex_contracep` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SINTOMOLOGIA`
--

CREATE TABLE `SINTOMOLOGIA` (
  `sin_id` int(11) NOT NULL,
  `sin_nome` varchar(155) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SOCIO_ECONOMICO`
--

CREATE TABLE `SOCIO_ECONOMICO` (
  `soe_id` int(11) NOT NULL,
  `soe_detento` tinyint(1) NOT NULL,
  `soe_familia_monoparamental` tinyint(1) NOT NULL,
  `soe_gravidez_adolescencia` tinyint(1) NOT NULL,
  `soe_area_de_risco` tinyint(1) NOT NULL,
  `soe_abuso_sexual` tinyint(1) NOT NULL,
  `soe_ex_detento` tinyint(1) NOT NULL,
  `soe_trabalho_infantil` tinyint(1) NOT NULL,
  `soe_violencia_domestica` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SONO`
--

CREATE TABLE `SONO` (
  `son_id` int(11) NOT NULL,
  `son_horas` time NOT NULL,
  `son_minutos_dia` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `TESTE_IMAGEM`
--

CREATE TABLE `TESTE_IMAGEM` (
  `tei_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `TESTE_LABORATORIO`
--

CREATE TABLE `TESTE_LABORATORIO` (
  `tel_id` int(11) NOT NULL,
  `tel_analito` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tel_valor_maximo` float DEFAULT NULL,
  `tel_valor_minimo` float DEFAULT NULL,
  `tel_unidade_medida` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `TRIAGEM`
--

CREATE TABLE `TRIAGEM` (
  `tri_id` int(5) NOT NULL,
  `tri_temperatura` varchar(25) COLLATE utf8_bin NOT NULL,
  `tri_pressao` varchar(25) COLLATE utf8_bin NOT NULL,
  `tri_peso` float NOT NULL,
  `tri_altura` float NOT NULL,
  `tri_batimento` varchar(25) COLLATE utf8_bin NOT NULL,
  `tri_classe_risco` varchar(25) COLLATE utf8_bin NOT NULL,
  `tri_oxigenacao` varchar(25) COLLATE utf8_bin NOT NULL,
  `tri_respiracao` varchar(25) COLLATE utf8_bin NOT NULL,
  `PACIENTE_pac_id` int(5) NOT NULL,
  `QUADRO_CLINICO_qcl_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `TRIAGEM_has_SINTOMOLOGIA`
--

CREATE TABLE `TRIAGEM_has_SINTOMOLOGIA` (
  `TRIAGEM_tri_id` int(5) NOT NULL,
  `SINTOMOLOGIA_stm_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `USUARIO`
--

CREATE TABLE `USUARIO` (
  `usu_id` int(11) NOT NULL,
  `usu_nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `usu_senha` varchar(64) COLLATE utf8_bin NOT NULL,
  `usu_email` varchar(45) COLLATE utf8_bin NOT NULL,
  `usu_ativo` tinyint(1) NOT NULL DEFAULT '1',
  `usu_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `USUARIO`
--

INSERT INTO `USUARIO` (`usu_id`, `usu_nome`, `usu_senha`, `usu_email`, `usu_ativo`, `usu_tipo`) VALUES
(1, 'João', '123', 'joaoneves@bol.com.br', 1, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `ACOMPANHAMENTO`
--
ALTER TABLE `ACOMPANHAMENTO`
  ADD PRIMARY KEY (`aco_id`);

--
-- Índices de tabela `ADMINISTRACAO`
--
ALTER TABLE `ADMINISTRACAO`
  ADD PRIMARY KEY (`adm_id`);

--
-- Índices de tabela `ALA`
--
ALTER TABLE `ALA`
  ADD PRIMARY KEY (`ala_id`),
  ADD KEY `fk_ALA_CAMA1_idx` (`CAMA_cam_id`);

--
-- Índices de tabela `ALCOOL`
--
ALTER TABLE `ALCOOL`
  ADD PRIMARY KEY (`alc_id`);

--
-- Índices de tabela `ASSOCIADOS`
--
ALTER TABLE `ASSOCIADOS`
  ADD PRIMARY KEY (`ass_id`);

--
-- Índices de tabela `CAMA`
--
ALTER TABLE `CAMA`
  ADD PRIMARY KEY (`cam_id`);

--
-- Índices de tabela `CIRURGIA`
--
ALTER TABLE `CIRURGIA`
  ADD PRIMARY KEY (`cir_id`);

--
-- Índices de tabela `CONDICAO`
--
ALTER TABLE `CONDICAO`
  ADD PRIMARY KEY (`cnd_id`);

--
-- Índices de tabela `CONSELHO_DELIBERATIVO`
--
ALTER TABLE `CONSELHO_DELIBERATIVO`
  ADD PRIMARY KEY (`cde_id`);

--
-- Índices de tabela `CONSELHO_GERAL`
--
ALTER TABLE `CONSELHO_GERAL`
  ADD PRIMARY KEY (`cog_id`);

--
-- Índices de tabela `CONSULTA`
--
ALTER TABLE `CONSULTA`
  ADD PRIMARY KEY (`con_id`);

--
-- Índices de tabela `DIETA`
--
ALTER TABLE `DIETA`
  ADD PRIMARY KEY (`die_id`);

--
-- Índices de tabela `DROGAS`
--
ALTER TABLE `DROGAS`
  ADD PRIMARY KEY (`dro_id`);

--
-- Índices de tabela `ENDERECO`
--
ALTER TABLE `ENDERECO`
  ADD PRIMARY KEY (`end_id`);

--
-- Índices de tabela `ENFERMEIRO`
--
ALTER TABLE `ENFERMEIRO`
  ADD PRIMARY KEY (`enf_id`),
  ADD KEY `fk_ENFERMEIRO_FUNCIONARIO1_idx` (`FUNCIONARIO_fun_id`);

--
-- Índices de tabela `ESPECIALIZACAO`
--
ALTER TABLE `ESPECIALIZACAO`
  ADD PRIMARY KEY (`esp_id`);

--
-- Índices de tabela `ESTILO_DE_VIDA`
--
ALTER TABLE `ESTILO_DE_VIDA`
  ADD PRIMARY KEY (`edv_id`),
  ADD KEY `fk_ESTILO_VIDA_FUMANTE1_idx` (`edv_vicios`),
  ADD KEY `fk_ESTILO_VIDA_DIETA1_idx` (`DIETA_die_id`),
  ADD KEY `fk_ESTILO_VIDA_SEXUALIDADE1_idx` (`SEXUALIDADE_sex_id`),
  ADD KEY `fk_ESTILO_VIDA_SONO1_idx` (`edv_sono`),
  ADD KEY `fk_ESTILO_VIDA_EXERCICIO1_idx` (`edv_exercicio`);

--
-- Índices de tabela `EXAME_ANALISE`
--
ALTER TABLE `EXAME_ANALISE`
  ADD PRIMARY KEY (`exa_id`);

--
-- Índices de tabela `EXAME_SOLICITACAO`
--
ALTER TABLE `EXAME_SOLICITACAO`
  ADD PRIMARY KEY (`exs_id`);

--
-- Índices de tabela `EXERCICIO`
--
ALTER TABLE `EXERCICIO`
  ADD PRIMARY KEY (`exe_id`);

--
-- Índices de tabela `FAMILIA`
--
ALTER TABLE `FAMILIA`
  ADD PRIMARY KEY (`fam_id`),
  ADD KEY `fk_FAMILIA_PACIENTE1_idx` (`PACIENTE_pac_id`);

--
-- Índices de tabela `FUMANTE`
--
ALTER TABLE `FUMANTE`
  ADD PRIMARY KEY (`fum_id`);

--
-- Índices de tabela `FUNCIONARIO`
--
ALTER TABLE `FUNCIONARIO`
  ADD PRIMARY KEY (`fun_id`),
  ADD KEY `fk_FUNCIONARIOS_PERMISSOES1_idx` (`PERMISSOES_per_id`),
  ADD KEY `fk_FUNCIONARIOS_USUARIO1_idx` (`USUARIO_usu_id`),
  ADD KEY `fk_FUNCIONARIOS_SETOR1_idx` (`SETOR_set_id`),
  ADD KEY `fk_FUNCIONARIO_PESSOA1_idx` (`PESSOA_pes_id`);

--
-- Índices de tabela `GENETICA`
--
ALTER TABLE `GENETICA`
  ADD PRIMARY KEY (`gen_id`);

--
-- Índices de tabela `GRUPO`
--
ALTER TABLE `GRUPO`
  ADD PRIMARY KEY (`grp_id`);

--
-- Índices de tabela `HISTORICO_MENSTRUAL`
--
ALTER TABLE `HISTORICO_MENSTRUAL`
  ADD PRIMARY KEY (`men_id`),
  ADD KEY `fk_HISTORICO_MENSTRUAL_MEDICO1_idx` (`MEDICO_med_id`);

--
-- Índices de tabela `INSTITUICAO`
--
ALTER TABLE `INSTITUICAO`
  ADD PRIMARY KEY (`ins_id`,`SETOR_OPERACIONAL_seo_id`,`SALA_OPERACAO_sao_id`),
  ADD KEY `fk_INSTITUICAO_ALA1_idx` (`ALA_ala_id`),
  ADD KEY `fk_INSTITUICAO_SETOR_OPERACIONAL1_idx` (`SETOR_OPERACIONAL_seo_id`),
  ADD KEY `fk_INSTITUICAO_SALA_OPERACAO1_idx` (`SALA_OPERACAO_sao_id`);

--
-- Índices de tabela `LOGIN_ACESSO`
--
ALTER TABLE `LOGIN_ACESSO`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_LOGIN_ACESSO_USUARIO1_idx` (`USUARIO_usu_id`);

--
-- Índices de tabela `MEDICACAO`
--
ALTER TABLE `MEDICACAO`
  ADD PRIMARY KEY (`mco_id`),
  ADD KEY `fk_MEDICACAO_PRESCRICAO1_idx` (`PRESCRICAO_pre_id`);

--
-- Índices de tabela `MEDICAMENTO`
--
ALTER TABLE `MEDICAMENTO`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `fk_MEDICAMENTO_PRODUTO1_idx` (`PRODUTO_prt_id`);

--
-- Índices de tabela `MEDICO`
--
ALTER TABLE `MEDICO`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `fk_MEDICO_ESPECIALIZACAO1_idx` (`ESPECIALIZACAO_esp_id`),
  ADD KEY `fk_MEDICO_FUNCIONARIO1_idx` (`FUNCIONARIO_fun_id`),
  ADD KEY `fk_MEDICO_CONSULTA1_idx` (`CONSULTA_con_id`);

--
-- Índices de tabela `MESA_ADMINISTRATIVA`
--
ALTER TABLE `MESA_ADMINISTRATIVA`
  ADD PRIMARY KEY (`mes_id`);

--
-- Índices de tabela `MODULOS`
--
ALTER TABLE `MODULOS`
  ADD PRIMARY KEY (`mod_id`);

--
-- Índices de tabela `OBITO`
--
ALTER TABLE `OBITO`
  ADD PRIMARY KEY (`obi_id`),
  ADD KEY `fk_OBITO_PACIENTE1_idx` (`PACIENTE_pac_id`);

--
-- Índices de tabela `OBSTETRIA_GINECOLOGISTA`
--
ALTER TABLE `OBSTETRIA_GINECOLOGISTA`
  ADD PRIMARY KEY (`ob_id`);

--
-- Índices de tabela `PACIENTE`
--
ALTER TABLE `PACIENTE`
  ADD PRIMARY KEY (`pac_id`),
  ADD KEY `fk_PACIENTE_PESSOA1_idx` (`PESSOA_id_dados`),
  ADD KEY `fk_PACIENTE_ESTILO_DE_VIDA1_idx` (`ESTILO_DE_VIDA_edv_id`),
  ADD KEY `fk_PACIENTE_SOCIO_ECONOMICO1_idx` (`SOCIO_ECONOMICO_soe_id`),
  ADD KEY `fk_PACIENTE_PATOLOGIA1_idx` (`PATOLOGIA_ptl_id`),
  ADD KEY `fk_PACIENTE_PLANO_DE_SAUDE1_idx` (`PLANO_DE_SAUDE_pds_id`),
  ADD KEY `fk_PACIENTE_CONSULTA1_idx` (`CONSULTA_con_id`),
  ADD KEY `fk_PACIENTE_PRESCRICAO1_idx` (`PRESCRICAO_pre_id`);

--
-- Índices de tabela `PATOLOGIA`
--
ALTER TABLE `PATOLOGIA`
  ADD PRIMARY KEY (`ptl_id`),
  ADD KEY `fk_PATOLOGIA_GENETICA1_idx` (`ptl_gene`),
  ADD KEY `fk_PATOLOGIA_GRUPO1_idx` (`ptl_grupo`);

--
-- Índices de tabela `PERMISSOES`
--
ALTER TABLE `PERMISSOES`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `fk_PERMISSOES_USUARIO1_idx` (`USUARIO_usu_id`),
  ADD KEY `fk_PERMISSOES_MODULOS1_idx` (`per_modulo`);

--
-- Índices de tabela `PESSOA`
--
ALTER TABLE `PESSOA`
  ADD PRIMARY KEY (`pes_id`),
  ADD KEY `fk_PESSOA_ENDERECO1_idx` (`pes_endereco`);

--
-- Índices de tabela `PLANO_DE_SAUDE`
--
ALTER TABLE `PLANO_DE_SAUDE`
  ADD PRIMARY KEY (`pds_id`);

--
-- Índices de tabela `PRATICA_SEXO`
--
ALTER TABLE `PRATICA_SEXO`
  ADD PRIMARY KEY (`prs_id`);

--
-- Índices de tabela `PRESCRICAO`
--
ALTER TABLE `PRESCRICAO`
  ADD PRIMARY KEY (`pre_id`);

--
-- Índices de tabela `PROCEDIMENTOS`
--
ALTER TABLE `PROCEDIMENTOS`
  ADD PRIMARY KEY (`pcd_id`);

--
-- Índices de tabela `PRODUTO`
--
ALTER TABLE `PRODUTO`
  ADD PRIMARY KEY (`prt_id`);

--
-- Índices de tabela `PROVEDORIA`
--
ALTER TABLE `PROVEDORIA`
  ADD PRIMARY KEY (`pro_id`);

--
-- Índices de tabela `QUADRO_CLINICO`
--
ALTER TABLE `QUADRO_CLINICO`
  ADD PRIMARY KEY (`qcl_id`);

--
-- Índices de tabela `QUIMICO`
--
ALTER TABLE `QUIMICO`
  ADD PRIMARY KEY (`qui_id`),
  ADD KEY `fk_QUIMICO_DROGAS1_idx` (`qui_outra`);

--
-- Índices de tabela `SALA_OPERACAO`
--
ALTER TABLE `SALA_OPERACAO`
  ADD PRIMARY KEY (`sao_id`);

--
-- Índices de tabela `SETOR`
--
ALTER TABLE `SETOR`
  ADD PRIMARY KEY (`set_id`);

--
-- Índices de tabela `SETOR_OPERACIONAL`
--
ALTER TABLE `SETOR_OPERACIONAL`
  ADD PRIMARY KEY (`seo_id`);

--
-- Índices de tabela `SEXUALIDADE`
--
ALTER TABLE `SEXUALIDADE`
  ADD PRIMARY KEY (`sex_id`),
  ADD KEY `fk_SEXUALIDADE_PRATICA_SEXO1_idx` (`sex_pratica_sexo`);

--
-- Índices de tabela `SINTOMOLOGIA`
--
ALTER TABLE `SINTOMOLOGIA`
  ADD PRIMARY KEY (`sin_id`);

--
-- Índices de tabela `SOCIO_ECONOMICO`
--
ALTER TABLE `SOCIO_ECONOMICO`
  ADD PRIMARY KEY (`soe_id`);

--
-- Índices de tabela `SONO`
--
ALTER TABLE `SONO`
  ADD PRIMARY KEY (`son_id`);

--
-- Índices de tabela `TESTE_IMAGEM`
--
ALTER TABLE `TESTE_IMAGEM`
  ADD PRIMARY KEY (`tei_id`);

--
-- Índices de tabela `TESTE_LABORATORIO`
--
ALTER TABLE `TESTE_LABORATORIO`
  ADD PRIMARY KEY (`tel_id`);

--
-- Índices de tabela `TRIAGEM`
--
ALTER TABLE `TRIAGEM`
  ADD PRIMARY KEY (`tri_id`),
  ADD KEY `fk_TRIAGEM_PACIENTE1_idx` (`PACIENTE_pac_id`),
  ADD KEY `fk_TRIAGEM_QUADRO_CLINICO1_idx` (`QUADRO_CLINICO_qcl_id`);

--
-- Índices de tabela `TRIAGEM_has_SINTOMOLOGIA`
--
ALTER TABLE `TRIAGEM_has_SINTOMOLOGIA`
  ADD PRIMARY KEY (`TRIAGEM_tri_id`,`SINTOMOLOGIA_stm_id`),
  ADD KEY `fk_TRIAGEM_has_SINTOMOLOGIA_SINTOMOLOGIA1_idx` (`SINTOMOLOGIA_stm_id`),
  ADD KEY `fk_TRIAGEM_has_SINTOMOLOGIA_TRIAGEM1_idx` (`TRIAGEM_tri_id`);

--
-- Índices de tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `ACOMPANHAMENTO`
--
ALTER TABLE `ACOMPANHAMENTO`
  MODIFY `aco_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ADMINISTRACAO`
--
ALTER TABLE `ADMINISTRACAO`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ALA`
--
ALTER TABLE `ALA`
  MODIFY `ala_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ALCOOL`
--
ALTER TABLE `ALCOOL`
  MODIFY `alc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ASSOCIADOS`
--
ALTER TABLE `ASSOCIADOS`
  MODIFY `ass_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `CAMA`
--
ALTER TABLE `CAMA`
  MODIFY `cam_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `CIRURGIA`
--
ALTER TABLE `CIRURGIA`
  MODIFY `cir_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `CONDICAO`
--
ALTER TABLE `CONDICAO`
  MODIFY `cnd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `CONSELHO_DELIBERATIVO`
--
ALTER TABLE `CONSELHO_DELIBERATIVO`
  MODIFY `cde_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `CONSELHO_GERAL`
--
ALTER TABLE `CONSELHO_GERAL`
  MODIFY `cog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `CONSULTA`
--
ALTER TABLE `CONSULTA`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `DIETA`
--
ALTER TABLE `DIETA`
  MODIFY `die_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `DROGAS`
--
ALTER TABLE `DROGAS`
  MODIFY `dro_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ENDERECO`
--
ALTER TABLE `ENDERECO`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ENFERMEIRO`
--
ALTER TABLE `ENFERMEIRO`
  MODIFY `enf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ESPECIALIZACAO`
--
ALTER TABLE `ESPECIALIZACAO`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ESTILO_DE_VIDA`
--
ALTER TABLE `ESTILO_DE_VIDA`
  MODIFY `edv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `EXAME_ANALISE`
--
ALTER TABLE `EXAME_ANALISE`
  MODIFY `exa_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `EXAME_SOLICITACAO`
--
ALTER TABLE `EXAME_SOLICITACAO`
  MODIFY `exs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `EXERCICIO`
--
ALTER TABLE `EXERCICIO`
  MODIFY `exe_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `FAMILIA`
--
ALTER TABLE `FAMILIA`
  MODIFY `fam_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `FUMANTE`
--
ALTER TABLE `FUMANTE`
  MODIFY `fum_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `FUNCIONARIO`
--
ALTER TABLE `FUNCIONARIO`
  MODIFY `fun_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `GENETICA`
--
ALTER TABLE `GENETICA`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `GRUPO`
--
ALTER TABLE `GRUPO`
  MODIFY `grp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `HISTORICO_MENSTRUAL`
--
ALTER TABLE `HISTORICO_MENSTRUAL`
  MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `INSTITUICAO`
--
ALTER TABLE `INSTITUICAO`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `LOGIN_ACESSO`
--
ALTER TABLE `LOGIN_ACESSO`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `MEDICACAO`
--
ALTER TABLE `MEDICACAO`
  MODIFY `mco_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `MEDICAMENTO`
--
ALTER TABLE `MEDICAMENTO`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `MEDICO`
--
ALTER TABLE `MEDICO`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `MESA_ADMINISTRATIVA`
--
ALTER TABLE `MESA_ADMINISTRATIVA`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `MODULOS`
--
ALTER TABLE `MODULOS`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `OBITO`
--
ALTER TABLE `OBITO`
  MODIFY `obi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `OBSTETRIA_GINECOLOGISTA`
--
ALTER TABLE `OBSTETRIA_GINECOLOGISTA`
  MODIFY `ob_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PACIENTE`
--
ALTER TABLE `PACIENTE`
  MODIFY `pac_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PATOLOGIA`
--
ALTER TABLE `PATOLOGIA`
  MODIFY `ptl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PERMISSOES`
--
ALTER TABLE `PERMISSOES`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PESSOA`
--
ALTER TABLE `PESSOA`
  MODIFY `pes_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PLANO_DE_SAUDE`
--
ALTER TABLE `PLANO_DE_SAUDE`
  MODIFY `pds_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PRATICA_SEXO`
--
ALTER TABLE `PRATICA_SEXO`
  MODIFY `prs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PRESCRICAO`
--
ALTER TABLE `PRESCRICAO`
  MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PROCEDIMENTOS`
--
ALTER TABLE `PROCEDIMENTOS`
  MODIFY `pcd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PRODUTO`
--
ALTER TABLE `PRODUTO`
  MODIFY `prt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `PROVEDORIA`
--
ALTER TABLE `PROVEDORIA`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `QUADRO_CLINICO`
--
ALTER TABLE `QUADRO_CLINICO`
  MODIFY `qcl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `QUIMICO`
--
ALTER TABLE `QUIMICO`
  MODIFY `qui_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SALA_OPERACAO`
--
ALTER TABLE `SALA_OPERACAO`
  MODIFY `sao_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SETOR`
--
ALTER TABLE `SETOR`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SETOR_OPERACIONAL`
--
ALTER TABLE `SETOR_OPERACIONAL`
  MODIFY `seo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SEXUALIDADE`
--
ALTER TABLE `SEXUALIDADE`
  MODIFY `sex_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SINTOMOLOGIA`
--
ALTER TABLE `SINTOMOLOGIA`
  MODIFY `sin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SOCIO_ECONOMICO`
--
ALTER TABLE `SOCIO_ECONOMICO`
  MODIFY `soe_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `SONO`
--
ALTER TABLE `SONO`
  MODIFY `son_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `TESTE_IMAGEM`
--
ALTER TABLE `TESTE_IMAGEM`
  MODIFY `tei_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `TESTE_LABORATORIO`
--
ALTER TABLE `TESTE_LABORATORIO`
  MODIFY `tel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `TRIAGEM`
--
ALTER TABLE `TRIAGEM`
  MODIFY `tri_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `TRIAGEM_has_SINTOMOLOGIA`
--
ALTER TABLE `TRIAGEM_has_SINTOMOLOGIA`
  MODIFY `TRIAGEM_tri_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `ALA`
--
ALTER TABLE `ALA`
  ADD CONSTRAINT `fk_ALA_CAMA1` FOREIGN KEY (`CAMA_cam_id`) REFERENCES `CAMA` (`cam_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `ENFERMEIRO`
--
ALTER TABLE `ENFERMEIRO`
  ADD CONSTRAINT `fk_ENFERMEIRO_FUNCIONARIO1` FOREIGN KEY (`FUNCIONARIO_fun_id`) REFERENCES `FUNCIONARIO` (`fun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `ESTILO_DE_VIDA`
--
ALTER TABLE `ESTILO_DE_VIDA`
  ADD CONSTRAINT `fk_ESTILO_VIDA_ALCOOL1` FOREIGN KEY (`edv_vicios`) REFERENCES `ALCOOL` (`alc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILO_VIDA_DIETA1` FOREIGN KEY (`DIETA_die_id`) REFERENCES `DIETA` (`die_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILO_VIDA_EXERCICIO1` FOREIGN KEY (`edv_exercicio`) REFERENCES `EXERCICIO` (`exe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILO_VIDA_FUMANTE1` FOREIGN KEY (`edv_vicios`) REFERENCES `FUMANTE` (`fum_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILO_VIDA_QUIMICO1` FOREIGN KEY (`edv_vicios`) REFERENCES `QUIMICO` (`qui_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILO_VIDA_SEXUALIDADE1` FOREIGN KEY (`SEXUALIDADE_sex_id`) REFERENCES `SEXUALIDADE` (`sex_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILO_VIDA_SONO1` FOREIGN KEY (`edv_sono`) REFERENCES `SONO` (`son_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `FAMILIA`
--
ALTER TABLE `FAMILIA`
  ADD CONSTRAINT `fk_FAMILIA_PACIENTE1` FOREIGN KEY (`PACIENTE_pac_id`) REFERENCES `PACIENTE` (`pac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `FUNCIONARIO`
--
ALTER TABLE `FUNCIONARIO`
  ADD CONSTRAINT `fk_FUNCIONARIOS_PERMISSOES1` FOREIGN KEY (`PERMISSOES_per_id`) REFERENCES `PERMISSOES` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FUNCIONARIOS_SETOR1` FOREIGN KEY (`SETOR_set_id`) REFERENCES `SETOR` (`set_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FUNCIONARIOS_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `USUARIO` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FUNCIONARIO_PESSOA1` FOREIGN KEY (`PESSOA_pes_id`) REFERENCES `PESSOA` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `HISTORICO_MENSTRUAL`
--
ALTER TABLE `HISTORICO_MENSTRUAL`
  ADD CONSTRAINT `fk_HISTORICO_MENSTRUAL_MEDICO1` FOREIGN KEY (`MEDICO_med_id`) REFERENCES `MEDICO` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `INSTITUICAO`
--
ALTER TABLE `INSTITUICAO`
  ADD CONSTRAINT `fk_INSTITUICAO_ALA1` FOREIGN KEY (`ALA_ala_id`) REFERENCES `ALA` (`ala_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INSTITUICAO_SALA_OPERACAO1` FOREIGN KEY (`SALA_OPERACAO_sao_id`) REFERENCES `SALA_OPERACAO` (`sao_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INSTITUICAO_SETOR_OPERACIONAL1` FOREIGN KEY (`SETOR_OPERACIONAL_seo_id`) REFERENCES `SETOR_OPERACIONAL` (`seo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `LOGIN_ACESSO`
--
ALTER TABLE `LOGIN_ACESSO`
  ADD CONSTRAINT `fk_LOGIN_ACESSO_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `USUARIO` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `MEDICACAO`
--
ALTER TABLE `MEDICACAO`
  ADD CONSTRAINT `fk_MEDICACAO_PRESCRICAO1` FOREIGN KEY (`PRESCRICAO_pre_id`) REFERENCES `PRESCRICAO` (`pre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `MEDICAMENTO`
--
ALTER TABLE `MEDICAMENTO`
  ADD CONSTRAINT `fk_MEDICAMENTO_PRODUTO1` FOREIGN KEY (`PRODUTO_prt_id`) REFERENCES `PRODUTO` (`prt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `MEDICO`
--
ALTER TABLE `MEDICO`
  ADD CONSTRAINT `fk_MEDICO_CONSULTA1` FOREIGN KEY (`CONSULTA_con_id`) REFERENCES `CONSULTA` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEDICO_ESPECIALIZACAO1` FOREIGN KEY (`ESPECIALIZACAO_esp_id`) REFERENCES `ESPECIALIZACAO` (`esp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MEDICO_FUNCIONARIO1` FOREIGN KEY (`FUNCIONARIO_fun_id`) REFERENCES `FUNCIONARIO` (`fun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `OBITO`
--
ALTER TABLE `OBITO`
  ADD CONSTRAINT `fk_OBITO_PACIENTE1` FOREIGN KEY (`PACIENTE_pac_id`) REFERENCES `PACIENTE` (`pac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `PACIENTE`
--
ALTER TABLE `PACIENTE`
  ADD CONSTRAINT `fk_PACIENTE_CONSULTA1` FOREIGN KEY (`CONSULTA_con_id`) REFERENCES `CONSULTA` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PACIENTE_ESTILO_DE_VIDA1` FOREIGN KEY (`ESTILO_DE_VIDA_edv_id`) REFERENCES `ESTILO_DE_VIDA` (`edv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PACIENTE_PATOLOGIA1` FOREIGN KEY (`PATOLOGIA_ptl_id`) REFERENCES `PATOLOGIA` (`ptl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PACIENTE_PESSOA1` FOREIGN KEY (`PESSOA_id_dados`) REFERENCES `PESSOA` (`pes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PACIENTE_PLANO_DE_SAUDE1` FOREIGN KEY (`PLANO_DE_SAUDE_pds_id`) REFERENCES `PLANO_DE_SAUDE` (`pds_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PACIENTE_PRESCRICAO1` FOREIGN KEY (`PRESCRICAO_pre_id`) REFERENCES `PRESCRICAO` (`pre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PACIENTE_SOCIO_ECONOMICO1` FOREIGN KEY (`SOCIO_ECONOMICO_soe_id`) REFERENCES `SOCIO_ECONOMICO` (`soe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `PATOLOGIA`
--
ALTER TABLE `PATOLOGIA`
  ADD CONSTRAINT `fk_PATOLOGIA_GENETICA1` FOREIGN KEY (`ptl_gene`) REFERENCES `GENETICA` (`gen_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PATOLOGIA_GRUPO1` FOREIGN KEY (`ptl_grupo`) REFERENCES `GRUPO` (`grp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `PERMISSOES`
--
ALTER TABLE `PERMISSOES`
  ADD CONSTRAINT `fk_PERMISSOES_MODULOS1` FOREIGN KEY (`per_modulo`) REFERENCES `MODULOS` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PERMISSOES_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `USUARIO` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `PESSOA`
--
ALTER TABLE `PESSOA`
  ADD CONSTRAINT `fk_PESSOA_ENDERECO1` FOREIGN KEY (`pes_endereco`) REFERENCES `ENDERECO` (`end_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `QUIMICO`
--
ALTER TABLE `QUIMICO`
  ADD CONSTRAINT `fk_QUIMICO_DROGAS1` FOREIGN KEY (`qui_outra`) REFERENCES `DROGAS` (`dro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `SEXUALIDADE`
--
ALTER TABLE `SEXUALIDADE`
  ADD CONSTRAINT `fk_SEXUALIDADE_PRATICA_SEXO1` FOREIGN KEY (`sex_pratica_sexo`) REFERENCES `PRATICA_SEXO` (`prs_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `TRIAGEM`
--
ALTER TABLE `TRIAGEM`
  ADD CONSTRAINT `fk_TRIAGEM_PACIENTE1` FOREIGN KEY (`PACIENTE_pac_id`) REFERENCES `PACIENTE` (`pac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TRIAGEM_QUADRO_CLINICO1` FOREIGN KEY (`QUADRO_CLINICO_qcl_id`) REFERENCES `QUADRO_CLINICO` (`qcl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `TRIAGEM_has_SINTOMOLOGIA`
--
ALTER TABLE `TRIAGEM_has_SINTOMOLOGIA`
  ADD CONSTRAINT `fk_TRIAGEM_has_SINTOMOLOGIA_SINTOMOLOGIA1` FOREIGN KEY (`SINTOMOLOGIA_stm_id`) REFERENCES `SINTOMOLOGIA` (`sin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TRIAGEM_has_SINTOMOLOGIA_TRIAGEM1` FOREIGN KEY (`TRIAGEM_tri_id`) REFERENCES `TRIAGEM` (`tri_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
