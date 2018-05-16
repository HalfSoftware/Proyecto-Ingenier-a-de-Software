-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-05-2018 a las 21:17:20
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gpi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_compra`
--

CREATE TABLE IF NOT EXISTS `lista_compra` (
  `id_producto` varchar(45) NOT NULL,
  `numero_solicitud_compra` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`,`numero_solicitud_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_reservados`
--

CREATE TABLE IF NOT EXISTS `lista_reservados` (
  `id_producto` varchar(45) NOT NULL,
  `numero_solicitud` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`,`numero_solicitud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_solicitados`
--

CREATE TABLE IF NOT EXISTS `lista_solicitados` (
  `id_producto` varchar(45) NOT NULL,
  `numero_solicitud` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`,`numero_solicitud`),
  KEY `precio` (`precio`),
  KEY `numero_solicitud` (`numero_solicitud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lista_solicitados`
--

INSERT INTO `lista_solicitados` (`id_producto`, `numero_solicitud`, `cantidad`, `precio`) VALUES
('1', 'SL2', 10, 3500),
('3', 'SL2', 15, 6750),
('5', 'SL2', 3, 4500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra`
--

CREATE TABLE IF NOT EXISTS `obra` (
  `obra` varchar(45) NOT NULL,
  `ubicacion` varchar(45) NOT NULL,
  `encargado` varchar(45) NOT NULL,
  `actividad` varchar(100) NOT NULL,
  PRIMARY KEY (`obra`),
  KEY `encargado` (`encargado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obra`
--

INSERT INTO `obra` (`obra`, `ubicacion`, `encargado`, `actividad`) VALUES
('O1', 'Santiago', 'Christopher Gonzales', 'Electricidad'),
('O2', 'Talcahuano', 'Mauricio Rodriguez', 'Minería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `rut` varchar(45) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `area` set('obras','bodega','ventas','contabilidad','administracion','otros') NOT NULL,
  `especialidad` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `obra` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rut`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `nombre_2` (`nombre`),
  KEY `obra` (`obra`),
  KEY `nombre_3` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`rut`, `nombre`, `area`, `especialidad`, `password`, `obra`) VALUES
('12.311.655-3', 'Jorge Urrutua', 'obras', 'Electricidad', '1234', 'O1'),
('13.121.548-6', 'Rodrigo Fuentes', 'obras', 'Mecánica', '1234', 'O2'),
('9.002.781-5', 'Alexis Campos', 'bodega', 'Almacenamiento', '1234', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` varchar(45) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `cantidad` int(45) NOT NULL,
  `unidad` set('Unid.','Caja','MI','Rollo','mts') NOT NULL DEFAULT 'Unid.',
  `certificado` set('N/A','Si','No') NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `precio`, `descripcion`, `cantidad`, `unidad`, `certificado`) VALUES
('1', 350, 'Pino Tapa Canteada 1"x4"x3.0', 10000, 'Unid.', 'N/A'),
('10', 900, 'Cable Araflex RV-K  3X2,5mm2', 1200, 'mts', 'N/A'),
('2', 400, 'Pino Dimencionado Seco 1"x2"x3.20', 500, 'Unid.', 'N/A'),
('3', 450, 'Pino Dimencionado Seco 2"x2"x3.20', 400, 'Unid.', 'N/A'),
('4', 520, 'Pino Dimencionado Seco 2"x3"x3.20', 420, 'Unid.', 'N/A'),
('5', 1500, 'Clavos 3"', 100, 'Caja', 'N/A'),
('6', 200, 'Manguera Transperente de 1/2 "', 20, 'MI', 'N/A'),
('7', 4000, 'Huicha de medir 7,5 mts', 20, 'Unid.', 'N/A'),
('8', 8900, 'Disco Sierra Circular 7"1/4 24 dientes', 50, 'Unid.', 'Si'),
('9', 600, 'Hoja Sierra Bimetal 18"', 30, 'Unid.', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `numero` varchar(45) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `solicitador` varchar(100) NOT NULL,
  `obra` varchar(45) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `solicitador` (`solicitador`,`obra`),
  KEY `obra` (`obra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`numero`, `number`, `fecha`, `solicitador`, `obra`) VALUES
('SL1', 2, '2018-05-14 20:42:20', 'Jorge Urrutua', 'O1'),
('SL2', NULL, '2018-05-16 21:13:06', 'Jorge Urrutua', 'O1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_compra`
--

CREATE TABLE IF NOT EXISTS `solicitud_compra` (
  `numero_compra` varchar(45) NOT NULL,
  `numero_solicitud` varchar(45) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lista_compra` varchar(45) NOT NULL,
  PRIMARY KEY (`numero_compra`),
  KEY `numero_solicitud` (`numero_solicitud`,`lista_compra`),
  KEY `lista_compra` (`lista_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lista_solicitados`
--
ALTER TABLE `lista_solicitados`
  ADD CONSTRAINT `lista_solicitados_ibfk_1` FOREIGN KEY (`numero_solicitud`) REFERENCES `solicitud` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`obra`) REFERENCES `obra` (`obra`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`solicitador`) REFERENCES `personal` (`nombre`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`obra`) REFERENCES `obra` (`obra`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  ADD CONSTRAINT `solicitud_compra_ibfk_1` FOREIGN KEY (`numero_solicitud`) REFERENCES `solicitud` (`numero`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
