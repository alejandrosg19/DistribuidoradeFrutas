<?php

$carrito;

$carrito = $_SESSION["carrito"]; /*asignando variable sesion a variable carrito*/
$carrito = unserialize($carrito); /*es necesario deserializar por que es un objeto*/

$band = false;
for ($i = 0; $i < count($carrito->getArrayProductos()); $i++) { /**Valida si el cliente vuelve a sleccionar la misma fruta y aumenta la cantidad comprada */
    if ($carrito->getArrayProductos()[$i]->getidProducto() == $_POST["idProducto"]) {
        $band = true;
        $carrito->getArrayProductos()[$i]->setCantidad($carrito->getArrayProductos()[$i]->getCantidad()+$_POST["Cantidad"]);
    }
}
if ($band == false) {
    $producto = new Producto($_POST["idProducto"], $_POST["Nombre"], $_POST["Cantidad"], $_POST["Precio"], $_POST["Imagen"]);
    $carrito->agregarProducto($producto);
}


$_SESSION["carrito"] = serialize($carrito);

$array = array(
    "estado" => true,
    "cantidad" => count($carrito->getArrayProductos()),
);
$objJSON = json_encode($array);
echo $objJSON;
