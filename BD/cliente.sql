-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-04-2022 a las 05:59:58
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aquamundo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(70) NOT NULL,
  `telefono` char(10) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `cve_estado` char(2) NOT NULL,
  `cve_municipio` char(3) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `correo_electronico` (`correo_electronico`),
  KEY `cve_estado` (`cve_estado`),
  KEY `cve_municipio` (`cve_municipio`),
  KEY `telefono` (`telefono`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cve_estado`) REFERENCES `inegidomgeo_cat_estado` (`CVE_ENT`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`cve_municipio`) REFERENCES `inegidomgeo_cat_municipio` (`CVE_MUN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
