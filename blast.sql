-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 18/02/2020 às 19:50
-- Versão do servidor: 5.7.29-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blast`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `newprojects`
--

CREATE TABLE `newprojects` (
  `Id_Project` int(11) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `Blast` varchar(15) DEFAULT NULL,
  `InterPro` varchar(15) DEFAULT NULL,
  `UniProt` varchar(15) DEFAULT NULL,
  `Description` text,
  `data` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `Project` int(11) NOT NULL,
  `Project_Name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Blast` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `BlastStatus` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `SeqNames` text CHARACTER SET latin1,
  `Seq` text CHARACTER SET latin1,
  `Description` text,
  `Hits` text CHARACTER SET latin1,
  `xml_File` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Fasta_File` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `eValue` text CHARACTER SET latin1,
  `simmean` text CHARACTER SET latin1,
  `Accession` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `GO` text CHARACTER SET latin1,
  `GO_IDs` text CHARACTER SET latin1,
  `GO_Names` text CHARACTER SET latin1,
  `Enzymes_Code` text CHARACTER SET latin1,
  `Enzymes_Name` text CHARACTER SET latin1,
  `InterPro_IDs` text CHARACTER SET latin1,
  `InterPro_GO_IDs` text CHARACTER SET latin1,
  `InterPro_GO_Names` text CHARACTER SET latin1,
  `FastaNCBI` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `InterProXML` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `GO_Annotation` varchar(20) DEFAULT NULL,
  `organism` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `newprojects`
--
ALTER TABLE `newprojects`
  ADD PRIMARY KEY (`Id_Project`);

--
-- Índices de tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`Project`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `newprojects`
--
ALTER TABLE `newprojects`
  MODIFY `Id_Project` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `Project` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
