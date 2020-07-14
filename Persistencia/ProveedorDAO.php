<?php

class ProveedorDAO{
    private $idProveedor;
    private $nombre;
    private $correo;
    private $clave;
    private $estado;
    private $foto;

    public function ProveedorDAO($idProveedor = "", $nombre = "", $correo = "", $clave = "", $estado = "",$foto = ""){
        $this -> idProveedor = $idProveedor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> estado = $estado;
        $this -> foto = $foto;
    }

    public function validarCorreo(){
        return "select idProveedor
                from proveedor
                where correo = '" . $this -> correo . "'";
    }
    
    public function registrarProveedor($codigoActivacion){
        return "insert into proveedor (nombre,correo,clave,estado,codigoActivacion) 
                values('".$this -> nombre ."','".$this -> correo."','".md5($this -> clave)."','0','".md5($codigoActivacion)."')";
    }

    public function autenticar(){
        return "select idProveedor 
                from proveedor
                where correo = '" . $this -> correo ."' and clave = '" . md5($this -> clave) . "'";
    }

    public function traerInfo(){
        return "select idProveedor, nombre, correo, estado, foto
                from proveedor
                where idProveedor = '". $this -> idProveedor ."'";
    }
    public function traerInfoCorreo(){
        return "select idProveedor, nombre, correo, estado, foto
                from proveedor
                where correo = '". $this -> correo ."'";
    }

    public function actualizarInfo(){
        return "update proveedor set nombre = '".$this -> nombre ."', correo = '". $this -> correo ."', foto = '".$this -> foto."'
                where idProveedor = '". $this -> idProveedor ."'";
    }

    public function listarProveedor(){
        return "select idProveedor, nombre, correo, clave, estado, foto
                from proveedor";
    }

    public function cantidadPaginasFiltro($filtro){
        return "select count(idProveedor) 
                from proveedor
                where idProveedor like '%".$filtro."%' or nombre like '".$filtro."%' or correo like '".$filtro."%'";
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        return "select idProveedor, nombre, correo, estado
                from proveedor
                where idProveedor like '%".$filtro."%' or nombre like '".$filtro."%' or correo like '".$filtro."%'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function actualizarEstado(){
        return "update proveedor set estado = '". $this -> estado ."' where idProveedor = '". $this -> idProveedor. "'";
    }
}
?>