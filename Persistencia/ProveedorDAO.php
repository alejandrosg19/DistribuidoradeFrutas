<?php

class ProveedorDAO{
    private $idProveedor;
    private $nombre;
    private $correo;
    private $clave;
    private $estado;

    public function ProveedorDAO($idProveedor = "", $nombre = "", $correo = "", $clave = "", $estado = ""){
        $this -> idProveedor = $idProveedor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> estado = $estado;
    }

    public function validarCorreo(){
        return "select idProveedor
                from proveedor
                where correo = '" . $this -> correo . "'";
    }
    
    public function registrarProveedor($codigoActivacion){
        return "insert into proveedor 
                values('','".$this -> nombre ."','".$this -> correo."','".md5($this -> clave)."','".$this -> estado."','".md5($codigoActivacion)."')";
    }

    public function autenticar(){
        return "select idProveedor 
                from proveedor
                where correo = '" . $this -> correo ."' and clave = '" . md5($this -> clave) . "'";
    }

    public function traerInfo(){
        return "select idProveedor, nombre, correo
                from proveedor
                where idProveedor = '". $this -> idProveedor ."'";
    }

    public function actualizarInfo(){
        return "update proveedor set nombre = '".$this -> nombre ."', correo = '". $this -> correo ."'
                where idProveedor = '". $this -> idProveedor ."'";
    }

    public function listarProveedor(){
        return "select idProveedor, nombre, correo, clave, estado
                from proveedor";
    }
}
?>