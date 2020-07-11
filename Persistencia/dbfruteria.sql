create database dbfruteria

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigoActivacion` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigoActivacion` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `cliente` (`idCliente`, `nombre`, `correo`, `clave`, `estado`, `codigoActivacion`, `foto`) VALUES
(4, 'Santiago Lopez', '123@123.com', '202cb962ac59075b964b07152d234b70', 1, 2591834, 'Vista/Img/Users/1594491758.png'),
(42, 'Diego Pardo', 'diego@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 6, 'Vista/Img/Users/1594491789.png'),
(43, 'Kevin Lopez', 'kevin@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(44, 'Sebastian', 'Sebastian@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(45, 'Andres', 'Andres@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(46, 'Alejandro', 'Alejandro@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(47, 'Ramiro', 'Ramiro@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
(48, 'Jose', 'Jose@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, ''),
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


CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idCliente` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `factura` (`idFactura`, `fecha`, `idCliente`, `valor`) VALUES
(118, '2020-07-11 13:12:26', 4, 146000);


CREATE TABLE `facturaproducto` (
  `idfacturaProducto` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `facturaproducto` (`idfacturaProducto`, `idProducto`, `idFactura`, `cantidad`, `precio`) VALUES
(116, 1, 118, 2, 12000),
(117, 2, 118, 4, 13000),
(118, 3, 118, 5, 14000);


CREATE TABLE `log` (
  `idLog` int(11) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `datos` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `actor` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `log` (`idLog`, `accion`, `datos`, `fecha`, `hora`, `actor`, `idUsuario`) VALUES
(342, 'Inicio de Sesion', '', '2020-07-11', '13:12:00', 'Cliente', 4),
(343, 'Compra', 'factura:118', '2020-07-11', '13:12:26', 'Cliente', 4),
(344, 'Inicio de Sesion', '', '2020-07-11', '13:17:46', 'Administrador', 3),
(345, 'Inicio de Sesion', '', '2020-07-11', '13:19:51', 'Cliente', 4),
(346, 'Actualizar Información', 'Actor:Cliente-Nombre:Santiago Alejandro-Correo:123@123.com-id:4', '2020-07-11', '13:21:07', 'Cliente', 4),
(347, 'Inicio de Sesion', '', '2020-07-11', '13:21:24', 'Cliente', 4),
(348, 'Inicio de Sesion', '', '2020-07-11', '13:21:54', 'Administrador', 3),
(349, 'Editar Cliente', 'Actor:Cliente-Nombre:Santiago-Correo:123@123.com-id:4', '2020-07-11', '13:22:38', 'Administrador', 3),
(350, 'Editar Cliente', 'Actor:Cliente-Nombre:Diego Pardo-Correo:diego@hotmail.com-id:42', '2020-07-11', '13:23:09', 'Administrador', 3),
(351, 'Actualizar Información', 'Actor:Administrador-Nombre:Santiago Alejo-Correo:alejandro@hotmail.com-id:3', '2020-07-11', '13:29:50', 'Administrador', 3),
(352, 'Inicio de Sesion', '', '2020-07-11', '13:30:08', 'Cliente', 4),
(353, 'Actualizar Información', 'Actor:Cliente-Nombre:Santiago Andres-Correo:123@123.com-id:4', '2020-07-11', '13:30:18', 'Cliente', 4),
(354, 'Crear Producto', 'id:41', '2020-07-11', '14:07:56', 'Administrador', 3),
(355, 'Crear Producto', 'id:42', '2020-07-11', '14:17:43', 'Administrador', 3),
(356, 'Crear Producto', 'id:43', '2020-07-11', '14:18:52', 'Administrador', 3),
(357, 'Crear Producto', 'id:44', '2020-07-11', '14:24:13', 'Administrador', 3),
(358, 'Crear Producto', 'id:45', '2020-07-11', '14:26:23', 'Administrador', 3);

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `estado` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `producto` (`idProducto`, `nombre`, `cantidad`, `precio`, `imagen`, `estado`) VALUES
(1, 'Naranja', 98, 12000, 'Vista/Img/imgProductos/naranja.jpg', 1),
(2, 'Fresas', 96, 13000, 'Vista/Img/imgProductos/fresa.jpg', 1),
(3, 'Manzanas', 95, 14000, 'Vista/Img/imgProductos/manzana.jpg', 1),
(4, 'Peras', 100, 15000, 'Vista/Img/imgProductos/pera.jpg', 1),
(5, 'Bananos', 100, 16000, 'Vista/Img/imgProductos/banano.jpg', 1),
(6, 'Mandarina', 100, 17000, 'Vista/Img/imgProductos/mandarina.jpg', 1),
(8, 'Mango', 100, 15000, 'Vista/Img/imgProductos/mango.jpg', 1),
(41, 'Moras', 100, 7000, 'Vista/Img/imgProductos/1594494476.jpeg', 1),
(42, 'Cerezas', 100, 9000, 'Vista/Img/imgProductos/1594495063.jpeg', 1),
(43, 'Duraznos', 100, 4500, 'Vista/Img/imgProductos/1594495131.jpeg', 1),
(44, 'Piñas', 100, 6000, 'Vista/Img/imgProductos/1594495453.jpeg', 1),
(45, 'Uvas', 100, 2500, 'Vista/Img/imgProductos/1594495583.jpeg', 1);


CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigoActivacion` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `proveedor` (`idProveedor`, `nombre`, `correo`, `clave`, `estado`, `codigoActivacion`, `foto`) VALUES
(2, 'Santiago Alejandro', '321@321.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, 'Vista/Img/Users/1594403487.jpeg'),
(33, 'Jose', 'Jose@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, ''),
(34, 'Mauricio', 'Mauricio@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, ''),
(35, 'Angel', 'Angel@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 1, ''),
(36, 'Raul', 'Raul@Hotmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 1, 0, '');


CREATE TABLE `proveedorproducto` (
  `idProveedorProducto` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(50) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);


ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);


ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `factura_ibfk_1` (`idCliente`);


ALTER TABLE `facturaproducto`
  ADD PRIMARY KEY (`idfacturaProducto`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idFactura` (`idFactura`);

ALTER TABLE `log`
  ADD PRIMARY KEY (`idLog`);


ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);


ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);


ALTER TABLE `proveedorproducto`
  ADD PRIMARY KEY (`idProveedorProducto`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);


ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;


ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;


ALTER TABLE `facturaproducto`
  MODIFY `idfacturaProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;


ALTER TABLE `log`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

ALTER TABLE `proveedorproducto`
  MODIFY `idProveedorProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;


ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);


ALTER TABLE `facturaproducto`
  ADD CONSTRAINT `facturaproducto_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `facturaproducto_ibfk_2` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`);


ALTER TABLE `proveedorproducto`
  ADD CONSTRAINT `proveedorproducto_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `proveedorproducto_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`);
COMMIT;
