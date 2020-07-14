<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/FacturaDAO.php";

class Factura
{
    private $idFactura;
    private $fecha;
    private $idCliente;
    private $valor;
    private $conexion;
    private $facturaDAO;

    public function Factura($idFactura = "", $fecha = "", $idCliente = "", $valor = 0)
    {
        $this->idFactura = $idFactura;
        $this->fecha = $fecha;
        $this->idCliente = $idCliente;
        $this->valor = $valor;
        $this->conexion = new Conexion();
        $this->facturaDAO = new FacturaDAO($this->idFactura, $this->fecha, $this->idCliente, $this->valor);
    }

    public function getIdFactura()
    {
        return $this->idFactura;
    }
    public function setIdFactura($idFactura)
    {
        $this->idFactura = $idFactura;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> traerInfo());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> fecha = $resultado[1];
        $this -> idCliente = $resultado[2];
        $this -> valor = $resultado[3];
    }
    public function crearFactura(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> crearFactura());
        $this -> conexion -> cerrar();
    }

    public function facturas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> facturas());
        $this -> conexion -> cerrar();
        $arrayFacturas = array();
        while(($facturaActual = $this -> conexion -> extraer())!=null){
            $newFactura = new Factura($facturaActual[0],$facturaActual[1],$facturaActual[2],$facturaActual[3]);
            array_push($arrayFacturas,$newFactura);
        }
        $this -> conexion -> cerrar(); 
        return end( $arrayFacturas );
    }

    public function actualizarValor(){
        $this -> conexion -> abrir();  
        $this -> facturaDAO -> setIdFactura($this -> idFactura);
        $this -> facturaDAO -> setValor($this -> valor);
        $this -> conexion -> ejecutar($this -> facturaDAO -> actualizarValor());
        $this -> conexion -> cerrar();
    }

    public function cantidadPaginasFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> cantidadPaginasFiltro($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> listarFiltro($filtro,$cantidad,$pagina));
        $arrayFacturas = array();
        while(($facturaActual = $this -> conexion -> extraer())!=null){
            $newFactura = new Factura($facturaActual[0],$facturaActual[1],$facturaActual[2],$facturaActual[3]);
            array_push($arrayFacturas,$newFactura);
        }
        $this -> conexion -> cerrar(); 
        return $arrayFacturas;
    }

    public function cantidadPaginasFiltroCliente($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> cantidadPaginasFiltroCliente($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltroCliente($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> listarFiltroCliente($filtro,$cantidad,$pagina));
        $arrayFacturas = array();
        while(($facturaActual = $this -> conexion -> extraer())!=null){
            $newFactura = new Factura($facturaActual[0],$facturaActual[1],$facturaActual[2],$facturaActual[3]);
            array_push($arrayFacturas,$newFactura);
        }
        $this -> conexion -> cerrar(); 
        return $arrayFacturas;
    }
}
?>