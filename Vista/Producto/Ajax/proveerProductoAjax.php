<?php
$precio = intval($_POST["Precio"] / 2);
date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");
$proveer = new ProveedorProducto("", $_POST["idProducto"], $_SESSION["id"], $_POST["Cantidad"], $precio,$fecha);
$proveer -> insertar();
$producto = new Producto($_POST["idProducto"]);
$producto->traerInfo();
$cantidadAux = $producto -> getCantidad();
$producto->setCantidad($producto->getCantidad() + $_POST["Cantidad"]);
$producto->actualizarCantidad();

$infoLog = "id:" . $producto->getidProducto()."-cantidad:".$cantidadAux;
date_default_timezone_set('America/Bogota');
$date = date('Y-m-d');
$hora = date('H:i:s');
$log = new Log("", 'Proveer Producto', $infoLog, $date, $hora, "Proveedor", $_SESSION["id"]);
$log->insertarLog();

$array = array(
    "estado" => true,  
    "id" => $_POST["idProducto"],
    "cantidad" => $_POST["Cantidad"],
    "Precio" => $precio,
);
$objJSON = json_encode($array);
echo $objJSON;