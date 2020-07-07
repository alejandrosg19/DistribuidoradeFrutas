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


$pid = base64_decode($_GET["pid"]);
include $pid;
?>