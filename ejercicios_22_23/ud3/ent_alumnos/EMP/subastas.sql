-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-10-2022 a las 22:47:12
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
  `categoria` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla de categorias';

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Videojuegos'),
(2, 'Pelis'),
(3, 'Series'),
(4, 'Música');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_IMAGENES_ITEMS` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Imagenes';

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`) VALUES
(1, 2, 'TLoU2.jpg'),
(2, 1, 'TLoU.jpg'),
(3, 3, 'uncharted1.jpg'),
(4, 4, 'uncharted2.jpg'),
(5, 5, 'uncharted3.jpg'),
(6, 6, 'uncharted4.jpg'),
(7, 7, 'NoWayHome.jpg'),
(8, 8, 'suits.jpg'),
(9, 1, 'TLoU_Ellie.jpg'),
(10, 1, 'TLoU_Ellie_y_Joel.jpg'),
(11, 1, 'TLoU_Joel.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `fechafin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ITEMS_CATEGORIA` (`id_cat`),
  KEY `FK_ITEMS_USUARIOS` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 1, 'The Last of Us Part I', 12, 'The Last of Us transcurre en un mundo posapocalíptico. La cepa de un hongo, de nombre Cordyceps, provocó una pandemia devastadora para el mundo. Si lo anterior no fuera suficiente, las personas contagiadas se convierten en criaturas agresivas con aires de zombis —no pueden ver y ubican a sus presas por medio del sonido—. La historia nos pone en los pies de Joel, quien apenas iniciar sufre una tragedia familiar que lo marca para siempre. Tiempo después, por esos giros repentinos de la vida, al protagonista se le encomienda una misión: escoltar a una niña hasta un asentamiento a las afueras de Boston.\r\n\r\nLa menor, de nombre Ellie, resulta ser inmune a la enfermedad. Joel comprende que mantenerla a salvo y cumplir con la misión es el primer paso para el posible hallazgo de una cura. Ahora bien, atravesar la ciudad del estado de Massachusetts se convierte en un reto mayúsculo, pues gran parte de la región está infestada de todo tipo de criaturas. La narrativa involucra momentos crudos, viscerales y dolorosos. Las complicadas vivencias que Joel y Ellie sufren juntos los llevan a desarrollar una relación muy cercana, casi de padre-hija.', '2022-11-01 02:00:00'),
(2, 1, 2, 'The Last of Us Part II', 15, 'Cinco años después de su peligroso viaje por un Estados Unidos postapocalíptico, Ellie y Joel se han asentado en Jackson, Wyoming. La vida en una próspera comunidad de supervivientes les ha permitido disfrutar de paz y estabilidad, a pesar de la amenaza constante de los infectados y de otros supervivientes más desesperados.\n\nSin embargo, tras un hecho violento que altera esa paz, Ellie se embarca en un viaje implacable en busca de justicia. A medida que va dando caza a los culpables uno a uno, deberá afrontar las devastadoras consecuencias, tanto físicas como emocionales, de sus acciones.', '2022-10-19 00:00:00'),
(3, 1, 1, 'Uncharted: El tesoro de Drake', 46, 'UNCHARTED: Drake\'s Fortune o UNCHARTED: El tesoro de Drake es la primera entrega de la serie Uncharted, desarrollada por Naughty Dog y publicada por Sony Computer Entertainment. Anunciado originalmente en el E3 de 2006, el título se desarrolló durante aproximadamente dos años antes de ser lanzado el 19 de noviembre de 2007 para PlayStation 3. En octubre de 2015, como parte de la promoción de A Thief\'s End, Drake\'s Fortune fue lanzado junto con su dos secuelas de PS3 como parte de Uncharted: The Nathan Drake Collection, remasterizado por Bluepoint Games para PlayStation 4.', '2022-10-28 12:32:11'),
(4, 1, 1, 'Uncharted 2: El reino de los ladrones', 50, 'Ambientada dos años después de los eventos de \"El tesoro de Drake\", \"El reino de los ladrones\" sigue a Nathan Drake y Chloe Frazer en su búsqueda de la entrada a la ciudad perdida de Shambhala y la legendaria Piedra Cintamani en una carrera contra el criminal de guerra serbio Zoran Lazarević y su ejército de mercenarios.', '2022-10-24 10:35:46'),
(5, 1, 1, 'Uncharted 3: La traición de Drake', 40, 'UNCHARTED 3: Drake\'s Deception o UNCHARTED 3: La tración de Drake es un juego de disparos en tercera persona de acción y aventura y la secuela de UNCHARTED 2: El reino de los ladrones. Es la tercera entrega de la saga UNCHARTED, lanzada el 1 de noviembre de 2011 para América del Norte, el 2 de noviembre de 2011 para Europa y Japón y el 3 de noviembre de 2011 para Australia. El juego es el primero de la serie que admite 3D estereoscópico de alta resolución. También recibió el premio al \"Mejor juego de PS3\" en los premios Spike TV Video Game Awards 2011.', '2022-10-24 10:37:28'),
(6, 1, 1, 'Uncharted 4: El desenlace del ladrón', 54, 'Ambientada tres años después de la conclusión de \"La traición de Drake\", \"El desenlace del ladrón\" sigue a Nathan Drake, ahora un cazador de fortunas retirado, mientras se reúne con su hermano Samuel, perdido hace mucho tiempo, y busca salvarlo de un tirano despiadado al emprender otra aventura. que implica encontrar el legendario tesoro pirata legendario del capitán Henry Avery.', '2022-10-24 10:38:29'),
(7, 2, 1, 'Spider-Man: No Way Home', 200, 'Tras descubrirse la identidad secreta de Peter Parker como Spider-Man, la vida del joven se vuelve una locura. Peter decide pedirle ayuda al Doctor Extraño para recuperar su vida. Pero algo sale mal y provoca una fractura en el multiverso.', '2022-10-24 10:48:06'),
(8, 3, 1, 'SUITS', 57, 'El gran abogado corporativo de Manhattan, Harvey Specter y su equipo, Donna Paulsen, Louis Litt y Alex Williams, se lanzan a un juego por obtener el poder cuando un nuevo socio se une a la empresa. Con sus dos mejores colegas fuera y Jessica de regreso en Chicago, Specter y el equipo intentan adaptarse a una nueva situación sin ellos. El grupo enfrenta traiciones, relaciones fieras y secretos que finalmente salen a la luz. Viejas y nuevas rivalidades aparecen entre los miembros del equipo a medida que aprenden a lidiar con el recién llegado.', '2022-10-24 10:53:32'),
(9, 4, 1, 'The Last of Us: Main Theme', 4999.99, 'Tema principal del videojuego The Last of US, compuesta por Gustavo Santaolalla', '2022-10-24 10:53:56'),
(10, 3, 2, 'DareDevil', 500.3, 'Daredevil gira en torno a Matt Murdock, un abogado de día y superhéroe de noche. A pesar de ser ciego, posee un oído, un olfato, una fuerza y una agilidad increíblemente desarrolladas. Sin descanso, Matt Murdoch recorrerá las calles de Hell`s Kitchen, en Nueva York, a la caza de todo tipo de criminales a los que no puede castigar un tribunal.', '2023-11-17 15:45:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Información relacionada con las pujas';

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`, `fecha`) VALUES
(1, 1, 1, 200.5, '2022-10-19'),
(2, 2, 2, 3, '2022-10-19'),
(7, 1, 1, 250, '2022-10-27'),
(8, 1, 1, 280, '2022-10-27'),
(9, 1, 2, 800, '2022-10-27'),
(10, 1, 2, 4800, '2022-10-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cadenaverificacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `falso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla con información de usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'edgar', 'edgar', '12345678', 'edgarmartinezdw2@gmail.com', '', 1, 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 1, 1),
(6, 'edgar2', 'Edgar', '123', 'edgarstreet03@gmail.com', 'X,Ebl6u{j154ZL9m', 0, 0),
(8, 'edgar3', 'e', 'e', 'e', 'j$+MUiNK8}oy,?y', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_IMAGENES_ITEMS` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_ITEMS_CATEGORIA` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `FK_ITEMS_USUARIOS` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `FK_ITEMS_PUJAS` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `FK_ITEMS_USUARIO` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
