-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2022 at 10:18 AM
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

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `id_usuario_compra` int(11) NOT NULL,
  `total_compra` float(10,2) NOT NULL,
  `fecha_compra` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_producto` float(10,2) NOT NULL,
  `precio_total_producto` float(10,2) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_usuario_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `unidad` varchar(6) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(15, 'Sandía', 8.00, 'unidad', 'sandia.webp');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `user_pass` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_name`, `user_surname`, `user_pass`, `user_email`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com'),
(15, 'Juan', 'Gavira', 'Holamundo1', 'mail@prueba.com'),
(17, 'Carita', 'Bonita', 'Caritabonita89', 'carita@bonita.es');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario_compra` (`id_usuario_compra`);

--
-- Indexes for table `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_usuario_compra` (`id_usuario_compra`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
