<?php
$idProducto = $_POST["idProducto"];

$carrito = $_SESSION["carrito"]; /*asignando variable sesion a variable carrito*/
$carrito = unserialize($carrito); /*es necesario deserializar por que es un objeto*/

$carritoNuevo = new Carrito();
$band=false;

foreach($carrito -> getArrayProductos() as $productoActual){
    if($productoActual -> getidProducto() != $idProducto){
        $carritoNuevo -> agregarProducto($productoActual);
    }else{
        $band=true;
    }
}
/*No me funciono problema al eliminar el producto 0
/*for ($i=0; $i<count($carrito -> getArrayProductos());$i++) {
    if($carrito -> getArrayProductos()[$i] -> getidProducto() == $idProducto){
        $band=true;
        unset($carrito -> getArrayProductos()[$i]);
    }
}*/

$subtotal = $carritoNuevo -> precioTotal();
$_SESSION["carrito"] = serialize($carritoNuevo);

$array = array(
    "estado" => $band,
    "precio" => $subtotal,
);
$objJSON = json_encode($array);
echo $objJSON;
?>