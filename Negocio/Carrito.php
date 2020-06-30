<?php
require_once "Negocio/Producto.php";

class Carrito
{
    private $arrayProductos;

    public function Carrito()
    {
        $this->arrayProductos = array();
    }

    public function getArrayProductos()
    {
        return $this->arrayProductos;
    }

    public function setArrayProductos($arrayProductos)
    {
        $this -> arrayProductos = $arrayProductos;
    }

    public function agregarProducto($newProducto)
    {
        array_push($this->arrayProductos, $newProducto);
    }

    public function infoProductos()
    {
        foreach ($this->arrayProductos  as $productoActual) {
            echo "<br>idProducto = " . $productoActual->getidProducto() . "Nombre: " . $productoActual->getNombre() . "Cantidad: " . $productoActual->getCantidad()
                . " Precio: " . $productoActual->getPrecio() . " Imagen: " . $productoActual->getImagen();
        }
    }

    public function precioTotal()
    {
        $valor = 0;
        foreach ($this->arrayProductos  as $productoActual) {
            $valor += $productoActual->getCantidad() * $productoActual->getPrecio();
        }
        return $valor;
    }
}
