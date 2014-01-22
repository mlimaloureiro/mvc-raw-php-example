-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2013 at 08:10 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categoria`
--

CREATE TABLE `Categoria` (
  `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Categoria`
--

INSERT INTO `Categoria` VALUES(1, 'Geral');
INSERT INTO `Categoria` VALUES(2, 'Design');
INSERT INTO `Categoria` VALUES(3, 'InformÃ¡tica');
INSERT INTO `Categoria` VALUES(4, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `Categoria_Livro`
--

CREATE TABLE `Categoria_Livro` (
  `ID_Categoria` int(11) NOT NULL,
  `ID_Livro` int(11) NOT NULL,
  KEY `ID_Categoria` (`ID_Categoria`,`ID_Livro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Categoria_Livro`
--

INSERT INTO `Categoria_Livro` VALUES(1, 5);
INSERT INTO `Categoria_Livro` VALUES(1, 6);
INSERT INTO `Categoria_Livro` VALUES(1, 7);
INSERT INTO `Categoria_Livro` VALUES(1, 9);
INSERT INTO `Categoria_Livro` VALUES(2, 4);
INSERT INTO `Categoria_Livro` VALUES(3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Livro`
--

CREATE TABLE `Livro` (
  `ID_Livro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `autor` varchar(120) NOT NULL,
  `edicao` varchar(120) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`ID_Livro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Livro`
--

INSERT INTO `Livro` VALUES(4, 'Livro 1', 'Autor 1', 'Primeira', 2000);
INSERT INTO `Livro` VALUES(5, 'Livro 2', 'Aquele', 'Segunda', 1929);
INSERT INTO `Livro` VALUES(6, 'Senhor dos Aneis', 'O senhor', 'Primeira', 2000);
INSERT INTO `Livro` VALUES(7, 'Harry Potter', 'A senhora', '1', 2000);
INSERT INTO `Livro` VALUES(8, 'Base de Dados', 'Os dados', 'Segunda', 2000);
INSERT INTO `Livro` VALUES(9, 'A Biblia', 'Pois', 'Trigesima SÃ©tima', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Reserva`
--

CREATE TABLE `Reserva` (
  `ID_Livro` int(11) NOT NULL,
  `ID_Utilizador` int(11) NOT NULL,
  `datalevantamento` int(11) NOT NULL,
  `dataentrega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reserva`
--


-- --------------------------------------------------------

--
-- Table structure for table `Utilizador`
--

CREATE TABLE `Utilizador` (
  `ID_Utilizador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `login` varchar(50) NOT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`ID_Utilizador`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Utilizador`
--

INSERT INTO `Utilizador` VALUES(1, 'victoria', 'password', 'victoria', 0);
INSERT INTO `Utilizador` VALUES(2, 'angelo', 'password', 'angelo', 0);
INSERT INTO `Utilizador` VALUES(3, 'Pedro', 'cenas', 'pedro', 0);
INSERT INTO `Utilizador` VALUES(4, 'Maria', 'cenas', 'maria', 0);
INSERT INTO `Utilizador` VALUES(5, 'Pedro', 'teste', 'Dias', 0);
INSERT INTO `Utilizador` VALUES(7, 'angelo', 'teste', 'loureiro', 1);
INSERT INTO `Utilizador` VALUES(9, 'pedro', 'cenas', 'campos', 0);
