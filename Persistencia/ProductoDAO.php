<?php

class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $imagen;
    private $estado;

    public function ProductoDAO($idProducto = "",$nombre = "", $cantidad = "", $precio = "", $imagen = "",$estado = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> imagen = $imagen;
        $this -> estado = $estado;
    }

    public function traerInfo(){
        return "select idProducto, nombre, cantidad, precio, imagen, estado
                from producto
                where idProducto = '". $this -> idProducto ."'";
    }

    public function traerInfoNombre(){
        return "select idProducto, nombre, cantidad, precio, imagen, estado
                from producto
                where nombre = '". $this -> nombre ."'";
    }

    public function actualizarProducto(){
        return "update producto set 
                nombre = '".$this -> nombre ."', cantidad = '".$this -> cantidad."', precio = '".$this -> precio."', imagen = '".$this -> imagen."', estado = '".$this -> estado."'
                where idProducto = '".$this -> idProducto."'";
    }
    
    public function validarProducto(){
        return "select idProducto 
                from producto  
                where nombre = '" . $this -> nombre ."'";
    }

    public function crearProducto(){
        return "insert into producto (nombre,cantidad,precio,imagen,estado)
                values ('".$this -> nombre."','".$this -> cantidad."','".$this -> precio."','". $this -> imagen."','".$this -> estado."')";
    }

    public function cantidadPaginasFiltro($filtro){
        return "select count(idProducto) 
                from producto
                where idProducto like '%".$filtro."%' or nombre like '".$filtro."%'";
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        return "select idProducto, nombre, cantidad, precio, imagen, estado
                from producto
                where idProducto like '%".$filtro."%' or nombre like '".$filtro."%'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function cantidadPaginasProve($filtro){
        return "select count(idProducto) 
                from producto
                where (idProducto like '%".$filtro."%' or nombre like '".$filtro."%')
                and estado = '0'";
    }

    public function listarFiltroProve($filtro,$cantidad,$pagina){
        return "select idProducto, nombre, cantidad, precio, imagen, estado
                from producto
                where (idProducto like '%".$filtro."%' or nombre like '".$filtro."%') and estado = '0'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function cantidadPaginas(){
        return "select count(idProducto) from producto";
    }

    public function listarProductos($cantidad, $pagina){
        return "select idProducto, nombre, cantidad, precio, imagen, estado 
                from Producto
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function actualizarCantidad($Nuevacantidad){
        return "update producto set cantidad= '".$Nuevacantidad."' where idProducto = '".$this -> idProducto."'";
    }

    public function actualizarEstado(){
        return "update producto set estado = '". $this -> estado ."' where idProducto = '". $this -> idProducto. "'";
    }

}
?>