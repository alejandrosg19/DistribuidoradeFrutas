<?php
$admAux = new Administrador($_POST["idAdm"]);
$admAux -> traerInfo();
$administrador = new Administrador($_POST["idAdm"], "", "", "", $_POST["estado"]);
$administrador->actualizarEstado();

/**Log */
$infoLog = "actor:administrador@idActor:".$admAux->getIdAdministrador()."@Estado:" . $admAux->getEstado();
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
