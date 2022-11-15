-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-10-2022 a las 15:07:08
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Tabla de categorias';

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'comida'),
(2, 'tecnologia'),
(3, 'licencias'),
(4, 'exclusividades'),
(5, 'futbol');

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
  KEY `IMAGENES_ITEMS` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='Imagenes';

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(1, 1, 'sandia.jpg'),
(2, 2, 'champions.jpg'),
(3, 3, 'camisetacopa.jpg'),
(4, 6, 'camisetauefa.jpg'),
(5, 8, 'arbitro.jpg'),
(6, 9, 'arbitro2.jpg'),
(7, 4, 'portatilusado.jpeg'),
(8, 5, 'proyector.jpeg'),
(9, 10, 'manosdeprogramador.jpeg'),
(10, 11, 'auricular.jpeg'),
(11, 12, 'txipirones.jpg'),
(12, 13, 'euro.jpg'),
(13, 14, 'alpineRoto.jpg'),
(14, 15, 'pelo.jpeg'),
(15, 17, 'cacahuetes.jpg'),
(16, 18, 'cono.jpg'),
(17, 19, 'licenciaObra.jpg'),
(18, 20, 'tatuajeDivino.jpg'),
(19, 21, 'vehiculoSegundaMano.jpeg'),
(20, 22, 'webinutil.gif'),
(21, 23, 'licenciawindows.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 4, 'Sandia', 2, 'Sandia bien fresca', '2022-10-19'),
(2, 5, 3, 'Champions', 100000000, 'Champions', '2022-10-19'),
(3, 5, 1, 'Camiseta Alaves Copa', 100, 'Camiseta de la final de la COPA', '2022-10-19'),
(4, 2, 4, 'Portatil', 50, 'Portatil usado por madridista aferrimo', '2025-10-14'),
(5, 2, 1, 'Proyector', 1, 'Proyector de la clase DW2', '2023-10-27'),
(6, 5, 1, 'Camiseta Alaves UEFA', 200, 'Camiseta de la final de la UEFA', '2022-10-19'),
(7, 1, 3, 'Melocoton', 3, 'Melocotón bien jugoso, de esos que te tienes que lavar las manos si no quieres parecer una ventosa andante.', '2025-10-02'),
(8, 5, 3, 'Arbitro', 2000000, 'ROBAR partido', '2023-01-06'),
(9, 5, 3, 'Arbitro', 1500000, 'ROBAR partido', '2023-01-01'),
(10, 2, 4, 'Manos De Programador', 500000, 'Manos de programador auténticas, experto en su materia', '2030-10-11'),
(11, 2, 4, 'Auricular', 40, 'Auricular solitario blutud (nunca supe como se escribe)\r\nIncluye una barba bien fresca, de salir viernes noche y no volver hasta lunes', '2024-02-02'),
(12, 1, 1, 'Txipirones', 60, 'Unos txipirones bien sabrosos', '2024-02-02'),
(13, 4, 3, '1 euro', 2, 'Es 1€ pero te lo vendo por 2, porque puedo.', '2022-10-31'),
(14, 4, 5, 'Alpine roto', 5000000, 'Alpine de don Fernando Alonso, roto tras la colisión con Stroll.\r\nPuedes pilotarlo como coche o como avión, a tu gusto.\r\nEl fondo plano ya no es plano.', '2022-10-13'),
(15, 4, 4, 'Pelo Marcelo', 900000, 'Pelo Marcelo, único en su especie', '2022-10-31'),
(16, 4, 3, 'Capa invisible', 20000000, 'Capa de segunda mano. Si la llevas puesta mucho tiempo te pica todo el cuerpo. CUIDADO - no la dejes cerca del perro. No la va a morder porque no la ve, pero si se le cae encima te quedas sin perro.', '2027-10-24'),
(17, 1, 6, 'Cacahuetes de bar', 2, 'Cacahuetes para acompañar una buena charla con amigos', '2024-11-09'),
(18, 4, 5, 'Cono de trafico', 50, 'Cono de tráfico tirado en la calle. 50€ limpios y subiendo!', '2031-05-01'),
(19, 3, 4, 'Licencia de obra', 10000, 'Licencia que te permite reventar media ciudad. Cuidado con las excavadoras.', '2024-06-23'),
(20, 4, 4, 'Tatuaje espectacular', 60, 'Tatuaje espectacular! Incluye el brazo entero pero por 10€ más te doy solo el tatuaje.', '2022-11-10'),
(21, 4, 7, 'Coche', 15000, 'Coche de segunda mano, pocos kilometros. Vamos, lo que viene siendo el llevarlo del concesionario al parking. Buen estado, pequeño golpe de un arbol.', '2029-07-19'),
(22, 2, 5, 'Web fallida', 1, 'Intento de web, con etiquetas ocultas.', '2022-10-25'),
(23, 3, 3, 'Licencia de Windows', 50, 'Realmente la licencia es pirata. Pero funciona, que es lo que importa.', '2028-03-08');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Información relacionada con las pujas';

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(1, 3, 1, 120, '2022-10-19'),
(2, 6, 1, 250, '2022-10-19'),
(3, 8, 3, 2000000, '2020-10-19'),
(4, 9, 3, 2500000, '2020-10-19'),
(5, 3, 1, 2, '2019-10-19'),
(6, 15, 3, 30, '2022-10-26'),
(7, 14, 4, 5000000, '2022-10-26'),
(8, 14, 5, 5000000, '2022-10-26'),
(9, 16, 3, 25000000, '2022-10-12'),
(10, 1, 5, 500, '2022-10-28'),
(11, 3, 3, 600, '2022-10-13'),
(12, 21, 4, 20000, '2022-10-14');

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
  `falso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Tabla con información de usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'iker', 'iker', 'P@ssw0rd', 'iker@gmail.com', 'verific', 1, 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 1, 1),
(3, 'florentino', 'florentino', '14champions', 'suflorentineza@realmadrid.com', 'verific', 1, 0),
(4, 'dani', 'dani', 'bicho', 'danielongo@gmail.com', 'verific', 1, 0),
(5, 'llarena', 'llarena', 'gatitos', 'llarena@gmail.com', 'verific', 0, 0),
(6, 'trofonio', 'trofonio el rey', 'trofo', 'trofonio@elrey.com', 'verific', 0, 0),
(7, 'tuplon', 'tuplon', 'tuplon', 'tuplon', 'verific', 0, 0);

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
