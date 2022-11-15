-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-10-2022 a las 18:58:56
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
-- Base de datos: `gestion_subastas`
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
(1, 'Joyas'),
(2, 'Libros'),
(3, 'Musica'),
(4, 'Vestimenta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `imagenes_items_id_item` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(1, 1, 'anillo_oro_diamantes.png'),
(2, 2, 'pulsera_oro_barra_diamantes_metal.png'),
(3, 3, 'colgante_wilde_zafiro_oro.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Cat` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechafin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `items_categorias_id_Cat` (`id_Cat`),
  KEY `items_usuaruis_id_User` (`id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_Cat`, `id_User`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 1, 'Anillo de oro con diamantes incrustado', 500, 'Anillo muy bonito', '2022-11-04 01:30:00'),
(2, 1, 1, 'Pulsera de Oro', 1000, 'Pulsera de lo mas elegante', '2022-10-20 12:30:00'),
(3, 1, 1, 'Colgante Wilde de zafiro y Oro', 750, 'Colgante de oro incrustado de zafiros', '2022-10-20 13:30:00'),
(4, 2, 1, 'El libro', 102, 'Es el libro', '2022-10-27 19:11:00'),
(5, 3, 1, 'Michael Jackson - Thriller', 12, 'Thriller es el sexto Ã¡lbum de estudio del artista estadounidense Michael Jackson, publicado el 30 de noviembre de 1982 por Epic Records.', '2023-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

DROP TABLE IF EXISTS `pujas`;
CREATE TABLE IF NOT EXISTS `pujas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pujas_Items_id_item` (`id_item`),
  KEY `pujas_usuarios_id_User` (`id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_User`, `cantidad`, `fecha`) VALUES
(1, 1, 2, 750, '2022-10-14'),
(2, 2, 3, 1100, '2022-10-15'),
(3, 1, 4, 800, '2022-10-18'),
(4, 1, 1, 900, '2022-10-20'),
(12, 1, 1, 1000, '2022-10-20'),
(13, 1, 1, 1000.5, '2022-10-20');

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
  `falso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'sergi1025', 'Sergio Groppa', '1234', 'sergio@gmail.com', '123654789', 1, 0),
(2, 'goldenLemon', 'Ander Panera', '12456', 'ander.p@gmail.com', '0987654321', 1, 0),
(3, 'volt', 'Pablo Gonzalez', '12456', 'pablo.g@gmail.com', '123123123', 0, 0),
(4, 'marcosEsDios', 'Marcos Vázquez', '12345', 'marcos.vz@gmail.com', '1233445657', 1, 0),
(5, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'grbmT9lvJI7Uy2Nj', 0, 1),
(6, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'iEM16gjoDUFTspLG', 0, 1),
(7, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'YhSMGPlvb7KZRcI3', 0, 1),
(8, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'KARiNEaX7tZ5rPh4', 0, 1),
(9, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'ySOxeb30FWhiaqC1', 0, 1),
(10, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'oLWJ5AdC73RtPyfa', 0, 1),
(11, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'tCzPmKuU5N2nj0M3', 0, 1),
(12, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'QUNdK9ynwIYRPFCb', 0, 1),
(13, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', '7kbAYemHDQzM0Wj2', 0, 1),
(14, 'mensaje_sergio', 'sergio Mensaje', '1234', 'sergiodanielgroppa@gmail.com', 'WVSl9NYL1bEK82TP', 0, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_items_id_item` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_categorias_id_Cat` FOREIGN KEY (`id_Cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `items_usuaruis_id_User` FOREIGN KEY (`id_User`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `pujas_Items_id_item` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `pujas_usuarios_id_User` FOREIGN KEY (`id_User`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
