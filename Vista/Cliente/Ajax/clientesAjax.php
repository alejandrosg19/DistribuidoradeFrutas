<?php
$clienteAux = new Cliente($_POST["idCliente"]);
$clienteAux -> traerInfo();
$cliente = new Cliente($_POST["idCliente"],"","","",$_POST["estado"]);
$cliente -> actualizarEstado();

/**Log */
$infoLog = "actor:cliente@idActor:".$clienteAux->getidCliente()."@Estado:" . $clienteAux->getEstado();
date_default_timezone_set('America/Bogota');
$date = date('Y-m-d');
$hora = date('H:i:s');
$log = new Log("", 'Cambio Estado Usuario', $infoLog, $date, $hora, "Administrador", $_SESSION["id"]);
$log->insertarLog();

$array = array(
    "estado" => true
);
$objJSON = json_encode($array);
echo $objJSON;
?>