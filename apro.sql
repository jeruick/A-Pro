-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-08-2014 a las 02:45:53
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `apro`
--
CREATE DATABASE IF NOT EXISTS `apro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `apro`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `nombre_articulo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `precio_unidad` float NOT NULL,
  `cantidad` int(3) NOT NULL,
  `estado` int(1) NOT NULL,
  `visitas` int(15) NOT NULL,
  `descripcion` longtext NOT NULL,
  `foto_articulo` longtext NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_categoria` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id`, `nombre_articulo`, `marca`, `precio_unidad`, `cantidad`, `estado`, `visitas`, `descripcion`, `foto_articulo`, `id_usuario`, `id_categoria`) VALUES
(1, 'Abrigo_cafe', 'Couture', 550, 2, 4, 3, 'Abrigo de algodon, color cafe, zise ''Large''  ', 'abrigo_feo.png', 1, 9),
(2, 'Reloj Galaxy Gear', 'Samsung', 2000, 2, 5, 3, 'Reloj de hombre colo naranja, nuevo.', 'galaxy_gear.png', 3, 9),
(4, 'Computadora HP Notebook', 'HP', 5000, 2, 5, 5, 'Computadora portatil, HD:400gb, RAM: 4gb, Procesador: intel i5 negra', 'hp_notebook.png', 4, 2),
(5, 'Ipad 2', 'Apple', 3500, 1, 4, 0, 'color: blanca, semi-nueva', 'ipad1.png', 1, 2),
(6, 'Zapatos de Dama', 'Louboutin', 850, 1, 5, 1, 'color rojo, nuevos, marca Louboutin', 'omg.png', 1, 9),
(7, 'Abrigo Gris Aeropostale', 'Aeropostale', 500, 1, 5, 0, 'Abrigo de algodon, size ''M'', nuevo.', 'abrigo_gris.png', 1, 9),
(8, 'Reloj_ Iwatch', 'Apple', 2500, 3, 5, 0, 'Reloj digital marca Apple, negro', 'iwatch.png', 3, 9),
(9, 'Iphone 5s', 'Apple', 2500, -1, 4, 0, 'color negro, seminuevo', 'iphone5s.png', 2, 2),
(10, 'Celular Samsung note 1', 'Samsung', 8500, 3, 4, 1, 'color blanco, 8gb de memoria interna, camara 12mpx', 'samsung_note1.png', 3, 2),
(11, 'Tablet Samsung tab3 ', 'Samsung', 2500, 1, 4, 1, 'Tablet Tab3, 5 plg, 16gb memoria interna, ranura para SIMCARD.', 'samsungtab3_5plg.png', 2, 2),
(12, 'Samsung Galaxy Note 3', 'Samsung', 8500, 1, 5, 1, 'color negro, mememoria interna:16gb- hasta 32gb.', 'note3.png', 1, 2),
(13, 'Hp Notebook', 'HP', 5000, 0, 5, 3, '500GB Disco Duro, 4GB RAM, color negro, procesador i5', 'hp_notebook2.png', 2, 2),
(14, 'Jersey Rojo Dama', 'DKNY', 850, 2, 5, 0, '', 'jersey_rojo.png', 1, 9),
(15, 'Loubotin_dama_Rosados', 'Louboutin', 800, 1, 4, 1, 'size 2 1/2', 'zapatos_rosados.png', 1, 9),
(16, 'Celular Ace', 'Ace', 3500, 1, 4, 0, '', 'ace4.png', 3, 2),
(17, 'Iphone 5', 'Apple', 6000, 1, 4, 0, 'color blanco, 8gb memoria interna', 'iphone5.png', 2, 2),
(18, 'Macbook Air', 'Apple', 20000, 1, 5, 0, '50gb DD solido, 4gb RAM', 'macbookair_1.png', 1, 2),
(19, 'Reloj Hombre Sandoz', 'Sandoz', 3000, 1, 5, 1, '', 'relojSandoz.png', 3, 9),
(20, 'Reloj Hombre_ plata', 'LV', 2300, 1, 4, 0, '', 'relojplata.png', 2, 9),
(21, 'Samsung Xperia', 'Samsung', 6300, 2, 4, 7, '', 'xperiat3.png', 3, 2),
(22, 'Reloj Dama_Lacoste', 'Lacoste', 2300, 2, 5, 0, '', 'relojLacoste2.png', 1, 9),
(23, 'Zapatos DKNY_negros_Mujer', 'DKNY', 950, 1, 4, 0, 'negros, zize 8', 'zapatosLoubotin.png', 1, 9),
(24, 'Perfume 212 Vip Dama', 'Carolina Herrera', 900, 2, 5, 10, '', '212VIP.png', 3, 10),
(25, 'Adorno para mesa_ hogar', 'DecoArt', 300, 3, 5, 2, 'pelotas naranja para centro de mesa', 'adornos.png', 1, 1),
(26, 'Locion Hombre_Aqua Bvlgari', 'Bvlgari', 2400, 1, 5, 0, '', 'aquaBulgari.png', 2, 10),
(27, 'Locion Armani_Code de Hombre', 'Armani', 250, 1, 5, 0, '', 'Armanicode.png', 3, 10),
(28, 'Equpo con base para Ipod ', 'Philips', 5500, 1, 5, 0, '', 'base_reproductor.png', 1, 2),
(29, 'Bolso de Viaje_ Cuero', 'Bvlgari', 2500, 1, 4, 2, '', 'bolsoCuero.png', 2, 5),
(30, 'Maleta Lous Vuitton_Viaje', 'Lous Vuitton', 2300, 2, 5, 6, '', 'bolsoLV.png', 3, 5),
(31, 'Bolso de Mujer_viaje_LV', 'Lous Vuitton', 2000, 2, 5, 0, '', 'bolsoLV2.png', 1, 5),
(32, 'Maletin_dama_Pink', 'Victorias Secret', 1200, 1, 5, 0, '', 'bolsoPink.png', 1, 5),
(33, 'Camion_juguete', 'Prismatics', 300, 1, 4, 0, '', 'camion.png', 2, 4),
(34, 'Camara Video_Canon', 'Canon', 4500, 1, 4, 5, '', 'camvideo.png', 3, 12),
(35, 'Camara fotografica_canon', 'Canon', 5000, 1, 5, 0, '', 'canon.png', 2, 12),
(36, 'Perfume_mujer_cocoChannel', 'Channel', 2300, 1, 5, 0, '', 'cocoChannel.png', 1, 10),
(37, 'Equipo de Sonido', 'Sony', 6500, 1, 5, 7, '', 'EquipoSonido.png', 3, 2),
(38, 'Escritorio_O', '', 0, 1, 1, 0, '', '', 0, 0),
(39, 'Escritorio_Oficina', 'DecoArt', 5500, 1, 5, 0, '', 'escritorio.png', 2, 13),
(40, 'Locion para Hombre_HugoBoss', 'Hugo Boss', 2300, 2, 5, 0, '', 'HB.png', 3, 10),
(41, 'Impresora_oficina', 'Canon', 3400, 1, 5, 0, '', 'impresora.png', 2, 6),
(42, 'Impresora_multifuncional', 'Epson', 4500, 1, 5, 0, '', 'impresoraEpson.png', 2, 6),
(43, 'Set_DeJarrones_para Decoracion', 'DecoArt', 500, 1, 5, 0, '', 'jarrones.png', 1, 1),
(44, 'Pictionary_juego de mesa', 'Hasbro', 300, 1, 5, 1, '', 'juegomesa.png', 1, 4),
(45, 'Juguete_timon_para Niño', 'Hasbro', 300, 1, 5, 0, '', 'juguetetimon.png', 2, 4),
(46, 'Lamparas ', 'DecoArt', 1200, 2, 5, 0, '', 'lampara.png', 1, 1),
(47, 'Televisor LCD', 'Sony', 5000, 1, 5, 0, '', 'lcd.png', 2, 2),
(48, 'Locion Blue_Nautica para Hombre', 'Nautica', 2400, 1, 5, 0, '', 'locionNautica.png', 3, 10),
(49, 'Camara fotografica Lumix', 'Lumix', 4500, 1, 5, 0, '', 'lumix.png', 2, 12),
(50, 'Set de Bolsos para viaje', 'Lous Vuitton', 2500, 1, 5, 0, '', 'maletaybolso.png', 1, 5),
(51, 'Set de MAquillaje', 'Lamcome', 2000, 1, 5, 3, '', 'maquillaje.png', 1, 10),
(52, 'Mesa Vidrio_LivingRoom', 'DecoArt', 2200, 1, 5, 1, '', 'mesacentral.png', 2, 1),
(53, 'Mesa_para Living Room', 'DecoArt', 3000, 1, 5, 1, '', 'mesaDecoracion.png', 1, 1),
(54, 'Camara Nikon_fotografica', 'Nikon', 6000, 1, 5, 0, '', 'nikon.png', 2, 12),
(55, 'Perforadora_oficina', 'Epson', 3000, 1, 5, 0, '', 'perforadora.png', 2, 6),
(56, 'Juego de Bolsos_Viaje', 'Lous Vuitton', 5000, 1, 5, 0, '', 'SetBolsosLV.png', 1, 5),
(57, 'Silla rotatoria_oficina', 'SFEF', 900, 1, 4, 0, '', 'silla.png', 3, 6),
(58, 'Silla de jardin', 'DecoArt', 1200, 1, 5, 0, '', 'sillapiscina.png', 2, 1),
(59, 'Silla_metalica_hogar', 'DecoArt', 2300, 1, 5, 0, '', 'Silla_metal.png', 3, 1),
(60, 'Camara_digital_fotografica ', 'Sony', 5400, 1, 5, 0, '', 'sonycibershot.png', 2, 12),
(61, 'Teatro en Casa', 'LG', 6500, 1, 5, 1, '', 'teatroenCasa.png', 3, 2),
(62, 'Amortiguadores', 'xxxxxx', 500, 4, 5, 5, '', 'amortiguadores.png', 3, 11),
(63, 'Llantas', 'Bridgestone', 800, 2, 5, 10, '', 'llantas.png', 2, 11),
(64, 'Casco Motocicleta', 'Yamaha', 1000, 1, 5, 10, '', 'casco.png', 2, 11),
(65, 'Rines para LLanta', 'Bridgestone', 1200, 4, 5, 10, '20 plgs', 'rin_llanta.png', 3, 11),
(66, 'Camara de Video', 'Sony', 8000, 1, 4, 15, '', 'camara_video.png', 1, 7),
(67, 'Bicicleta Estatica', 'Weston', 4400, 1, 4, 20, '', 'bici_estatica.png', 2, 3),
(68, 'Maquina de Ejercicio', 'Weston', 3000, 1, 5, 5, '', 'maquina_ejercicio.png', 3, 3),
(69, 'Maquina de Pesas', 'Wilson', 5500, 1, 5, 10, '', 'maquina_pesas.png', 2, 3),
(70, 'Mesa de Pin Pon', 'Weston', 3400, 1, 4, 10, '', 'mesa_pingpong.png', 1, 3),
(71, 'Pesas !kg', 'Wilson', 200, 2, 4, 15, '', 'pesas.png', 1, 3),
(72, 'Raquetas de Tenis', 'Wilson', 350, 2, 5, 20, '', 'raquetas.png', 3, 3),
(73, 'Archivero de Oficina', 'dfsdfdfsd', 4300, 1, 4, 5, '', 'archivero.png', 3, 8),
(74, 'Escritorio para PC', 'DecoArt', 3500, 1, 5, 23, '', 'escritorio_pc.png', 2, 8),
(75, 'Escritorio Oficina', 'DecoArt', 3000, 1, 4, 10, '', 'escritorio1.png', 2, 8),
(76, 'Silla Ejecutiva', 'DecoArt', 2300, 1, 5, 20, '', 'silla_ejecutiva.png', 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`, `descripcion`) VALUES
(1, 'Casa y jardín', ''),
(2, 'Electrónica', ''),
(3, 'Equipamiento deportivo', ''),
(4, 'Juegos y juguetes', ''),
(5, 'Maletas y bolsos de viaje', ''),
(6, 'Material de oficina', ''),
(7, 'Medios audiovisuales', ''),
(8, 'Mobiliario', ''),
(9, 'Ropa y accesorios', ''),
(10, 'Salud y belleza', ''),
(11, 'Vehículos y recambios', ''),
(12, 'Óptica y fotografía', ''),
(13, 'Otros', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre_ciudad` varchar(50) NOT NULL,
  `id_pais` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre_ciudad`, `id_pais`) VALUES
(1, 'Boston', 1),
(2, 'Chicago', 1),
(3, 'Las Vegas', 1),
(4, 'Los Ángeles', 1),
(5, 'Nueva York', 1),
(6, 'Washington', 1),
(7, 'Toronto', 2),
(8, 'Burnaby', 2),
(9, 'Montreal', 2),
(10, 'Ottawa', 2),
(11, 'Acapulco', 3),
(12, 'Ciudad de Mexico', 3),
(13, 'Leon', 3),
(14, 'Monterrey', 3),
(15, 'Guadalajara', 3),
(16, 'Pachuca', 3),
(17, 'Belmopan', 4),
(18, 'Ciudad de Belice', 4),
(19, 'Punta Gorda', 4),
(20, 'Antigua Guatemala', 5),
(21, 'Chiquimula', 5),
(22, 'San Benito', 5),
(23, 'Chimaltenango', 5),
(24, 'Acajutla', 6),
(25, 'Chalchuapa', 6),
(26, 'La Union', 6),
(27, 'San Salvador', 6),
(28, 'San Vicente', 6),
(29, 'Comayagua', 7),
(30, 'El Progreso', 7),
(31, 'Roatan', 7),
(32, 'San Pedro Sula', 7),
(33, 'Siguatepeque', 7),
(34, 'Tegucigalpa', 7),
(35, 'Puerto Cortez', 7),
(36, 'La Paz', 7),
(37, 'Juticalpa', 7),
(38, 'Chichigalpa', 8),
(39, 'Ciudad Sandino', 8),
(40, 'Managua', 8),
(41, 'Puerto Cabezas', 8),
(42, 'San Carlos', 8),
(43, 'Leon', 8),
(44, 'Alajuela', 9),
(45, 'Esparza', 9),
(46, 'San Diego', 9),
(47, 'San Francisco', 9),
(48, 'San Vicente', 9),
(49, 'Puntarenas', 9),
(50, 'Bocas del Toro', 10),
(51, 'Ciudad de Panama', 10),
(52, 'Ciudad de Colon', 10),
(53, 'La Palma', 10),
(54, 'La Concepcion', 10),
(55, 'Puerto Escondido', 10),
(56, 'Sabanitas', 10),
(57, 'Vista Alegre', 10),
(58, 'Buenos Aires', 11),
(59, 'Córdoba', 11),
(60, 'Santa Fe', 11),
(61, 'Bariloche', 11),
(62, 'Belo Horizonte', 12),
(63, 'Boa Vista', 12),
(64, 'Brasilia', 12),
(65, 'Curitiba', 12),
(66, 'Fortaleza', 12),
(67, 'Manaos', 12),
(68, 'Punta Arenas', 13),
(69, 'Angol', 13),
(70, 'Arica', 13),
(71, 'Viña del Mar', 13),
(72, 'Arauca', 14),
(73, 'Armenia', 14),
(74, 'Bogotá', 14),
(75, 'Caracas', 15),
(76, 'Maracaibo', 15),
(77, 'Valencia', 15),
(78, 'Ciudad Bolívar', 15),
(79, 'Ibarra', 16),
(80, 'Quito', 16),
(81, 'La Libertad', 16),
(82, 'Astrakhan', 17),
(83, 'Barnaul', 17),
(84, 'Moscú', 17),
(85, 'Samara', 17),
(86, 'Amersfoort', 18),
(87, 'Amsterdam', 18),
(88, 'Bolduque', 18),
(89, 'La Haya', 18),
(90, 'Estrasburgo', 19),
(91, 'Lourdes', 19),
(92, 'París', 19),
(93, 'Sedán', 19),
(94, 'Madrid', 20),
(95, 'Barcelona', 20),
(96, 'Valencia', 20),
(97, 'Sevilla', 20),
(98, 'Bilbao', 20),
(99, 'Malaga', 20),
(100, 'Ancona', 21),
(101, 'Florence', 21),
(102, 'Génova', 21),
(103, 'Roma', 21),
(104, 'Lausana', 22),
(105, 'Solothurn', 22),
(106, 'Lucerna', 22),
(107, 'Ginebra', 22),
(108, 'Lisboa', 23),
(109, 'Oporto', 23),
(110, 'Braga', 23),
(111, 'Aveiro', 23),
(112, 'Tan-shui', 24),
(113, 'Hua-lien', 24),
(114, 'Chu-tung', 24),
(115, 'Feng-shan', 24),
(116, 'Chi-lung', 24),
(117, 'Kao-hsiung', 24),
(118, 'Tegucigalpa', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL,
  `codigo_telefonico` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre_pais`, `codigo_telefonico`) VALUES
(1, 'Estados Unidos', '+1'),
(2, 'Canada', '+1'),
(3, 'Mexico', '+52'),
(4, 'Belice', '+501'),
(5, 'Guatemala', '+502'),
(6, 'El Salvador', '+503'),
(7, 'Honduras', '+504'),
(8, 'Nicaragua', '+505'),
(9, 'Costa Rica', '+506'),
(10, 'Panama', '+507'),
(11, 'Argentina', '+54'),
(12, 'Brasil', '+55 '),
(13, 'Chile', '+56'),
(14, 'Colombia', '+57'),
(15, 'Venezuela', '+58'),
(16, 'Ecuador', '+593'),
(17, 'Rusia', '+7'),
(18, 'Paises Bajos', '+31'),
(19, 'Francia', '+33'),
(20, 'España', '+34'),
(21, 'Italia', '+39'),
(22, 'Suiza', '+41'),
(23, 'Portugal', '+351'),
(24, 'China', '+86');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(150) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `numero_telefonico` varchar(15) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `foto_usuario` longtext NOT NULL,
  `id_ciudad` int(3) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `fecha_nacimiento`, `sexo`, `numero_telefonico`, `correo_electronico`, `contrasena`, `foto_usuario`, `id_ciudad`, `admin`) VALUES
(1, 'Sindy Danely Garcia', '1991-05-06', 'Femenino', '22460424', 'sindy_danely@gmail.com', '0186b112fb0406696ff3b32386866a09', 'sindy.jpg', 29, 1),
(2, 'Edson Froylan Bonilla', '1990-05-06', 'Masculino', '22551043', 'edson_bonilla@hotmail.com', '822d163155fcfc5f88618dae47d4a38d', 'edson.jpg', 11, 0),
(3, 'Erick Alexander Zelaya', '1991-12-24', 'Masculino', '22304585', 'erick_zelaya@yahoo.com', '5b7179cff6a78c5e43ea6acaefb21431', 'erick.jpg', 12, 0),
(4, 'Ana Izaguirre', '1991-02-02', 'Femenino', '22697845', 'ana_izaguirre@gmail.com', 'c5c5ef2caf75f0756da2a9b38d586782', 'ana.jpg', 31, 0),
(14, 'Roos Geller', '2014-08-01', 'Masculino', '23423423', 'rossy@yahoo.com', '078d2bb3be8edc3e4658ef90e19f76c4', 'ross.jpg', 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_articulo`
--

CREATE TABLE IF NOT EXISTS `usuario_articulo` (
  `id_usuario` int(10) NOT NULL,
  `id_articulo` int(15) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_articulo`
--

INSERT INTO `usuario_articulo` (`id_usuario`, `id_articulo`, `fecha_compra`, `cantidad`) VALUES
(1, 9, '2014-08-14 21:25:43', 2),
(1, 13, '2014-08-14 21:25:43', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
