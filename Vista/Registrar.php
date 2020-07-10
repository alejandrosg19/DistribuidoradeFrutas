<?php

$log;
date_default_timezone_set('America/Bogota');
$date = date('Y-m-d');
$hora = date('H:i:s');
$proveedor = new Proveedor("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
$cliente = new Cliente("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);

if ($_POST["Rol"] == "Proveedor") {

    if ($proveedor->validarCorreo() || $cliente->validarCorreo()) {
        header("Location: index.php?validacion=1");
    } else {
        $proveedor->registrarProveedor();
        $proveedor->traerInfoCorreo();
        /**log */
        $log = new Log("", 'Nuevo Usuario', "", $date, $hora, "Proveedor", $proveedor->getIdProveedor());
        $log->insertarLog();
        header("Location: index.php?validacion=2");
    }
} else if ($_POST["Rol"] == "Comprador") {

    if ($proveedor->validarCorreo() || $cliente->validarCorreo()) {
        header("Location: index.php?validacion=1");
    } else {
        $cliente->registrarCliente();
        $cliente->traerInfoCorreo();
        /**Log */
        $log = new Log("", 'Nuevo Usuario', "", $date, $hora, "Cliente", $cliente->getidCliente());
        $log->insertarLog();
        header("Location: index.php?validacion=2");
    }
}
