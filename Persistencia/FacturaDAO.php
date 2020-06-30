<?php
class FacturaDAO{
    private $idFactura;
    private $fecha;
    private $idCliente;
    private $valor;


    public function FacturaDAO($idFactura = "", $fecha = "", $idCliente = "", $valor = "")
    {
        $this->idFactura = $idFactura;
        $this->fecha = $fecha;
        $this->idCliente = $idCliente;
        $this->valor = $valor;
    }

    public function setIdFactura($idFactura)
    {
        $this->idFactura = $idFactura;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function crearFactura(){
        return "insert into factura values('".$this -> idFactura."','".$this -> fecha."','".$this -> idCliente."','".$this -> valor."')";
    }

    public function facturas(){
        return "select * from factura";
    }

    public function actualizarValor(){
        return "update factura set valor = '".$this -> valor."' where idFactura = '".$this -> idFactura."'";
    }
}
?>