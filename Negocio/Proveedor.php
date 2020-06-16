<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ProveedorDAO.php";

class Proveedor{
    private $idProveedor;
    private $nombre;
    private $correo;
    private $clave;
    private $estado;
    private $conexion;
    private $proveedorDAO;

    public function Proveedor($idProveedor = "", $nombre = "", $correo = "", $clave = "", $estado = ""){
        $this -> idProveedor = $idProveedor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> proveedorDAO = new ProveedorDAO($this -> idProveedor, $this -> nombre, $this -> correo, $this -> clave, $this -> estado);
    }

    public function getIdProveedor(){
        return $this -> idProveedor;
    }
     
    public function getNombre(){
        return $this -> nombre;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getClave(){
        return $this -> Clave;
    }

    public function getEstado(){
        return $this -> estado;
    }

    public function validarCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> validarCorreo());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            return true;
        }else{
            return false;
        }
    }

    public function registrarProveedor(){
        $this -> conexion -> abrir();
        $codigoActivacion  = rand(100,1000);
        $this -> conexion -> ejecutar($this -> proveedorDAO -> registrarProveedor($codigoActivacion));
        $this -> conexion -> cerrar();
    }
}
?>