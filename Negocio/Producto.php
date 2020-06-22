<?php
require_once "Persistencia/ProductoDAO.php";
require_once "Persistencia/Conexion.php";

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $imagen;
    private $productoDAO;
    private $conexion;

    public function Producto($idProducto = "",$nombre = "", $cantidad = "", $precio = "", $imagen = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> imagen = $imagen;
        $this -> productoDAO = new ProductoDAO($this -> idProducto, $this -> nombre, $this -> cantidad, $this -> precio, $this -> imagen);
        $this -> conexion = new Conexion();
    }
    public function getidProducto(){
        return $this -> idProducto;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getCantidad(){
        return $this -> cantidad;
    }

    public function getPrecio(){
        return $this -> precio;
    }

    public function getImagen(){
        return $this -> imagen;
    }

    public function validarProducto(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> validarProducto());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            return true;
        }else{
            return false;
        }
    }

    public function crearProducto(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> crearProducto());
        $this -> conexion -> cerrar();
    }

    public function cantidadPaginas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> cantidadPaginas());
        return $this -> conexion -> extraer();
    }

    public function listarProductos($Cantidad, $Pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> listarProductos($Cantidad,$Pagina));
        $arrayproductos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $newProducto = new Producto($resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4]);
            array_push($arrayproductos,$newProducto);
        }
        $this -> conexion -> cerrar();
        return $arrayproductos;
    }

}
?>