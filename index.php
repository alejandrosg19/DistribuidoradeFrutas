<?php
session_start();
require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Proveedor.php";
require_once "Negocio/Producto.php";
require_once "Negocio/Carrito.php";
require_once "Negocio/Factura.php";
require_once "Negocio/ProductoFactura.php";
require_once "Negocio/Log.php";

include "Vista/Main/head.php";

$pid = "";

if (isset($_GET["pid"])) {
    $pid = base64_decode($_GET["pid"]);
} else {
    $_SESSION["id"] = "";
    $_SESSION["rol"] = "";
    $_SESSION["carrito"]="";
}
if (isset($_GET["cerrarSesion"]) || !isset($_SESSION["id"])) {
    $_SESSION["id"] = "";
    $_SESSION["rol"] = "";
    $_SESSION["carrito"]="";
}

$urlsinValidacion = array(
    "Vista/Auth/Autenticar.php",
    "Vista/Registrar.php",
);

if(in_array($pid,$urlsinValidacion)){
    include $pid;
}else if ($_SESSION["id"] != "") {
    if ($_SESSION["rol"] == "Cliente") {
        include "Vista/Cliente/main.php";
    } else if ($_SESSION["rol"] == "Proveedor") {
        include "Vista/Proveedor/main.php";
    } else if ($_SESSION["rol"] == "Administrador") {
        include "Vista/Administrador/main.php";
    }
    include $pid;
} else {
    include "Vista/Main/mainPrincipal.php";
    include "Vista/Main/carrusel.php";
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Yellowtail&display=swap');
</style>

<!--Scrip que permite mostrar el modal alerta de error o succes en mainPrincipal-->
<script>
  $(document).ready(function() {
    $("#mostrarmodal").modal("show");
  });
</script>