-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2021 a las 03:54:17
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
(7, 'Bebida'),
(8, 'Veggie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_carrito`
--

CREATE TABLE `items_carrito` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `productos_producto_id` int(10) UNSIGNED NOT NULL,
  `usuarios_usuario_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `items_carrito`
--

INSERT INTO `items_carrito` (`id`, `cantidad`, `productos_producto_id`, `usuarios_usuario_id`) VALUES
(40, 1, 2, 1),
(43, 1, 9, 1),
(44, 1, 3, 2),
(45, 1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_pedido`
--

CREATE TABLE `items_pedido` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` varchar(100) NOT NULL,
  `pedidos_pedido_id` int(11) NOT NULL,
  `productos_producto_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `items_pedido`
--

INSERT INTO `items_pedido` (`id`, `cantidad`, `precio`, `pedidos_pedido_id`, `productos_producto_id`) VALUES
(6, 2, '380', 5, 2),
(7, 2, '380', 5, 4),
(8, 2, '380', 5, 7),
(9, 1, '760', 5, 3),
(10, 2, '380', 6, 2),
(11, 2, '380', 6, 4),
(12, 2, '380', 6, 7),
(13, 1, '760', 6, 3),
(14, 2, '380', 7, 2),
(15, 2, '380', 7, 4),
(16, 2, '380', 7, 7),
(17, 1, '760', 7, 3),
(18, 1, '380', 8, 2),
(19, 1, '760', 9, 3),
(20, 1, '380', 9, 4),
(21, 1, '760', 10, 3),
(22, 1, '380', 10, 4),
(23, 1, '760', 11, 3),
(24, 1, '380', 12, 2),
(25, 1, '760', 13, 3),
(26, 1, '760', 14, 3),
(27, 2, '380', 14, 2),
(28, 1, '760', 15, 3),
(29, 1, '760', 16, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(11) NOT NULL,
  `monto_total` float NOT NULL,
  `monto_envio` float NOT NULL,
  `monto_productos` float NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `delivery` tinyint(4) NOT NULL,
  `completado` tinyint(4) NOT NULL DEFAULT 0,
  `usuarios_usuario_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `monto_total`, `monto_envio`, `monto_productos`, `fecha`, `delivery`, `completado`, `usuarios_usuario_id`) VALUES
(5, 3240, 200, 3040, '2021/08/10', 0, 1, 2),
(6, 3240, 200, 3040, '2021/08/10', 1, 1, 2),
(7, 3240, 200, 3040, '2021/08/10', 1, 0, 2),
(8, 580, 200, 380, '2021/08/10', 1, 0, 2),
(9, 1340, 200, 1140, '2021/08/10', 1, 0, 2),
(10, 1340, 200, 1140, '2021/08/11', 1, 0, 2),
(11, 960, 200, 760, '2021/08/11', 1, 0, 2),
(12, 580, 200, 380, '2021/08/11', 1, 0, 2),
(13, 960, 200, 760, '2021/08/11', 1, 0, 2),
(14, 1720, 200, 1520, '2021/08/12', 1, 0, 2),
(15, 960, 200, 760, '2021/08/12', 1, 0, 2),
(16, 960, 200, 760, '2021/08/13', 1, 0, 2);

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
(1, 1, 'California (5 piezas)', 'Kanikama-palta.', '380', 'Clasico', 'california.jpg', 'California roll'),
(2, 1, 'Tuna Cream (5 piezas)', 'Atún cocido-mayonesa.', '380', 'Clasico', 'tunacream.jpg', 'Tuna Cream roll'),
(3, 1, 'Miami (10 piezas)', 'Salmón Cocido-Philadelphia y remolacha', '760', 'Clasico', 'miami.jpg', 'Miami roll'),
(4, 1, 'San Pablo (5 piezas)', 'Pollo Apanado-Philadelphia-salsa Teriyaki.', '380', 'Clasico', 'sanpablo.jpg', 'San Pablo roll'),
(5, 1, 'Siberian (5 piezas)', 'Kanikama-Philadelphia-Palta.', '380', 'Clasico', 'siberian.jpg', 'Siberian roll'),
(6, 1, 'Amazona (6 piezas)', 'Mix Vegetales.', '420', 'Clasico', 'amazona.jpg', 'Amazona roll'),
(7, 1, 'Washington (5 piezas)', 'Langostino rebosado, Palta y sésamo por fuera.', '380', 'Clasico', 'washington.jpg', 'Washington roll'),
(8, 1, 'Japan (5 piezas)', 'Kanikama, salmon, pepino y anana', '380', 'Clasico', 'japan.jpg', 'Japan roll'),
(9, 1, 'Orinoco (5 piezas)', 'Palmito, Salmon, Philadelphia, con panko exterior.', '380', 'Clasico', 'orinoco.jpg', 'Orinoco roll'),
(10, 1, 'Dragon Roll Uramaki', '10 piezas rellenas de salmón cocido, palta y queso crema, topping de palta y langostinos', '690', 'Especiales', 'Dragon-Roll-Uramaki.png', 'Dragon Roll Uramaki'),
(11, 1, 'Rock and Roll', '10 piezas Futomaki (alga por fuera) rellenas de salmón y langostino, con un rico topping de langostinos empanizados y salsa Miyagui', '690', 'Especiales', 'Rock-and-Roll.png', 'Rock and Roll'),
(12, 1, 'Alaska Roll Especial', '10 piezas relleno de salmón, queso crema y palta, con una cobertura de fetas de salmón por encima', '690', 'Especiales', 'Alaska-Roll-Especial.png', 'Alaska Roll Especial'),
(13, 1, 'Tigger Roll Especial', '8 piezas de Maki sin arroz rellenas de cangrejo, salmón, palta y queso crema, y luego tempurizado (empanizado)', '690', 'Especiales', 'Tigger-Roll-Especial.png', 'Tigger Roll Especial'),
(14, 1, 'Fantasy Roll', '10 piezas con una deliciosa combinación de cangrejo y langostino, palta y queso crema, con un toping de pasta Dinamita', '690', 'Especiales', 'Fantasy-Roll.png', 'Fantasy Roll'),
(15, 1, 'Fancy Roll Especial', '10 piezas de Uramaki (arroz por fuera) rellenas de langostino, queso crema, cubierto con palta y tiras de kanikama frito', '750', 'Especiales', 'Fancy-Roll-Especial.png', 'Fancy Roll Especial'),
(16, 1, 'Cono de Salmon', 'Rico cucurucho relleno de salmón, palta y queso crema', '480', 'Temakis', 'Cono-de-Salmon.png', 'Cono de Salmon'),
(17, 1, 'Cono California', 'Rico cucurucho relleno de cangrejo, pepino y palta', '450', 'Temakis', 'Cono-California.png', 'Cono California'),
(18, 1, 'Cono de Langostino', 'Un rico cucurucho relleno de langostino, pepino y queso crema', '450', 'Temakis', 'Cono-de-Langostino.png', 'Cono de Langostino'),
(19, 1, 'Combinado del dia', 'Elija el combo del dia, piezas variadas', '1100', 'Combos', 'Combinado-del-dia.jpg', 'Combinado del dia'),
(20, 1, 'Combinado Hot de 30 Piezas', '30 piezas de rolls variados entre salmón, kanikama y langostino', '1890', 'Combos', 'Combinado-Hot.jpg', 'Combinado Hot de 30 Piezas'),
(21, 1, 'Combinado Veggie de 30 Piezas', '30 rolls variados todos de vegetales', '1450', 'Combos', 'Combinado-Veggie.jpg', 'Combinado Veggie de 30 Piezas');

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
(1, 3),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 5),
(17, 5),
(18, 5),
(19, 1),
(19, 2),
(20, 1),
(20, 3),
(21, 1),
(21, 8);

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
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(45) DEFAULT NULL,
  `numero` varchar(100) DEFAULT NULL,
  `dpto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `rol_id`, `email`, `password`, `nombre`, `apellido`, `telefono`, `calle`, `codigo_postal`, `numero`, `dpto`) VALUES
(1, 1, 'shopveggie0@gmail.com ', '$2y$10$LbRb9q8fqHHxBiAS/madx.4qhplMmLhBn3wXe75RqO0Cl.ywzOQsa', 'Patricio', 'Huang', '', '', '', '', ''),
(2, 2, 'usuario@gmail.com', '$2y$10$LbRb9q8fqHHxBiAS/madx.4qhplMmLhBn3wXe75RqO0Cl.ywzOQsa', 'prueba123', 'usuario', '12345678', 'aasdasdasd', '1419', '123', ''),
(3, 2, 'prueba@123.com', '$2y$10$K9AytmFC/gIZApLr6xJwxeYQIRZtpw3mMczk8eH0Y0Px1hoKuppDW', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'prueba@234.com', '$2y$10$wfX1RTEtFGxCo9tz5iLREOcF/ujhB3BRoDfi8bL6K4hh/h97e4gJy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'prueba@456.com', '$2y$10$14TtDScQJyrMVBVh3TsegOZYsFBVHrkoU13nRHhKPwIXJahkinmui', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 'prueba@789.com', '$2y$10$keCqEiAiacfHxw4PCRf70OpHI2pA6lNsqGdAkOjVbVdpHM7OPxhUq', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 'prueba@78.com', '$2y$10$100iooKwRXHQiVAblAaoBuE4MKufsYKHDkhdlb7Hr7ch5layuGtAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 'prueba@780.com', '$2y$10$XYqNOvSzq9My7CTNodTDaOuAarBV5OoMcGZ8zhat5/HoF6pgf1.lK', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 2, 'prueba@80.com', '$2y$10$7p9scuAlpfYmExcrLPxZwOwJjKno8eB2ZgmfJkUlt6O4AgF/4VWo.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 2, 'prueba@801.com', '$2y$10$Dox/CuLjRUP6w4h77IOSD.OrWbaXuwrcGIz76qbA84m6651FDzfWy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 2, 'prueba@802.com', '$2y$10$E3rKJXsGx/Ipxmjn5Oq8yuwXhe3ii9goZlfzzkpyg6Hc9V1sLGo1i', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 2, 'prueba@803.com', '$2y$10$vQcXr8VwbSfMiOfm0dI7xOBsnRdd2H0K0wEjn9GfI4Jbsuy/BL3sO', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2, 'prueba@805.com', '$2y$10$MnQluuYu5naofTP0GZLqnOAQ6m1sRcG/CKaQ0f4M7duT3a8K/./M6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 2, 'prueba@810.com', '$2y$10$AM3526uh1fiiTq660QWDK.Y6lQAD0wrex14j1xfzSa4YvqF0TW1P.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 2, 'prueba@820.com', '$2y$10$r0JH0HgDnSZQ/cp/Y9zZBeQgTuOehPMDiBLv6d7nSuVsSuZPC0IG.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 2, 'prueba@850.com', '$2y$10$sv4NRMe2KyUAYmjW2KHWuuuGyoz0hGfvSmOzePy7rxNwEzz/xk8Ka', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 2, 'prueba@860.com', '$2y$10$3trvfTVnfGIk9EGr.QYIbegzlKC0P71yj.5Mg0qbsq/dPn3QjQbhK', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 2, 'prueba@900.com', '$2y$10$6e8YCFc35EatiodYgoQWdOG94IIKeb.MROePOViq790UJkP.kjeWW', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 2, 'prueba@910.com', '$2y$10$Dw7BPehCyJxeiU.MhU/v8.mKdJpI5oM4Hs0l.cCWPAErlltxnj4jy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, 'prueba@920.com', '$2y$10$Uvk8INvVt9HpFV2UCYz5ZOX.mXVFzIoM0pntMCdVVNPhG2roQQmcm', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 2, 'prueba@930.com', '$2y$10$r4VgEJmyQuqzMgIeMXNmm.uzXpQgqa6hE9CYN8zOQVfZwMVsrF8q6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 2, 'prueba@940.com', '$2y$10$fp76pPlpVtsxJxw4iDnZ5O.WKWXBboup59mKx.ruu28kf6tIAGnzS', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 2, 'prueba@950.com', '$2y$10$869qBfGh9JA/5dWpEQNmTOFtFK9wrezc0/17/zdMWW7y5XX/uEMXa', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 2, 'prueba@960.com', '$2y$10$nVK/U46Doaa6Mw7pccqVz.h74Yr/p7w/aaPoNLOIJ/SIA1GNK5TXW', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 2, 'prueba@970.com', '$2y$10$vM.01Zh2JKr99JEaT/hmZ.tVSmFFDW1xa9cF07mrRGGRQKj.r9xlC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 2, 'prueba@980.com', '$2y$10$vlDd1bN0eJcWeGZhhW9ej.AlQ.hEFh0Paq2m7OxOr2VKTYMpO2ve.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 2, 'prueba@990.com', '$2y$10$oYCU9d9cXpuS03YNOwiKmewa1JzIMHax3WppBC2PGN.IkTUg3b1.a', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 2, 'prueba@000.com', '$2y$10$h0KUJ4yuQapiXCrIRCaDzekx3/fp7HHx6/dTzGftVEk6qoUfRFObG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 2, 'prueba@12.com', '$2y$10$9M8cg7FsCmtlY2wtujWUf.0KeEKX1kgv83e8Bke3EslAKkPw.lvdC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 2, 'prueba@124.com', '$2y$10$Xz9AjaM6NP6pn9fP9gHVfe0QE8WuMmnxBFKNcYPQ8cfYjtnSIr8ou', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 2, 'prueba@125.com', '$2y$10$0lrzpJOc5bRXS4qitSoYfeqDQ0kCzdGSjdRI2aEyjif298PNFIpp6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 2, 'prueba@126.com', '$2y$10$0du8XcHFPHsZ1JMV/..AS.krvjQkINdBm/xUz5lIaAzMu6PXEY.7y', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 2, 'prueba@127.com', '$2y$10$iTBYvt2Kbht7CdqrMxXRcOutGjlsz1gKLAtFkfMnUM3Fa6SlcZdV2', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 2, 'prueba@128.com', '$2y$10$zVp31nku.i2n1FpF/9H64uMrYsBJOlhUYRjKu1JGfSHXOKjjdzkr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 2, 'prueba@129.com', '$2y$10$4jzWWObQ0QM7NxSTkniX..5lh8no.56VhScxPJIEhOTVCnhs2I/Ly', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 2, 'prueba@130.com', '$2y$10$aocOITQSSIEuJdb6jrwxBe.a2LMaWK1PUvlv4X0SLKA4UHlj5.eca', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 2, 'prueba@131.com', '$2y$10$YvYNTTtw3NYAZozz/nuySuH3UplQt6fRj/7ev8xL7cxyTL75FEmsm', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 2, 'prueba@132.com', '$2y$10$CMNWtHt6EaseyNJC7W3ig.92/sEFqRMLRvPnDhha5YZ5LUveBA.Qi', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 2, 'prueba@133.com', '$2y$10$w3QBrUIOf1WEC7KvG6QysuTJD7EhszjATtvAonGTzpW4zmXaUPLJ6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 2, 'prueba@134.com', '$2y$10$QU5HNEangkiDfqS9ZZMle.jJiYbBOmWdEPjU5t9ihYYQSQPUgKB22', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 2, 'prueba@135.com', '$2y$10$Qw9hlRb9vJshKLuLv7gtc.nA/98AwtjNcJIUNxGlO2L5tYb8kfNSy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 2, 'prueba@136.com', '$2y$10$5Oa5pHgLKs8YXmq5t3HaxuC/1EGnI3ZMPHvAZeGA5ujQx.gKcSwMy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 2, 'prueba@137.com', '$2y$10$ThyKXQ4/INPDFPUdF8bHX.IDGedGqlfmoPU0Ja2AmsR8OzWe7wXwy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 2, 'prueba@138.com', '$2y$10$6DMUYxwm0rXHCQzsPDhHN.6m0XBTx0ddAOAHnpF2D0mccEEB5ArOi', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `items_carrito`
--
ALTER TABLE `items_carrito`
  ADD PRIMARY KEY (`id`,`productos_producto_id`,`usuarios_usuario_id`),
  ADD KEY `fk_items_carrito_productos1_idx` (`productos_producto_id`),
  ADD KEY `fk_items_carrito_usuarios1_idx` (`usuarios_usuario_id`);

--
-- Indices de la tabla `items_pedido`
--
ALTER TABLE `items_pedido`
  ADD PRIMARY KEY (`id`,`pedidos_pedido_id`,`productos_producto_id`),
  ADD KEY `fk_items_pedido_pedidos1_idx` (`pedidos_pedido_id`),
  ADD KEY `fk_items_pedido_productos1_idx` (`productos_producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`,`usuarios_usuario_id`),
  ADD KEY `fk_pedidos_usuarios1_idx` (`usuarios_usuario_id`);

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
  MODIFY `categoria_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `items_carrito`
--
ALTER TABLE `items_carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `items_pedido`
--
ALTER TABLE `items_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items_carrito`
--
ALTER TABLE `items_carrito`
  ADD CONSTRAINT `fk_items_carrito_productos1` FOREIGN KEY (`productos_producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_carrito_usuarios1` FOREIGN KEY (`usuarios_usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `items_pedido`
--
ALTER TABLE `items_pedido`
  ADD CONSTRAINT `fk_items_pedido_pedidos1` FOREIGN KEY (`pedidos_pedido_id`) REFERENCES `pedidos` (`pedido_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_pedido_productos1` FOREIGN KEY (`productos_producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`usuarios_usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
