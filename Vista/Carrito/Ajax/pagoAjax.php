<?php

$carrito = $_SESSION["carrito"]; /*asignando variable sesion a variable carrito*/
$carrito = unserialize($carrito); /*es necesario deserializar por que es un objeto*/
$arrayProductos = $carrito -> getArrayProductos();

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d");

$idCliente = $_SESSION["id"];

/*se crea la factura pero toca trear el id de esa factura ya que es autoincrementable en db */
$factura = new Factura("",$fecha,$idCliente);
$factura -> crearFactura();
$ultimaFactura = $factura -> facturas();
$idFactura = $ultimaFactura -> getIdFactura();

/*se agrega todos los productos a la base de datos en la tabla productofactura*/
foreach($arrayProductos as $productoActual){
    $productoFactura = new ProductoFactura("",$productoActual -> getidProducto(),$idFactura,$productoActual -> getCantidad(),$productoActual -> getPrecio());
    $productoFactura -> crearProductoFactura();
}

/**se modifica el valor y el id de la factura que se creo en un principio */
$factura -> setValor($carrito -> precioTotal());
$factura -> setIdFactura($idFactura);
$factura -> actualizarValor();

/**Se crea carrito nuevo y se limpia variable carrito del cliente por que se realizo el pago */
$carritoNuevo = new Carrito();
$_SESSION["carrito"] = serialize($carritoNuevo);

$array = array(
    "estado" => $idCliente,
    "facturaID" => $factura -> getIdFactura(),
    "carrito" => $carrito -> precioTotal(),
    "factura" => $factura -> getValor(),
);
$objJSON = json_encode($array);
echo $objJSON;
?>