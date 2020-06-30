<?php
$idProducto = $_POST["idProducto"];

$carrito = $_SESSION["carrito"]; /*asignando variable sesion a variable carrito*/
$carrito = unserialize($carrito); /*es necesario deserializar por que es un objeto*/

$band=false;
$info="";
for ($i=0; $i<count($carrito -> getArrayProductos());$i++) {
    if($carrito -> getArrayProductos()[$i] -> getidProducto() == $idProducto){
        $band=true;
        $carrito -> getArrayProductos()[$i] -> setCantidad($_POST["cantidad"]);
    }
}

$_SESSION["carrito"] = serialize($carrito);

$array = array(
    "estado" => $band,
    "precio" => $carrito -> precioTotal(),
);
$objJSON = json_encode($array);
echo $objJSON;
?>