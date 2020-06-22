<?php

class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $imagen;


    public function ProductoDAO($idProducto = "",$nombre = "", $cantidad = "", $precio = "", $imagen = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> imagen = $imagen;
    }

    public function validarProducto(){
        return "select idProducto 
                from producto  
                where nombre = '" . $this -> nombre ."'";
    }

    public function crearProducto(){
        return "insert into producto (nombre,cantidad,precio,imagen)
                values ('".$this -> nombre."','".$this -> cantidad."','".$this -> precio."','". $this -> imagen."')";
    }

    public function cantidadPaginas(){
        return "select count(idProducto) from producto";
    }

    public function listarProductos($cantidad, $pagina){
        return "select idProducto, nombre, cantidad, precio, imagen
                from Producto
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

}
?>