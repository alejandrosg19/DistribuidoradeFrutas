<?php
session_start();

require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Proveedor.php";

include "Vista/Main/head.php";

$pid = null;

if (isset($_GET["pid"])) {
    $pid = base64_decode($_GET["pid"]);
    include $pid;
} else {
    
    include "Vista/Main/mainPrincipal.php";
    
}

include "Vista/Main/carrusel.php";

