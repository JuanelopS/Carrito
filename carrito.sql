-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 01:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrito`
--


-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_compra` int(11) NOT NULL,
  `total_compra` float(10,2) NOT NULL,
  `fecha_compra` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_compra`),
  KEY `id_usuario_compra` (`id_usuario_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id_compra`, `id_usuario_compra`, `total_compra`, `fecha_compra`) VALUES
(15, 15, 123.25, '2022-10-02 11:42:35'),
(16, 15, 290.90, '2022-10-02 11:43:27'),
(17, 15, 26.80, '2022-10-02 13:57:00'),
(18, 1, 39.35, '2022-10-02 14:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_compra`
--

CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_producto` float(10,2) NOT NULL,
  `precio_total_producto` float(10,2) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_usuario_compra` int(11) NOT NULL,
  KEY `id_compra` (`id_compra`),
  KEY `id_usuario_compra` (`id_usuario_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detalle_compra`
--

INSERT INTO `detalle_compra` (`nombre_producto`, `cantidad_producto`, `precio_producto`, `precio_total_producto`, `id_compra`, `id_usuario_compra`) VALUES
('Pera Ercolini', 23, 3.20, 73.60, 15, 15),
('Manzana Golden', 23, 1.30, 29.90, 15, 15),
('Manzana Royal Gala', 1, 2.50, 2.50, 15, 15),
('Plátanos', 5, 3.45, 17.25, 15, 15),
('Manzana Golden', 23, 1.30, 29.90, 16, 15),
('Manzana Royal Gala', 12, 2.50, 30.00, 16, 15),
('Ciruela Roja', 45, 2.45, 110.25, 16, 15),
('Kiwi', 23, 5.25, 120.75, 16, 15),
('Ciruela Roja', 1, 2.45, 2.45, 17, 15),
('Pomelo', 1, 2.80, 2.80, 17, 15),
('Piña', 1, 8.75, 8.75, 17, 15),
('Aguacates', 1, 7.55, 7.55, 17, 15),
('Melocotón', 1, 5.25, 5.25, 17, 15),
('Uva Morada', 5, 2.30, 11.50, 18, 1),
('Coco', 2, 6.45, 12.90, 18, 1),
('Ciruela Roja', 1, 2.45, 2.45, 18, 1),
('Manzana Royal Gala', 5, 2.50, 12.50, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `unidad` varchar(6) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nombre`, `precio`, `unidad`, `imagen`) VALUES
(1, 'Manzana Royal Gala', 2.50, 'kilo', 'manzana-royal-gala.jpg'),
(2, 'Manzana Golden', 1.30, 'kilo', 'manzana-golden-800g.jpg'),
(3, 'Higos', 8.80, 'kilo', 'higos-500g.jpg'),
(4, 'Pera Ercolini', 3.20, 'kilo', 'pera-ercollini-800gr.jpg'),
(5, 'Plátanos', 3.45, 'kilo', 'platanos-800g.jpg'),
(6, 'Melocotón', 5.25, 'kilo', 'melocoton-amarillo-1kg.jpg'),
(7, 'Aguacates', 7.55, 'kilo', 'aguacates-1kg.jpg'),
(8, 'Ciruela Roja', 2.45, 'kilo', 'ciruela-roja-800g.jpg'),
(9, 'Pomelo', 2.80, 'kilo', 'pomelo-1kg.jpg'),
(10, 'Piña', 8.75, 'unidad', 'pina-1ud.jpg'),
(11, 'Coco', 6.45, 'unidad', 'coco-1ud.jpg'),
(12, 'Kiwi', 5.25, 'kilo', 'kiwi-verde-800g.jpg'),
(14, 'Uva Morada', 2.30, 'kilo', 'uva_morada.png'),
(15, 'Sandía', 8.00, 'unidad', 'sandia.webp'),
(16, 'Fresas', 4.15, 'kilo', 'fresas.png'),
(26, 'Pepino', 2.20, 'kilo', 'pepino.png');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `user_pass` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_name`, `user_surname`, `user_pass`, `user_email`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com'),
(15, 'Juan', 'Gavira', 'Holamundo1', 'mail@prueba.com'),
(17, 'Carita', 'Bonita', 'Caritabonita89', 'carita@bonita.es');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_usuario_compra`) REFERENCES `usuarios` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_usuario_compra`) REFERENCES `compra` (`id_usuario_compra`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
