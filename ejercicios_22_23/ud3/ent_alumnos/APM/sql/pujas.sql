--
-- Estructura de tabla para la tabla `pujas`
--

DROP TABLE IF EXISTS `pujas`;
CREATE TABLE IF NOT EXISTS `pujas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
(7, 6, 2, 150000, '2021-10-10'),
(8, 5, 1, 600000, '2021-11-11'),
(9, 6, 1, 15000, '2021-10-16'),
(10, 5, 2, 6000, '2021-10-17');