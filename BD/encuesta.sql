-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-04-2022 a las 05:57:32
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
-- Estructura de tabla para la tabla `encuesta`
--

DROP TABLE IF EXISTS `encuesta`;
CREATE TABLE IF NOT EXISTS `encuesta` (
  `idEncuesta` int(11) NOT NULL AUTO_INCREMENT,
  `idVisita` int(11) NOT NULL,
  `realizada` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_realizacion` datetime DEFAULT NULL,
  `pregunta1` char(2) DEFAULT NULL,
  `pregunta2` char(2) DEFAULT NULL,
  `pregunta3` char(2) DEFAULT NULL,
  `pregunta4` char(2) DEFAULT NULL,
  `pregunta5` char(2) DEFAULT NULL,
  `pregunta6` char(2) DEFAULT NULL,
  `pregunta7` char(2) DEFAULT NULL,
  `idEmpleadoMejor` int(11) DEFAULT NULL,
  `comentarios` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idEncuesta`),
  KEY `idVisita` (`idVisita`),
  KEY `idEmpleadoMejor` (`idEmpleadoMejor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`idVisita`) REFERENCES `visita` (`idVisita`),
  ADD CONSTRAINT `encuesta_ibfk_2` FOREIGN KEY (`idEmpleadoMejor`) REFERENCES `empleado` (`idEmpleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
