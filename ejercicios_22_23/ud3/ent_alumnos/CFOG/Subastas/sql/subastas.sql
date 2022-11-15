-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-10-2022 a las 21:03:38
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

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
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'Cine'),
(3, 'Mierda'),
(4, 'Videojuegos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`),
  KEY `id_item_2` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `id_item`, `imagen`) VALUES
(1, 57, 'blood_machines.jpg'),
(5, 62, 'hotline_miami_collection.jpg'),
(26, 65, 'scorn_00.jpg'),
(27, 65, 'scorn_01.jpg'),
(28, 65, 'scorn_02.jpg'),
(48, 63, 'esta_mierda_de_ejercicio.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fechafin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(57, 1, 1, 'Blood Machines', 4.2, 'An artificial intelligence escapes her spaceship to turn into a female ghost and challenges two blade runners to a galactic chase.', '2022-12-01 10:20:11'),
(62, 4, 1, 'Hotline Miami Collection', 15, 'Hotline Miami Collection contains both legendary games in the neon-soaked, brutally-challenging Hotline Miami series from Dennaton Games.', '2022-11-02 09:35:25'),
(63, 3, 1, 'Esta Mierda de Ejercicio', 1, 'Aplicación subastas', '2022-10-30 10:12:43'),
(65, 4, 1, 'Scorn', 39.99, 'Scorn es un juego evocador de aventuras de miedo en primera persona con un ambiente propio de un universo tenebroso plagado de formas extrañas y una complejidad lúgubre.', '2022-11-02 21:00:00'),
(68, 1, 1, 'Hot Shots', 49, 'Topper Harley, uno de los mejores pilotos de combate, abandona su retiro en una reserva india al ser llamado para participar en una peligrosa misión.', '2022-11-02 12:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puja`
--

DROP TABLE IF EXISTS `puja`;
CREATE TABLE IF NOT EXISTS `puja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puja`
--

INSERT INTO `puja` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(1, 63, 6, 2, '2022-10-26'),
(5, 57, 12, 4.5, '2022-10-30'),
(6, 57, 2, 5, '2022-10-30'),
(11, 57, 1, 5.5, '2022-10-30'),
(16, 62, 5, 16, '2022-10-30'),
(17, 68, 1, 99, '2022-11-01'),
(20, 57, 12, 5.65, '2022-10-30'),
(25, 57, 1, 15, '2022-10-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cadenaverificacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `falso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@jajasaludos.com', '', 1, 1),
(2, 'Elen Anito', 'Elena Sanz', 'Elen_Anito1234', 'elenanito@jajasaludos.com', '', 1, 1),
(3, 'Ander Zorri', 'Ander Rodriguez', 'Ander_Zorri1234', 'anderzorri@jajasaludos.com', '', 1, 1),
(5, 'Graphic Design is My Passion', 'Tania Alcudia', 'Graphic_Designer1234', 'graphicdesigner@jajasaludos.com', '', 1, 1),
(6, 'Patricia Txikita', 'Patricia Bastida', 'Patricia_Txikita1234', 'patriciatxikita@jajasaludos.com', '', 1, 1),
(12, 'patata', 'César Ferreiro', '1234', 'patata@example.com', 'OQvjZhiT7JWiqiva', 1, 0),
(13, 'Cuenta Sin Activar', 'Cuenta Sin Activar', '1234', 'cuentasinactivar@example.com', 'IrbtXMosBqY24Wf2', 0, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `CA_IMAGEN_ITEM` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `CA_ITEM_CATEGORIA` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CA_ITEM_USUARIO` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puja`
--
ALTER TABLE `puja`
  ADD CONSTRAINT `CA_PUJA_ITEM` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CA_PUJA_USUARIO` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
