<?php
$proveedorAux = new Proveedor($_POST["idProveedor"]);
$proveedorAux -> traerInfo();
$proveedor = new Proveedor($_POST["idProveedor"],"","","",$_POST["estado"]);
$proveedor -> actualizarEstado();

/**Log */
$infoLog = "actor:proveedor@idActor:".$proveedorAux->getIdProveedor()."@Estado:" . $proveedorAux->getEstado();
date_default_timezone_set('America/Bogota');
$date = date('Y-m-d');
$hora = date('H:i:s');
$log = new Log("", 'Cambio Estado', $infoLog, $date, $hora, "Administrador", $_SESSION["id"]);
$log->insertarLog();

$array = array(
    "estado" => true
);
$objJSON = json_encode($array);
echo $objJSON;
?>