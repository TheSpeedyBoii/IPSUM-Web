-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-08-2024 a las 16:33:17
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id_user` int NOT NULL,
  `question_1` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `answer_1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `question_2` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `answer_2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `question_3` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `answer_3` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `question_4` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `answer_4` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `answers`
--

INSERT INTO `answers` (`id_user`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`) VALUES
(1, 'Pelicula favorita', 'Endgame', 'Artista favorito', 'Aimer', 'Lugar favorito', 'Mi Casa', 'Color favorito', 'Blanco'),
(41, 'Carro favorito', 'Mazda 5', 'Moto favorita', 'Husvarqna', 'Lugar favorito', 'Medellín', 'Color favorito', 'Rojo'),
(42, 'Buseta', 'Cointur', 'Moto favorita', 'Kawasaki', 'Lugar favorito', 'Hotel', 'Color favorito', 'Blanco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`question_id`, `question`) VALUES
(1, 'Comida favorita'),
(2, 'Artista favorito'),
(3, 'Lugar favorito'),
(4, 'Color favorito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `role`) VALUES
(2, 'admin'),
(1, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `id_role` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `country`, `pass`, `photo`, `id_role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '3123123123', 'Colombia', '$2y$10$HA1GBFLTq9hKtBqA7guXQuukL7ag0pzI.jSNx8YrgH1o06T9Xvq6u', 'C:/wamp64/www/IPSUM-Web/profile_photos/adminimg.jpg', 2),
(41, 'Jose', 'Agudelo', 'jose@gmail.com', '3208576310', 'Colombia', '$2y$10$iC2I7l/QB95Oi6jerzSLXOYvAjwN4EhxbygZ8lt3nhb53neE2u3zy', 'C:/wamp64/www/IPSUM-Web/profile_photos/Josepfp.jpg', 1),
(42, 'Pedro', 'Posada', 'pedro@gmail.com', '3208576310', 'Argentina', '$2y$10$UI8xXP3Arvq/iHaJfU3Lbu/7Ogb/urFHqVztJZge0.NxE9jIRFYfS', 'C:/wamp64/www/IPSUM-Web/profile_photos/Pedrouf.jpg', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role_user` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
