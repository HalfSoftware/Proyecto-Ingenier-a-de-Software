-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-08-2018 a las 01:17:54
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
-- Estructura de tabla para la tabla `obra`
--

CREATE TABLE IF NOT EXISTS `obra` (
  `obra` varchar(45) NOT NULL,
  `ubicacion` varchar(45) NOT NULL,
  `encargado` varchar(45) NOT NULL,
  `actividad` varchar(100) NOT NULL,
  `estado` set('activa','terminada','pendiente') DEFAULT NULL,
  PRIMARY KEY (`obra`),
  KEY `encargado` (`encargado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obra`
--

INSERT INTO `obra` (`obra`, `ubicacion`, `encargado`, `actividad`, `estado`) VALUES
('O1', 'Santiago', 'Christopher Gonzales', 'Electricidad', 'activa'),
('O2', 'Talcahuano', 'Mauricio Rodriguez', 'Minería', 'activa');

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
('1111111111-1', 'Obras', 'obras', 'testing', '1234', 'O2'),
('1111111111-2', 'Bodega', 'bodega', 'testing', '1234', NULL),
('12.311.655-3', 'Jorge Urrutua', 'obras', 'Electricidad', '1234', 'O1'),
('13.121.548-6', 'Rodrigo Fuentes', 'obras', 'Mecánica', '1234', 'O2'),
('16.211.920-1', 'admin', 'administracion', 'informática', '1234', NULL),
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
('1', 350, 'Pino Tapa Canteada 1"x4"x3.0', 9996, 'Unid.', 'N/A'),
('10', 900, 'Cable Araflex RV-K  3X2,5mm2', 1188, 'mts', 'N/A'),
('2', 400, 'Pino Dimencionado Seco 1"x2"x3.20', 485, 'Unid.', 'N/A'),
('3', 450, 'Pino Dimencionado Seco 2"x2"x3.20', 353, 'Unid.', 'N/A'),
('4', 520, 'Pino Dimencionado Seco 2"x3"x3.20', 391, 'Unid.', 'N/A'),
('5', 1500, 'Clavos 3"', 85, 'Caja', 'N/A'),
('6', 200, 'Manguera Transperente de 1/2 "', 9958, 'MI', 'N/A'),
('7', 4000, 'Huicha de medir 7,5 mts', 9954, 'Unid.', 'N/A'),
('8', 8900, 'Disco Sierra Circular 7"1/4 24 dientes', 389, 'Unid.', 'Si'),
('9', 600, 'Hoja Sierra Bimetal 18"', 24, 'Unid.', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_solicitados`
--

CREATE TABLE IF NOT EXISTS `productos_solicitados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` varchar(45) NOT NULL,
  `nro_solicitud` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` set('solicitado','reservado en bodega','recibido en bodega','enviado a adquisiciones','enviado a proveedores','recibido en obras','devuelto') NOT NULL DEFAULT 'solicitado',
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`,`nro_solicitud`),
  KEY `nro_solicitud` (`nro_solicitud`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `productos_solicitados`
--

INSERT INTO `productos_solicitados` (`id`, `id_producto`, `nro_solicitud`, `cantidad`, `estado`) VALUES
(6, '1', 'SL1', 22, 'reservado en bodega'),
(7, '1', 'SL2', 22, 'reservado en bodega'),
(8, '4', 'SL3', 4, 'reservado en bodega'),
(9, '9', 'SL3', 3, 'reservado en bodega'),
(10, '3', 'SL5', 20, 'reservado en bodega'),
(11, '2', 'SL5', 15, 'reservado en bodega'),
(12, '5', 'SL5', 3, 'reservado en bodega'),
(13, '9', 'SL6', 28, 'enviado a adquisiciones'),
(14, '5', 'SL7', 3, 'solicitado'),
(15, '8', 'SL7', 12, 'solicitado'),
(16, '7', 'SL8', 23, 'reservado en bodega'),
(17, '8', 'SL9', 2, 'solicitado'),
(18, '6', 'SL10', 20, 'reservado en bodega'),
(19, '3', 'SL12', 2, 'reservado en bodega'),
(20, '1', 'SL12', 4, 'reservado en bodega'),
(21, '3', 'SL12', 5, 'reservado en bodega'),
(22, '7', 'SL12', 1, 'reservado en bodega'),
(23, '5', 'SL12', 2, 'reservado en bodega'),
(24, '9', 'SL12', 3, 'reservado en bodega'),
(25, '8', 'SL12', 2, 'reservado en bodega');

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
  `estado` set('pendiente','reservada','solicitada','enviada a proveedores','recibida') NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`numero`),
  KEY `solicitador` (`solicitador`,`obra`),
  KEY `obra` (`obra`),
  KEY `estado` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`numero`, `number`, `fecha`, `solicitador`, `obra`, `estado`) VALUES
('SL1', 12, '2018-07-02 22:35:47', 'Rodrigo Fuentes', 'O2', 'reservada'),
('SL10', NULL, '2018-07-08 23:14:31', 'Obras', 'O2', 'reservada'),
('SL11', NULL, '2018-07-08 23:17:11', 'Obras', 'O2', 'reservada'),
('SL12', NULL, '2018-07-10 19:06:02', 'Rodrigo Fuentes', 'O2', 'reservada'),
('SL2', NULL, '2018-07-02 22:36:07', 'Rodrigo Fuentes', 'O2', 'reservada'),
('SL3', NULL, '2018-07-02 22:38:28', 'Rodrigo Fuentes', 'O2', 'reservada'),
('SL5', NULL, '2018-07-04 17:06:18', 'Rodrigo Fuentes', 'O2', 'reservada'),
('SL6', NULL, '2018-07-04 17:12:21', 'Rodrigo Fuentes', 'O2', 'reservada'),
('SL7', NULL, '2018-07-08 06:47:26', 'Obras', 'O2', 'pendiente'),
('SL8', NULL, '2018-07-08 22:05:17', 'Obras', 'O2', 'reservada'),
('SL9', NULL, '2018-07-08 22:13:35', 'Obras', 'O2', 'pendiente');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`obra`) REFERENCES `obra` (`obra`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_solicitados`
--
ALTER TABLE `productos_solicitados`
  ADD CONSTRAINT `productos_solicitados_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_solicitados_ibfk_2` FOREIGN KEY (`nro_solicitud`) REFERENCES `solicitud` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`solicitador`) REFERENCES `personal` (`nombre`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`obra`) REFERENCES `obra` (`obra`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
