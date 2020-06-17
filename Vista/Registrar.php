<?php
if ($_POST["Rol"] == "Proveedor") {
    $proveedor = new Proveedor("", $_POST["Nombre"], $_POST["Correo"],$_POST["Password"], $_POST["Rol"]);
    if ($proveedor->validarCorreo()) {
        header("Location: index.php?validacion=1");
    } else {
        $proveedor->registrarProveedor();
        header("Location: index.php?validacion=2");
    }
} else if($_POST["Rol"] == "Comprador"){
    $cliente = new Cliente("", $_POST["Nombre"], $_POST["Correo"],$_POST["Password"], $_POST["Rol"]);
    if ($cliente->validarCorreo()) {
        header("Location: index.php?validacion=1");
    } else {
        $cliente->registrarCliente();
        header("Location: index.php?validacion=2");
    }
}
