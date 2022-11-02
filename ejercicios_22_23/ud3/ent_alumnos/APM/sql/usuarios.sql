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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'ander', 'ander', 'dw2', 'ander@gmail.com', 'verificado', 1, 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 1, 1);