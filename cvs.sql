-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2020 at 05:31 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvs`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `dpi` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` int(8) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `fechaNac` date NOT NULL,
  PRIMARY KEY (`dpi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`dpi`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `fechaNac`) VALUES
(1, 'Ricardo', 'Perez', 52819696, 'guate', 'elum', '2020-10-22'),
(2, 'Ricardo', 'Perez', 52819696, 'guate', 'elum', '2020-10-22'),
(3, 'Ricardo', 'Perez', 52819696, 'guate', 'elum', '2020-10-22'),
(4, 'Ricardo', 'Perez', 52819696, 'guate', 'elum', '2020-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `detalle`
--

DROP TABLE IF EXISTS `detalle`;
CREATE TABLE IF NOT EXISTS `detalle` (
  `cod_receta` int(10) NOT NULL,
  `cod_med` int(10) NOT NULL,
  `dosis` varchar(20) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `total` float NOT NULL,
  KEY `cod_receta` (`cod_receta`,`cod_med`),
  KEY `cod_med` (`cod_med`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle`
--

INSERT INTO `detalle` (`cod_receta`, `cod_med`, `dosis`, `cantidad`, `total`) VALUES
(1, 1, '2 al dia', 30, 900),
(1, 2, '2 al dia', 30, 86),
(2, 2, '2 al dia', 60, 986);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `dpi` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` int(8) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `contra` varchar(15) NOT NULL,
  PRIMARY KEY (`dpi`)
) ENGINE=InnoDB AUTO_INCREMENT=245655 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`dpi`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `contra`) VALUES
(123435, 'chatio', 'cahtio2', 2354324, 'ciudad', 'elumg', '1234'),
(245654, 'juancho', 'juancho2', 9874561, 'guate', 'elumg', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `farmacia`
--

DROP TABLE IF EXISTS `farmacia`;
CREATE TABLE IF NOT EXISTS `farmacia` (
  `codigo` int(10) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(20) NOT NULL,
  `horaAp` varchar(15) NOT NULL,
  `horaCe` varchar(15) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmacia`
--

INSERT INTO `farmacia` (`codigo`, `direccion`, `horaAp`, `horaCe`) VALUES
(1, 'zona1', '7', '8'),
(2, 'zona 12', '7', '8');

-- --------------------------------------------------------

--
-- Table structure for table `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
CREATE TABLE IF NOT EXISTS `medicamento` (
  `codigo` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `presentacion` varchar(20) NOT NULL,
  `stock` int(3) NOT NULL,
  `costo` int(5) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicamento`
--

INSERT INTO `medicamento` (`codigo`, `nombre`, `presentacion`, `stock`, `costo`) VALUES
(1, 'ibuprofeno', 'pastillas', 20, 45),
(2, 'metronidazol', 'pastilla', 50, 30);

-- --------------------------------------------------------

--
-- Table structure for table `receta`
--

DROP TABLE IF EXISTS `receta`;
CREATE TABLE IF NOT EXISTS `receta` (
  `codigo` int(10) NOT NULL AUTO_INCREMENT,
  `cod_doct` int(10) NOT NULL,
  `cod_cliente` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  `cod_farm` int(10) NOT NULL,
  `costo_tot` float NOT NULL,
  `tipoPago` varchar(15) NOT NULL,
  `noFactura` int(10) NOT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `hora` varchar(15) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `cod_doct_2` (`cod_doct`,`cod_cliente`,`cod_farm`),
  KEY `cod_doct` (`cod_doct`,`cod_cliente`,`cod_farm`),
  KEY `cod_cliente` (`cod_cliente`),
  KEY `cod_farm` (`cod_farm`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receta`
--

INSERT INTO `receta` (`codigo`, `cod_doct`, `cod_cliente`, `fecha`, `estado`, `cod_farm`, `costo_tot`, `tipoPago`, `noFactura`, `fechaEntrega`, `hora`) VALUES
(1, 123435, 1, '2020-10-16', 'pendiente', 1, 968, 'Caja', 3, '2020-10-22', '10:22'),
(2, 245654, 2, '2020-10-24', 'Finalizado', 1, 968, 'Seguro', 3, '2020-10-23', '10:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`cod_receta`) REFERENCES `receta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`cod_med`) REFERENCES `medicamento` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`cod_doct`) REFERENCES `doctor` (`dpi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`dpi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receta_ibfk_3` FOREIGN KEY (`cod_farm`) REFERENCES `farmacia` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
