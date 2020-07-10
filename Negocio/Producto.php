<?php
require_once "Persistencia/ProductoDAO.php";
require_once "Persistencia/Conexion.php";

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $imagen;
    private $estado;
    private $productoDAO;
    private $conexion;

    public function Producto($idProducto = "",$nombre = "", $cantidad = "", $precio = "", $imagen = "",$estado=""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> imagen = $imagen;
        $this -> estado = $estado;
        $this -> productoDAO = new ProductoDAO($this -> idProducto, $this -> nombre, $this -> cantidad, $this -> precio, $this -> imagen, $this -> estado);
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

    public function getEstado(){
        return $this -> estado;
    }

    public function setCantidad($Cantidad){
        $this -> cantidad = $Cantidad;
    }

    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> traerInfo());
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[1];
        $this -> cantidad = $resultado[2];
        $this -> precio = $resultado[3];
        $this -> imagen = $resultado[4];
        $this -> estado = $resultado[5];
        $this -> conexion -> cerrar();
    }

    public function traerInfoNombre(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> traerInfoNombre());
        $resultado = $this -> conexion -> extraer();
        $this -> idProducto = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> cantidad = $resultado[2];
        $this -> precio = $resultado[3];
        $this -> imagen = $resultado[4];
        $this -> estado = $resultado[4];
        $this -> conexion -> cerrar();
    }
    
    public function actualizarProducto(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> actualizarProducto());
        $this -> conexion -> cerrar();
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

    public function cantidadPaginasFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> cantidadPaginasFiltro($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> listarFiltro($filtro,$cantidad,$pagina));
        $arrayProductos = array();
        while(($productoActual = $this -> conexion -> extraer())!=null){
            $newProducto = new Producto($productoActual[0],$productoActual[1],$productoActual[2],$productoActual[3],$productoActual[4],$productoActual[5]);
            array_push($arrayProductos,$newProducto);
        }
        $this -> conexion -> cerrar(); 
        return $arrayProductos;
    }

    public function cantidadPaginasProve($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> cantidadPaginasProve($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltroProve($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> listarFiltroProve($filtro,$cantidad,$pagina));
        $arrayProductos = array();
        while(($productoActual = $this -> conexion -> extraer())!=null){
            $newProducto = new Producto($productoActual[0],$productoActual[1],$productoActual[2],$productoActual[3],$productoActual[4],$productoActual[5]);
            array_push($arrayProductos,$newProducto);
        }
        $this -> conexion -> cerrar(); 
        return $arrayProductos;
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
            $newProducto = new Producto($resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5]);
            array_push($arrayproductos,$newProducto);
        }
        $this -> conexion -> cerrar();
        return $arrayproductos;
    }

    public function actualizarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> actualizarCantidad($this -> cantidad));
        $this -> conexion -> cerrar();
    }

    public function actualizarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> actualizarEstado());
        $this -> conexion -> cerrar();
    }
}
?>