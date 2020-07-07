<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ProductoFacturaDAO.php";

class ProductoFactura
{
    private $idFacturaProducto;
    private $idProducto;
    private $idFactura;
    private $cantidad;
    private $precio;
    private $conexion;
    private $productoFacturaDAO;

    public function ProductoFactura($idFacturaProducto = "", $idProducto = "", $idFactura = "", $cantidad = "",$precio = "")
    {
        $this -> idFacturaProducto = $idFacturaProducto;
        $this -> idProducto = $idProducto;
        $this -> idFactura = $idFactura;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> conexion = new Conexion();
        $this -> productoFacturaDAO = new ProductoFacturaDAO($this -> idFacturaProducto, $this -> idProducto, $this -> idFactura, $this -> cantidad, $this -> precio);
    }

    public function getidFacturaProducto()
    {
        return $this->idFacturaProducto;
    }

    public function getidProducto()
    {
        return $this->idProducto;
    }

    public function getidFactura()
    {
        return $this->idFactura;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function crearProductoFactura(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoFacturaDAO -> crearProductoFactura());
        $this -> conexion -> cerrar();
    }

    public function traerfacturaProducto(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoFacturaDAO -> traerfacturaProducto());
        $arrayP = array();
        while(($facturaProducto = $this -> conexion -> extraer())!=null){
            $NewfacturaProducto = new ProductoFactura($facturaProducto[0],$facturaProducto[1],$facturaProducto[2],$facturaProducto[3],$facturaProducto[4]);
            array_push($arrayP,$NewfacturaProducto);
        }
        $this -> conexion -> cerrar(); 
        return $arrayP;
    }
}
?>