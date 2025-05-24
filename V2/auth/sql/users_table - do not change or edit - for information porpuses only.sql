-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2025 a las 19:31:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `domus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` char(36) DEFAULT uuid(),
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` text NOT NULL,
  `profile_picture_url` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `banned` tinyint(1) DEFAULT 0,
  `collection_public` tinyint(1) DEFAULT 0,
  `is_seller` tinyint(1) DEFAULT 0,
  `is_trusted_seller` tinyint(1) DEFAULT 0,
  `shop_name` varchar(100) DEFAULT NULL,
  `shop_description` text DEFAULT NULL,
  `seller_rating` float DEFAULT NULL,
  `total_sales` int(11) DEFAULT 0,
  `seller_since` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `email`, `password_hash`, `profile_picture_url`, `bio`, `location`, `created_at`, `updated_at`, `last_login_at`, `is_admin`, `banned`, `collection_public`, `is_seller`, `is_trusted_seller`, `shop_name`, `shop_description`, `seller_rating`, `total_sales`, `seller_since`) VALUES
(2, '7f88e6d8-335c-11f0-b944-d8bbc1b71044', 'PokeSebas', 'sebastian.czinna@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$dkc2aDdRZzRRQU4zd0hCSA$5b8ybxZUniuwc/nCPCQX/+jGleBtyIi+OsZBq0eETe4', NULL, NULL, NULL, '2025-05-17 20:21:21', '2025-05-19 19:41:50', '2025-05-19 19:41:50', 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
