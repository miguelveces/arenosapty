-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-04-2014 a las 07:52:52
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ptyloto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `id_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_fk_usuario` int(11) NOT NULL,
  `tipo_transaccion` varchar(30) NOT NULL,
  `tabla` varchar(30) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `comentario` varchar(200) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id_auditoria`),
  KEY `id_fk_usuario` (`id_fk_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id_auditoria`, `id_fk_usuario`, `tipo_transaccion`, `tabla`, `ip`, `comentario`, `fecha_registro`) VALUES
(1, 6, 'insert', 'usuarios', '122.122.33.33', 'se realizo el registro correctamente', '2014-04-08'),
(2, 6, 'insert', 'usuarios', '122.122.33.33', 'se realizo el registro correctamente', '2014-04-08'),
(3, 6, 'insert', 'usuarios', '122.122.33.33', 'se realizo el registro correctamente', '2014-04-08'),
(4, 6, 'insert', 'usuarios', '122.122.33.33', 'se realizo el registro correctamente', '2014-04-08'),
(5, 6, 'insert', 'usuarios', '122.122.33.33', 'se realizo el registro correctamente', '2014-04-08'),
(6, 6, 'insert', 'usuarios', '122.122.33.33', 'se realizo el registro correctamente', '2014-04-08'),
(7, 6, 'insert', 'usuarios', '127.0.0.1', 'se realizo el registro correctamente', '2014-04-08'),
(8, 6, 'insert', 'usuarios', '127.0.0.1', 'se realizo el registro correctamente', '2014-04-08'),
(9, 6, 'insert', 'usuarios', '127.0.0.1', 'se realizo el registro correctamente', '2014-04-08'),
(10, 6, 'insert', 'usuarios', '127.0.0.1', 'se realizo el registro correctamente', '2014-04-08'),
(11, 6, 'insert', 'usuarios', 'sad', 'se realizo el registro correctamente', '2014-04-08'),
(12, 6, 'insert', 'usuarios', '127.0.0.1', 'se realizo el registro correctamente', '2014-04-08'),
(13, 6, 'login', 'usuarios', '127.0.0.1', 'Acaba de inisiar sescion', '2014-04-21'),
(14, 6, 'login', 'usuarios', '127.0.0.1', 'Acaba de inisiar sescion', '2014-04-21'),
(15, 6, 'login', 'usuarios', '127.0.0.1', 'Acaba de inisiar sescion', '2014-04-21'),
(16, 6, 'login', 'usuarios', '127.0.0.1', 'Acaba de inisiar sescion', '2014-04-21'),
(17, 6, 'login', 'usuarios', '127.0.0.1', 'El usuario acaba de cerrar sesion', '2014-04-21'),
(18, 6, 'login', 'usuarios', '127.0.0.1', 'Acaba de inisiar sescion', '2014-04-21'),
(19, 6, 'Consulta', 'restricciones_venta', '127.0.0.1', 'valor retornado= 1', '2014-04-21'),
(20, 6, 'Consulta', 'tarjetas_recibidas', '127.0.0.1', 'valor retornado select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b\r\n            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= 12345678 and a.registrada_sistema=TRUE', '2014-04-21'),
(21, 6, 'Update', 'tarjetas_recibidas', '127.0.0.1', 'Error al intentar actualizar el valor', '2014-04-21'),
(22, 6, 'Insert', 'numeros_por_usuario', '127.0.0.1', 'OK, se ha registrado!', '2014-04-21'),
(23, 6, 'Consulta', 'restricciones_venta', '127.0.0.1', 'valor retornado= 1', '2014-04-21'),
(24, 6, 'Consulta', 'tarjetas_recibidas', '127.0.0.1', 'valor retornado select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b\r\n            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= 12345678 and a.registrada_sistema=TRUE', '2014-04-21'),
(25, 6, 'Update', 'tarjetas_recibidas', '127.0.0.1', 'Error al intentar actualizar el valor', '2014-04-21'),
(26, 6, 'Insert', 'numeros_por_usuario', '127.0.0.1', 'OK, se ha registrado!', '2014-04-21'),
(27, 6, 'Insert', 'registrada_sistema', '127.0.0.1', 'Se actualiza el estado de la tarjeta en tarjetas recibidas', '2014-04-21'),
(28, 6, 'Insert', 'tarjetas_por_usuario', '127.0.0.1', 'Tarjeta Registrada Correctamente', '2014-04-21'),
(29, 6, 'Consulta', 'restricciones_venta', '127.0.0.1', 'valor retornado= 1', '2014-04-21'),
(30, 6, 'Consulta', 'tarjetas_recibidas', '127.0.0.1', 'valor retornado select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b\r\n            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= 88888888 and a.registrada_sistema=TRUE', '2014-04-21'),
(31, 6, 'Update', 'tarjetas_recibidas', '127.0.0.1', 'Error al intentar actualizar el valor', '2014-04-21'),
(32, 6, 'Insert', 'numeros_por_usuario', '127.0.0.1', 'OK, se ha registrado!', '2014-04-21'),
(33, 6, 'login', 'usuarios', '127.0.0.1', 'Acaba de inisiar sescion', '2014-04-21'),
(34, 6, 'login', 'usuarios', '127.0.0.1', 'El usuario acaba de cerrar sesion', '2014-04-21'),
(35, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(36, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(37, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(38, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(39, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(40, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(41, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(42, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-21'),
(43, 11, 'login', 'usuarios', '127.0.0.1', 'Validando si el usuario esta ok', '2014-04-21'),
(44, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-22'),
(45, 11, 'login', 'usuarios', '127.0.0.1', 'Validando si el usuario esta ok', '2014-04-22'),
(46, 11, 'Insert', 'usuarios', '127.0.0.1', ' Se ha registrado correctamente.', '2014-04-22'),
(47, 11, 'login', 'usuarios', '127.0.0.1', 'Validando si el usuario esta ok', '2014-04-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_disponibles`
--

CREATE TABLE IF NOT EXISTS `numeros_disponibles` (
  `id_numero` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `id_fk_sorteo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_numero`),
  KEY `id_fk_sorteo` (`id_fk_sorteo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `numeros_disponibles`
--

INSERT INTO `numeros_disponibles` (`id_numero`, `numero`, `cantidad_disponible`, `id_fk_sorteo`) VALUES
(1, 0, 100, 0),
(2, 1, 17, 0),
(3, 2, 50, 0),
(4, 3, 100, 0),
(5, 4, 100, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_ganadores`
--

CREATE TABLE IF NOT EXISTS `numeros_ganadores` (
  `id_numero_ganador` int(11) NOT NULL AUTO_INCREMENT,
  `id_fk_numero_comprado` int(11) DEFAULT NULL,
  `fecha_sorteo` date DEFAULT NULL,
  PRIMARY KEY (`id_numero_ganador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `numeros_ganadores`
--

INSERT INTO `numeros_ganadores` (`id_numero_ganador`, `id_fk_numero_comprado`, `fecha_sorteo`) VALUES
(3, 11, '2014-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_loteria`
--

CREATE TABLE IF NOT EXISTS `numeros_loteria` (
  `id_numero` int(11) NOT NULL AUTO_INCREMENT,
  `primero` int(11) NOT NULL,
  `segundo` int(11) NOT NULL,
  `tercero` int(11) NOT NULL,
  `serie` varchar(20) DEFAULT NULL,
  `folio` varchar(20) DEFAULT NULL,
  `fecha_sorteo` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `numeros_loteria`
--

INSERT INTO `numeros_loteria` (`id_numero`, `primero`, `segundo`, `tercero`, `serie`, `folio`, `fecha_sorteo`, `fecha`) VALUES
(5, 1, 2, 3, '', '', '2014-04-21', '2014-04-21');

--
-- Disparadores `numeros_loteria`
--
DROP TRIGGER IF EXISTS `numeros_ganadores`;
DELIMITER //
CREATE TRIGGER `numeros_ganadores` AFTER INSERT ON `numeros_loteria`
 FOR EACH ROW BEGIN
    insert into ptyloto.numeros_ganadores (id_fk_numero_comprado, fecha_sorteo ) 
select a.id_numero_usuario,c.fecha_sorteo  from ptyloto.numeros_por_usuario a, ptyloto.numeros_disponibles b, ptyloto.numeros_loteria c
where a.id_fk_numero = b.numero
and (b.numero = c.primero 
or  b.numero = c.segundo
or  b.numero = c.tercero);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_por_usuario`
--

CREATE TABLE IF NOT EXISTS `numeros_por_usuario` (
  `id_numero_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_fk_targeta` int(11) DEFAULT NULL,
  `id_fk_numero` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_registro` int(11) DEFAULT NULL,
  `fecha_sorteo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_numero_usuario`),
  KEY `id_fk_targeta` (`id_fk_targeta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `numeros_por_usuario`
--

INSERT INTO `numeros_por_usuario` (`id_numero_usuario`, `id_fk_targeta`, `id_fk_numero`, `cantidad`, `fecha_registro`, `fecha_sorteo`) VALUES
(11, 12345678, 1, 10, 2014, 2014),
(12, 12345678, 1, 1, 2014, 2014),
(13, 12345678, 1, 1, 2014, 2014),
(14, 88888888, 1, 1, 2014, 2014);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restricciones_venta`
--

CREATE TABLE IF NOT EXISTS `restricciones_venta` (
  `id_restriccion` int(11) NOT NULL DEFAULT '0',
  `hora_limite` time DEFAULT NULL,
  PRIMARY KEY (`id_restriccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int(11) NOT NULL DEFAULT '0',
  `nombre_rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'usuario'),
(2, 'Administrador'),
(3, 'default');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteos`
--

CREATE TABLE IF NOT EXISTS `sorteos` (
  `id_sorteo` int(11) NOT NULL DEFAULT '0',
  `nombre_sorteo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_sorteo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sorteos`
--

INSERT INTO `sorteos` (`id_sorteo`, `nombre_sorteo`) VALUES
(0, 'Miercolito'),
(1, 'Domingo'),
(2, 'Extraordinaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas_por_usuarios`
--

CREATE TABLE IF NOT EXISTS `tarjetas_por_usuarios` (
  `id_targeta_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_targeta` int(11) NOT NULL DEFAULT '0',
  `codigo_verificador` varchar(5) NOT NULL,
  `id_fk_usuario` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `Estado_tarjeta` tinyint(1) NOT NULL DEFAULT '1',
  `Sellar_tarjeta` tinyint(1) NOT NULL DEFAULT '1',
  `QR_Tarjeta` varchar(100) NOT NULL,
  `activacion` varchar(10) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_targeta_usuario`),
  KEY `id_fk_usuario` (`id_fk_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tarjetas_por_usuarios`
--

INSERT INTO `tarjetas_por_usuarios` (`id_targeta_usuario`, `codigo_targeta`, `codigo_verificador`, `id_fk_usuario`, `fecha_registro`, `Estado_tarjeta`, `Sellar_tarjeta`, `QR_Tarjeta`, `activacion`, `estado`) VALUES
(6, 12345678, '12345', 6, '2014-04-19', 1, 0, '', NULL, NULL),
(7, 87654321, '54321', 6, '2014-04-21', 1, 0, '', NULL, NULL),
(8, 88888888, '55555', 6, '2014-04-21', 1, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas_recibidas`
--

CREATE TABLE IF NOT EXISTS `tarjetas_recibidas` (
  `codigo_targeta` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_verificador` int(5) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `fecha_recibido` date NOT NULL,
  `registrada_sistema` tinyint(1) NOT NULL DEFAULT '0',
  `saldo` decimal(18,2) NOT NULL,
  PRIMARY KEY (`codigo_targeta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88888889 ;

--
-- Volcado de datos para la tabla `tarjetas_recibidas`
--

INSERT INTO `tarjetas_recibidas` (`codigo_targeta`, `codigo_verificador`, `cedula`, `fecha_recibido`, `registrada_sistema`, `saldo`) VALUES
(12345678, 12345, '234343434', '2014-04-15', 1, '9.50'),
(87654321, 54321, '234343434', '2014-04-21', 1, '30.00'),
(88888888, 55555, '234343434', '2014-04-21', 1, '29.75');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `contrasenia` varchar(20) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `telefono` varchar(40) DEFAULT NULL,
  `correo_electronico` varchar(60) DEFAULT NULL,
  `correo_electronico2` varchar(60) DEFAULT NULL,
  `cedula` varchar(25) DEFAULT NULL,
  `activacion` varchar(20) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuarios_ibfk_1` (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `id_rol`, `contrasenia`, `fecha_registro`, `apellido`, `telefono`, `correo_electronico`, `correo_electronico2`, `cedula`, `activacion`, `estado`) VALUES
(6, 'Miguel', 1, 'o6KnraGl', '2014-04-08', 'veces', '123445', 'mveces8@gmail.com', 'mveces8@gmail.com', '234343434', NULL, NULL),
(7, 'bbbb', NULL, 'o6KnraGl', '2014-04-21', 'sss', '11111', 'mvece@yahoo.com', 'mvece@yahoo.com', '222222', NULL, NULL),
(8, '4234', NULL, 'o6KnraGlq6c=', '2014-04-21', 'rrr', '33234', 'mvece2@yahoo.com', 'mvece2@yahoo.com', '000000', NULL, NULL),
(9, 'rar', NULL, 'o6KnraGl', '2014-04-21', 'werw', 'rwer', 'mvece22@yahoo.com', 'mvece2@yahoo.com', 'werer', NULL, NULL),
(10, 'rwer', NULL, 'o6KnraGl', '2014-04-21', 'werwe', 'wer', 'mvece21@yahoo.com', 'mvece2@yahoo.com', '4444444', NULL, NULL),
(11, 'admin', 3, 'generico', '2014-04-21', 'admin', '123456', 'generico@admin.com', 'generico@admin.com', '12345678', NULL, NULL),
(12, '4234', NULL, 'o6KnraGl', '2014-04-22', 'rrr', '34', 'mvece232@yahoo.com', 'mvece2@yahoo.com', '44444443', NULL, NULL),
(13, '4234', NULL, 'o6Glqp2gpQ==', '2014-04-22', 'rrr', '11111', 'mvec22e@yahoo.com', 'mvece2@yahoo.com', '1211111', '019059823f48e01d3dc9', '0'),
(14, 'cc', NULL, 'o6Klqw==', '2014-04-22', 'd', '11', 'mvec222e@yahoo.com', 'mvece2@yahoo.com', '22', '', '0'),
(15, '4234', NULL, 'pqQ=', '2014-04-22', 'sss', '99999', 'mvec229e@yahoo.com', 'mvece2@yahoo.com', '99', '16628', '0'),
(16, '4234', NULL, 'paSnrZ8=', '2014-04-22', 'sss', '11111', 'mvec220e@yahoo.com', 'mvece2@yahoo.com', '12111118', 'o6KnqqM=', '1'),
(17, '4234', NULL, '6+mssqQ=', '2014-04-22', 'sss', '11', 'mvec220e0@yahoo.com', 'mvece2@yahoo.com', '12111117', 'aqWs', '1'),
(18, 'cc', NULL, 'qKeqsKI=', '2014-04-22', 'werwe', '98987666', 'mvec30e@yahoo.com', 'mvece2@yahoo.com', '99999', 'ZaOnrqE=', '0'),
(19, 'bb', NULL, 'qairsaM=', '2014-04-22', 'nn', '11111', 'mvec89@yahoo.com', 'mvece@yahoo.com', '898989', 'ZaepqaM=', '0'),
(20, 'bbbb', NULL, 'pqWorqCkqKQ=', '2014-04-22', 'sss', '11111', 'mvec77e@yahoo.com', 'mvece2@yahoo.com', '000000777', 'ZaOq', '0'),
(21, '4234', NULL, 'o6KnraE=', '2014-04-22', 'sss', '11111', 'mvec2202222e0@yahoo.com', 'mvece2@yahoo.com', '000000433333', 'Z6CsqqI=', '0');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`id_fk_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
