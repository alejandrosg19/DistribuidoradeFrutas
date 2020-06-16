<?php

$cliente = new Cliente("", "", $_POST["Correo"], $_POST["Clave"]);
$proveedor = new Proveedor("", "", $_POST["Correo"], $_POST["Clave"]);
$administrador = new Administrador("", "", $_POST["Correo"], $_POST["Clave"]);

if ($cliente->autenticar()) {
    $_SESSION["id"] = $cliente -> getidCliente();
    $_SESSION["rol"] = "Cliente";
    header("Location: index.php?pid=". base64_encode("Vista/Cliente/sesionCliente.php"));
} else if ($proveedor->autenticar()) {
    $_SESSION["id"] = $proveedor -> getIdProveedor();
    $_SESSION["rol"] = "Proveedor";
    header("Location: index.php?pid=". base64_encode("Vista/Proveedor/sesionProveedor.php"));
} else if ($administrador->autenticar()) {
    $_SESSION["id"] = $administrador -> getIdAdministrador();
    $_SESSION ["rol"] = "Administrador";
    header("Location: index.php?pid=". base64_encode("Vista/Administrador/sesionAdministrador.php"));
}else{
    header("Location: index.php?validacion=3");
}
