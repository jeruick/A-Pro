-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2014 a las 06:20:44
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `articulo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `id_articulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `foto` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_articulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `nombre`, `descripcion`, `precio`, `foto`) VALUES
(1, 'Samsung Galaxy Ace 4', 'Android OS, v4.4.2 (KitKat) Dual-core 1.0 GHz', 5000, 'ace4.jpg'),
(2, 'Samsung Galaxy S5 mi', 'Android OS, v4.4.2 (KitKat) CPU	Quad-core 1.4 GHz', 7000, 's5mini.jpg'),
(3, 'Samsung Galaxy Core ', 'Android OS, v4.4.2 (KitKat) CPU	Quad-core 1.2 GHz', 8000, 'ace4.jpg'),
(4, 'Samsung Galaxy S5 Sp', 'Android OS, v4.4.2 (KitKat) Chipset Qualcomm Snapd', 10000, 's5sport.jpg'),
(5, 'Apple iPhone 5', 'iOS 6, upgradable to iOS 7.1.2, planned upgrade to', 12000, 'iphone5.jpg'),
(6, 'Apple iPhone 5s', 'Dual-core 1.3 GHz Cyclone (ARM v8-based)', 13000, 'iphone5s.jpg'),
(7, 'Sony Xperia T3', 'Quad-core 1.4 GHz Cortex-A7', 14000, 'xperiat3.jpg'),
(8, 'Sony Xperia T2 Ultra', 'Qualcomm MSM8928 Snapdragon 400', 14000, 't2ultra.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
