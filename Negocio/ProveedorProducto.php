<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ProveedorProductoDAO.php";
class ProveedorProducto{
    private $idProveedorProducto;
    private $idProducto;
    private $idProveedor;
    private $cantidad;
    private $precio;
    private $fecha;
    private $conexion;
    private $proveedorProductoDAO;

    public function ProveedorProducto($idProveedorProducto="",$idProducto="",$idProveedor="",$cantidad="",$precio="",$fecha=""){
        $this -> idProveedorProducto = $idProveedorProducto;
        $this -> idProducto = $idProducto;
        $this -> idProveedor = $idProveedor;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> fecha = $fecha;
        $this -> conexion = new Conexion();
        $this -> proveedorProductoDAO = new ProveedorProductoDAO($this -> idProveedorProducto,$this -> idProducto,$this -> idProveedor,$this -> cantidad, $this -> precio,$this -> fecha);
    }

    public function getIdProveedorProducto(){
        return $this -> idProveedorProducto;
    }

    public function getIdProducto(){
        return $this -> idProducto;
    }

    public function getIdProveedor(){
        return $this -> idProveedor;
    }

    public function getCantidad(){
        return $this -> cantidad;
    }

    public function getPrecio(){
        return $this -> precio;
    }

    public function getFecha(){
        return $this -> fecha;
    }

    public function insertar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorProductoDAO -> insertar());
        $this -> conexion -> cerrar();
    }

    public function cantidadPaginasFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorProductoDAO -> cantidadPaginasFiltro($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorProductoDAO -> listarFiltro($filtro,$cantidad,$pagina));
        $arrayOrdenes = array();
        while(($ordenActual = $this -> conexion -> extraer())!=null){
            $newOrden = new ProveedorProducto($ordenActual[0],$ordenActual[1],$ordenActual[2],$ordenActual[3],$ordenActual[4],$ordenActual[5]);
            array_push($arrayOrdenes,$newOrden);
        }
        $this -> conexion -> cerrar(); 
        return $arrayOrdenes;
    }

    public function cantidadPaginasFiltroProve($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorProductoDAO -> cantidadPaginasFiltroProve($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltroProve($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorProductoDAO -> listarFiltroProve($filtro,$cantidad,$pagina));
        $arrayOrdenes = array();
        while(($ordenActual = $this -> conexion -> extraer())!=null){
            $newOrden = new ProveedorProducto($ordenActual[0],$ordenActual[1],$ordenActual[2],$ordenActual[3],$ordenActual[4],$ordenActual[5]);
            array_push($arrayOrdenes,$newOrden);
        }
        $this -> conexion -> cerrar(); 
        return $arrayOrdenes;
    }

    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorProductoDAO -> traerInfo());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idProveedorProducto = $resultado[0];
        $this -> idProducto = $resultado[1];
        $this -> idProveedor = $resultado[2];
        $this -> cantidad = $resultado[3];
        $this -> precio = $resultado[4];
        $this -> fecha = $resultado[5];
    }
}
