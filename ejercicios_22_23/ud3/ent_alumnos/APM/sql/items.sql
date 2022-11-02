--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `preciopartida` float(20,2) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechafin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 1, 1, 'cactus', 12.00, 'flores de cactus', '2022-10-19 00:00:00'),
(2, 2, 2, 'paloma', 15.00, 'paloma blanca', '2022-10-19 00:00:00'),
(3, 3, 1, 'cama', 1200.00, 'mueble de habitcion', '2022-10-19 00:00:00'),
(4, 3, 2, 'comoda', 2000.00, 'mueble de salon', '2022-10-19 00:00:00'),
(5, 4, 1, 'bungalow', 120000.00, 'casas de campo', '2022-10-19 00:00:00'),
(6, 4, 2, 'cabaña', 15000.00, 'casas arbol', '2022-10-19 00:00:00'),
(7, 1, 1, 'monstera', 150.00, 'Planta de interior', '2023-01-01 00:00:00'),
(8, 1, 1, 'geranio', 150.00, 'Planta de interior', '2023-01-01 00:00:00'),
(9, 1, 1, 'Cala', 150.00, 'Planta de interior', '2023-01-01 00:00:00');