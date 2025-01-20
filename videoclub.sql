-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2025 a las 23:22:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosdevolucion`
--

CREATE TABLE `estadosdevolucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadosdevolucion`
--

INSERT INTO `estadosdevolucion` (`id`, `nombre`) VALUES
(1, 'A tiempo'),
(2, 'Retrasado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadospeliculas`
--

CREATE TABLE `estadospeliculas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadospeliculas`
--

INSERT INTO `estadospeliculas` (`id`, `nombre`) VALUES
(3, 'Alquilada'),
(5, 'Devolucion'),
(1, 'Disponible'),
(4, 'No disponible'),
(2, 'Reservada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`) VALUES
(1, 'Acción'),
(4, 'Ciencia ficción'),
(2, 'Comedia'),
(3, 'Drama'),
(5, 'Horror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pelicula_id` int(11) NOT NULL,
  `tipo_accion_id` int(11) NOT NULL,
  `fecha_accion` datetime NOT NULL,
  `fecha_prevista_devolucion` datetime DEFAULT NULL,
  `estado_devolucion_id` int(11) DEFAULT NULL,
  `codigo_operacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `usuario_id`, `pelicula_id`, `tipo_accion_id`, `fecha_accion`, `fecha_prevista_devolucion`, `estado_devolucion_id`, `codigo_operacion`) VALUES
(113, 2, 32, 2, '2025-01-20 23:19:44', NULL, NULL, 33),
(114, 3, 15, 2, '2025-01-20 23:19:54', NULL, NULL, 34),
(115, 4, 7, 2, '2025-01-20 23:20:03', NULL, NULL, 35),
(116, 4, 26, 2, '2025-01-20 23:20:08', NULL, NULL, 36),
(117, 2, 32, 3, '2025-01-13 00:00:00', '2025-01-23 00:00:00', NULL, 33),
(118, 3, 15, 3, '2025-01-15 00:00:00', '2025-01-31 00:00:00', NULL, 34),
(119, 4, 26, 3, '2025-01-21 00:00:00', '2025-01-30 00:00:00', NULL, 36),
(120, 3, 15, 5, '2025-01-29 00:00:00', '0000-00-00 00:00:00', 1, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `codigo_operacion` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pelicula_id` int(11) NOT NULL,
  `fecha_operacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`codigo_operacion`, `usuario_id`, `pelicula_id`, `fecha_operacion`) VALUES
(33, 2, 32, '2025-01-20 23:19:44'),
(34, 3, 15, '2025-01-20 23:19:54'),
(35, 4, 7, '2025-01-20 23:20:03'),
(36, 4, 26, '2025-01-20 23:20:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `anio` year(4) NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `genero_id`, `anio`, `estado_id`) VALUES
(1, 'Matrix', 4, '1999', 1),
(2, 'The Dark Knight', 1, '2008', 1),
(3, 'The Shining', 5, '1980', 1),
(4, 'Inception', 4, '2010', 1),
(5, 'Titanic', 3, '1997', 1),
(6, 'Jurassic Park', 1, '1993', 1),
(7, 'The Godfather', 3, '1972', 2),
(8, 'Pulp Fiction', 3, '1994', 1),
(9, 'The Matrix Reloaded', 4, '2003', 1),
(10, 'The Avengers', 1, '2012', 1),
(11, 'Forrest Gump', 3, '1994', 1),
(12, 'Back to the Future', 4, '1985', 1),
(13, 'The Silence of the Lambs', 5, '1991', 1),
(14, 'Gladiator', 1, '2000', 1),
(15, 'The Lion King', 2, '1994', 1),
(16, 'Toy Story', 2, '1995', 1),
(17, 'Finding Nemo', 2, '2003', 1),
(18, 'The Exorcist', 5, '1973', 1),
(19, 'Alien', 5, '1979', 1),
(20, 'Blade Runner', 4, '1982', 1),
(21, 'Star Wars: A New Hope', 4, '1977', 1),
(22, 'The Terminator', 1, '1984', 1),
(23, 'Die Hard', 1, '1988', 1),
(24, 'The Big Lebowski', 2, '1998', 1),
(25, 'Monty Python and the Holy Grail', 2, '1975', 1),
(26, 'Groundhog Day', 2, '1993', 3),
(27, 'Ghostbusters', 2, '1984', 1),
(28, 'Shrek', 2, '2001', 1),
(29, 'The Sixth Sense', 5, '1999', 1),
(30, 'A Beautiful Mind', 3, '2001', 1),
(31, 'Schindlers List', 3, '1993', 1),
(32, 'Braveheart', 1, '1995', 3),
(33, 'The Departed', 3, '2006', 1),
(34, 'Blancanieves', 4, '1960', 1),
(35, 'Comecocos', 3, '2010', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperarcontrasena`
--

CREATE TABLE `recuperarcontrasena` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `fecha_expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(2, 'Cliente'),
(1, 'Personal de tienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `rol_id`, `usuario`) VALUES
(1, 'Daniel Álvarez', 'daniel@gmail.com', '$2y$10$5UaIVqVM7/OQCcXgtg9W8O1834YVmSo2BWYoXkxrG36UbrrK8Lfm2', 1, 'dani'),
(2, 'Juan Perez', 'juan@gmail.com', '$2y$10$jQZtwUuucU3kDkYTPi4Q2uGbXjVbMaBX62uE5p9TvED0T8vKRKLei', 2, 'juan'),
(3, 'Maria Rodriguez', 'maria@gmail.com', '$2y$10$zW6doNdSPV2Fu.lbSYZx7.TAaKUmFkOYR6eeaSEsusikktnMEsFue', 2, 'maria'),
(4, 'Nicolás Safonov', 'nicolasafonov@gmail.com', '$2y$10$8HecUGDWow5H2d1KcRx/GOSseZs4yT1uo81A63kgTIcO1Juddi80i', 2, 'nico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estadosdevolucion`
--
ALTER TABLE `estadosdevolucion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estadospeliculas`
--
ALTER TABLE `estadospeliculas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `pelicula_id` (`pelicula_id`),
  ADD KEY `estado_devolucion_id` (`estado_devolucion_id`),
  ADD KEY `codigo_operacion` (`codigo_operacion`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`codigo_operacion`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `pelicula_id` (`pelicula_id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genero_id` (`genero_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `recuperarcontrasena`
--
ALTER TABLE `recuperarcontrasena`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estadosdevolucion`
--
ALTER TABLE `estadosdevolucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadospeliculas`
--
ALTER TABLE `estadospeliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `codigo_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `recuperarcontrasena`
--
ALTER TABLE `recuperarcontrasena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`),
  ADD CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`estado_devolucion_id`) REFERENCES `estadosdevolucion` (`id`),
  ADD CONSTRAINT `historial_ibfk_4` FOREIGN KEY (`codigo_operacion`) REFERENCES `operaciones` (`codigo_operacion`);

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `operaciones_ibfk_2` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`);

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`),
  ADD CONSTRAINT `peliculas_ibfk_2` FOREIGN KEY (`estado_id`) REFERENCES `estadospeliculas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
