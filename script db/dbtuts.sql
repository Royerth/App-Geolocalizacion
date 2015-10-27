-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2015 a las 00:01:52
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtuts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordenadas`
--

CREATE TABLE IF NOT EXISTS `coordenadas` (
  `id` int(50) NOT NULL,
  `Lat` varchar(50) NOT NULL,
  `Lng` varchar(50) NOT NULL,
  `id_ruta` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coordenadas`
--

INSERT INTO `coordenadas` (`id`, `Lat`, `Lng`, `id_ruta`) VALUES
(1, '-16.383391', '-64.489746', 0),
(2, '-15.135764', '-64.665527', 2),
(3, '-15.262989', '-65.34668', 2),
(4, '-15.347762', '-65.786133', 2),
(5, '-15.665354', '-66.708984', 2),
(6, '-15.135764', '-64.665527', 4),
(7, '-15.135764', '-64.665527', 3),
(8, '-16.024696', '-66.972656', 2),
(9, '-15.262989', '-65.34668', 4),
(10, '-15.262989', '-65.34668', 3),
(11, '-15.347762', '-65.786133', 4),
(12, '-15.347762', '-65.786133', 3),
(13, '-15.665354', '-66.708984', 4),
(14, '-15.665354', '-66.708984', 3),
(15, '-16.024696', '-66.972656', 4),
(16, '-16.024696', '-66.972656', 3),
(17, '-15.749963', '-62.973633', 5),
(18, '-15.749963', '-63.193359', 5),
(19, '-15.68651', '-63.61084', 5),
(20, '-15.538376', '-64.599609', 5),
(21, '-15.559544', '-65.500488', 5),
(22, '-15.792254', '-66.445312', 5),
(23, '-15.474857', '-67.060547', 5),
(24, '-16.193575', '-67.346191', 5),
(25, '-16.972741', '-67.873535', 5),
(26, '-16.045813', '-63.303223', 6),
(27, '-16.003576', '-63.764648', 6),
(28, '-16.003576', '-64.160156', 6),
(29, '-16.003576', '-64.709473', 6),
(30, '-16.40447', '-65.083008', 6),
(31, '-16.36231', '-63.984375', 7),
(32, '-15.093339', '-65.061035', 7),
(33, '-13.132979', '-65.76416', 7),
(34, '-13.645987', '-66.950684', 7),
(35, '-16.193575', '-61.743164', 8),
(36, '-15.813396', '-63.171387', 8),
(37, '-15.644197', '-64.379883', 8),
(38, '-15.855674', '-66.049805', 8),
(39, '-15.855674', '-65.895996', 9),
(40, '-15.45368', '-65.280762', 9),
(41, '-15.45368', '-64.204102', 9),
(42, '-15.771109', '-64.204102', 9),
(43, '-15.982454', '-64.511719', 9),
(44, '-15.220589', '-67.324219', 10),
(45, '-15.029686', '-66.115723', 10),
(46, '-15.178181', '-65.544434', 10),
(47, '-16.193575', '-65.939941', 10),
(48, '-16.36231', '-66.42334', 10),
(49, '-14.774883', '-64.995117', 11),
(50, '-15.135764', '-64.313965', 11),
(51, '-15.68651', '-63.676758', 11),
(52, '-16.573023', '-62.578125', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE IF NOT EXISTS `rutas` (
  `id` int(20) NOT NULL,
  `lugar_inicio` varchar(255) NOT NULL,
  `destino_final` varchar(255) NOT NULL,
  `lat_i` varchar(50) NOT NULL,
  `lng_i` varchar(50) NOT NULL,
  `lat_f` varchar(50) NOT NULL,
  `lng_f` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `lugar_inicio`, `destino_final`, `lat_i`, `lng_i`, `lat_f`, `lng_f`) VALUES
(1, 'gfyu', 'gyuik', '-16.383391', '-64.489746', '-16.256867', '-65.390625'),
(2, 'guhjkjhiol', 'ghjkbhljjl.', '-15.135764', '-64.665527', '-16.024696', '-66.972656'),
(3, 'guhjkjhiol', 'ghjkbhljjl.', '-15.135764', '-64.665527', '-16.024696', '-66.972656'),
(4, 'guhjkjhiol', 'ghjkbhljjl.', '-15.135764', '-64.665527', '-16.024696', '-66.972656'),
(5, 'f', 'j', '-15.749963', '-62.973633', '-16.972741', '-67.873535'),
(7, 'k', 'p', '-16.36231', '-63.984375', '-13.645987', '-66.950684'),
(8, 'gyu', 'l', '-16.193575', '-61.743164', '-15.855674', '-66.049805'),
(9, '', '', '-15.855674', '-65.895996', '-15.982454', '-64.511719'),
(10, '', '', '-15.220589', '-67.324219', '-16.36231', '-66.42334'),
(11, '', '', '-14.774883', '-64.995117', '-16.573023', '-62.578125');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `email` varchar(80) NOT NULL,
  `lugar` varchar(400) NOT NULL,
  `coordenada_x` varchar(20) NOT NULL,
  `coordenada_y` varchar(20) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `nombre`, `apellido`, `email`, `lugar`, `coordenada_x`, `coordenada_y`, `imagen`) VALUES
(18, 'Royerth', 'Encinas', 'Roy@gmail.com', 'Plaza 14 de Septiembre, Cochabamba', '-19.422112051395338', '-62.911435694694546', 'Bean_lo_ltimo_en_cine_catastr_fico-837107731-large.jpg'),
(38, 'Carla', 'Claure MontaÃ±o', 'Carla@gmail.com', 'Plaza Colon, Cochabamba', '-18.12190541799265', '-64.62530288219455', 'Windows 7 Pink HD Wallpaper.jpg'),
(39, 'Gary', 'Cespedes Herrera', 'Gary@gmail.com', 'Circuito Bolivia, Laguna Alalay', '-17.407520305678226', '-66.14347609996798', 'Adidas.jpg'),
(41, 'Pedro ', 'Zambrana Montoya', 'Pedro@gmail.com', 'Parque Kanata, Cochabamba', ' -17.36853187650009', ' -66.16338881969455', 'Nike_Ultimate_Green_Wallpaper_by_Opium_.png'),
(42, 'Carla', 'Saavedra Campos', 'Carl@gmail.com', 'Plaza Colon, Cochabamba', '-17.402154514601335', '-66.15422773480418', 'img-wallpapers-apple-world-(-7-colours--version--bmp-)-aquagraph-16074.png'),
(47, 'Erick', 'Encinas', 'Erick@gmail.com', 'Calle Calama', '-17.536221239841886', '-66.29522475719455', 'cisne-negro.jpg'),
(44, 'gyi', 'gt7i', 'gui', 't8yui', '-16.78041769335103', '-66.63580092906955', '7C9.jpg'),
(37, 'Gustavo', 'Choque Mamani', 'Gus@gmail.com', 'Parque Acuatico, Cochabamba', '-19.38066219146416', '-65.22955092906955', 'Wallpapers-room_com___BITUF_Charging_by_emoryu21_2560x1600 (1).jpg'),
(36, 'Einet', 'Aduviri Claros', 'Einet@gamil.com', 'Parque Bicentenario, Cochabamba', '-20.845531062552414', '-66.17437514781955', 'Apple_5.jpg'),
(43, 'Gary', 'v', 'Gary@gmail.com', 'Parque Kanata, Cochabamba', '-17.402236416722136', '-66.15423444032672', 'img-wallpapers-apple-world-(-7-colours--version--bmp-)-aquagraph-16074.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coordenadas`
--
ALTER TABLE `coordenadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `coordenadas`
--
ALTER TABLE `coordenadas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
