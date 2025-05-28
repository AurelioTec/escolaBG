-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Maio-2025 às 04:48
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admidn@gmail.com|127.0.0.1', 'i:1;', 1733449368),
('admidn@gmail.com|127.0.0.1:timer', 'i:1733449368;', 1733449368),
('admin@admin|127.0.0.1', 'i:1;', 1744650026),
('admin@admin|127.0.0.1:timer', 'i:1744650026;', 1744650026),
('adrianomarco@gmail.com|127.0.0.1', 'i:1;', 1731263079),
('adrianomarco@gmail.com|127.0.0.1:timer', 'i:1731263079;', 1731263079),
('afonso.aurelio|127.0.0.1', 'i:1;', 1733497513),
('afonso.aurelio|127.0.0.1:timer', 'i:1733497513;', 1733497513),
('aureliofabio16@gmail.com|127.0.0.1', 'i:1;', 1747115570),
('aureliofabio16@gmail.com|127.0.0.1:timer', 'i:1747115570;', 1747115570),
('belarmino@gmail.com|127.0.0.1', 'i:1;', 1744195441),
('belarmino@gmail.com|127.0.0.1:timer', 'i:1744195441;', 1744195441),
('dbwuhcbw@ladjkw.com|127.0.0.1', 'i:1;', 1745331799),
('dbwuhcbw@ladjkw.com|127.0.0.1:timer', 'i:1745331799;', 1745331799),
('escola_cache_admin@gmaaiil.com|127.0.0.1', 'i:1;', 1744221472),
('escola_cache_admin@gmaaiil.com|127.0.0.1:timer', 'i:1744221472;', 1744221472),
('escola_cache_aureliofabio16@gmail.com|127.0.0.1', 'i:1;', 1744823297),
('escola_cache_aureliofabio16@gmail.com|127.0.0.1:timer', 'i:1744823297;', 1744823297),
('josebalarmino@gmail.com|127.0.0.1', 'i:1;', 1748384500),
('josebalarmino@gmail.com|127.0.0.1:timer', 'i:1748384500;', 1748384500),
('josebelarmino@gmail.com|127.0.0.1', 'i:1;', 1748384521),
('josebelarmino@gmail.com|127.0.0.1:timer', 'i:1748384521;', 1748384521),
('paulomafuni@gmail.com|127.0.0.1', 'i:1;', 1748353492),
('paulomafuni@gmail.com|127.0.0.1:timer', 'i:1748353492;', 1748353492);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configini`
--

CREATE TABLE `configini` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `escola` varchar(120) NOT NULL,
  `tipo` enum('Colegio','Complexo','Escola primaria') NOT NULL,
  `director` varchar(80) NOT NULL,
  `pedagogico` varchar(80) NOT NULL,
  `administrativo` varchar(80) NOT NULL,
  `salas` int(11) NOT NULL,
  `anoletivo` int(11) NOT NULL,
  `estado` enum('Aberto','Encerrado') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `configini`
--

INSERT INTO `configini` (`id`, `escola`, `tipo`, `director`, `pedagogico`, `administrativo`, `salas`, `anoletivo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Complexo Escolar BG 1237', 'Complexo', 'Paulo Mafuani', 'Belarino Tchimwambo', 'Alice Miguel', 15, 2024, 'Encerrado', '2024-10-25 14:21:31', '2025-05-12 13:29:39'),
(3, 'Complexo Escolar Bg 1237', 'Complexo', 'Paulo Miranda', 'José Belarmino', 'Alice MIguel', 15, 2025, 'Aberto', '2025-05-12 13:31:15', '2025-05-12 13:31:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nagente` varchar(8) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `datanascimento` date NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `telf` varchar(15) NOT NULL,
  `habilitacao` enum('Médio','Superior','Mestre','Doutor') NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `funcao` varchar(45) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nagente`, `nome`, `datanascimento`, `genero`, `telf`, `habilitacao`, `categoria`, `funcao`, `users_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, '24155171', 'Fabiano Wanda', '1994-05-12', 'M', '932 253 235', 'Médio', 'Ecriturário Dactilografo', 'Tecnico do SIGFE', 2, 'e706acfa9a148f3a49cf545a71f8a461png', '2024-10-25 14:19:18', '2024-10-25 14:19:18'),
(2, '12631890', 'José Belarmino', '1987-02-12', 'M', '932 253 234', 'Superior', 'Professor do 6º Grau', 'Subdirector Pedagógico', 3, '368783297054004a0eca63a3deee802b.png', '2024-10-25 14:20:13', '2025-01-06 19:37:34'),
(3, '00000000', 'Fabio Aurelio', '0000-00-00', 'M', '000 000 000', 'Doutor', 'Supervisor Geral', 'Admin super Geral', 1, '315d5d81ad6d0d9321cfc1fa432d7ba1.png', NULL, '2025-01-06 20:00:59'),
(5, '05598432', 'Paulo Miranda Mafuani', '1975-03-19', 'M', '935428932', 'Mestre', 'Professor do 4º Grau', 'Director', 4, '80d3556618f6a4c199204c497e652a03png', '2025-01-23 15:10:38', '2025-01-23 15:10:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricaos`
--

CREATE TABLE `inscricaos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomealuno` varchar(120) NOT NULL,
  `municipio_id` bigint(20) UNSIGNED NOT NULL,
  `datanascimento` date NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `doctipo` enum('BI','Cedula','Assento','Passaporte') NOT NULL,
  `docnumero` varchar(14) NOT NULL,
  `dataemissao` date NOT NULL,
  `nomepai` varchar(120) DEFAULT NULL,
  `nomemae` varchar(120) DEFAULT NULL,
  `morada` varchar(40) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `rua` varchar(120) DEFAULT NULL,
  `telf` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `obs` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` enum('Pendente','Confirmar','Matriculado') NOT NULL DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `inscricaos`
--

INSERT INTO `inscricaos` (`id`, `nomealuno`, `municipio_id`, `datanascimento`, `genero`, `doctipo`, `docnumero`, `dataemissao`, `nomepai`, `nomemae`, `morada`, `bairro`, `rua`, `telf`, `foto`, `obs`, `created_at`, `updated_at`, `estado`) VALUES
(1, 'Feliciano António José', 9, '1994-08-12', 'M', 'Cedula', '2345', '2000-11-12', 'Nazario José', 'Analdina António', '9', 'Calomburaco', 'S/N', '923 239 232', 'e8e0f421d0433e65232bac77429793b6png', NULL, '2024-11-10 18:49:37', '2024-11-10 18:49:37', 'Matriculado'),
(2, 'Dorivaldo Marcos Silva', 9, '2003-12-13', 'M', 'Cedula', '1223', '2004-05-14', 'Agnaldo Silva', 'Conceição Marcos Silva', '9', 'Graça', 'S/N', '935472829', 'c238d2e1304c83e75c049d3eec6e03d1png', NULL, '2024-12-18 11:01:49', '2024-12-18 11:24:30', 'Matriculado'),
(3, 'Francisca Ermelinda Vateca', 9, '2003-12-19', 'F', 'Cedula', '1231', '2004-05-12', 'Sebastião Vateca', 'Bernarda Ermelinda', '9', 'Cotel', 'S/N', '935472829', '8994be2cd6d37e3a2b71294929f5cf99png', NULL, '2024-12-19 04:44:53', '2024-12-27 08:16:04', 'Matriculado'),
(4, 'Feliciana Margarida Vasconcelos', 16, '2005-04-13', 'F', 'Cedula', '1233', '2066-08-13', 'Antunes Vasconcelos', 'Catarina Margarida Vasconcelos', '9', 'Massangarala', 'S/N', '934564738', '8fc4c0259f70acdcc833f1f70981ac8bpng', NULL, '2024-12-30 12:57:58', '2024-12-30 12:58:46', 'Matriculado'),
(5, 'Bibiana Tchateca Ambrosio', 7, '2009-09-12', 'F', 'Cedula', '1232', '2010-09-10', 'Andre Ambrosio', 'Margarida Tchateca', '9', 'Calomburcaco', 'S/N', '934527282', '81b52e02c7778a364e3d57e837c54ff5png', NULL, '2024-12-30 13:32:30', '2024-12-30 13:33:12', 'Matriculado'),
(6, 'Carolina Margarida Jamba', 9, '2008-05-13', 'F', 'Cedula', '1234', '2009-09-18', 'Jose Jamba', 'Teresa Margarida', '9', 'Santa Teresa', 'S/N', '937634745', 'cd53dc59313422086141514a515a6058png', NULL, '2025-01-03 23:16:42', '2025-01-06 13:22:39', 'Matriculado'),
(7, 'Adelino Bumba Mulamba', 8, '2006-05-14', 'M', 'Cedula', '1234', '2007-06-14', 'Avelino Mulumba', 'Margarida Sofia', '9', 'Santa Teresa', 'S/N', '932 253 234', 'c92af04c4c366437128563fd02e736ffpng', NULL, '2025-01-06 16:24:20', '2025-01-06 16:25:01', 'Matriculado'),
(8, 'Jesualdo Andriano Marcos', 16, '2009-08-13', 'M', 'Cedula', '3232', '2010-09-12', 'Viriato Marcos', 'Fernanda Marcos', '9', 'Calomburcaco', 'S/N', '945372634', 'f22890981f2b160f6d57a7cffee8983bpng', NULL, '2025-01-09 17:57:06', '2025-01-17 20:17:23', 'Matriculado'),
(10, 'Marcelino Vieira André', 9, '2007-02-09', 'M', 'Cedula', '1232', '2008-03-14', 'Benedito André', 'Marcia Vieira', '9', 'Cotel', 'S/N', '902323313', '12b6c8b3f3fcebc47cc16a5168a72863png', NULL, '2025-01-27 23:47:30', '2025-04-25 11:17:16', 'Matriculado'),
(11, 'Feliciano Adriano José', 9, '2004-08-19', 'M', 'Cedula', '4354', '2009-04-19', 'Moises José', 'Rebeca Adriano', '9', 'Graça', 'S/N', '945321328', 'de00bfc89e1f379a81cbc0e43e3572bejpg', NULL, '2025-05-12 20:41:10', '2025-05-12 20:42:41', 'Matriculado'),
(12, 'Patricia Malaquias Branco', 9, '2005-02-10', 'F', 'Cedula', '4646', '2006-02-10', 'Margarida Malaquias', 'Francisco Branco', '9', 'Graça', 'S/N', '945321328', '2b94a00f7a73ed00221ec5fa0b201447png', NULL, '2025-05-12 21:20:29', '2025-05-27 22:11:42', 'Matriculado'),
(13, 'Margarida Fernando', 9, '2006-08-19', 'F', 'Cedula', '43467', '2007-09-19', 'Adriano Fernando', 'Bibiana Francisca', '9', 'Cambanda', 'S/N', '935283345', '001d634a6d3872f5670361629cc1fd0epng', NULL, '2025-05-21 16:00:46', '2025-05-27 16:33:47', 'Matriculado'),
(14, 'Feliciano Jorge', 7, '2004-06-19', 'M', 'Cedula', '2356', '2005-05-19', 'Adriano Vasco', 'Bernadete Sales', '9', 'Calomburaco', 'S/N', '934532843', '6fc205b081212ab8c1595c53df4d4b3bjpg', NULL, '2025-05-27 14:54:39', '2025-05-27 16:11:08', 'Matriculado'),
(15, 'Frederico Antero', 9, '2015-02-19', 'M', 'Cedula', '232844', '2015-08-19', 'Moises Antero', 'Vanessa Cecília', '9', 'Seta Antiga', 'S/N', '934526859', 'fe2df75a7e6b7185f548e2340c4db6c8png', NULL, '2025-05-27 22:24:26', '2025-05-27 22:25:11', 'Matriculado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numatricula` varchar(8) NOT NULL,
  `inscricaos_id` bigint(20) UNSIGNED NOT NULL,
  `turmas_id` bigint(20) UNSIGNED NOT NULL,
  `lestrangeira` varchar(50) DEFAULT NULL,
  `datamatricula` date NOT NULL,
  `encarregado` varchar(120) DEFAULT NULL,
  `telfencarregado` varchar(15) DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `tipomatricula` enum('Novo','Repetente') NOT NULL DEFAULT 'Novo',
  `estado` enum('Pendente','Suspensa','Cancelada','Inativa','Transferido','Aprovada') NOT NULL DEFAULT 'Pendente' COMMENT 'Pendente: Quando a matrícula está em processo e falta alguma informação ou ação para completar a matrícula.\r\nCancelada: Quando a matrícula foi cancelada, seja por solicitação do aluno, por erro ou por qualquer outro motivo.\r\n\r\nAprovada: Quando o aluno conclui a matrícula e está oficialmente registrado no curso ou na instituição.\r\n\r\nInativa: Quando a matrícula foi realizada, mas o aluno não está mais ativo, ou seja, ele desistiu ou foi desmatriculado.\r\n\r\nSuspensa: Quando a matrícula está temporariamente suspensa, como em casos de indiciplina, falta de documentos ou outras pendências administrativas.\r\n\r\nTransferida: Quando o aluno foi transferido de um curso ou turma para outro.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `resultado` enum('Apto','Não apto') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `numatricula`, `inscricaos_id`, `turmas_id`, `lestrangeira`, `datamatricula`, `encarregado`, `telfencarregado`, `anexo`, `users_id`, `tipomatricula`, `estado`, `created_at`, `updated_at`, `resultado`) VALUES
(1, '2024F001', 1, 10, 'Inglês', '2024-12-06', 'Eduardo José', '943 434 321', '697af5150626d0c720c40a6f9e066e7apdf', 1, 'Novo', 'Suspensa', '2024-12-06 15:55:35', '2025-05-09 19:42:05', 'Apto'),
(2, '2024D002', 2, 10, 'Inglês', '2024-12-18', 'Agnaldo Silva', '923456372', '67c5408841002652ee2405c3b38eeefcpdf', 1, 'Novo', 'Aprovada', '2024-12-18 11:24:31', '2025-05-09 19:40:23', 'Apto'),
(5, '2024F002', 3, 10, 'Inglês', '2024-12-27', 'Eduardo José', '923456372', '2c2d32d37ecf78424fc18490052b11e1pdf', 1, 'Novo', 'Aprovada', '2024-12-27 08:50:00', '2025-05-09 19:41:23', 'Apto'),
(6, '2024F003', 3, 10, 'Inglês', '2024-12-27', 'Eduardo José', '923456372', '476fc882580397340189129df23879d1pdf', 1, 'Novo', 'Aprovada', '2024-12-27 08:53:06', '2025-05-09 19:41:10', 'Apto'),
(7, '2024F004', 3, 10, 'Inglês', '2024-12-27', 'Eduardo José', '923456372', '8fc90cc206b1976080b04ead9253941apdf', 1, 'Novo', 'Aprovada', '2024-12-27 08:58:12', '2025-05-09 19:41:02', 'Apto'),
(8, '2024F005', 3, 10, 'Inglês', '2024-12-27', 'Eduardo José', '923456372', 'bcab6ef2f6a6dc6dfc813e222df7b61apdf', 1, 'Novo', 'Aprovada', '2024-12-27 09:43:12', '2025-05-09 19:17:39', 'Não apto'),
(9, '2024F006', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', '54c3cd85953111bf2d75325d12fb4082pdf', 1, 'Novo', 'Aprovada', '2024-12-30 12:58:46', '2025-05-09 19:40:32', 'Apto'),
(10, '2024F007', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', 'adfe2e714222ab24e4ee0d86af2167b4pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:05:16', '2025-05-09 19:40:44', 'Apto'),
(11, '2024F008', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', '5678787bc6b4c3fb37431c08a0076a34pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:07:19', '2025-05-09 19:40:53', 'Apto'),
(12, '2024F009', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', '864e3122f9c93cffca64bceacbf726abpdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:12:24', '2025-05-09 19:41:38', 'Apto'),
(13, '2024F010', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', 'b9aa8f0a810a767c6c3a93743f3b06c7pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:12:50', '2025-05-09 19:41:44', 'Apto'),
(14, '2024F011', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', '7b0f05c6cbffaa65fd7b72d662969e39pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:13:14', '2025-05-09 19:41:52', 'Apto'),
(15, '2024F012', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', '1f0272df0298ef53bba184220a8e25a3pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:15:10', '2025-05-09 19:41:58', 'Apto'),
(16, '2024F013', 4, 10, 'Inglês', '2024-12-30', 'Antunes Vasconcelos', '923384756', 'c4523011ec22cbd188e6dce1da78abb8pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:22:01', '2025-05-09 19:41:31', 'Apto'),
(17, '2024B001', 5, 10, 'Inglês', '2024-12-30', 'Andre Ambrosio', '943098456', '25d96b319239bc92bc373e7b172d6615pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:33:12', '2025-05-09 19:37:41', 'Apto'),
(18, '2024B002', 5, 10, 'Inglês', '2024-12-30', 'Andre Ambrosio', '943098456', '421fe7a78efd0748243c2fd1f6c53cc4pdf', 1, 'Novo', 'Aprovada', '2024-12-30 13:33:47', '2025-05-09 19:39:55', 'Apto'),
(19, '2025C001', 6, 10, 'Inglês', '2025-01-06', 'Jose Jamba', '943098456', '4fe8503097235ede468e71ad05e7278a.pdf', 1, 'Novo', 'Aprovada', '2025-01-06 13:22:40', '2025-05-09 19:40:14', 'Não apto'),
(20, '2025A001', 7, 10, 'Inglês', '2025-01-06', 'Avelino Mulumba', '943 434 321', '6a68bda1ea69497ce27ccc6bd907046d.pdf', 1, 'Novo', 'Aprovada', '2025-01-06 16:25:01', '2025-04-09 10:47:36', 'Apto'),
(21, '2025J001', 8, 10, 'Inglês', '2025-01-17', 'Adriano Marcos', '943 434 321', 'Jesualdo Andriano Marcos.pdf', 1, 'Novo', 'Aprovada', '2025-01-17 20:17:24', '2025-05-09 19:21:26', 'Apto'),
(22, '2025F001', 11, 41, 'Inglês', '2025-05-12', 'Moises José', '93456787', 'Feliciano Adriano José.pdf', 4, 'Novo', 'Aprovada', '2025-05-12 20:48:27', '2025-05-12 21:21:00', NULL),
(23, '2025F002', 14, 41, 'Inglês', '2025-05-27', 'Adriano Vasco', '935281923', 'Feliciano Jorge.pdf', 4, 'Novo', 'Aprovada', '2025-05-27 16:11:08', '2025-05-27 16:11:39', NULL),
(24, '2025M001', 13, 41, 'Inglês', '2025-05-27', 'Adriano Vasco', '935281923', 'Margarida Fernando.pdf', 4, 'Novo', 'Pendente', '2025-05-27 16:33:47', '2025-05-27 16:33:47', NULL),
(25, '2025P001', 12, 41, 'Inglês', '2025-05-27', 'Domingos Vasco', '930203049', 'docs/upload/aluno/P2025P001//Patricia Malaquias Branco.pdf', 4, 'Novo', 'Pendente', '2025-05-27 22:11:42', '2025-05-27 22:11:42', NULL),
(26, '2025F003', 15, 41, 'Inglês', '2025-05-27', 'Moises Antero', '930203049', 'docs/upload/aluno/F2025F003/Frederico Antero.pdf', 3, 'Novo', 'Pendente', '2025-05-27 22:25:11', '2025-05-27 22:25:11', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_11_173249_configini', 1),
(5, '2024_10_17_225156_funcionarios', 1),
(6, '2024_10_25_102448_create_provincias_table', 1),
(7, '2024_10_25_102550_create_municipios_table', 1),
(8, '2024_10_25_102658_create_inscricaos_table', 1),
(9, '2024_11_14_210239_create_turmas_table', 2),
(10, '2024_11_26_203034_create_matriculas_table', 3),
(11, '2024_12_06_171005_add_estado_to_inscricaos', 4),
(12, '2025_01_09_092015_add_fields_to_2024_11_26_203034_create_matriculas_table', 5),
(13, '2025_05_12_224126_add_limite_to_turmas', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipios`
--

CREATE TABLE `municipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `muninome` varchar(120) NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `municipios`
--

INSERT INTO `municipios` (`id`, `muninome`, `provincia_id`, `created_at`, `updated_at`) VALUES
(1, 'Ambriz', 1, NULL, NULL),
(2, 'Bula Atumba', 1, NULL, NULL),
(3, 'Dande', 1, NULL, NULL),
(4, 'Dembos', 1, NULL, NULL),
(5, 'Nambuangongo', 1, NULL, NULL),
(6, 'Pango Aluquém', 1, NULL, NULL),
(7, 'Baia Farta', 2, NULL, NULL),
(8, 'Balombo', 2, NULL, NULL),
(9, 'Benguela', 2, NULL, NULL),
(10, 'Bocoio', 2, NULL, NULL),
(11, 'Caimbambo', 2, NULL, NULL),
(12, 'Catumbela', 2, NULL, NULL),
(13, 'Chongorói', 2, NULL, NULL),
(14, 'Cubal', 2, NULL, NULL),
(15, 'Ganda', 2, NULL, NULL),
(16, 'Lobito', 2, NULL, NULL),
(17, 'Andulo', 3, NULL, NULL),
(18, 'Camacupa', 3, NULL, NULL),
(19, 'Catabola', 3, NULL, NULL),
(20, 'Chinguar', 3, NULL, NULL),
(21, 'Chitembo', 3, NULL, NULL),
(22, 'Cuemba', 3, NULL, NULL),
(23, 'Cuito', 3, NULL, NULL),
(24, 'Cunhinga', 3, NULL, NULL),
(25, 'Nharêa', 3, NULL, NULL),
(26, 'Belize', 4, NULL, NULL),
(27, 'Buco Zau', 4, NULL, NULL),
(28, 'Cabinda', 4, NULL, NULL),
(29, 'Cacongo', 4, NULL, NULL),
(30, 'Calai', 5, NULL, NULL),
(31, 'Cuangar', 5, NULL, NULL),
(32, 'Cuchi', 5, NULL, NULL),
(33, 'Cuito Cuanavale', 5, NULL, NULL),
(34, 'Dirico', 5, NULL, NULL),
(35, 'Mavinga', 5, NULL, NULL),
(36, 'Menongue', 5, NULL, NULL),
(37, 'Nancova', 5, NULL, NULL),
(38, 'Rivungo', 5, NULL, NULL),
(39, 'Ambaca', 6, NULL, NULL),
(40, 'Golungo Alto', 6, NULL, NULL),
(41, 'Banga', 6, NULL, NULL),
(42, 'Bolongongo', 6, NULL, NULL),
(43, 'Cambambe', 6, NULL, NULL),
(44, 'Cazengo', 6, NULL, NULL),
(45, 'Lucala', 6, NULL, NULL),
(46, 'Ngonguembo', 6, NULL, NULL),
(47, 'Quiculungo', 6, NULL, NULL),
(48, 'Samba Cajú', 6, NULL, NULL),
(49, 'Conda', 7, NULL, NULL),
(50, 'Mussende', 7, NULL, NULL),
(51, 'Quilenda', 7, NULL, NULL),
(52, 'Amboim', 7, NULL, NULL),
(53, 'Cassongue', 7, NULL, NULL),
(54, 'Cela', 7, NULL, NULL),
(55, 'Ebo', 7, NULL, NULL),
(56, 'Libolo', 7, NULL, NULL),
(57, 'Porto Amboim', 7, NULL, NULL),
(58, 'Quibala', 7, NULL, NULL),
(59, 'Seles', 7, NULL, NULL),
(60, 'Sumbe', 7, NULL, NULL),
(61, 'Cahama', 8, NULL, NULL),
(62, 'Cuanhama', 8, NULL, NULL),
(63, 'Curoca', 8, NULL, NULL),
(64, 'Cuvelai', 8, NULL, NULL),
(65, 'Namacunde', 8, NULL, NULL),
(66, 'Ombadja', 8, NULL, NULL),
(67, 'Bailundo', 9, NULL, NULL),
(68, 'Caála', 9, NULL, NULL),
(69, 'Cachiungo', 9, NULL, NULL),
(70, 'Chicala-Choloanga', 9, NULL, NULL),
(71, 'Chinjenje', 9, NULL, NULL),
(72, 'Ecunha', 9, NULL, NULL),
(73, 'Huambo', 9, NULL, NULL),
(74, 'Londuimbali', 9, NULL, NULL),
(75, 'Longonjo', 9, NULL, NULL),
(76, 'Mungo', 9, NULL, NULL),
(77, 'Ucuma', 9, NULL, NULL),
(78, 'Caconda', 10, NULL, NULL),
(79, 'Cacula', 10, NULL, NULL),
(80, 'Caluquembe', 10, NULL, NULL),
(81, 'Chibia', 10, NULL, NULL),
(82, 'Chicomba', 10, NULL, NULL),
(83, 'Chipindo', 10, NULL, NULL),
(84, 'Cuvango', 10, NULL, NULL),
(85, 'Gambos', 10, NULL, NULL),
(86, 'Humpata', 10, NULL, NULL),
(87, 'Jamba', 10, NULL, NULL),
(88, 'Lubango', 10, NULL, NULL),
(89, 'Matala', 10, NULL, NULL),
(90, 'Quilengues', 10, NULL, NULL),
(91, 'Quipungo', 10, NULL, NULL),
(92, 'Belas', 11, NULL, NULL),
(93, 'Cacuaco', 11, NULL, NULL),
(94, 'Cazenga', 11, NULL, NULL),
(95, 'Icolo e Bengo', 11, NULL, NULL),
(96, 'Kilamba Kiaxi', 11, NULL, NULL),
(97, 'Luanda', 11, NULL, NULL),
(98, 'Quiçama', 11, NULL, NULL),
(99, 'Talatona', 11, NULL, NULL),
(100, 'Viana', 11, NULL, NULL),
(101, 'Capenda Camulemba', 12, NULL, NULL),
(102, 'Caungula', 12, NULL, NULL),
(103, 'Cuilo', 12, NULL, NULL),
(104, 'Lôvua', 12, NULL, NULL),
(105, 'Lubalo', 12, NULL, NULL),
(106, 'Xá-Muteba', 12, NULL, NULL),
(107, 'Chitato', 12, NULL, NULL),
(108, 'Cambulo', 12, NULL, NULL),
(109, 'Cuango', 12, NULL, NULL),
(110, 'Lucapa', 12, NULL, NULL),
(111, 'Caculo', 13, NULL, NULL),
(112, 'Dala', 13, NULL, NULL),
(113, 'Saurimo', 13, NULL, NULL),
(114, 'Muconda', 13, NULL, NULL),
(115, 'Cacuso', 14, NULL, NULL),
(116, 'Cahombo', 14, NULL, NULL),
(117, 'Calandula', 14, NULL, NULL),
(118, 'Cambundi Catembo', 14, NULL, NULL),
(119, 'Cangandala', 14, NULL, NULL),
(120, 'Kiwaba Nzoji', 14, NULL, NULL),
(121, 'Kunda dya Baze', 14, NULL, NULL),
(122, 'Luquembo', 14, NULL, NULL),
(123, 'Malanje', 14, NULL, NULL),
(124, 'Marimba', 14, NULL, NULL),
(125, 'Massango', 14, NULL, NULL),
(126, 'Mucari', 14, NULL, NULL),
(127, 'Quela', 14, NULL, NULL),
(128, 'Quirima', 14, NULL, NULL),
(129, 'Alto Zambeze', 15, NULL, NULL),
(130, 'Bundas', 15, NULL, NULL),
(131, 'Camanongue', 15, NULL, NULL),
(132, 'Cameia', 15, NULL, NULL),
(133, 'Leua', 15, NULL, NULL),
(134, 'Luacano', 15, NULL, NULL),
(135, 'Luau', 15, NULL, NULL),
(136, 'Luchazes', 15, NULL, NULL),
(137, 'Moxico', 15, NULL, NULL),
(138, 'Bibala', 16, NULL, NULL),
(139, 'Camucuio', 16, NULL, NULL),
(140, 'Moçâmedes', 16, NULL, NULL),
(141, 'Tômbwa', 16, NULL, NULL),
(142, 'Virei', 16, NULL, NULL),
(143, 'Alto Cauale', 17, NULL, NULL),
(144, 'Ambuila', 17, NULL, NULL),
(145, 'Bembe', 17, NULL, NULL),
(146, 'Buengas', 17, NULL, NULL),
(147, 'Bungo', 17, NULL, NULL),
(148, 'Damba', 17, NULL, NULL),
(149, 'Dange-Quitexe', 17, NULL, NULL),
(150, 'Maquela do Zombo', 17, NULL, NULL),
(151, 'Milunga', 17, NULL, NULL),
(152, 'Mucaba', 17, NULL, NULL),
(153, 'Negage', 17, NULL, NULL),
(154, 'Nzeto', 17, NULL, NULL),
(155, 'Pombo', 17, NULL, NULL),
(156, 'Puri', 17, NULL, NULL),
(157, 'Quimbele', 17, NULL, NULL),
(158, 'Songo', 17, NULL, NULL),
(159, 'Uíge', 17, NULL, NULL),
(160, 'Cuimba', 18, NULL, NULL),
(161, 'Mbanza Kongo', 18, NULL, NULL),
(162, 'Nóqui', 18, NULL, NULL),
(163, 'Soyo', 18, NULL, NULL),
(164, 'Tomboco', 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincias`
--

CREATE TABLE `provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pronome` varchar(120) NOT NULL,
  `abreviacao` varchar(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `provincias`
--

INSERT INTO `provincias` (`id`, `pronome`, `abreviacao`, `created_at`, `updated_at`) VALUES
(1, 'Bengo', 'BO', NULL, NULL),
(2, 'Benguela', 'BA', NULL, NULL),
(3, 'Bié', 'BE', NULL, NULL),
(4, 'Cabinda', 'CA', NULL, NULL),
(5, 'Cuando-Cubango', 'CC', NULL, NULL),
(6, 'Cunene', 'CE', NULL, NULL),
(7, 'Huambo', 'HO', NULL, NULL),
(8, 'Huíla', 'HA', NULL, NULL),
(9, 'Kwanza Sul', 'KS', NULL, NULL),
(10, 'Kwanza Norte', 'KN', NULL, NULL),
(11, 'Luanda', 'LA', NULL, NULL),
(12, 'Lunda Norte', 'LN', NULL, NULL),
(13, 'Lunda Sul', 'LS', NULL, NULL),
(14, 'Malanje', 'ME', NULL, NULL),
(15, 'Moxico', 'MO', NULL, NULL),
(16, 'Namibe', 'NE', NULL, NULL),
(17, 'Uíge', 'UE', NULL, NULL),
(18, 'Zaire', 'ZE', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('htNkYc4dfLgd3swsWKIXFUE4BQ69WgeyGWYiI0mZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0dnTWxoUTk0blB4THpKSmFNV0NzSGM4N1EyRWlEZkFRdzJpZjFEeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748388477),
('URR8AJfj9PStuzfFF5d06ITFGCfDc3QlVpMEP16k', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZU1Na3M1SGJ6NW5oU1l1WkRydkNZdDZhSEdrOVg2azdyQU15VmJ3VCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjk1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbWF0cmljdWxhL3R1cm1hbHVubz9jbGFzc2U9NyVDMiVBQSZpbXByaW1pcj1PSyZwZXJpb2RvPU1hbmglQzMlQTMmdHVybWE9QSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc0ODM4NDUwNDt9czo1OiJhbGVydCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1748397738),
('YR9HR9j8wfz8ZH0XEWyljyTQn9LleG8NZAViRzQZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQjljc2FtTng2QUJENndJTkFlVldQaWg5SGZzeVdCZzA2RkZyc0xHVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL21hdHJpY3VsYSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbWF0cmljdWxhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748388477);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classe` varchar(2) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `descricao` char(255) NOT NULL,
  `periodo` varchar(5) NOT NULL,
  `sala` int(11) NOT NULL,
  `anolectivo` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `limite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id`, `classe`, `codigo`, `descricao`, `periodo`, `sala`, `anolectivo`, `created_at`, `updated_at`, `limite`) VALUES
(1, '9ª', '9AM23', 'A', 'Manhã', 1, '2024', NULL, NULL, 0),
(2, '9ª', '9BM23', 'B', 'Manhã', 2, '2024', NULL, NULL, 0),
(3, '9ª', '9CM23', 'C', 'Manhã', 3, '2024', NULL, NULL, 0),
(4, '9ª', '9DM23', 'D', 'Manhã', 4, '2024', NULL, NULL, 0),
(5, '8ª', '8AM23', 'A', 'Manhã', 5, '2024', NULL, NULL, 0),
(6, '8ª', '8BM23', 'B', 'Manhã', 6, '2024', NULL, NULL, 0),
(7, '8ª', '8CM23', 'C', 'Manhã', 7, '2024', NULL, NULL, 0),
(8, '8ª', '8DM23', 'D', 'Manhã', 8, '2024', NULL, NULL, 0),
(9, '8ª', '8EM23', 'E', 'Manhã', 9, '2024', NULL, NULL, 0),
(10, '7ª', '7AM23', 'A', 'Manhã', 10, '2024', NULL, NULL, 0),
(11, '7ª', '7BM23', 'B', 'Manhã', 11, '2024', NULL, NULL, 0),
(12, '7ª', '7CM23', 'C', 'Manhã', 12, '2024', NULL, NULL, 0),
(13, '7ª', '7DM23', 'D', 'Manhã', 13, '2024', NULL, NULL, 0),
(14, '7ª', '7EM23', 'E', 'Manhã', 14, '2024', NULL, NULL, 0),
(15, '7ª', '7FM23', 'F', 'Manhã', 15, '2024', NULL, NULL, 0),
(16, '9ª', '9ET23', 'E', 'Tarde', 1, '2024', NULL, NULL, 0),
(17, '9ª', '9FT23', 'F', 'Tarde', 2, '2024', NULL, NULL, 0),
(18, '9ª', '9GT23', 'G', 'Tarde', 3, '2024', NULL, NULL, 0),
(19, '8ª', '8FT23', 'F', 'Tarde', 4, '2024', NULL, NULL, 0),
(20, '8ª', '8GT23', 'G', 'Tarde', 5, '2024', NULL, NULL, 0),
(21, '8ª', '8HT23', 'H', 'Tarde', 6, '2024', NULL, NULL, 0),
(22, '8ª', '8IT23', 'I', 'Tarde', 7, '2024', NULL, NULL, 0),
(23, '8ª', '8JT23', 'J', 'Tarde', 8, '2024', NULL, NULL, 0),
(24, '7ª', '7GT23', 'G', 'Tarde', 9, '2024', NULL, NULL, 0),
(25, '7ª', '7HT23', 'H', 'Tarde', 10, '2024', NULL, NULL, 0),
(26, '7ª', '7IT23', 'I', 'Tarde', 11, '2024', NULL, NULL, 0),
(27, '7ª', '7JT23', 'J', 'Tarde', 12, '2024', NULL, NULL, 0),
(28, '7ª', '7KT23', 'K', 'Tarde', 13, '2024', NULL, NULL, 0),
(29, '7ª', '7LT23', 'L', 'Tarde', 14, '2024', NULL, NULL, 0),
(30, '7ª', '7MT23', 'M', 'Tarde', 15, '2024', NULL, NULL, 0),
(31, '9ª', '9HN23', 'H', 'Noite', 1, '2024', NULL, NULL, 0),
(32, '9ª', '9IN23', 'I', 'Noite', 2, '2024', NULL, NULL, 0),
(33, '9ª', '9JN23', 'J', 'Noite', 3, '2024', NULL, NULL, 0),
(34, '8ª', '8KN23', 'K', 'Noite', 4, '2024', NULL, NULL, 0),
(35, '8ª', '8LN23', 'L', 'Noite', 5, '2024', NULL, NULL, 0),
(36, '8ª', '8MN23', 'M', 'Noite', 6, '2024', NULL, NULL, 0),
(37, '7ª', '7NN23', 'N', 'Noite', 7, '2024', NULL, NULL, 0),
(38, '7ª', '7ON23', 'O', 'Noite', 8, '2024', NULL, NULL, 0),
(39, '7ª', '7PN23', 'P', 'Noite', 9, '2024', NULL, NULL, 0),
(41, '7ª', '7AM25', 'A', 'Manhã', 10, '2025', '2025-05-12 21:13:09', '2025-05-12 21:52:52', 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` enum('Admin','Diretor','Pedagogico','Tecnico') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `tipo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fabio Aurelio', 'admin@gmail.com', 'Admin', '2024-10-25 14:04:34', '$2y$12$.UM7J./j1O0jOE/Z97G.qOMZczYAt4B/A1NyTpg4VWTOr7PTYkMtC', NULL, NULL, NULL),
(2, 'Fabiano Wanda', 'fabianowanda@gmail.com', 'Tecnico', NULL, '$2y$12$D6UOzDQkRrpSJh0Gv4GixeWkMJ1fuSRCCoDoD6FAP2m/NVAuX3LO2', NULL, '2024-10-25 14:19:17', '2024-10-25 14:19:17'),
(3, 'José Belarmino', 'josebelas@gmail.com', 'Pedagogico', NULL, '$2y$12$yvL3EsFnzZ2aNhc2se9.6OQIAoS/PUVJ7/6F6eTqcw6GX6ydDqJ1i', NULL, '2024-10-25 14:20:13', '2024-10-25 14:22:29'),
(4, 'Paulo Miranda Mafuani', 'paulomafuani@gmail.com', 'Diretor', NULL, '$2y$12$pfLt/xe5.OW4trxOXrB.3uIqTktqRVWtlw4KxT7QHBbfTsSr34rCS', NULL, '2025-01-23 15:10:37', '2025-01-23 15:11:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `configini`
--
ALTER TABLE `configini`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionarios_users_id_foreign` (`users_id`);

--
-- Índices para tabela `inscricaos`
--
ALTER TABLE `inscricaos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inscricaos_municipio_id_foreign` (`municipio_id`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matriculas_numatricula_unique` (`numatricula`),
  ADD KEY `matriculas_inscricaos_id_foreign` (`inscricaos_id`),
  ADD KEY `matriculas_turmas_id_foreign` (`turmas_id`),
  ADD KEY `matriculas_users_id_foreign` (`users_id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_provincia_id_foreign` (`provincia_id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `configini`
--
ALTER TABLE `configini`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `inscricaos`
--
ALTER TABLE `inscricaos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de tabela `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `inscricaos`
--
ALTER TABLE `inscricaos`
  ADD CONSTRAINT `inscricaos_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`);

--
-- Limitadores para a tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_inscricaos_id_foreign` FOREIGN KEY (`inscricaos_id`) REFERENCES `inscricaos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matriculas_turmas_id_foreign` FOREIGN KEY (`turmas_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matriculas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
