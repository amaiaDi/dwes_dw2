-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-10-2022 a las 19:39:29
-- Versión del servidor: 5.7.36
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Tabla de categorias';

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Real Madrid'),
(2, 'FC Barcelona'),
(3, 'PSG'),
(4, 'Manchester City'),
(5, 'Elche Club de futbol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_IMAGENES_ITEMS` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Imagenes';

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(1, 2, 'pantalonesRealMadrid.jpg'),
(2, 1, 'camisetaRealMadrid.jpg'),
(3, 3, 'camisetaBarcelona.jpg'),
(4, 4, 'pantalonesBarcelona.jpg'),
(7, 5, 'camisetaManchesterCity.jpg'),
(8, 6, 'pantalonesManchesterCity.jpg'),
(9, 7, 'camisetaPSG.jpg'),
(10, 8, 'pantalonesPSG.jpg'),
(11, 9, 'camisetaLevante.jpg'),
(12, 10, 'pantalonesLevante.jpg'),
(13, 1, 'camisetaRealMadrid2.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fechafin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ITEMS_CATEGORIA` (`id_cat`),
  KEY `FK_ITEMS_USUARIOS` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 1, 'Camiseta Real Madrid', 100, 'Camiseta Real Madrid', '2022-10-31'),
(2, 1, 2, 'Pantalones Real Madrid', 60, 'Pantalones Real Madrid', '2022-10-31'),
(3, 2, 1, 'Camiseta Barcelona', 90, 'Camiseta Barcelona', '2022-10-19'),
(4, 2, 2, 'Pantalon Barcelona', 40, 'Pantalon Barcelona', '2022-10-19'),
(5, 4, 1, 'Camiseta Manchester City', 95, 'Camiseta Manchester City', '2022-10-19'),
(6, 4, 2, 'Pantalon Manchester City', 60, 'Pantalon Manchester City', '2022-10-19'),
(7, 3, 2, 'Camiseta PSG', 90, 'Camiseta PSG', '2022-10-31'),
(8, 3, 2, 'Pantalon PSG', 60, 'Pantalon PSG', '2022-10-31'),
(9, 5, 2, 'Camiseta Elche', 75, 'Camiseta Elche', '2022-10-31'),
(10, 5, 2, 'Pantalon Elche', 40, 'Pantalon Elche', '2022-10-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

DROP TABLE IF EXISTS `pujas`;
CREATE TABLE IF NOT EXISTS `pujas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ITEMS_PUJAS` (`id_item`),
  KEY `FK_ITEMS_USUARIO` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Información relacionada con las pujas';

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(1, 1, 1, 100, '2022-10-19'),
(2, 9, 3, 90, '2022-10-19'),
(3, 3, 4, 20, '2022-10-27'),
(4, 1, 2, 120, '2022-10-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cadenaverificacion` varchar(100) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `false` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tabla con información de usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `false`) VALUES
(1, 'dani', 'dani', '123456789', 'dani@gmail.com', 'identific', 1, 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 1, 1),
(3, 'iker', 'iker', '123456789', 'iker@gmail.com', 'identific', 1, 0),
(4, 'llarena', 'llarena', '123456789', 'llarena@gmail.com', 'identific', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `IMAGENES_ITEMS` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `ITEMS_CATEGORIA` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `ITEMS_USUARIOS` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `ITEMS_PUJAS` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `ITEMS_USUARIO` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
