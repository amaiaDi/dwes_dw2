-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-10-2022 a las 09:56:02
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
  `categoria` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'FPS'),
(2, 'Historia'),
(3, 'Simulacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_imagenes_items` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(1, 1, 'CSGO1.jpg'),
(2, 2, 'Valo1.jpg'),
(3, 4, 'TLOU1.jpg'),
(4, 5, 'Forza1.jpg'),
(5, 6, 'Assetto.jpg'),
(6, 1, 'CSGO2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechafin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_items_categorias` (`id_cat`),
  KEY `FK_items_usuarios` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 1, 'CS:GO', 1, 'Counter Strike: Global Ofensive.\r\nValve inc.', '2022-10-31 17:38:33'),
(2, 1, 1, 'Valorant', 1, 'Valorant 2020\r\nRiot Games', '2022-10-31 12:04:36'),
(3, 2, 1, 'The Last of Us ', 50, 'The Last of Us 2013\r\nPS3 Naugthy Dog', '2022-10-31 09:26:47'),
(4, 2, 1, 'The Last of Us: Parte 2', 30, 'The Last of Us: Parte 2 2020\r\nPS4 Naugthy Dog', '2022-10-31 14:26:39'),
(5, 3, 1, 'Forza Horizon 5', 10, 'Forza Horizon 5 2021\r\nPlayground Games', '2022-10-25 07:06:47'),
(6, 3, 1, 'Assetto Corsa', 20, 'Assetto Corsa 2014\r\n505 Games', '2022-10-31 09:07:51');

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
  KEY `FK_pujas_items` (`id_item`),
  KEY `FK_pujas_usuarios` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(1, 1, 1, 200, '2022-10-31'),
(2, 1, 1, 201, '2022-10-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cadenaverificacion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `falso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_imagenes_items` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_items_categorias` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `FK_items_usuarios` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `FK_pujas_items` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `FK_pujas_usuarios` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
