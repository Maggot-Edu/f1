-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2022 a las 19:08:39
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `f1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pilotos`
--

CREATE TABLE `pilotos` (
  `IdPiloto` int(11) NOT NULL COMMENT 'Identificados del piloto',
  `NombrePiloto` varchar(150) NOT NULL COMMENT 'Nombre Piloto',
  `FechaNaciPiloto` date NOT NULL COMMENT 'Fecha nacimiento piloto',
  `EdadPiloto` int(11) NOT NULL COMMENT 'Edad del piloto',
  `LugarNaciPiloto` varchar(200) NOT NULL COMMENT 'Lugar de nacimiento del piloto',
  `NacionalidadPiloto` varchar(100) NOT NULL COMMENT 'Nacionalidad del piloto',
  `InstaPiloto` varchar(150) NOT NULL COMMENT 'Instagram piloto',
  `TwitterPiloto` varchar(150) NOT NULL COMMENT 'Twitter del piloto',
  `FotoPiloto` varchar(70) NOT NULL COMMENT 'Foto del piloto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pilotos`
--

INSERT INTO `pilotos` (`IdPiloto`, `NombrePiloto`, `FechaNaciPiloto`, `EdadPiloto`, `LugarNaciPiloto`, `NacionalidadPiloto`, `InstaPiloto`, `TwitterPiloto`, `FotoPiloto`) VALUES
(1, 'Fernando Alonso', '1981-07-29', 41, 'Oviedo, Asturias', 'España', 'https://www.instagram.com/fernandoalo_oficial/', 'https://twitter.com/alo_oficial', 'ALO.png'),
(2, 'Carlos Sainz', '1994-09-01', 28, 'Madrid', 'España', 'https://www.instagram.com/carlossainz55/', 'https://twitter.com/Carlossainz55', 'SAINZ.png'),
(5, 'PEDRO DE LA ROSA', '1971-02-24', 51, 'BARCELONA', 'España', '', 'https://twitter.com/PedrodelaRosa1', 'DELAROSA.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `perfil` varchar(20) NOT NULL COMMENT 'Perfil de usuario, suscriptor, editor, administrador',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `perfil`, `created_at`) VALUES
(5, 'MaggotEdu', '$2y$10$Z0XenILe6D8KcDjEylVWAeK63Pfu1F/nOPh2jT9tgvV/WUqJW/7OW', 'user', '2022-07-14 10:32:07'),
(6, 'LOL', '$2y$10$vS9qqRlIHgVIWn/1cHLB/.wCIFsgrDOmziNzaRWo7D6QNeTjoUsr6', 'admin', '2022-07-14 10:45:22'),
(7, 'Cristian', '$2y$10$mefKSmmVdFwxswqe2y2nj..V6uqqnJGjGxpbWychDrSiWRrEoRGe2', 'editor', '2022-07-15 10:45:07'),
(8, 'Paco', '$2y$10$9r1EXXhIurLopVekB1PPfuUXcca5F1dNT/j.Whgn5zusBOxofUQhG', 'user', '2022-07-18 12:12:54'),
(9, 'Manolo', '$2y$10$w8AvUEHOBq1lNfpJuBJRjeZ9MNGkmHjZQoFTBbD9dAqp4r7LcjYn6', '', '2022-07-20 16:42:59'),
(10, 'Edu', '$2y$10$V9jp26Km5X7lfOy1HhlxN.H3SmfYqBjuoYegAqTfnBkZemyS3M7S6', '', '2022-09-09 11:10:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pilotos`
--
ALTER TABLE `pilotos`
  ADD PRIMARY KEY (`IdPiloto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pilotos`
--
ALTER TABLE `pilotos`
  MODIFY `IdPiloto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificados del piloto', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
