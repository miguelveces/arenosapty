/*
SQLyog Community Edition- MySQL GUI v8.17 
MySQL - 5.6.12-log : Database - ptyloto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ptyloto` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ptyloto`;

/*Table structure for table `auditoria` */

DROP TABLE IF EXISTS `auditoria`;

CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL DEFAULT '0',
  `id_fk_usuario` int(11) DEFAULT NULL,
  `tipo_transaccion` varchar(30) DEFAULT NULL,
  `tabla` varchar(20) DEFAULT NULL,
  `comentario` varchar(100) DEFAULT NULL,
  `estados` varchar(20) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_auditoria`),
  KEY `id_fk_usuario` (`id_fk_usuario`),
  CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`id_fk_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `numeros_disponibles` */

DROP TABLE IF EXISTS `numeros_disponibles`;

CREATE TABLE `numeros_disponibles` (
  `id_numero` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `id_fk_sorteo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_numero`),
  KEY `id_fk_sorteo` (`id_fk_sorteo`),
  CONSTRAINT `numeros_disponibles_ibfk_1` FOREIGN KEY (`id_fk_sorteo`) REFERENCES `sorteos` (`id_sorteo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `numeros_ganadores` */

DROP TABLE IF EXISTS `numeros_ganadores`;

CREATE TABLE `numeros_ganadores` (
  `id_numero_ganador` int(11) NOT NULL AUTO_INCREMENT,
  `id_fk_numero_comprado` int(11) DEFAULT NULL,
  `fecha_sorteo` date DEFAULT NULL,
  `id_fk_numero_loteria` int(11) DEFAULT NULL,
  `id_fk_restriccion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_numero_ganador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `numeros_loteria` */

DROP TABLE IF EXISTS `numeros_loteria`;

CREATE TABLE `numeros_loteria` (
  `id_numero` int(11) NOT NULL DEFAULT '0',
  `1er` int(11) DEFAULT NULL,
  `2nd` int(11) DEFAULT NULL,
  `3rd` int(11) DEFAULT NULL,
  `serie` varchar(20) DEFAULT NULL,
  `folio` varchar(20) DEFAULT NULL,
  `fecha_sorteo` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `numeros_por_usuario` */

DROP TABLE IF EXISTS `numeros_por_usuario`;

CREATE TABLE `numeros_por_usuario` (
  `id_numero_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_fk_targeta` int(11) DEFAULT NULL,
  `id_fk_numero` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_registro` int(11) DEFAULT NULL,
  `fecha_sorteo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_numero_usuario`),
  KEY `id_fk_targeta` (`id_fk_targeta`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Table structure for table `restricciones_venta` */

DROP TABLE IF EXISTS `restricciones_venta`;

CREATE TABLE `restricciones_venta` (
  `id_restriccion` int(11) NOT NULL DEFAULT '0',
  `hora_limite` time DEFAULT NULL,
  PRIMARY KEY (`id_restriccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL DEFAULT '0',
  `nombre_rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `sorteos` */

DROP TABLE IF EXISTS `sorteos`;

CREATE TABLE `sorteos` (
  `id_sorteo` int(11) NOT NULL DEFAULT '0',
  `nombre_sorteo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_sorteo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tarjetas_por_usuarios` */

DROP TABLE IF EXISTS `tarjetas_por_usuarios`;

CREATE TABLE `tarjetas_por_usuarios` (
  `id_targeta_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_targeta` int(11) NOT NULL DEFAULT '0',
  `codigo_verificador` varchar(5) DEFAULT NULL,
  `id_fk_usuario` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `Estado_tarjeta` tinyint(1) NOT NULL DEFAULT '1',
  `Sellar_tarjeta` tinyint(1) NOT NULL DEFAULT '1',
  `QR_Tarjeta` varchar(100) NOT NULL,
  PRIMARY KEY (`id_targeta_usuario`,`codigo_targeta`,`QR_Tarjeta`),
  KEY `id_fk_usuario` (`id_fk_usuario`),
  CONSTRAINT `tarjetas_por_usuarios_ibfk_1` FOREIGN KEY (`id_fk_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `tarjetas_recibidas` */

DROP TABLE IF EXISTS `tarjetas_recibidas`;

CREATE TABLE `tarjetas_recibidas` (
  `codigo_targeta` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_verificador` int(5) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `fecha_recibido` date NOT NULL,
  `registrada_sistema` tinyint(1) NOT NULL DEFAULT '0',
  `saldo` decimal(18,2) NOT NULL,
  PRIMARY KEY (`codigo_targeta`)
) ENGINE=InnoDB AUTO_INCREMENT=345678905 DEFAULT CHARSET=latin1;

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
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
  PRIMARY KEY (`id_usuario`),
  KEY `usuarios_ibfk_1` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
