-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2021 a las 02:08:29
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_huang_patricio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
(1, 'Combos para compartir'),
(2, 'Clásicos'),
(3, 'Especiales'),
(4, 'Poke '),
(5, 'Temakis'),
(6, 'Postre'),
(7, 'Bebida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` varchar(100) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `imagen_descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `usuario_id`, `nombre`, `descripcion`, `precio`, `categoria`, `imagen`, `imagen_descripcion`) VALUES
(1, 1, 'California (5 piezas)', 'Kanikama-palta.', '$380', 'Clasico', 'california.jpg', 'California roll'),
(2, 1, 'Tuna Cream (5 piezas)', 'Atún cocido-mayonesa.', '$380', 'Clasico', 'tunacream.jpg', 'Tuna Cream roll'),
(3, 1, 'Miami (10 piezas)', 'Salmón Cocido-Philadelphia y remolacha', '$760', 'Clasico', 'miami.jpg', 'Miami roll'),
(4, 1, 'San Pablo (5 piezas)', 'Pollo Apanado-Philadelphia-salsa Teriyaki.', '$380', 'Clasico', 'sanpablo.jpg', 'San Pablo roll'),
(5, 1, 'Siberian (5 piezas)', 'Kanikama-Philadelphia-Palta.', '$380', 'Clasico', 'siberian.jpg', 'Siberian roll'),
(6, 1, 'Amazona (6 piezas)', 'Mix Vegetales.', '$420', 'Clasico', 'amazona.jpg', 'Amazona roll'),
(7, 1, 'Washington (5 piezas)', 'Langostino rebosado, Palta y sésamo por fuera.', '$380', 'Clasico', 'washington.jpg', 'Washington roll'),
(8, 1, 'Japan (5 piezas)', 'Kanikama, salmon, pepino y anana', '$380', 'Clasico', 'japan.jpg', 'Japan roll'),
(9, 1, 'Orinoco (5 piezas)', 'Palmito, Salmon, Philadelphia, con panko exterior.', '$380', 'Clasico', 'orinoco.jpg', 'Orinoco roll');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_has_categorias`
--

CREATE TABLE `productos_has_categorias` (
  `productos_producto_id` int(10) UNSIGNED NOT NULL,
  `categorias_categoria_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_has_categorias`
--

INSERT INTO `productos_has_categorias` (`productos_producto_id`, `categorias_categoria_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `rol_id`, `email`, `password`, `nombre`, `apellido`) VALUES
(1, 1, 'shopveggie0@gmail.com ', '$2y$10$LbRb9q8fqHHxBiAS/madx.4qhplMmLhBn3wXe75RqO0Cl.ywzOQsa', 'Patricio', 'Huang'),
(2, 2, 'usuario@gmail.com', '$2y$10$LbRb9q8fqHHxBiAS/madx.4qhplMmLhBn3wXe75RqO0Cl.ywzOQsa', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `producto_index` (`nombre`,`categoria`),
  ADD KEY `fk_productos_usuario_1_idx` (`usuario_id`);

--
-- Indices de la tabla `productos_has_categorias`
--
ALTER TABLE `productos_has_categorias`
  ADD PRIMARY KEY (`productos_producto_id`,`categorias_categoria_id`),
  ADD KEY `fk_productos_has_categorias_categorias1_idx` (`categorias_categoria_id`),
  ADD KEY `fk_productos_has_categorias_productos1_idx` (`productos_producto_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_usuarios_roles_1_idx` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_usuarios_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_has_categorias`
--
ALTER TABLE `productos_has_categorias`
  ADD CONSTRAINT `fk_productos_has_categorias_categorias1` FOREIGN KEY (`categorias_categoria_id`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_categorias_productos1` FOREIGN KEY (`productos_producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
