-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-10-2022 a las 18:22:03
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
-- Base de datos: `bd_subastas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'flores'),
(2, 'pajaros'),
(3, 'muebles'),
(4, 'casas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ca_imagenes_items` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(1, 2, 'imagen_paloma.jpg'),
(2, 1, 'imagen_cactus.jpg'),
(3, 2, 'imagen_paloma_01.jpg'),
(4, 2, 'imagen_paloma_02.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechafin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ca_items_usuarios` (`id_user`),
  KEY `ca_items_categorias` (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 1, 'cactus', 12, 'flores de cactus', '2022-10-19 00:00:00'),
(2, 2, 2, 'paloma', 15, 'paloma blanca', '2022-10-19 00:00:00'),
(3, 3, 1, 'cama', 1200, 'mueble de habitcion', '2022-10-19 00:00:00'),
(4, 3, 2, 'comoda', 2000, 'mueble de salon', '2022-10-20 01:00:00'),
(5, 4, 1, 'bungalow', 120000, 'casas de campo', '2022-10-19 00:00:00'),
(6, 4, 2, 'cabaña', 15000, 'casas arbol', '2022-10-19 00:00:00'),
(7, 1, 1, 'monstera', 150, 'Planta de interior', '2023-01-01 00:00:00'),
(8, 1, 1, 'geranio', 150, 'Planta de interior', '2023-01-01 00:00:00'),
(9, 1, 1, 'Cala', 150, 'Planta de interior', '2023-01-01 00:00:00'),
(10, 1, 2, 'adgfhsfsad', 67, 'asdfdfghrsh', '2022-10-31 04:30:00'),
(11, 1, 2, 'asdfghf', 4555, 'asdgfghf', '2022-10-30 00:00:00');

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
  KEY `ca_pujas_items` (`id_item`),
  KEY `ca_pujas_usuarios` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(1, 1, 1, 2, '2022-10-19'),
(2, 2, 2, 3, '2022-10-19'),
(3, 1, 1, 2, '2020-10-19'),
(4, 3, 2, 3, '2020-10-19'),
(5, 3, 1, 2, '2019-10-19'),
(6, 3, 2, 3, '2019-10-19'),
(11, 6, 2, 150000, '2021-10-10'),
(12, 5, 1, 600000, '2021-11-11'),
(13, 6, 1, 15000, '2021-10-16'),
(14, 5, 2, 6000, '2021-10-17'),
(15, 2, 2, 4, '2022-10-23'),
(16, 2, 2, 5, '2022-10-23'),
(17, 2, 2, 6, '2022-10-23'),
(18, 1, 2, 3, '2022-10-27'),
(19, 1, 3, 4, '2022-10-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cadenaverificacion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `false` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `false`) VALUES
(1, 'amaiadci', 'amaia', '123456', 'amaia.dlci@gmail.com', 'verific', 1, 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 1, 1),
(3, 'unai', 'unai', 'asdf', 'unaivn@gmail.com', 'verific', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `ca_imagenes_items` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `ca_items_categorias` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `ca_items_usuarios` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `ca_pujas_items` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `ca_pujas_usuarios` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
