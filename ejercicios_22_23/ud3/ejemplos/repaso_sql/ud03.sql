-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-10-2022 a las 16:34:08
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
-- Base de datos: `ud03`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL,
  `categoria` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla de categorias';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int NOT NULL,
  `id_item` int NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_IMAGENES_ITEMS` (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Imagenes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL,
  `id_cat` int NOT NULL,
  `id_user` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fechafin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ITEMS_CATEGORIA` (`id_cat`),
  KEY `FK_ITEMS_USUARIOS` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

DROP TABLE IF EXISTS `pujas`;
CREATE TABLE IF NOT EXISTS `pujas` (
  `id` int NOT NULL,
  `id_item` int NOT NULL,
  `id_user` int NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ITEMS_PUJAS` (`id_item`),
  KEY `FK_ITEMS_USUARIO` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Información relacionada con las pujas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL,
  `username` varchar(40) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cadenaverificacion` varchar(100) NOT NULL,
  `activo` tinyint NOT NULL,
  `false` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Tabla con información de usuarios';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_IMAGENES_ITEMS` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_ITEMS_CATEGORIA` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_ITEMS_USUARIOS` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `FK_ITEMS_PUJAS` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_ITEMS_USUARIO` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
