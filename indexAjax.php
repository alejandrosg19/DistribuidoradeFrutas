<?php
require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Proveedor.php";
require_once "Negocio/Producto.php";


$pid = base64_decode($_GET["pid"]);
include $pid;
?>