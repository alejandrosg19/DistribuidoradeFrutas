<?php
$cliente = new Cliente($_POST["idCliente"],"","","",$_POST["estado"]);
$cliente -> actualizarEstado();
$array = array(
    "estado" => true
);
$objJSON = json_encode($array);
echo $objJSON;
?>