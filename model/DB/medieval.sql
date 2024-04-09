-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2023 a las 18:32:10
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medieval`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'Abrigos'),
(2, 'Camisetas'),
(3, 'Accesorios'),
(4, 'Vestidos'),
(8, 'Morrales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `numero_pedido` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `Qty_producto` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `valor_producto` double NOT NULL,
  `Total_producto` double NOT NULL,
  `pedido_confirmado` int(11) NOT NULL,
  `Pedido_entregado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `numero_pedido`, `id_usuario`, `id_producto`, `Qty_producto`, `direccion`, `valor_producto`, `Total_producto`, `pedido_confirmado`, `Pedido_entregado`) VALUES
(1, '186510', 1, 8, 1, '15', 85000, 85000, 0, 0),
(2, '488975', 1, 8, 1, '0', 85000, 85000, 0, 0),
(3, '488975', 1, 8, 3, '0', 85000, 255000, 0, 0),
(4, '488975', 1, 1, 3, '0', 500000, 1500000, 0, 0),
(5, '488975', 1, 10, 2, '0', 68000, 136000, 0, 0),
(6, '488975', 1, 10, 1, '0', 68000, 68000, 0, 0),
(7, '488975', 1, 10, 1, '0', 68000, 68000, 0, 0),
(8, '488975', 1, 10, 1, '0', 68000, 68000, 0, 0),
(9, '683282', 1, 12, 1, '0', 120000, 120000, 0, 0),
(10, '683282', 1, 5, 1, '0', 720000, 720000, 0, 0),
(12, '898427', 1, 5, 2, 'Calle 5 # 45 -121 APT 511', 720000, 1440000, 1, 0),
(14, '164805', 10, 15, 2, 'Calle Falsa 123', 325000, 650000, 1, 1),
(15, '164805', 10, 13, 1, 'Calle Falsa 123', 110000, 110000, 1, 1),
(16, '849015', 3, 6, 1, 'Calle 2 45-52', 654000, 654000, 1, 0),
(17, '849015', 3, 11, 1, 'Calle 2 45-52', 250000, 250000, 1, 0),
(18, '849015', 3, 14, 1, 'Calle 2 45-52', 235000, 235000, 1, 0),
(19, '505489', 3, 2, 1, 'Calle 2 45-52', 840000, 840000, 1, 1),
(20, '102304', 3, 1, 1, 'Calle 2 45-52', 500000, 500000, 1, 0),
(21, '771712', 1, 8, 1, '0', 85000, 85000, 0, 0),
(22, '771712', 1, 1, 2, '0', 500000, 1000000, 0, 0),
(23, '771712', 1, 12, 2, '0', 120000, 240000, 0, 0),
(25, '656077', 1, 10, 2, 'Calle hueca', 68000, 136000, 1, 0),
(26, '347713', 1, 7, 1, 'Calle hueca', 540000, 540000, 1, 1),
(28, '347713', 1, 8, 2, 'Calle hueca', 85000, 170000, 1, 1),
(29, '426533', 1, 1, 1, 'Calle 5 23 47', 500000, 500000, 1, 1),
(30, '426533', 1, 15, 2, 'Calle 5 23 47', 325000, 650000, 1, 1),
(31, '613596', 10, 9, 3, 'Calle 5 # 45 -123', 94000, 282000, 1, 0),
(32, '613596', 10, 13, 1, 'Calle 5 # 45 -123', 110000, 110000, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `clave_producto` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `imagen1_producto` varchar(255) NOT NULL,
  `imagen2_producto` varchar(255) NOT NULL,
  `precio_producto` float NOT NULL,
  `mostrar_main` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion_producto`, `clave_producto`, `id_categoria`, `imagen1_producto`, `imagen2_producto`, `precio_producto`, `mostrar_main`) VALUES
(1, 'Chaqueta Alaskan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Buso, chaqueta, abrigo', 1, 'buso1_small.jpg', 'buso1_big.jpg', 500000, 1),
(2, 'Chaqueta Russia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Buso, chaqueta, abrigo', 1, 'buso2_small.jpg', 'buso2_big.jpg', 840000, 0),
(5, 'Chaqueta Soviet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Buso, chaqueta, abrigo', 1, 'buso5_small.jpg', 'buso5_big.jpg', 720000, 1),
(6, 'Chaqueta War', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Buso, chaqueta, abrigo', 1, 'buso3_small.jpg', 'buso3_big.jpg', 654000, 0),
(7, 'Chaqueta Combat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Buso, chaqueta, abrigo', 1, 'buso4_small.jpg', 'buso4_big.jpg', 540000, 0),
(8, 'Camiseta warrior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Camiseta, mujer', 2, 'camisa1_small.jpg', 'camisa1_big.jpg', 85000, 1),
(9, 'Camiseta Laika', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Camiseta, mujer', 2, 'camisa2_small.jpg', 'camisa2_big.jpg', 94000, 0),
(10, 'Camiseta Morticia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Camiseta, mujer', 2, 'camisa3_small.jpg', 'camisa3_big.jpg', 68000, 1),
(11, 'Vestido wednsday', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Vestido, mujer, negro', 4, 'vestido1_small.jpg', 'vestido1_big.jpg', 250000, 0),
(12, 'Acesorio Cross', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Acesorio, collar', 3, 'accesorio1_small.jpg', 'accesorio1_big.jpg', 120000, 0),
(13, 'Accesorio Skull', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Acesorio, collar', 3, 'accesorio2_small.jpg', 'accesorio2_big.jpg', 110000, 1),
(14, 'Morral kinder', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Morral, mochila, bolso', 8, 'bolso1_4x3.jpg', 'bolso1_2x3.jpg', 235000, 0),
(15, 'Morral militia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi metus, dapibus nec volutpat a, vestibulum in magna. Aliquam aliquet quis dui eget rhoncus. Duis dolor dui, gravida et tempus eu, fermentum dapibus purus.', 'Morral, mochila, bolso', 8, 'bolso2_small.jpg', 'bolso2_big.jpg', 325000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `user_type` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `fecha`, `user_type`) VALUES
(1, 'Alejandro', 'Castrillon Ospina', 'acastrio@gmail.com', 'cualquiera', '2007-04-23', 2),
(2, 'Jenn', 'Soto Pino', 'jsoto198@gmail.com', 'jeni1', '2008-04-23', 2),
(3, 'Altamo', 'AltamoJ', 'altamo@gmail.com', 'altamo1', '2009-04-23', 2),
(4, 'admin1', 'admin', 'admin1@admin.com', 'admin1', '2014-04-23', 1),
(5, 'prueba1', 'prueba', 'prueba1@gmail.com', 'prueba1', '2023-04-14', 2),
(6, 'prueba3', 'prueba', 'prueba@gmail.com', 'prueba3', '2023-04-15', 2),
(7, 'Prueba4', 'prueba', 'prueba4@prueba.com', 'prueba4', '2023-04-15', 2),
(9, 'pepito', 'perez', 'pepito@gmail.com', 'pepito1', '2023-05-02', 1),
(10, 'pepito', 'perez', 'pepito2@gmail.com', 'pepito2', '2023-05-03', 2),
(11, 'pepito', 'perez', 'pepito3@gmail.com', 'pepito3', '2023-05-03', 2),
(12, 'pepito', 'perez', 'pepito4@gmail.com', 'pepito4', '2023-05-03', 2),
(13, 'pepito', 'perez', 'pepito5@gmail.com', 'pepito5', '2023-05-03', 2),
(14, 'pepito', 'perez', 'pepito6@gmail.com', 'pepito6', '2023-05-03', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
