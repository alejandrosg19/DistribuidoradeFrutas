create database dbfruteria;
use dbfruteria;
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 03:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfruteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigoActivacion` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombre`, `correo`, `clave`, `estado`, `codigoActivacion`, `foto`) VALUES
(17, 'Santiago Alejandro', 'alejandro@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigoActivacion` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `correo`, `clave`, `estado`, `codigoActivacion`, `foto`) VALUES
(43, 'Kevin Lopez', 'kevin@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(44, 'Sebastian', 'Sebastian@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(45, 'Andres', 'Andres@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(47, 'Ramiro', 'Ramiro@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(49, 'Karol', 'Karol@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(50, 'Vanesa', 'Vanesa@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(51, 'Karen', 'Karen@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(52, 'Jeimy', 'Jeimy@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(53, 'Viviana', 'Viviana@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(54, 'Daniela', 'Daniela@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(55, 'Rosa', 'Rosa@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(56, 'Angela', 'Angela@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(57, 'Steven', 'Steven@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(58, 'Miguel', 'Miguel@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(59, 'Laura', 'Laura@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idCliente` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`idFactura`, `fecha`, `idCliente`, `valor`) VALUES
(140, '2020-09-12 20:14:17', 43, 42000);

-- --------------------------------------------------------

--
-- Table structure for table `facturaproducto`
--

CREATE TABLE `facturaproducto` (
  `idfacturaProducto` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facturaproducto`
--

INSERT INTO `facturaproducto` (`idfacturaProducto`, `idProducto`, `idFactura`, `cantidad`, `precio`) VALUES
(154, 1, 140, 5, 3000),
(155, 2, 140, 5, 3000),
(156, 3, 140, 5, 2400);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `idLog` int(11) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `datos` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `actor` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`idLog`, `accion`, `datos`, `fecha`, `hora`, `actor`, `idUsuario`) VALUES
(535, 'Inicio de Sesion', '', '2020-09-12', '20:10:43', 'Cliente', 48),
(536, 'Inicio de Sesion', '', '2020-09-12', '20:13:04', 'Proveedor', 33),
(537, 'Proveer Producto', 'id:5-cantidad:100', '2020-09-12', '20:13:19', 'Proveedor', 33),
(538, 'Inicio de Sesion', '', '2020-09-12', '20:13:51', 'Cliente', 43),
(539, 'Compra', 'factura:140', '2020-09-12', '20:14:17', 'Cliente', 43),
(540, 'Inicio de Sesion', '', '2020-09-12', '20:18:51', 'Administrador', 17),
(541, 'Inicio de Sesion', '', '2020-09-12', '20:19:57', 'Proveedor', 33),
(542, 'Inicio de Sesion', '', '2020-09-12', '20:20:43', 'Cliente', 43);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `estado` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `cantidad`, `precio`, `imagen`, `estado`) VALUES
(1, 'Naranja', 77, 3000, 'Vista/Img/imgProductos/naranja.jpg', 1),
(2, 'Fresas', 84, 3000, 'Vista/Img/imgProductos/fresa.jpg', 1),
(3, 'Manzanas', 92, 2400, 'Vista/Img/imgProductos/manzana.jpg', 1),
(4, 'Peras', 100, 3400, 'Vista/Img/imgProductos/pera.jpg', 1),
(5, 'Bananos', 110, 1400, 'Vista/Img/imgProductos/banano.jpg', 0),
(6, 'Mandarina', 100, 2600, 'Vista/Img/imgProductos/mandarina.jpg', 0),
(8, 'Mango', 100, 3000, 'Vista/Img/imgProductos/mango.jpg', 0),
(41, 'Moras', 100, 5500, 'Vista/Img/imgProductos/1594494476.jpeg', 0),
(42, 'Cerezas', 100, 9000, 'Vista/Img/imgProductos/1594495063.jpeg', 1),
(43, 'Duraznos', 100, 4500, 'Vista/Img/imgProductos/1594495131.jpeg', 1),
(44, 'Piñas', 100, 6000, 'Vista/Img/imgProductos/1594495453.jpeg', 1),
(45, 'Uvas', 100, 2500, 'Vista/Img/imgProductos/1594495583.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigoActivacion` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `correo`, `clave`, `estado`, `codigoActivacion`, `foto`) VALUES
(33, 'Jose', 'Jose@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, ''),
(34, 'Mauricio', 'Mauricio@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, ''),
(35, 'Angel', 'Angel@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, ''),
(36, 'Raul', 'Raul@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `proveedorproducto`
--

CREATE TABLE `proveedorproducto` (
  `idProveedorProducto` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(50) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proveedorproducto`
--

INSERT INTO `proveedorproducto` (`idProveedorProducto`, `idProducto`, `idProveedor`, `cantidad`, `precio`, `fecha`) VALUES
(25, 5, 33, 10, 700, '2020-09-12 20:13:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `factura_ibfk_1` (`idCliente`);

--
-- Indexes for table `facturaproducto`
--
ALTER TABLE `facturaproducto`
  ADD PRIMARY KEY (`idfacturaProducto`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idFactura` (`idFactura`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idLog`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indexes for table `proveedorproducto`
--
ALTER TABLE `proveedorproducto`
  ADD PRIMARY KEY (`idProveedorProducto`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `facturaproducto`
--
ALTER TABLE `facturaproducto`
  MODIFY `idfacturaProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `proveedorproducto`
--
ALTER TABLE `proveedorproducto`
  MODIFY `idProveedorProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);

--
-- Constraints for table `facturaproducto`
--
ALTER TABLE `facturaproducto`
  ADD CONSTRAINT `facturaproducto_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `facturaproducto_ibfk_2` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`);

--
-- Constraints for table `proveedorproducto`
--
ALTER TABLE `proveedorproducto`
  ADD CONSTRAINT `proveedorproducto_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `proveedorproducto_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
