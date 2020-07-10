<?php
$productoAux = new Producto($_POST["idProducto"]);
$productoAux -> traerInfo();
$producto = new Producto($_POST["idProducto"],"","","","",$_POST["estado"]);
$producto -> actualizarEstado();

/**Log */
$infoLog = "idProducto:".$productoAux->getidProducto()."@Estado:" . $productoAux->getEstado();
date_default_timezone_set('America/Bogota');
$date = date('Y-m-d');
$hora = date('H:i:s');
$log = new Log("", 'Cambio Estado Producto', $infoLog, $date, $hora, "Administrador", $_SESSION["id"]);
$log->insertarLog();

$array = array(
    "estado" => true
);
$objJSON = json_encode($array);
echo $objJSON;
?>