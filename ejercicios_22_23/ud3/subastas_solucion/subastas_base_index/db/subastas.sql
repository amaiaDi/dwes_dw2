-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-11-2022 a las 20:45:45
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `subastas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Joyas'),
(2, 'Libros'),
(3, 'Cuadros'),
(4, 'Ceramica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_item` int NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(3, 1, 'collar1.jpg'),
(4, 2, 'david1.jpg'),
(6, 1, 'collar2.jpg'),
(7, 1, 'collar3.jpg'),
(8, 2, 'david2.jpg'),
(11, 30, 'nocheEstrellada1.jpg'),
(12, 30, 'nocheEstrellada2.jpg'),
(22, 31, 'anilloOro.jpg'),
(23, 31, 'anilloOro2.jpg'),
(24, 32, 'monet2.jpg'),
(25, 34, 'monet1.jpg'),
(28, 30, 'nocheEstrellada2_01.jpg'),
(29, 35, 'jarron.jpg'),
(30, 35, 'jarron2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cat` int NOT NULL,
  `id_user` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fechafin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 19, 'Diamante Wittelsbach-Graff', 80000000, 'Se trata de uno de los diamantes más grandes del mundo, que se cree que fue extraído en el siglo XVII en el antiguo reino de Golconda.', '2020-10-27 00:00:00'),
(2, 2, 20, 'La Biblia de Gutenberg', 65000000, 'Fue una de las primeras biblias impresas por Gutenberg y que fue coloreada a mano', '2020-11-17 00:00:00'),
(30, 3, 23, 'Van Gogh - Noche estrellada', 15015000, 'Cuadro de Van Gohg- El cuadro La Noche Estrellada de Vincent Van Gogh es una de las obras más famosas del mundo, apreciada por décadas por sus formas sinuosas y azules profundos, para decorar es un gr', '2022-12-23 22:00:00'),
(31, 1, 23, 'Anillo Oro', 13000, 'Anillo de oro único fabricado artesanalmente en Madrid desde 1917. Descubre la joya de nuestra colección', '2023-05-06 19:00:00'),
(32, 3, 20, 'Monet', 150000, 'Cuadro Monet', '2022-11-16 17:00:00'),
(33, 4, 20, 'Ceramica Moche', 1501, 'La cerámica de la cultura Moche es una de las cumbres de la historia de la cerámica, son muy conocidas las cerámicas figurativas realistas, aunque en este caso traemos orta de las piezas más represent', '2022-11-16 12:00:00'),
(34, 3, 20, 'Monet Azul', 261500, 'Monet Azul', '2022-11-18 20:00:00'),
(35, 4, 20, 'Jarron Ming', 150000, 'Jarron MING', '2022-12-20 18:00:00'),
(36, 4, 23, 'Jarron nueva dinastia', 1500, 'Jarrones nuea dinastias', '2022-11-16 19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

DROP TABLE IF EXISTS `pujas`;
CREATE TABLE IF NOT EXISTS `pujas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_item` int NOT NULL,
  `id_user` int NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(6, 2, 20, 71000000, '2020-10-27'),
(7, 2, 20, 71000000, '2020-10-27'),
(47, 1, 19, 81000000, '2020-10-28'),
(48, 1, 20, 82000000, '2020-10-28'),
(50, 2, 19, 72000000, '2020-10-29'),
(52, 30, 20, 25000000, '2022-11-13'),
(53, 30, 23, 25006000, '2022-11-13'),
(54, 30, 23, 5000000000, '2022-11-13'),
(55, 33, 23, 2000, '2022-11-14'),
(56, 33, 23, 25000000, '2022-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cadenaverificacion` varchar(100) NOT NULL,
  `activo` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`) VALUES
(19, 'ander', 'Ander', 'ander', 'dwes.icj@gmail.com', 'uzHupQURFXFjG@dY', 1),
(20, 'admin', 'admin', 'admin', 'dwes.icj@gmail.com', 'bhMQK6a/Ke?rIOdS', 1),
(21, 'ibai', 'ibai', 'ibai', 'dwes.icj@gmail.com', 'AdNyWQLrz*UV1?mF', 1),
(23, 'amaia', 'amaia', 'amaia', 'dwes.icj@gmail.com', 'psB3WYfFOfcO6Pis', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `pujas_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `pujas_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
