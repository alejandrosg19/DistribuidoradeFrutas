<?php

class ProductoFacturaDAO
{
    private $idFacturaProducto;
    private $idProducto;
    private $idFactura;
    private $cantidad;
    private $precio;


    public function ProductoFacturaDAO($idFacturaProducto = "", $idProducto = "", $idFactura = "", $cantidad = "",$precio = "")
    {
        $this -> idFacturaProducto = $idFacturaProducto;
        $this -> idProducto = $idProducto;
        $this -> idFactura = $idFactura;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
    }

    
    public function crearProductoFactura(){
        return "insert into facturaproducto (idProducto,idFactura,cantidad,precio)
                values('".$this -> idProducto."','".$this -> idFactura."','".$this -> cantidad."','".$this -> precio."')";
    }

    public function traerfacturaProducto(){
        return "select idfacturaProducto, idProducto, idFactura, cantidad, precio
                from facturaproducto
                where idFactura = '".$this -> idFactura."'";
    }
}
